<?php

namespace App\Http\Controllers;

use App\Models\Effect;
use App\Models\Item;
use App\Models\Page;
use App\Models\Story;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

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
            return response()->json([
                'success' => $item->delete()
            ]);
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
        $validated = Validator::validate($request->all(),
            [
                'name'          => 'required|min:2',
                'default_price' => 'required',
                'is_unique'     => '',
                'is_throwable'  => '',
                'story_id'      => 'required|exists:stories,id',
                'size'          => 'required|min:0',
                'effects'       => '',
                'category'      => '',
            ]);

        $effects = $validated['effects'] ?? [];
        unset($validated['effects']);

        // Create the new item
        $item = Item::updateOrCreate($validated);

        foreach ($effects as $effect) {
            if ($effect['value'] != '') {
                Effect::updateOrCreate([
                    'field_id' => $effect['id'],
                    'item_id'  => $item->id,
                ],
                    [
                        'operator' => $effect['operator'] ?? '+',
                        'quantity' => $effect['value'],
                    ]);
            }
        }

        // Reload the items in the story, so that we have the new one in the collection
        $item->story->load('items');

        return response()->json([
            'success' => $item instanceof Item,
            'item'    => $item->toArray(),
        ]);
    }

    /**
     * @param \App\Models\Item $item
     * @param \App\Models\Page $page
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function take(Item $item, Page $page): JsonResponse
    {
        $success = $item->take($page);

        return response()->json($success + [
            'is_unique' => (bool) $item->getRawOriginal('is_unique'),
            'refreshPurse' => $success['success'],
            'refreshInventory' => $success['success'],
        ], 200);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Story        $story
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function htmlList(Request $request, Story $story)
    {
        $validated = $request->validate([
            'context' => 'required|in:div,select'
        ]);

        return View::make('page.js.partials.item_list_' . $validated['context'], ['items' => $story->items->sortBy('name')]);
    }

    /**
     * @param \App\Models\Item $item
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function throwAway(Item $item)
    {
        /** @var \App\Models\Character $character */
        $character = $item->story->currentCharacter();

        if ($item->is_unique) {
            $detached = $character->items()->detach($item);

            return response()->json([
               'refreshInventory' => $detached,
               'refreshContent' => $detached,
            ]);
        }
    }

    /**
     * List all items for a given story
     *
     * @param \App\Models\Story $story
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function list(Story $story): \Illuminate\Contracts\View\View
    {
        $view = View::make('page.partials.modal_list_items', [
            'items' => $story->items
        ]);

        return $view;
    }
}
