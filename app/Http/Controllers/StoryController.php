<?php

namespace App\Http\Controllers;

use App\Classes\Action;
use App\Models\Inventory;
use App\Models\Item;
use App\Models\UniqueItemsUsed;
use Illuminate\Http\Request;
use \App\Models\Story;
use \App\Models\Character;
use \App\Models\Page;
use \App\Models\PageLink;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function play(int $id, string $page_id = null)
    {
        $story = Story::where('id', $id)->first();

        // Check if the user has an already existing character for this story
        $character = Character::where(['user_id' => Auth::id(), 'story_id' => $id])->first();

        session([
            'story_id' => $story->id,
        ]);


        // Params that are always returned to the view
        $commonParams = [
            'story' => $story,
            'title' => $story->title,
        ];

        // If the character does not exist, it is a new game
        if (!$character) {
            // Get the first page of the story
            $page = Page::where([
                'story_id' => $id,
                'is_first' => true,
            ])->first();

            if ($page) {
                $this->getChoicesFromPage($page);

                // Create the character
                $character = $this->createCharacter($story, $page);

                session([
                    'character_id' => $character->id,
                ]);

                return view('story.play', $commonParams + [
                    'page' => $page,
                    'layout' => $lastPage->layout ?? $story->layout,
                    'character' => $character,
                ]);
            }
        } else { // The character exists, let's go back to the previous save point
            // Get the last visited page
            if ($page_id === null) {
                $lastPage = Page::where('id', $character->page_id)->first();
            } else {
                $lastPage = Page::where('id', $page_id)->first();
            }

            if ($lastPage) {
                if ($lastPage->is_last) {
                    $lastPage->choices = 'gameover';
                } else {
                    $this->getChoicesFromPage($lastPage);
                }

                $character->update(['page_id' => $lastPage->id]);

                return view('story.play', $commonParams + [
                    'page' => $lastPage,
                    'layout' => $lastPage->layout ?? $story->layout,
                    'character' => $character,
                ]);
            }
        }

        return view('errors.404');
    }

    private function createCharacter($story, $page) {
        return Character::create([
            'name' => 'Quasimodo',
            'user_id' => Auth::id(),
            'story_id' => $story->id,
            'page_id' => $page->id,
        ]);
    }

    /**
     * Get all the choices (links to the next page(s)
     *
     * @param $page
     * @return mixed
     */
    private function getChoicesFromPage(&$page) {
        // Get all the choices (links to the next page(s)
        $choices = PageLink::where('page_from', $page->id)->get();

        $page->choices = $choices;
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
            'story_id' => session('story_id'),
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
     * @param \App\Models\Character $character
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function inventory(Character $character)
    {
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
}
