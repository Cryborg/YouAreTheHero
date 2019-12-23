<?php

namespace App\Http\Controllers;

use App\Classes\Sheet;
use App\Models\Character;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class CharacterController extends Controller
{
    public function getCreate(Story $story)
    {
        $data = [
            'title' => trans('character.create_title'),
            'story' => $story,
        ];

        $view = View::make('character.create', $data);

        return $view;
    }

    public function postCreate(Request $request, Story $story)
    {
        $page = $story->getCurrentPage();

        $sheet = new Sheet($story);

        $character = Character::create([
            'name' => $request->get('name'),
            'user_id' => Auth::id(),
            'story_id' => $story->id,
            'page_id' => $page->id,
            'sheet' => $sheet->getArray()
        ]);

        $character->sheet = $sheet;

        dd($character);
    }
}
