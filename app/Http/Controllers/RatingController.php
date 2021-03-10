<?php

namespace App\Http\Controllers;

use App\Bases\ControllerBase;
use App\Models\Rating;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

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
        $validated = Validator::validate($request->all(), [
            'rating' => 'required|between:1,5|multiple_of:.5',
            'comment' => ''
        ]);

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
