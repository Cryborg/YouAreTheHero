<?php

namespace App\Http\Controllers;

use App\Classes\Action;
use App\Models\Genre;
use App\Models\Inventory;
use App\Models\Item;
use App\Models\Checkpoint;
use App\Models\CharacterStat;
use App\Models\StoryGenre;
use App\Models\UniqueItemsUsed;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use \App\Models\Story;
use \App\Models\Character;
use \App\Models\Page;
use \App\Models\PageLink;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;

use App\Repositories\PageRepository;
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
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getPlay(Story $story, Page $page = null)
    {
        // Check if the user has an already existing character for this story
        $character = $this->getCurrentCharacter($story);

        // If there is an ID, save it in the session so that we show a nice URL without the page ID
        if ($page !== null) {
            setSession('page_uuid', $page->uuid);
            return Redirect::route('story.play', ['story' => $story->id]);
        }

        $page_uuid = getSession('page_uuid');
        if (!empty($page_uuid)) {
            $page = Page::where('uuid', $page_uuid)
                        ->first();
        }

        setSession('story_id', $story->id);

        // Params that are always returned to the view
        $commonParams = [
            'story' => $story,
            'title' => $story->title,
        ];

        // If the character does not exist, it is a new game
        if (!$character) {
            return Redirect::route('character.create', [
                'story' => $story->id,
            ]
            );
        }

        // The character exists, let's go back to the previous save point
        // Get the last visited page
        if ($page === null || empty($page)) {
            $page = $story->getCurrentPage($character->page_uuid);
        }

        if ($page) {
            if ($page->is_last) {
                $page->choices = 'gameover';
            }
            else {
                $this->getFilteredChoicesFromPage($page, $character);
            }

            $character->update(['page_uuid' => $page->uuid]);
        }

        setSession('character_id', $character->id);
        $this->saveCheckpoint($character, $page);

        $visitedPlaces = $character->checkpoints;

        $visitedPlaces = $visitedPlaces->map(function ($value, $key) {
            $page                = Page::where('uuid', $value['page_uuid'])
                                       ->firstOrFail();
            $value['page_title'] = $page->title;
            return $value;
        }
        );

        $actions = $this->filterActions($character, $page);

        $view = view('story.play', $commonParams + [
                'page'          => $page,
                'actions'       => $actions,
                'layout'        => $page->layout ?? $story->layout,
                'character'     => $character,
                'visitedPlaces' => $visitedPlaces,
            ]
        );

        return $view ?? view('errors.404');
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

        // Check if there are prerequisites, and that they are fulfilled
        foreach ($allChoices as $choice) {
            $fulfilled = false;
            $pageTo    = $choice->pageTo;

            if ($pageTo && $pageTo->prerequisites()
                                  ->count() > 0) {
                foreach ($pageTo->prerequisites() as $prerequisite) {
                    switch (get_class($prerequisite->prerequisiteable)) {
                        case CharacterStat::class:
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
            }
        }

        $currentPage->filtered_choices = $finalChoices;
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function ajaxAction(Request $request): JsonResponse
    {
        $isOk = false;

        $json   = $request->get('json');
        $action = json_decode($json, true);

        /** @var \App\Models\Character $character */
        $character = $this->getCurrentCharacter(getSession('story_id'));

        $item = $this->getItem($action['item']);

        // Perform the action
        switch ($action['verb']) {
            case 'buy':
                $isOk = Action::buy($character, $item, $action);
                break;
            case 'sell':
                $isOk = Action::sell($character, $item, $action);
                break;
            case 'give':
                $isOk = Action::give($character, $item);
                break;
            case 'earn':
                $isOk = $character->addMoney($action['price']);

                if (isset($action['item'])) {
                    Inventory::create([
                        'character_id' => $character->id,
                        'item_id'      => $action['item'],
                        'quantity'     => $action['quantity'] ?? 1,
                    ]
                    );
                }
                break;
        }

        // Apply item effects, if applicable
        Action::effects($character, $item);

        // Check if the item used has the single_use flag,
        // and in this case it must not be shown again
        if ($item->single_use) {
            UniqueItemsUsed::create([
                'character_id' => $character->id,
                'item_id'      => $item->id,
            ]
            );
        }

        return response()->json([
            'result' => $isOk,
            'money'  => $character->money,
        ], 200
        );
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
        $character = $this->getCurrentCharacter($story);

        $inventory = Inventory::where('character_id', $character->id)
                              ->get();

        if (!empty($inventory)) {
            $items = [];

            foreach ($inventory as $item) {
                $items[] = [
                    'item'     => $this->getItem($item->item_id),
                    'quantity' => $item->quantity,
                ];
            }

            return view('story.inventory', [
                'items'     => $items,
                'character' => $character,
            ]
            );
        }

    }

    /**
     * @param \App\Models\Story $story
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sheet(Story $story)
    {
        $character = $this->getCurrentCharacter($story);

        return view('story.partials.sheet', [
            'sheet' => $character->character_stats ?? [],
        ]
        );
    }

    /**
     * @param \App\Models\Story $story
     * @param \App\Models\Page  $page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function choices(Story $story, Page $page)
    {
        $character = $this->getCurrentCharacter($story);

        $this->getFilteredChoicesFromPage($page, $character);

        return view('story.partials.choices', [
            'story' => $story,
            'page'  => $page,
        ]
        );
    }

    /**
     * @param array                 $prerequisites
     * @param \App\Models\Character $character
     *
     * @return bool
     */
    private function isStatPrerequisitesFulfilled(CharacterStat $prerequisites, Character $character): bool
    {
        $sheet = $character->character_stats;

        foreach ($prerequisites as $name => $value) {
            if (array_key_exists($name, $sheet) && $sheet[$name] >= $value) {
                return true;
            }
        }

        return false;
    }

    private function isItemPrerequisitesFulfilled(Item $prerequisites, Character $character): bool
    {
        $itemsInInventory = $character->inventory();

        foreach ($prerequisites as $requiredItemId) {
            foreach ($itemsInInventory as $item) {
                if ($item['item']['id'] == $requiredItemId) {
                    return true;
                }
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
            Checkpoint::firstOrCreate([
                'character_id' => $character->id,
                'page_uuid'    => $page->uuid,
            ], [
                    'character_id' => $character->id,
                    'page_uuid'    => $page->uuid,
                ]
            );
        }
    }

    /**
     * @param \App\Models\Story|int $story
     *
     * @return mixed
     */
    private function getCurrentCharacter($story)
    {
        $story_id = $story instanceof Story ? $story->id : $story;

        return Character::where(['user_id'  => Auth::id(),
                                 'story_id' => $story_id,
        ]
        )
                        ->first();
    }

    private function getAllChoicesForPage(Page $page)
    {
        $key = 'choices_' . $page->uuid;

        return Cache::remember($key, Config::get('app.story.cache_ttl'), function () use ($page, $key) {
            return PageLink::with('pageTo')
                           ->where('page_from', $page->uuid)
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
        $param = null;

        if ($story) {
            $param = $story->id;
        }

        $data = [
            'title'   => trans('story.create_title'),
            'locales' => getLanguages(),
            'layouts' => [
                'play1' => 'Premier layout',
            ],
            'story'   => $story,
            'route'   => 'story.create.post',
            'param'   => $param,
            'genres'  => Genre::all(),
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
    private function filterActions(Character $character, Page $page)
    {
        $actions = [];

        foreach ($page->actions->toArray() as $action) {
            $isFound = false;

            foreach ($character->inventory ?? [] as $items) {
                if ($items->item->id == $action['item_id'] && $items->item->single_use) {
                    $isFound = true;
                }
            }

            if (!$isFound) {
                $action['item'] = Item::where('id', $action['item_id'])
                                      ->first();
                $actions[]      = $action;
            }
        }

        return $actions;
    }

    /**
     * @param \App\Models\Story $story
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function getTree(Story $story)
    {

        //FIXME: does not work for now

        $tree  = [];
        $pages = $story->pages->where('is_first', true);
        $page  = $pages->first();

        $view = View::make('story.tree', [
            'pages' => [$page],
        ]
        );

        return $view;
    }

    public function postChildrenPagesAjax(Request $request)
    {
        if ($request->ajax()) {
            $pageId = $request->get('page');
            $page   = Cache::remember('page_' . $pageId, Config::get('app.story.cache_ttl'), function () use ($pageId) {
                return Page::where('uuid', $pageId)
                           ->first();
            }
            );

            $view = View::make('story.partials.treecard', ['pages' => $page->choices()]);

            return $view;
        }

        abort(JsonResponse::HTTP_NOT_FOUND);
    }

    public function getReset(Request $request, Story $story)
    {
        $deleted = Character::where([
            'user_id'  => Auth::id(),
            'story_id' => $story->id,
        ]
        )
                            ->delete();

        if ($deleted == true) {
            Flash::success(trans('story.reset_successful_text'));
        }
        else {
            Flash::error(trans('story.reset_failed_text'));
        }

        return Redirect::route('stories.list');
    }
}
