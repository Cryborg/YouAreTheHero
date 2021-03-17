<?php

namespace App\Http\Controllers;

use App\Bases\ControllerBase;
use App\Models\Rating;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;

class RatingController extends ControllerBase
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\Story $story
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Story $story)
    {
        $data = [
            'ratings' => Rating::where('rateable_id', $story->id)->get()
        ];

        return View::make('layouts.partials.story_ratings', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Story        $story
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, Story $story)
    {
        $validator = Validator::make($request->all(), [
            'rating' => 'required|between:.5,5',
            'comment' => [
                Rule::requiredIf(static function() use ($request) {
                    $rating = (int) $request->get('rating');

                    // Comment is mandatory when the rating is under 2.5
                    return $rating <= 2.5;
                }),
                'min:5'
            ]
        ]);

        if ($validator->fails()) {
            return Response::json([
                'success' => false,
                'errors' => $validator->errors(),
                'type' => 'save'
            ]);
        }

        $validated = $validator->validated();

        $story->rateOnce($validated['rating'], $validated['comment']);

        return Response::json([
            'success' => true,
            'type'    => 'save',
        ]);
    }
}
