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
            $validated = $request->validate([
                'prerequisite_type' => 'required',
                'prerequisite_id'   => 'required',
            ]);

            $validated['page_id'] = $page->id;

            $newPrerequisite = Prerequisite::create($validated);

            return response()->json([
                'action' => $newPrerequisite,
                'success' => true,
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
