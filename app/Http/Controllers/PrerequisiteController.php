<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Page;
use App\Models\Prerequisite;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PrerequisiteController extends Controller
{
    public function store(Request $request, Page $page)
    {
        if ($request->ajax()) {
            $addedPrerequisites = ['items' => [], 'stats' => []];

            if ($request->get('items')) {
                foreach ($request->get('items') as $stat) {
                    $addedPrerequisites['items'][] = Prerequisite::create([
                        'page_id'   => $page->id,
                        'prerequisiteable_type' => 'item',
                        'prerequisiteable_id' => $stat,
                    ]);
                }
            }

            if ($request->get('sheet')) {
                foreach ($request->get('sheet') as $stat => $value) {
                    $addedPrerequisites['stats'][] = Prerequisite::create([
                        'page_id'   => $page->id,
                        'prerequisiteable_type' => 'sheet',
                        'prerequisiteable_id' => $stat,
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
    public function delete(Request $request, Action $action)
    {
        if ($request->ajax()) {
            $deleted = $action->delete();

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
