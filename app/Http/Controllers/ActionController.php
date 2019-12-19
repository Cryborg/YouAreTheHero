<?php

namespace App\Http\Controllers;

use App\Models\ActionPage;
use App\Models\Page;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    public function store(Request $request, Page $page)
    {
        if ($request->ajax()) {
            $validated = $request->validate([
                'item_id'  => 'required',
                'verb'     => 'required',
                'quantity' => 'required',
                'price'    => '',
            ]);

            $validated['page_id'] = $page->id;

            $newAction = ActionPage::create($validated);

            // Item object
            $newAction['item'] = $newAction->item;

            // Translate the verb, as we cannot do this in JS without plugin
            $newAction['verb'] = trans('actions.' . $newAction['verb']);

            return json_encode([
                'action' => $newAction,
                'success' => true,
            ]);
        }

        abort(JsonResponse::HTTP_NOT_FOUND);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ActionPage   $action
     *
     * @return false|string
     * @throws \Exception
     */
    public function delete(Request $request, ActionPage $action)
    {
        if ($request->ajax()) {
            $deleted = $action->delete();

            return json_encode(['success' => $deleted]);
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
        return json_encode($page->actions);
    }
}
