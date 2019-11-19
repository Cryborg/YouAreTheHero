<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Story;
use \App\Models\Character;
use \App\Models\Page;
use \App\Models\Page_link;
use \App\Models\Savegame;

class StoryController extends Controller
{
    private $_currentUserId = null;       //TODO: remove this once we can login !!!!!!

    public function play(int $id, string $page_id = null)
    {
        $story = Story::where('id', $id)->first();
        $this->_currentUserId = $story->user_id;       //TODO: remove this once we can login !!!!!!

        // Check if the user has an already existing character for this story
        $character = Character::where('story_id', $id)->first();

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
                $this->createCharacter($story);
                $this->createSavegame($story, $page);

                return view('story.play', [
                    'story' => $story,
                    'page' => $page,
                    'title' => $story->title,
                    'layout' => $lastPage->layout ?? $story->layout,
                ]);
            }
        } else { // The character exists, let's go back to the previous save point
            // Get the last visited page
            if (is_null($page_id)) {
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

                return view('story.play', [
                    'story' => $story,
                    'page' => $lastPage,
                    'title' => $story->title,
                    'layout' => $lastPage->layout ?? $story->layout,
                ]);
            }
        }

        return view('errors.404');
    }

    private function createCharacter($story) {
        Character::create([
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
}
