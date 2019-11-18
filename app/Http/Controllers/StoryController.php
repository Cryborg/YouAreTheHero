<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Story;
use \App\Character;
use \App\Paragraph;
use \App\Paragraph_link;
use \App\Savegame;

class StoryController extends Controller
{
    private $_currentUserId = null;       //TODO: remove this once we can login !!!!!!

    public function play(int $id, string $paragraph_id = null)
    {
        $story = Story::where('id', $id)->first();
        $this->_currentUserId = $story->user_id;       //TODO: remove this once we can login !!!!!!

        // Check if the user has an already existing character for this story
        $character = Character::where('story_id', $id)->first();

        // If the character does not exist, it is a new game
        if (!$character) {
            // Get the first paragraph of the story
            $paragraph = Paragraph::where([
                'story_id' => $id,
                'is_first' => true,
            ])->first();

            if ($paragraph) {
                $this->getChoicesFromParagraph($paragraph);

                // Create the character and the savegame
                $this->createCharacter($story);
                $this->createSavegame($story, $paragraph);

                return view('story.play', [
                    'story' => $story,
                    'paragraph' => $paragraph,
                    'title' => $story->title,
                ]);
            }
        } else { // The character exists, let's go back to the previous save point
            // Get the last visited paragraph
            if (is_null($paragraph_id)) {
                $lastParagraph = $this->getLastParagraphFromSavegame($story);
            } else {
                $lastParagraph = Paragraph::where('id', $paragraph_id)->first();
            }

            if ($lastParagraph) {
                if ($lastParagraph->is_last) {
                    $lastParagraph->choices = 'gameover';
                } else {
                    $this->getChoicesFromParagraph($lastParagraph);
                }

                $this->createSavegame($story, $lastParagraph);

                return view('story.play', [
                    'story' => $story,
                    'paragraph' => $lastParagraph,
                    'title' => $story->title,
                ]);
            }
        }

        return view('errors.paragraph_not_found');
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
     * @param $paragraph
     */
    private function createSavegame($story, $paragraph) {
        Savegame::updateOrCreate([
            'user_id' => $this->_currentUserId,
            'story_id' => $story->id
        ], [
            'paragraph_id' => $paragraph->id,
        ]);
    }

    /**
     * @param $story
     * @return |null
     */
    private function getLastParagraphFromSavegame($story) {
        $savegame = Savegame::where([
            'user_id' => $this->_currentUserId,
            'story_id' => $story->id,
        ])->first();

        if ($savegame) {
            $lastParagraph = Paragraph::where('id', $savegame->paragraph_id)->first();

            if ($lastParagraph) {
                return $lastParagraph;
            }
        }

        return null;
    }

    /**
     * Get all the choices (links to the next paragraph(s)
     *
     * @param $paragraph
     * @return mixed
     */
    private function getChoicesFromParagraph(&$paragraph) {
        // Get all the choices (links to the next paragraph(s)
        $choices = Paragraph_link::where('paragraph_from', $paragraph->id)->get();
        $paragraph->choices = $choices;
    }
}
