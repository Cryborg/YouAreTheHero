<?php

namespace App\Http\Controllers;

use App\Models\ItemPage;
use App\Models\Page;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ItemPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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

            $newAction = ItemPage::create($validated);

            // Item object
            $newAction['item'] = $newAction->item;

            // Translate the verb, as we cannot do this in JS without plugin
            $newAction['verb'] = trans('item_page.' . $newAction['verb']);

            return response()->json([
                'action' => $newAction,
                'success' => true,
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
    public function delete(Request $request, ItemPage $action)
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
