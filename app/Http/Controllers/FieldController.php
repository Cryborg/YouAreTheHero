<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\Story;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

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

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Field        $field
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, Field $field)
    {
        if ($request->ajax()) {
            $htmlData = [];

            $response = [
                'success' => false,
                'type'    => 'delete',
                'max'     => $field->story->maxPointsToShare(),
                'html'    => '',
                'texts'   => []
            ];

            if (!$request->get('force')) {
                /**
                 * Check if the field is used elsewhere
                 * If it is, return the 'confirm" type, so that we can show
                 * a popup to the user to warn him
                 */
                $prerequisitesCount = $field->prerequisites()->count();
                $itemsCount         = $field->items()->count();
                $resultInPages      = $this->getOccurrencesInPages($field);
                $response['test']   = $resultInPages;

                // Common to all cases
                if ($prerequisitesCount > 0 || $itemsCount > 0 || count($resultInPages) > 0) {
                    $response['type']  = 'confirm';
                    $response['texts'] = [
                        'title'  => trans('field.deleting.title'),
                        'button' => trans('field.deleting.button')
                    ];
                }

                // If it is used in prerequisites
                if ($prerequisitesCount > 0) {
                    $htmlData['prerequisites'] = $field->prerequisites;
                }

                // If it is used in items
                if ($itemsCount > 0) {
                    $htmlData['items'] = $field->items;
                }

                // If it is used in pages
                if (count($resultInPages) > 0) {
                    $htmlData['pages'] = $resultInPages;
                }

                $response['html'] = View::make('layouts.modals.template.deleting_field', $htmlData)->render();
            }

            // If it is used nowhere, soft delete it
            if ($response['type'] === 'delete') {
                $response['success'] = $field->delete();
            }

            return response()->json($response);
        }

        abort(JsonResponse::HTTP_NOT_FOUND);
    }

    /**
     * @param \App\Models\Field $field
     *
     * @return array
     */
    private function getOccurrencesInPages(Field $field)
    {
        $result = [];

        $field->story->pages->each(static function ($page) use ($field, &$result) {
            if (strrpos($page->content, '[' . $field->name) !== false) {
                $result[] = $page;
            }
        });

        return $result;
    }
}
