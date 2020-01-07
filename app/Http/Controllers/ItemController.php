<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Item         $item
     *
     * @return false|string
     * @throws \Exception
     */
    public function delete(Request $request, Item $item)
    {
        if ($request->ajax()) {
            $deleted = $item->delete();

            return json_encode(['success' => $deleted]);
        }

        abort(JsonResponse::HTTP_NOT_FOUND);
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $validated = Validator::validate($request->all(), [
            'name'          => 'required|min:2|unique:items',
            'default_price' => 'required',
            'single_use'    => '',
            'story_id'      => 'required|exists:stories,id',
        ]
        );

        // Create the new item
        $item = Item::create($validated);

        // Reload the items in the story, so that we have the new one in the collection
        $item->story->load('items');

        return response()->json([
            'success'   => $item instanceof Item,
            'item'      => $item->toArray(),
        ]);
    }
}
