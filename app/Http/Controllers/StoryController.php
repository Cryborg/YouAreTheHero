<?php

namespace App\Http\Controllers;

use App\Bases\ControllerBase;
use App\Models\Character;
use App\Models\Field;
use App\Models\Genre;
use App\Models\Item;
use App\Models\Page;
use App\Models\Story;
use App\Models\User;
use App\Repositories\ChoiceRepository;
use App\Repositories\PageRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;
use Spatie\Activitylog\Models\Activity;

class StoryController extends ControllerBase
{
    /** @var PageRepository $page */
    protected $page;

    public function __construct(PageRepository $page)
    {
        $this->page = $page;

        parent::__construct();
    }

    public function index(Request $request)
    {
        unsetSession();

        $selectedLanguage = $request->get('language');

        $query = Story::select()
                      ->orderByDesc('updated_at');

        $draft = $request->get('draft') == '1';

        if ($draft) {
            $query->where('is_published', false)
                  ->where('user_id', Auth::id());
        }

        if (!$this->authUser->hasRole('admin')) {
            $query->where('user_id', $this->authUser->id)
                  ->orWhere('is_published', true);
        }

        if ($selectedLanguage) {
            $query->where('locale', $selectedLanguage);
        } else {
            // By default look for stories in the same language as the user's
            $userLocale = $this->authUser->locale;
            $selectedLanguage = $userLocale;
            $query->where('locale', $userLocale);
        }

        $stories = $query->get();

        // Count words in the whole story. Cache this later
        $activities = Activity::where('subject_type', Story::class)->get();

        $stories->map(function ($story) use ($activities) {
            // Count words and pages
            $story->wordsCount = 0;
            $story->pagesCount = $story->pages()->count();
            $story->pages->map(static function ($page) use ($story) {
                $story->wordsCount += count(explode(' ', $page->content));
            });

            // Statistics
            $activity = $activities->where('subject_id', $story->id);
            $story->statistics = [
                'games_played'      => $activity->where('log_name', 'new_game')->count(),
                'games_reset'       => $activity->where('log_name', 'reset_game')->count(),
                'games_finished'    => $activity->where('log_name', 'end_game')->count(),
                'unique_players'    => Activity::where('subject_type', Story::class)
                                               ->where('log_name', 'new_game')
                                               ->where('subject_id', $story->id)
                                               ->distinct('causer_id')->count(),
            ];
        });

        // List stories in other languages
        $storiesLocales = Story::distinct('locale')->get('locale');

        return View::make('stories.list', [
            'user' => $this->authUser,
            'stories' => $stories,
            'storiesLocales' => $storiesLocales,
            'selectedLanguage' => !empty($selectedLanguage) ? $selectedLanguage : null
        ]);
    }

    public function indexDraft()
    {
        unsetSession();

        return view('stories.list_drafts', [
            'stories' => $this->authUser->stories
        ]);
    }

    public function getPlayAnonymous(): RedirectResponse
    {
        // Create a fake, temporary user
        $newUser = User::factory()->temporary()->create();

        // Log the newly created user
        Auth::login($newUser);

        // FIXME!
        $tutoId = App::getLocale() === 'fr_FR' ? 23 : 28;

        // Go to the tuto story
        return Redirect::route('story.play', ['story' => $tutoId]);
    }

    /**
     * @param \App\Models\Story     $story
     * @param \App\Models\Page|null $page
     */
    public function getPlay(Story $story, Page $page = null)
    {
        // Check if the user has an already existing character for this story
        $character = $story->currentCharacter();

        // If there is an ID, save it in the session so that we show a nice URL without the page ID
        if ($page !== null) {
            setSession('page_id', $page->id);
            return Redirect::route('story.play', ['story' => $story->id]);
        }

        $page_id = getSession('page_id');

        if (!empty($page_id)) {
            $page = Page::where('id', $page_id)->first();
        }

        setSession('story_id', $story->id);

        // If the character does not exist, it is a new game
        if (!$character) {
            $character = Character::createNewForStory($story);

            if ($story->options && $story->options->has_character) {
                return Redirect::route('character.create', [
                    'story' => $story->id,
                ]);
            }
        }

        // The character exists, let's go back to the previous save point
        // Get the last visited page
        if ($page === null || empty($page)) {
            $page = $story->getCurrentPage($character->page_id);

            if ($page->is_last) {
                // TODO: Reset the story for this player, because there is no point in
                //       accessing a finished story on the last page

            }
        }

        if (!$page->is_last) {
            ChoiceRepository::getFilteredChoicesFromPage($page, $character);
        }

        $character->update(['page_id' => $page->id]);

        setSession('character_id', $character->id);
        $this->saveCheckpoint($character, $page);

        $visitedPlaces = $character->pages;

        $items = $this->showItems($character, $page);

        // Check if there is an action bound to this page, and execute it
        $messages = $this->executeAction($page, $character);

        $view = null;

        // Params that are always returned to the view
        $commonParams = [
            'story' => $story,
            'title' => $story->title,
            'character' => $character,
            'refreshChoices' => true,
        ];

        $page->load('descriptions');

        if (\Illuminate\Support\Facades\Request::ajax()) {
            $view = view('layouts.partials.page_content',
                         $commonParams + [
                             'page'             => $page,
                             'items'            => $items,
                             'messages'         => $messages,
                         ]);
        } else {
            // First display of the page
            $view = view('story.play',
                         $commonParams + [
                             'page'          => $page,
                             'items'         => $items,
                             'layout'        => $page->layout ?? $story->layout,
                             'character'     => $character,
                             'visitedPlaces' => $visitedPlaces,
                             'messages'      => $messages,
                         ]
            );
        }

        if ($page->is_last) {
            if (!$this->authUser->hasRole('admin')) {
                activity()
                    ->performedOn($story)
                    ->useLog('end_game')
                    ->log($page->ending_type);
            }
        }

        return $view ?? view('errors.404');
    }

    /**
     * @param Character $character
     * @param Page      $page
     */
    private function saveCheckpoint(Character $character, $page): void
    {
        if ($page && $page->is_checkpoint) {
            $character->pages()
                      ->syncWithoutDetaching($page->id);
        }
    }

    /**
     * Only show items on the page that:
     * - are not in the character inventory (if the item is unique)
     *
     * @param \App\Models\Character $character
     * @param \App\Models\Page      $page
     *
     * @return array
     */
    private function showItems(Character $character, Page $page)
    {
        $items = [];

        foreach ($page->items as $pageItem) {
            $canBeShown = true;

            foreach ($character->items as $characterItem) {
                // If the character owns the item
                if ($characterItem->id === $pageItem->id) {
                    // If it is unique, don't show it
                    $canBeShown = (bool) $pageItem->is_unique === false;

                    continue;
                }
            }

            if ($canBeShown) {
                if ($pageItem->category) {
                    $items[$pageItem->category][] = $pageItem;
                } else {
                    $items[trans('constants.no_category')][] = $pageItem;
                }
            }
        }

        return $items;
    }

    /**
     * @param \App\Models\Page      $page
     * @param \App\Models\Character $character
     *
     * @return array
     */
    private function executeAction(Page $page, Character $character): array
    {
        // Will contain messages such as "You lost 1 gold coin" or "You gained 2 health points"
        $messages = [];

        foreach ($page->triggers as $trigger) {
            // If this is a Field
            if ($trigger->actionable instanceof Field) {
                $field = $character->fields->where('pivot.field_id', $trigger->actionable->id)
                                           ->first();

                // Check if the action has already been done
                // Don't do it again if it is the case
                if ($character->actions->where('pivot.action_id', $trigger->id)
                                       ->count() === 0) {

                    if (!$field) {
                        $character->fields()->attach($trigger->actionable->id, ['value' => $trigger->quantity]);
                        $saved = true;
                    } else {
                        $field->pivot->value += $trigger->quantity;
                        $saved = $field->pivot->save();
                    }

                    if ($saved) {
                        $character->actions()->syncWithoutDetaching($trigger->id);

                        // Don't show any message to the player if the Field is hidden
                        if ($trigger->hidden === false) {
                            $messages[] = [
                                'text' => $trigger->quantity > 0
                                    ? trans('common.you_earned_something', [
                                        'quantity' => $trigger->quantity,
                                        'item'     => $trigger->actionable->name,
                                    ])
                                    : trans('common.you_lost_something', [
                                        'quantity' => $trigger->quantity * -1,
                                        'item'     => $trigger->actionable->name,
                                    ]),
                                'type' => $trigger->quantity > 0 ? 'success' : 'warning',
                            ];
                        }
                    }
                }
            }

            // If this is an item
            if ($trigger->actionable instanceof Item) {
                $item = $trigger->actionable;

                // Check if the action has already been done
                $nbActionsDone = $character->actions->where('pivot.action_id', $trigger->id)
                                                    ->count();

                if ($nbActionsDone === 0) {
                    $character->actions()->syncWithoutDetaching($trigger->id);

                    if ($trigger->quantity > 0) {
                        $item->take($page);
                    } else {
                        $item->throwAway();
                    }

                    $messages[] = [
                        'text' => $trigger->quantity > 0
                            ? trans('common.you_earned_something', [
                                'quantity' => $trigger->quantity,
                                'item'     => $item->name,
                            ])
                            : trans('common.you_lost_something', [
                                'quantity' => $trigger->quantity * -1,
                                'item'     => $item->name,
                            ]),
                        'type' => $trigger->quantity > 0 ? 'success' : 'warning',
                    ];
                }
            }
        }

        return $messages;
    }

    /**
     * Get a character's inventory
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function inventory()
    {
        $character = Character::find(getSession('character_id'));

        return view('story.partials.inventory', [
            'items'     => $this->showItemsInInventory($character),
            'character' => $character,
        ]);
    }

    private function showItemsInInventory(Character $character)
    {
        $items = [];

        foreach ($character->items as $characterItem) {
            if ($characterItem->category) {
                $items[$characterItem->category][] = $characterItem;
            } else {
                $items[trans('constants.no_category')][] = $characterItem;
            }
        }

        return $items;
    }

    /**
     * @param \App\Models\Story $story
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sheet(Story $story)
    {
        $character = $story->currentCharacter();

        return view('story.partials.sheet', [
            'fields'             => $character->fields,
            'show_hidden_fields' => Auth::id() === $story->user->id,
        ]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'story_id'     => '',
            'title'        => 'required',
            'description'  => 'required',
            'locale'       => 'required',
            'layout'       => 'required',
            'is_published' => 'boolean',
            'genres'       => 'required|array|between:1,5',
        ]);

        $validated['is_published'] = $request->has('is_published');
        $storyId                   = $validated['story_id'] ?? null;
        $genres                    = $validated['genres'];
        unset($validated['genres'], $validated['story_id']);

        $data = [
            'storyIsNew' => false
        ];

        try {
            if ($storyId !== null) {
                $story = Story::where('id', $storyId)->firstOrFail();

                $story->update($validated);
            } else {
                $story = Story::create($validated);
                $story->options()->create($validated);

                // Create the first page with dummy data
                Page::factory()->create([
                    'story_id' => $story->id,
                    'is_first' => true,
                ]);

                $data = [
                    'storyIsNew' => true,
                ];
            }

            $story->genres()->sync($genres);

            $data['story'] = $story->id;

            Session::flash('message', trans('model.save_successful'));
        } catch (\Exception $e) {
            Session::flash('message', trans('model.save_successful'));
            \flash(trans('model.save_error'), 'error');
        }

        return Redirect::to(route('story.edit', $data));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Story        $story
     *
     * @return \Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function getEdit(Request $request, Story $story)
    {
        $this->authorize('edit', $story);

        return $this->getCreate($story, $request->all());
    }

    /**
     * @param null $story
     *
     * @param null $data
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function getCreate($story = null, $data = [])
    {
        $data += [
            'title'            => trans('story.create_title'),
            'locales'          => getLanguages(),
            'layouts'          => [
                'play1' => 'Premier layout',
            ],
            'story'            => $story,
            'route'            => 'story.create.post',
            'contexts'         => ['story_creation'],
        ];

        // Translate story genres and sort them alphabetically
        $genres = Genre::all();
        $orderdGenres = collect();
        $genres->each(static function ($genre) use ($orderdGenres) {
            $genre->label = trans('story.writing_genre_' . $genre->label);
            $orderdGenres->push($genre);
        });

        $data['genres'] = $orderdGenres->where('hidden', false)->sortBy('label');
        $data['audiences'] = $orderdGenres->where('hidden', true)->sortBy('id');
        $data['max_points_to_share'] = $story ? $story->maxPointsToShare() : 10;

        /*****************\
        * User Successes *
        \*****************/
        $data['storyIsNew'] = isset($data['storyIsNew']) && (bool)$data['storyIsNew'] === true;
        $data['isPublished'] = isset($data['story']) && (bool)$data['story']->is_published === true;

        $this->saveUserSuccess($data);

        $view = View::make('story.create', $data);

        return $view;
    }

    public function getReset(Story $story, string $play = null)
    {
        $character = $story->currentCharacter();

        if ($character !== null) {
            $deleted = (bool) $character->delete();
            Cache::forget('character_' . $character->id);
            setSession('character_id', null);
            setSession('story_id', null);

            if ($deleted === true) {
                Flash::success(trans('story.reset_successful_text'));

                if (!$this->authUser->hasRole('admin')) {
                    activity()
                        ->performedOn($story)
                        ->useLog('reset_game')
                        ->log('reset');
                }
            } else {
                Flash::error(trans('story.reset_failed_text'));
            }
        }

        Session::remove('story');

        if ($play !== null) {
            return Redirect::route('story.play', $story);
        }

        return Redirect::route('stories.list');
    }

    public function delete(Story $story)
    {
        $this->authorize('view', $story);

        DB::beginTransaction();
        $success = $story->delete();

        if ($success) {
            DB::commit();
        } else {
            DB::rollBack();
        }

        return response()->json([
            'success' => $success,
            'type' => 'delete',
        ]);
    }

    public function hasErrors(Story $story)
    {
        return PageController::hasErrors($story);
    }

    public function errors(Story $story)
    {
        $errors = PageController::getErrors($story);

        return View::make('story.errors', [
            'story'       => $story,
            'deadEnds'    => $errors['deadEnds'],
            'orphans'     => $errors['orphans'],
            'unusedItems' => $errors['unusedItems'],
            'unusedFields'=> $errors['unusedFields'],
            'emptyRiddles'=> $errors['emptyRiddles'],
            'hasErrors'   => $errors['deadEnds']->count() > 0
                                  || $errors['orphans']->count() > 0
                                  || $errors['unusedItems']->count() > 0
                                  || $errors['emptyRiddles']->count() > 0
                                  || $errors['unusedFields']->count() > 0,
        ]);
    }
}
