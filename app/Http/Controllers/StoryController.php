<?php

namespace App\Http\Controllers;

use App\Classes\Sheet;
use App\Classes\Action;
use App\Models\Inventory;
use App\Models\Item;
use App\Models\Map;
use App\Models\UniqueItemsUsed;
use Illuminate\Http\Request;
use \App\Models\Story;
use \App\Models\Character;
use \App\Models\Page;
use \App\Models\PageLink;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use phpDocumentor\Reflection\Types\Mixed_;

class StoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function play(Story $story, string $page_id = null)
    {
        // Check if the user has an already existing character for this story
        $character = Character::where(['user_id' => Auth::id(), 'story_id' => $story->id])->first();
        $page = null;

        $this->setSession('story_id', $story->id);

        // Params that are always returned to the view
        $commonParams = [
            'story' => $story,
            'title' => $story->title,
        ];

        // If the character does not exist, it is a new game
        if (!$character) {
            // Get the first page of the story
            $page = Page::where([
                'story_id' => $story->id,
                'is_first' => true,
            ])->first();

            if ($page) {
                // Create the character
                $character = $this->createCharacter($story, $page);

                $this->getChoicesFromPage($page, $character);

                $view = view('story.play', $commonParams + [
                    'page' => $page,
                    'layout' => $page->layout ?? $story->layout,
                    'character' => $character,
                ]);
            }
        } else { // The character exists, let's go back to the previous save point
            // Get the last visited page
            if ($page_id === null) {
                $page = Page::where('id', $character->page_id)->first();
            } else {
                $page = Page::where('id', $page_id)->first();
            }

            if ($page) {
                if ($page->is_last) {
                    $page->choices = 'gameover';
                } else {
                    $this->getChoicesFromPage($page, $character);
                }

                $character->update(['page_id' => $page->id]);

                $view = view('story.play', $commonParams + [
                    'page' => $page,
                    'layout' => $page->layout ?? $story->layout,
                    'character' => $character,
                ]);
            }
        }

        $this->setSession('character_id', $character->id);

        $this->saveCheckpoint($character, $page);

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
     * Get all the choices (links to the next page(s)
     *
     * @param \App\Models\Page      $currentPage
     * @param \App\Models\Character $character
     *
     * @return mixed
     */
    private function getChoicesFromPage(Page &$currentPage, Character $character) {
        // Get all the choices (links to the next page(s)
        $allChoices = PageLink::where('page_from', $currentPage->id)->get();
        $finalChcoices = [];

        // Check if there are prerequisites, and that they are fulfilled
        foreach ($allChoices as $choice) {
            $fulfilled = false;
            $pageTo = Page::where('id', $choice->page_to)->first();

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
                $finalChcoices[] = $choice;
            }
        }

        $currentPage->choices = $finalChcoices;
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax_action(Request $request)
    {
        $isOk = false;

        $json = $request->get('json');
        $action = json_decode($json, true);

        /** @var \App\Models\Character $character */
        $character = Character::where([
            'user_id' => Auth::id(),
            'story_id' => $this->getSession('story_id'),
        ])->first();
        $item = Item::where('id', $action['item'])->first();

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
        $character = Character::where([
            'user_id' => Auth::id(),
            'story_id' => $story->id,
        ])->first();

        $inventory = Inventory::where('character_id', $character->id)->get();

        if (!empty($inventory)) {
            $items = [];

            foreach ($inventory as $item) {
                $items[] = [
                    'item' => Item::where('id', $item->item_id)->first(),
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
        $character = Character::where([
            'user_id' => Auth::id(),
            'story_id' => $story->id,
        ])->first();

        return view('story.partials.sheet', [
            'caracteristics' => $character->sheet,
        ]);
    }

    public function choices(Story $story, Page $page)
    {
        $character = Character::where([
            'user_id' => Auth::id(),
            'story_id' => $story->id
        ])->first();

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
    private function isSheetPrerequisitesFulfilled(array $prerequisites, Character $character)
    {
        $sheet = $character->sheet;

        foreach ($prerequisites as $name => $value) {
            return array_key_exists($name, $sheet) && $sheet[$name] >= $value;
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
     * @param $character
     * @param $page
     */
    private function saveCheckpoint($character, $page): void
    {
        if ($page->is_checkpoint) {
            Map::create([
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
     * @return array|mixed
     */
    private function getSession(string $key = null)
    {
        $actualStorySession = Session::get('story');

        if ($key === null) {
            return $actualStorySession;
        }

        if ($actualStorySession) {
            return $actualStorySession[$key];
        }

        return [];
    }
}
