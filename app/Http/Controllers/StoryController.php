<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Field;
use App\Models\Genre;
use App\Models\Item;
use App\Models\Page;
use App\Models\Story;
use App\Models\StoryGenre;
use App\Repositories\ChoiceRepository;
use App\Repositories\PageRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;
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
            $character = Character::createNewForStory($story);

            if ($character && ($story->story_options->has_character === false || $story->story_options->count() === 0)) {
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

        $page->load('descriptions');

        if (\Illuminate\Support\Facades\Request::ajax()) {
            $view = view('layouts.partials.page_content', $commonParams + [
                                                            'page'     => $page,
                                                            'items'    => $items,
                                                            'messages' => $messages,
                                                        ]);
        } else {
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
        }

        if ($page->is_last) {
            if (!Auth::user()
                     ->hasRole('admin')) {
                activity()
                    ->performedOn($story)
                    ->useLog('end_game')
                    ->log('finished');
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

        foreach ($page->items as $pageItem)
        {
            $canBeShown = true;

            foreach ($character->items as $characterItem)
            {
                // If the character owns the item
                if ($characterItem->id === $pageItem->id)
                {
                    // If it is unique, don't show it
                    $canBeShown = (bool) $pageItem->getRawOriginal('is_unique') === false;

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
                    $field->pivot->value += $trigger->quantity;
                    if ($field->pivot->save()) {
                        $character->actions()
                                  ->syncWithoutDetaching($trigger->id);

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

            // If this is an item
            if ($trigger->actionable instanceof Item)
            {
                $item = $trigger->actionable;

                // Check if the action has already been done
                if ($character->actions->where('pivot.action_id', $trigger->id)->count() === 0)
                {
                    if ($character->actions()->syncWithoutDetaching($trigger->id))
                    {
                        if ($trigger->quantity > 0) {
                            $item->take();
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
            'items' => $this->showItemsInInventory($character),
            'character' => $character
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

        try {
            if ($storyId !== null) {
                $story = Story::where('id', $storyId)
                              ->firstOrFail();

                $story->update($validated);
            } else {
                $story = Story::create($validated);
                $story->story_options()
                      ->create();
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
     * @param null $story
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function getCreate($story = null)
    {
        $data = [
            'title'    => trans('story.create_title'),
            'locales'  => getLanguages(),
            'layouts'  => [
                'play1' => 'Premier layout',
            ],
            'story'    => $story,
            'route'    => 'story.create.post',
            'genres'   => Genre::all(),
            'contexts' => ['story_creation'],
        ];

        $view = View::make('story.create', $data);

        return $view;
    }

    public function getReset(Story $story)
    {
        $character = $story->currentCharacter();

        if ($character !== null) {
            $deleted = $character->delete();

            if ($deleted == true) {
                Flash::success(trans('story.reset_successful_text'));

                if (!Auth::user()
                         ->hasRole('admin')) {
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
}
