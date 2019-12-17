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

            $newAction['item'] = $newAction->item;

            return json_encode([
                'action' => $newAction,
                'success' => true,
            ]);
        }

        abort(404);
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

        abort(404);
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
