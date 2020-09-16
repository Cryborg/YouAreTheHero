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
                'name'          => 'required',
                'short_name'    => 'required|max:5',
                'hidden'        => 'required|in:0,1',
                'min_value'     => 'required',
                'max_value'     => 'required|gte:min_value',
            ]
            );

            $validated['story_id'] = $story->id;
            $validated['start_value'] = $validated['min_value'];

            $field = Field::create($validated);

            return response()->json([
                'success'   => $field instanceof Field,
                'field' => $field->toArray(),
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
            ]);
        }

        abort(JsonResponse::HTTP_NOT_FOUND);
    }
}
