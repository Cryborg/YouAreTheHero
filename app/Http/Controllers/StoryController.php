<?php

namespace App\Http\Controllers;

use App\Classes\Sheet;
use App\Classes\Action;
use App\Models\Inventory;
use App\Models\Item;
use App\Models\Checkpoint;
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
use Illuminate\Support\Facades\Session;

use App\Repositories\PageRepository;
use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;
use Spatie\Menu\Laravel\Facades\Menu;
use Spatie\Menu\Laravel\Link;

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPlay(Story $story, Page $page = null)
    {
        // Check if the user has an already existing character for this story
        $character = $this->getCurrentCharacter($story);

        // If there is an ID, save it in the session so that we show a nice URL without the page ID
        if ($page !== null) {
            $this->setSession('page_id', $page->id);
            redirect(route('story.play', ['story' => $story->id]));//'/story/' . $story->id);
        } else {
            $page = $this->getSession('page_id');
        }

        $this->setSession('story_id', $story->id);

        // Params that are always returned to the view
        $commonParams = [
            'story' => $story,
            'title' => $story->title,
        ];

        // If the character does not exist, it is a new game
        if (!$character) {
            // Get the first page of the story
            $page = $this->getCurrentPage($story);

            if ($page) {
                // Create the character
                $character = $this->createCharacter($story, $page);

                $this->getChoicesFromPage($page, $character);
            }
        } else { // The character exists, let's go back to the previous save point
            // Get the last visited page
            if ($page === null) {
                $page = $this->getCurrentPage(null, $character->page_id);
            }

            if ($page) {
                if ($page->is_last) {
                    $page->choices = 'gameover';
                } else {
                    $this->getChoicesFromPage($page, $character);
                }

                $character->update(['page_id' => $page->id]);
            }
        }

        $this->setSession('character_id', $character->id);

        $this->saveCheckpoint($character, $page);

        $visitedPlaces = $character->checkpoints;

        $visitedPlaces = $visitedPlaces->map(function ($value, $key) {
            $page = Page::where('id', $value['page_id'])->first();
            $value['page_title'] = $page->title;
            return $value;
        });

        $actions = $this->filterActions($character, $page);

        $view = view('story.play', $commonParams + [
            'page' => $page,
            'actions' => $actions,
            'layout' => $page->layout ?? $story->layout,
            'character' => $character,
            'visitedPlaces' => $visitedPlaces,
        ]);

        return $view ?? view('errors.404');
    }

    /**
     * @param $story
     * @param $page
     *
     * @return mixed
     */
    private function createCharacter($story, $page) {

        $sheet = new Sheet($story);

        $character = Character::create([
            'name' => 'Quasimodo',
            'user_id' => Auth::id(),
            'story_id' => $story->id,
            'page_id' => $page->id,
            'sheet' => $sheet->getArray()
        ]);

        $character->sheet = $sheet;

        return $character;
    }

    /**
     * Get all the choices (links to the next page) based on page prerequisites.
     *
     * @param \App\Models\Page      $currentPage
     * @param \App\Models\Character $character
     *
     * @return mixed
     */
    private function getChoicesFromPage(Page $currentPage, Character $character) {
        // Get all the choices (links to the next page(s)
        $allChoices = $this->getAllChoicesForPage($currentPage);
        $finalChoices = [];

        // Check if there are prerequisites, and that they are fulfilled
        foreach ($allChoices as $choice) {
            $fulfilled = false;
            $pageTo = $this->page->find($choice->page_to);

            if (!empty($pageTo->prerequisites)) {
                foreach ($pageTo->prerequisites as $type => $prerequisite) {
                    switch ($type) {
                        case 'sheet':
                            $fulfilled = $this->isSheetPrerequisitesFulfilled($prerequisite, $character);
                            break;
                        case 'items':
                            $fulfilled = $this->isItemPrerequisitesFulfilled($prerequisite, $character);
                            break;
                    }
                }
            } else {
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
     */
    public function ajaxAction(Request $request): JsonResponse
    {
        $isOk = false;

        $json = $request->get('json');
        $action = json_decode($json, true);

        /** @var \App\Models\Character $character */
        $character = $this->getCurrentCharacter($this->getSession('story_id'));

        $item = $this->getItem($action['item']);

        // Perform the action
        switch ($action['verb']) {
            case 'buy':
                $isOk = Action::buy($character, $item);
                break;
            case 'earn':
                $isOk = $character->addMoney($action['price']);
                break;
        }

        Action::effects($character, $item);

        // Check if the item used has the single_use flag,
        // and in this case it must not be shown again
        if ($item->single_use) {
            UniqueItemsUsed::create([
                'character_id' => $character->id,
                'item_id' => $item->id,
            ]);
        }

        return response()->json([
            'result' => $isOk,
            'money' => $character->money,
        ], 200);
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

        $inventory = Inventory::where('character_id', $character->id)->get();

        if (!empty($inventory)) {
            $items = [];

            foreach ($inventory as $item) {
                $items[] = [
                    'item' => $this->getItem($item->item_id),
                    'quantity' => $item->quantity,
                ];
            }

            return view('story.inventory', [
                'items' => $items,
                'character' => $character,
            ]);
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
            'caracteristics' => $character->sheet,
        ]);
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

        $this->getChoicesFromPage($page, $character);

        return view('story.partials.choices', [
            'story' => $story,
            'page' => $page,
        ]);
    }

    /**
     * @param array                 $prerequisites
     * @param \App\Models\Character $character
     *
     * @return bool
     */
    private function isSheetPrerequisitesFulfilled(array $prerequisites, Character $character): bool
    {
        $sheet = $character->sheet;

        foreach ($prerequisites as $name => $value) {
            if (array_key_exists($name, $sheet) && $sheet[$name] >= $value) {
                return true;
            }
        }

        return false;
    }

    private function isItemPrerequisitesFulfilled($prerequisites, Character $character): bool
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
                'page_id'      => $page->id,
            ],
            [
                'character_id' => $character->id,
                'page_id'      => $page->id,
            ]);
        }
    }

    /**
     * @param string $key
     * @param        $value
     */
    private function setSession(string $key, $value): void
    {
        $actualStorySession = collect(Session::get('story'));

        $newValue = collect([
            $key => $value,
        ]);

        Session::put([
            'story' => $actualStorySession->merge($newValue),
        ]);
    }

    /**
     * @param string $key
     *
     * @return array|string
     */
    private function getSession(string $key = null)
    {
        $actualStorySession = Session::get('story');

        if ($key === null) {
            return $actualStorySession;
        }

        if ($actualStorySession) {
            return $actualStorySession[$key] ?? null;
        }

        return [];
    }

    /**
     * @param \App\Models\Story|int  $story
     *
     * @return mixed
     */
    private function getCurrentCharacter($story)
    {
        $story_id = is_int($story) ? $story : $story->id;

        return Character::where(['user_id' => Auth::id(), 'story_id' => $story_id])->first();
    }

    private function getAllChoicesForPage(Page $page)
    {
        $key = 'choices_' . $page->id;

        return Cache::remember($key, Config::get('app.story.cache_ttl'), function () use ($page, $key) {
            return PageLink::where('page_from', $page->id)->get();
        });
    }

    /**
     * @param \App\Models\Story|null $story
     * @param string|null            $page_id
     *
     * @return \App\Models\Page
     */
    private function getCurrentPage(Story $story = null, string $page_id = null): ?Page
    {
        if ($story !== null) {
            return $this->page->findOneWith([
                'story_id' => $story->id,
                'is_first' => true,
            ]);
        }

        if ($page_id !== null) {
            return $this->page->find($page_id);
        }
    }

    private function getItem($itemId)
    {
        return Cache::remember('item_' . $itemId, Config::get('app.story.cache_ttl'), function () use ($itemId) {
            return Item::where('id', $itemId)->first();
        });
    }

    /**
     * @param null $story
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function getCreate($story = null)
    {
        $postRoute = 'story.create.post';
        $param = null;

        if ($story) {
            $postRoute = 'story.edit.post';

            $param = $story->id;
        }

        $data = [
            'title' => trans('story.create_title'),
            'locales' => [
                'fr_FR' => trans('common.fr_FR'),
                'en_US' => trans('common.en_US'),
                'es_ES' => trans('common.es_ES'),
            ],
            'layouts' => [
                'play1' => 'Premier layout',
            ],
            'story' => $story,
            'route' => $postRoute,
            'param' => $param,
        ];

        $view = View::make('story.create', $data);

        return $view;
    }

    public function postCreate(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'locale' => 'required',
            'layout' => 'required',
            'is_published' => 'boolean',
        ]);

        $story = Story::create($validated);

        if ($story) {
            // Create the first page with dummy data
            $page = factory(Page::class)->create([
                'story_id' => $story->id,
                'is_first' => true,
            ]);

            \flash(trans('model.save_successful'));

            return Redirect::to(route('page.edit', ['page' => $page->id]));
        }

        \flash(trans('model.save_error'));

        return Redirect::to(route('story.create'));
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
     * @param \App\Models\Story        $story
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit(Request $request, Story $story): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'locale' => 'required',
            'layout' => 'required',
            'is_published' => 'boolean',
        ]);

        $story->update($validated);

        return Redirect::to(route('story.edit', $story->id));
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
            ]);

            $item = $this->getItem($validated['itemId']);

            $view = view('page.partials.modal_item', [
                'item' => $item,
            ]);

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

            foreach ($character->inventory() as $items) {
                if ($items['item']->id == $action['item_id'] && $items['item']->single_use) {
                    $isFound = true;
                }
            }

            if (!$isFound) {
                $action['item'] = Item::where('id', $action['item_id'])->first();
                $actions[] = $action;
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


        $tree = [];
        $pages = $story->pages->where('is_first', true);
        $page = $pages->first();

        $view = View::make('story.tree', [
            'pages' => [$page],
        ]);

        return $view;
    }

    public function postChildrenPagesAjax(Request $request)
    {
        if ($request->ajax()) {
            $pageId = $request->get('page');
            $page = Cache::remember('page_' . $pageId, Config::get('app.story.cache_ttl'), function () use ($pageId) {
                return Page::where('id', $pageId)
                           ->first();
            });

            $view = View::make('story.partials.treecard', ['pages' => $page->choices()]);

            return $view;
        }

        abort(JsonResponse::HTTP_NOT_FOUND);
    }
}
