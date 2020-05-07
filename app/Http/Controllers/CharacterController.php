<?php

namespace App\Http\Controllers;

use App\Models\CharacterStat;
use App\Models\Character;
use App\Models\Story;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class CharacterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getCreate(Story $story)
    {
        $story->load('story_options');

        $data = [
            'title' => trans('character.create_title'),
            'story' => $story,
        ];

        $view = View::make('character.create', $data);

        return $view;
    }

    public function store(Request $request, Story $story)
    {
        if (request()->ajax()) {
            $page = $story->getCurrentPage();
            $stats = $request->get('stats');

            $character = Character::create([
                'name'     => $request->get('name'),
                'user_id'  => Auth::id(),
                'story_id' => $story->id,
                'page_id'  => $page->id,
            ]
            );

            if ($stats) {
                foreach ($stats as $stat) {
                    CharacterStat::create([
                        'character_id'    => $character->id,
                        'stat_story_id' => $stat['stat_id'],
                        'value' => $stat['value'],
                    ]
                    );
                }
            }

            return response()->json(['success' => true]);
        }

        abort(JsonResponse::HTTP_NOT_FOUND);
    }
}
