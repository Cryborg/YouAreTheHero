<?php

namespace App\Http\Controllers;

use App\Bases\ControllerBase;
use App\Models\Rating;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RatingController extends ControllerBase
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\Story $story
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Story $story)
    {
        $ratings = Rating::where('story_id', $story->id)->get();

        return Response::json([
            'ratings' => $ratings
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Story        $story
     *
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rating $rating)
    {
        //
    }
}
