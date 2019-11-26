<?php

namespace App\Http\Controllers;

use App\Classes\Action;
use App\Models\Inventory;
use App\Models\Item;
use Illuminate\Http\Request;
use \App\Models\Story;
use \App\Models\Character;
use \App\Models\Page;
use \App\Models\Page_link;
use \App\Models\Savegame;
use Illuminate\Validation\Rule;

class StoryController extends Controller
{
    private $_currentUserId = null;       //TODO: remove this once we can login !!!!!!

    public function play(int $id, string $page_id = null)
    {
        $story = Story::where('id', $id)->first();

        $this->_currentUserId = $story->user_id;       //TODO: remove this once we can login !!!!!!

        // Check if the user has an already existing character for this story
        $character = Character::where(['user_id' => $this->_currentUserId, 'story_id' => $id])->first();

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

                // Create the character and the savegame
                $character = $this->createCharacter($story);
                $this->createSavegame($story, $page);

                return view('story.play', $commonParams + [
                    'page' => $page,
                    'layout' => $lastPage->layout ?? $story->layout,
                    'character' => $character,
                ]);
            }
        } else { // The character exists, let's go back to the previous save point
            // Get the last visited page
            if ($page_id === null) {
                $lastPage = $this->getLastPageFromSavegame($story);
            } else {
                $lastPage = Page::where('id', $page_id)->first();
            }

            if ($lastPage) {
                if ($lastPage->is_last) {
                    $lastPage->choices = 'gameover';
                } else {
                    $this->getChoicesFromPage($lastPage);
                }

                $this->createSavegame($story, $lastPage);

                return view('story.play', $commonParams + [
                    'page' => $lastPage,
                    'layout' => $lastPage->layout ?? $story->layout,
                    'character' => $character,
                ]);
            }
        }

        return view('errors.404');
    }

    private function createCharacter($story) {
        return Character::create([
            'name' => 'Quasimodo',
            'user_id' => $this->_currentUserId,
            'story_id' => $story->id,
        ]);
    }

    /**
     * Automatically save the character progression
     *
     * @param $story
     * @param $page
     */
    private function createSavegame($story, $page) {
        Savegame::updateOrCreate([
            'user_id' => $this->_currentUserId,
            'story_id' => $story->id
        ], [
            'page_id' => $page->id,
        ]);
    }

    /**
     * @param $story
     * @return |null
     */
    private function getLastPageFromSavegame($story) {
        $savegame = Savegame::where([
            'user_id' => $this->_currentUserId,
            'story_id' => $story->id,
        ])->first();

        if ($savegame) {
            $lastPage = Page::where('id', $savegame->page_id)->first();

            if ($lastPage) {
                return $lastPage;
            }
        }

        return null;
    }

    /**
     * Get all the choices (links to the next page(s)
     *
     * @param $page
     * @return mixed
     */
    private function getChoicesFromPage(&$page) {
        // Get all the choices (links to the next page(s)
        $choices = Page_link::where('page_from', $page->id)->get();
        $page->choices = $choices;
    }

    public function ajax_action(Request $request)
    {
        $isOk = false;

        $json = $request->get('json');
        $action = json_decode($json, true);

        /** @var \App\Models\Character $character */
        $character = Character::where('id', 1)->first();
        $item = Item::where('id', $action['item'])->first();

        switch ($action['verb']) {
            case 'buy':
                $isOk = Action::buy($character, $item);
                break;
            case 'earn':
                $isOk = $character->addMoney($action['price']);
                break;
        }

        return response()->json([
            'result' => $isOk,
            'money' => $character->money,
        ], 200);
    }

    public function inventory(Character $character)
    {
        // Check if the user has an already existing character for this story
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
