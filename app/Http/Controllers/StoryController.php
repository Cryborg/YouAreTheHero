<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Story;
use \App\Character;
use \App\Paragraph;

class StoryController extends Controller
{
    public function play(int $id)
    {
        $story = Story::where('id', $id)->first();

        // Check if the user has an already existing character for this story
        $character = Character::where('story_id', $id)->first();

        if (!$character) {
            $paragraph = Paragraph::where([
                'story_id' => $id,
                'is_first' => true,
            ])->first();

            if ($paragraph) {
                return view('story.play', [
                    'paragraph' => $paragraph,
                    'title' => $story->title,
                ]);
            }
        }
    }
}
