<?php

namespace App\Http\Controllers;

use App\Bases\ControllerBase;
use App\Classes\Constants;
use App\Models\Character;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class CharacterController extends ControllerBase
{
    public function __construct()
    {
        $this->middleware('auth');

        parent::__construct();
    }

    public function getCreate(Story $story)
    {
        $story->load('options');

        $data = [
            'title' => trans('character.create_title'),
            'story' => $story,
            'has_visible_fields' => $story->fields()->where('hidden', false)->count() > 0
        ];

        $view = View::make('character.create', $data);

        return $view;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Story        $story
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Story $story)
    {
        $page = $story->getCurrentPage();
        $fields = $request->post('stats');
        $people = $request->post('people');

        $character = Character::create([
            'name'     => $request->post('name'),
            'user_id'  => Auth::id(),
            'story_id' => $story->id,
            'page_id'  => $page->id,
            'genre'    => $request->post('genre', 'male'),
            'people'   => '',
            'money'    => $story->options->currency_amount,
        ]);

        // Customizable people
        if ($people) {
            foreach ($people as $person) {
                $character->people()->syncWithoutDetaching([
                    $person['id'] => [
                        'first_name' => $person['first_name'],
                        'last_name'  => $person['last_name'],
                    ]
                ]);
            }
        }

        foreach ($story->fields as $storyField) {
            // Default values
            $character->fields()->attach($storyField->id, [
                'character_id' => $character->id,
                'value' => $storyField->start_value,
                'start_value' => $storyField->start_value
            ]);

            // Update if the user changed the values (case where story.options.points_to_share > 0)
            if ($fields) {
                foreach ($fields as $field) {
                    if ($field['field_id'] == $storyField->id) {
                        $character->fields()->syncWithoutDetaching([
                            $field['field_id'] =>
                            [
                                'value'        => $field['value'],
                                'start_value'  => $field['value'],
                            ]
                        ]);
                    }
                }
            }
        }

        // Log this new game
        if (!$this->authUser->hasRole(Constants::ROLE_ADMIN)) {
            activity()
                ->performedOn($story)
                ->useLog('new_game')
                ->log('New game started');
        }

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'type'    => 'save',
            ]);
        }

        return redirect()->route('story.play', ['story' => $story]);
    }

    public function purse(Character $character)
    {
        return view('story.partials.ajax.purse', [
            'character' => $character,
        ]);
    }

    public function equipmentList(Character $character)
    {
        $data = [
            'items' => $character->equipment(),
        ];

        return View::make('', $data);
    }
}
