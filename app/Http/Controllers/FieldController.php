<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\Story;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FieldController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Story $story)
    {
        if ($request->ajax()) {

            Validator::extend('type', function ($validator) {
                $validator->type = 'save';
            });

            $validated = $request->validate([
                'id'            => '',
                'name'          => 'required',
                'hidden'        => 'required|in:0,1',
                'min_value'     => 'required',
                'max_value'     => 'required|gte:min_value',
                'start_value'   => 'required|gte:min_value|lte:max_value',
            ]);

            $validated['story_id'] = $story->id;

            // Replace spaces with underscores for variables (= hidden field)
            if ((bool)$validated['hidden'] === true) {
                $validated['name'] = str_replace(' ', '_', $validated['name']);
            }

            if (isset($validated['id'])) {
                $field = Field::updateOrCreate(['id' => $validated['id']], $validated);
            } else {
                $field = Field::create($validated);
            }

            // Determine the maximum points that can be shared
            $max = $story->maxPointsToShare();

            if ($story->options->points_to_share > $max) {
                $story->options->points_to_share = $max;
                $story->options->save();
            }

            return response()->json([
                'success'   => $field instanceof Field,
                'type' => 'save',
                'field' => $field->toArray(),
                'max' => $max,
            ]);
        }

        abort(JsonResponse::HTTP_NOT_FOUND);
    }

    public function delete(Request $request, Field $field)
    {
        // Check if the field is used elsewhere
        $prerequisitesCount = $field->prerequisites->count();
        $itemsCount = $field->items->count();
        $effectsCount = $field->fields->count();


        if ($request->ajax()) {
            return response()->json([
                                        //'success' => $field->delete(),
                                        'success' => true,
                                        'type'    => 'delete',
                                        'max'     => $field->story->maxPointsToShare(),
                                        'counts' => [
                                            $prerequisitesCount, $itemsCount, $effectsCount
                                        ]
                                    ]);
        }

        abort(JsonResponse::HTTP_NOT_FOUND);
    }
}
