<?php

namespace App\Http\Controllers;

use App\Models\StatStory;
use App\Models\Story;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StatStoryController extends Controller
{
    public function store(Request $request, Story $story)
    {
        if ($request->ajax()) {
            $validated = $request->validate([
                'full_name'  => 'required',
                'short_name' => 'required|max:5',
                'min_value'  => 'required',
                'max_value'  => 'required|gte:min_value',
            ]
            );

            $validated['story_id'] = $story->id;
            $validated['start_value'] = $validated['min_value'];

            $statStory = StatStory::create($validated);

            return response()->json([
                'success'   => $statStory instanceof StatStory,
                'statStory' => $statStory->toArray(),
            ]);
        }

        abort(JsonResponse::HTTP_NOT_FOUND);
    }

    public function delete(Request $request, StatStory $statStory)
    {
        if ($request->ajax()) {
            return response()->json([
                'success' => $statStory->delete()
            ]);
        }

        abort(JsonResponse::HTTP_NOT_FOUND);
    }
}
