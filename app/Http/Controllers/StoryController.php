<?php

namespace App\Http\Controllers;

use App\Classes\Action;
use App\Models\Field;
use App\Models\Genre;
use App\Models\Inventory;
use App\Models\Item;
use App\Models\CharacterField;
use App\Models\StoryGenre;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use \App\Models\Story;
use \App\Models\Character;
use \App\Models\Page;
use \App\Models\Choice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use App\Repositories\PageRepository;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;

class StoryController extends Controller
{
    /** @var PageRepository $page */
    protected $page;

    public function __construct(PageRepository $page)
    {
        $this->middleware('auth');

        $this->page = $page;
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

        // Params that are always returned to the view
        $commonParams = [
            'story' => $story,
            'title' => $story->title,
        ];

        // If the character does not exist, it is a new game
        if (!$character) {
            $storyOption = $story->story_options();

            // If no option needs to be set, create an unnamed character
            if ($storyOption->count() === 0 || $story->story_options->has_character == false) {
                Character::create([
                   'name'     => 'Unnamed',
                   'user_id'  => Auth::id(),
                   'story_id' => $story->id,
                   'page_id'  => $story->getCurrentPage()->id,
               ]);

                return Redirect::route('story.play', [
                    'story' => $story->id,
                ]);
            }

            return Redirect::route('character.create', [
                'story' => $story->id,
            ]);
        }

        // The character exists, let's go back to the previous save point
        // Get the last visited page
        if ($page === null || empty($page)) {
            $page = $story->getCurrentPage($character->page_id);
        }

        if ($page) {
            if ($page->is_last) {
                // FIXME
                $page->choices = 'gameover';
            }
            else {
                $this->getFilteredChoicesFromPage($page, $character);
            }

            $character->update(['page_id' => $page->id]);
        }

        setSession('character_id', $character->id);
        $this->saveCheckpoint($character, $page);

        $visitedPlaces = $character->pages;

        $items = $this->filterItems($character, $page);

        // Check if there is an action bound to this page, and execute it
        $messages = $this->executeAction($page, $character);

        // First display of the page
        $view = view('story.play', $commonParams + [
                'page'          => $page,
                'items'         => $items,
                'layout'        => $page->layout ?? $story->layout,
                'character'     => $character,
                'visitedPlaces' => $visitedPlaces,
                'messages'      => $messages,
            ]
        );

        if (\Illuminate\Support\Facades\Request::ajax()) {
            $view = view('layouts.partials.page_content', $commonParams + [
                'page'      => $page,
                'items'     => $items,
                'messages'  => $messages,
            ]);
        }

        return $view ?? view('errors.404');
    }

    /**
     * @param \App\Models\Page      $page
     * @param \App\Models\Character $character
     */
    private function executeAction(Page $page, Character $character)
    {
        // Will contain messages such as "You lost 1 gold coin" or "You gained 2 health points"
        $messages = [];

        foreach ($page->trigger as $trigger)
        {
            if ($trigger->actionable instanceof Field) {
                $field = $character->fields->where('pivot.field_id', $trigger->actionable->id)->first();

                // Check if the action has already been done
                // Don't do it again if it is the case
                if ($character->actions->where('pivot.action_id', $trigger->id)->count() === 0) {
                    $field->pivot->value += $trigger->quantity;
                    if ($field->pivot->save())
                    {
                        $messages[] = [
                            'text' => $trigger->quantity > 0
                                ? trans('common.you_earned_something', [
                                    'quantity' => $trigger->quantity,
                                    'item'     => $trigger->actionable->name
                                ])
                                : trans('common.you_lost_something', [
                                    'quantity' => $trigger->quantity * -1,
                                    'item'     => $trigger->actionable->name
                                ]),
                            'type' => $trigger->quantity > 0 ? 'success' : 'warning',
                        ];
                    }
                }
            }

            // If this is an item
            if ($trigger->actionable instanceof Item) {
                // If the character has something in his inventory
                if ($character->items()->count() > 0) {
                    foreach ($character->inventory as $inventory) {
                        // If the character has the item in the inventory
                        if ($inventory->item == $trigger->actionable) {
                            if ($character->actions->where('pivot.action_id', $trigger->id)->count() === 0) {
                                $inventory->quantity += $trigger->quantity;

                                if ($inventory->save()) {
                                    $messages[] = [
                                        'text' => $trigger->quantity > 0
                                            ? trans('common.you_earned_something', [
                                                     'quantity' => $trigger->quantity,
                                                     'item'     => $trigger->actionable->name
                                                 ])
                                            : trans('common.you_lost_something', [
                                                  'quantity' => $trigger->quantity * -1,
                                                  'item'     => $trigger->actionable->name
                                              ]),
                                        'type' => $trigger->quantity > 0 ? 'success' : 'warning',
                                    ];
                                }
                            }
                        }
                    }
                }

            }

            $character->actions()->syncWithoutDetaching($trigger->id);
        }

        return $messages;
    }

    /**
     * Get all the choices (links to the next page) based on page prerequisites.
     *
     * @param \App\Models\Page      $currentPage
     * @param \App\Models\Character $character
     *
     * @return mixed
     */
    private function getFilteredChoicesFromPage(Page $currentPage, Character $character)
    {
        // Get all the choices (links to the next page(s)
        $allChoices   = $this->getAllChoicesForPage($currentPage);
        $finalChoices = [];
        $unreachableChoices = [];

        // Check if there are prerequisites, and that they are fulfilled
        foreach ($allChoices as $choice) {
            $fulfilled = false;
            $pageTo    = $choice->pageTo;

            if ($pageTo && $pageTo->prerequisites()->count() > 0) {
                foreach ($pageTo->prerequisites() as $prerequisite) {
                    switch (get_class($prerequisite->prerequisiteable)) {
                        case CharacterField::class:
                            $fulfilled = $this->isStatPrerequisitesFulfilled($prerequisite->prerequisiteable, $character);
                            break;
                        case Item::class:
                            $fulfilled = $this->isItemPrerequisitesFulfilled($prerequisite->prerequisiteable, $character);
                            break;
                    }
                }
            }
            else {
                $fulfilled = true;
            }

            if ($fulfilled) {
                $finalChoices[] = $choice;
            } else {
                $unreachableChoices[] = $choice;
            }
        }

        $currentPage->filtered_choices = $finalChoices;
        $currentPage->unreachable_choices = $unreachableChoices;

        // Log if there is no choice, and the story is not finished
        if (!$currentPage->is_last && count($currentPage->filtered_choices) === 0) {
            activity()
                ->performedOn($currentPage)
                ->log('The player has nowhere to go!');
        }
    }

    /**
     * Get a character's inventory
     *
     * @param \App\Models\Story $story
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function inventory(Story $story)
    {
        $character = Character::find(getSession('character_id'));

        return view('story.inventory', [
            'character' => $character,
        ]);

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
            'fields' => $character->fields ?? [],
        ]
        );
    }

    /**
     * @param array                 $prerequisites
     * @param \App\Models\Character $character
     *
     * @return bool
     */
    private function isStatPrerequisitesFulfilled(CharacterField $prerequisites, Character $character): bool
    {
        $sheet = $character->fields;

        foreach ($prerequisites as $name => $value) {
            if (array_key_exists($name, $sheet) && $sheet[$name] >= $value) {
                return true;
            }
        }

        return false;
    }

    private function isItemPrerequisitesFulfilled(Item $requiredItem, Character $character): bool
    {
        foreach ($character->items as $item) {
            if ($item->id == $requiredItem->id) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param Character $character
     * @param Page      $page
     */
    private function saveCheckpoint(Character $character, $page): void
    {
        if ($page && $page->is_checkpoint) {
            $character->pages()->syncWithoutDetaching($page->id);
        }
    }

    /**
     * @param Page $page
     *
     * @return mixed
     */
    private function getAllChoicesForPage(Page $page)
    {
        $key = 'choices_' . $page->id;

        return Cache::remember($key, Config::get('app.story.cache_ttl'), function () use ($page, $key) {
            return Choice::with('pageTo')
                         ->where('page_from', $page->id)
                         ->get();
        }
        );
    }

    /**
     * @param $itemId
     *
     * @return mixed
     */
    private function getItem($itemId)
    {
        return Cache::remember('item_' . $itemId, Config::get('app.story.cache_ttl'), function () use ($itemId) {
            return Item::where('id', $itemId)
                       ->first();
        }
        );
    }

    /**
     * @param null $story
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function getCreate($story = null)
    {
        $data = [
            'title'   => trans('story.create_title'),
            'locales' => getLanguages(),
            'layouts' => [
                'play1' => 'Premier layout',
            ],
            'story'   => $story,
            'route'   => 'story.create.post',
            'genres'  => Genre::all(),
            'contexts' => ['story_creation'],
        ];

        $view = View::make('story.create', $data);

        return $view;
    }

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
        $storyId                   = $validated['story_id'];
        $genres                    = $validated['genres'];
        unset($validated['genres'], $validated['story_id']);

        try {
            if ($storyId !== null) {
                $story = Story::where('id', $storyId)
                              ->firstOrFail();

                $story->update($validated);
            }
            else {
                $story = Story::create($validated);
                $story->story_options()->create();
            }

            // Create the first page with dummy data
            factory(Page::class)->create([
                'story_id' => $story->id,
                'is_first' => true,
            ]);

            StoryGenre::where('story_id', $story->id)
                      ->delete();

            foreach ($genres as $genre) {
                StoryGenre::create([
                    'story_id' => $story->id,
                    'genre_id' => (int) $genre,
                ]);
            }

            \flash(trans('model.save_successful'));

            return Redirect::to(route('story.edit', ['story' => $story->id]));
        } catch (\Exception $e) {
            \flash(trans('model.save_error'), 'error');

            return Redirect::to(route('story.create'));
        }
    }

    /**
     * @param \App\Models\Story $story
     *
     * @return \Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function getEdit(Story $story)
    {
        $this->authorize('view', $story);

        return $this->getCreate($story);
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function getItemAjax(Request $request)
    {
        if ($request->ajax()) {
            $validated = $request->validate([
                'itemId' => 'integer',
            ]
            );

            $item = $this->getItem($validated['itemId']);

            $view = view('page.partials.modal_item', [
                'item' => $item,
            ]
            );

            return $view ?? view('errors.404');
        }

        abort(JsonResponse::HTTP_NOT_FOUND);
    }

    /**
     * @param \App\Models\Character $character
     * @param \App\Models\Page      $page
     *
     * @return array
     */
    private function filterItems(Character $character, Page $page)
    {
        $actions = [];

        foreach ($page->items as $pageItem) {
            $isFound = false;

            foreach ($character->items as $characterItem) {
                if ($characterItem->id == $pageItem->id && $characterItem->single_use) {
                    $isFound = true;
                }
            }

            if (!$isFound) {
                $actions[] = $pageItem;
            }
        }

        return $actions;
    }

    public function getReset(Story $story)
    {
        $character = $story->currentCharacter();

        if ($character !== null) {
            $deleted = $character->delete();

            if ($deleted == true) {
                Flash::success(trans('story.reset_successful_text'));
            } else {
                Flash::error(trans('story.reset_failed_text'));
            }
        }

        Session::remove('story');

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

        return response()->json(['success' => $success]);
    }
}
