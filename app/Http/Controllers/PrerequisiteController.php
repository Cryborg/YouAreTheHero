<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Item;use App\Models\Page;
use App\Models\Prerequisite;
use App\Models\CharacterStat;use App\Models\StatStory;use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PrerequisiteController extends Controller
{
    public function store(Request $request, Page $page)
    {
        if ($request->ajax()) {
            $addedPrerequisites = ['items' => [], 'stats' => []];

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

            if ($request->get('stats')) {
                foreach ($request->get('stats') as $stat => $value) {
                    $foundStat = StatStory::where([
                        'story_id' => $page->story->id,
                        'full_name' => $stat
                    ])->firstOrFail();
                    $addedPrerequisites['stats'][] = Prerequisite::updateOrCreate([
                        'page_id'   => $page->id,
                        'prerequisiteable_type' => 'stat',
                        'prerequisiteable_id' => $foundStat->id,
                    ], [
                        'quantity' => $value
                    ]);
                }
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
     * @param \App\Models\Action   $action
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
