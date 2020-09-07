<?php

namespace App\Http\Controllers;

use App\Models\CharacterField;
use App\Models\Character;
use App\Models\Story;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'has_visible_fields' => $story->fields()->where('hidden', false)->count() > 0
        ];

        $view = View::make('character.create', $data);

        return $view;
    }

    public function store(Request $request, Story $story)
    {
        $page = $story->getCurrentPage();
        $fields = $request->post('stats');

        $character = Character::create([
            'name'     => $request->post('name'),
            'user_id'  => Auth::id(),
            'story_id' => $story->id,
            'page_id'  => $page->id,
            'genre'    => $request->post('genre'),
        ]);

        if ($fields) {
            foreach ($story->fields as $storyField) {
                if ($storyField->hidden) {
                    $character->fields()
                              ->attach($storyField->id, [
                                  'character_id' => $character->id,
                                  'value' => $storyField->min_value
                              ]);
                }
                foreach ($fields as $field) {
                    if ($field['field_id'] == $storyField->id) {
                        $character->fields()
                                  ->attach(
                                      $field['field_id'],
                                      [
                                          'character_id' => $character->id,
                                          'value'        => $field['value'],
                                      ]
                                  );
                    }
                }
            }
        }

        // Log this new game
        if (!Auth::user()->hasRole('admin')) {
            activity()
                ->performedOn($story)
                ->useLog('new_game')
                ->log('New game started');
        }

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('story.play', ['story' => $story]);
    }
}
