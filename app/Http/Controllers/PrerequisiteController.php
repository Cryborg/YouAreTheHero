<?php

namespace App\Http\Controllers;

use App\Models\ItemPage;
use App\Models\Item;use App\Models\Page;
use App\Models\Prerequisite;
use App\Models\CharacterField;use App\Models\Field;use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
            if ($request->get('items')) {
                $quantity = $request->get('quantity');

                foreach ($request->get('items') as $itemId) {
                    $prerequisite = Prerequisite::updateOrCreate([
                        'page_id'   => $page->id,
                        'prerequisiteable_type' => 'item',
                        'prerequisiteable_id' => $itemId,
                    ], [
                        'quantity' => $quantity
                    ]);

                    $addedPrerequisites['items'][] = array_merge(
                        Item::findOrFail($itemId)->toArray(),
                        [
                            'quantity' => $quantity,
                            'prerequisite_id' => $prerequisite->id,
                        ]
                    );
                }
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
            ]);
        }

        abort(JsonResponse::HTTP_NOT_FOUND);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ItemPage     $action
     *
     * @return false|string
     * @throws \Exception
     */
    public function delete(Request $request, Prerequisite $prerequisite)
    {
        if ($request->ajax()) {
            $deleted = $prerequisite->delete();

            return response()->json(['success' => $deleted]);
        }

        abort(JsonResponse::HTTP_NOT_FOUND);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Page $page
     *
     * @return false|string
     */
    public function list(Request $request, Page $page)
    {
        return response()->json($page->actions);
    }
}
