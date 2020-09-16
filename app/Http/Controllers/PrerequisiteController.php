<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Page;
use App\Models\Prerequisite;
use App\Models\Field;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PrerequisiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Page $page)
    {
        if ($request->ajax()) {
            $addedPrerequisites = ['items' => [], 'stats' => []];

            // Item case
            if ($request->get('item')) {
                $quantity = $request->get('quantity');

                $prerequisite = Prerequisite::updateOrCreate([
                    'page_id'   => $page->id,
                    'prerequisiteable_type' => 'item',
                    'prerequisiteable_id' => $request->get('item'),
                ], [
                    'quantity' => $quantity
                ]);

                $addedPrerequisites['items'][] = array_merge(
                    Item::findOrFail($request->get('item'))->toArray(),
                    [
                        'quantity' => $quantity,
                        'prerequisite_id' => $prerequisite->id,
                    ]
                );
            }

            // Stat case
            if ($request->get('stats')) {
                foreach ($request->get('stats') as $stat => $value) {
                    $foundStat = Field::where([
                        'story_id' => $page->story->id,
                        'name' => $stat
                    ])->firstOrFail();
                    $addedPrerequisites['stats'][] = Prerequisite::updateOrCreate([
                        'page_id'   => $page->id,
                        'prerequisiteable_type' => 'field',
                        'prerequisiteable_id' => $foundStat->id,
                    ], [
                        'quantity' => $value
                    ]);
                }
            }

            // Money case
            if ($request->get('money')) {
                Prerequisite::updateOrCreate([
                    'page_id'   => $page->id,
                    'prerequisiteable_type' => 'money',
                    'prerequisiteable_id' => 0,
                ], [
                    'quantity' => $request->get('money')
                ]);
            }

            return response()->json([
                'success' => true,
                'prerequisites' => $addedPrerequisites,
                'type' => 'save',
            ]);
        }

        abort(JsonResponse::HTTP_NOT_FOUND);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Prerequisite $prerequisite
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request, Prerequisite $prerequisite)
    {
        if ($request->ajax()) {
            $deleted = $prerequisite->delete();

            return response()->json([
                'success' => $deleted,
                'type' => 'delete'
            ]);
        }

        abort(JsonResponse::HTTP_NOT_FOUND);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Page         $page
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Page $page)
    {
        $view = View::make('page.partials.prerequisites_list', [
            'page' => $page
        ]);

        return $view;
    }
}
