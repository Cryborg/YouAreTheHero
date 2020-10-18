<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\Story;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Story $story)
    {
        if ($request->ajax()) {
            $validated = $request->validate([
                'id'            => '',
                'name'          => 'required',
                'hidden'        => 'required|in:0,1',
                'min_value'     => 'required',
                'max_value'     => 'required|gte:min_value',
            ]);

            $validated['story_id'] = $story->id;
            $validated['start_value'] = $validated['min_value'];

            if (isset($validated['id'])) {
                $field = Field::updateOrCreate(['id' => $validated['id']], $validated);
            } else {
                $field = Field::create($validated);
            }

            // Determine the maximum points that can be shared
            $max = $story->maxPointsToShare();

            if ($story->story_options->points_to_share > $max) {
                $story->story_options->points_to_share = $max;
                $story->story_options->save();
            }

            return response()->json([
                'success'   => $field instanceof Field,
                'field' => $field->toArray(),
                'max' => $max,
            ]);
        }

        abort(JsonResponse::HTTP_NOT_FOUND);
    }

    public function delete(Request $request, Field $field)
    {
        if ($request->ajax()) {
            return response()->json([
                'success' => $field->delete(),
                'type'    => 'delete',
                'max'     => $field->story->maxPointsToShare(),
            ]);
        }

        abort(JsonResponse::HTTP_NOT_FOUND);
    }
}
