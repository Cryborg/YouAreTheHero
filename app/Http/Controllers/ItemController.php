<?php

namespace App\Http\Controllers;

use App\Models\CharacterItem;
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
                'success' => $item->delete(),
                'type' => 'delete',
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
                'id'            => '',
                'category'      => '',
                'default_price' => 'required',
                'effects'       => '',
                'is_throwable'  => '',
                'is_unique'     => '',
                'name'          => 'required|min:2',
                'single_use'    => '',
                'size'          => 'required|min:0',
                'story_id'      => 'required|exists:stories,id',
            ]);

        $effects = $validated['effects'] ?? [];
        unset($validated['effects']);

        // Create the new item
        if (!empty($validated['id'])) {
            $item = Item::updateOrCreate(['id' => $validated['id']], $validated);
        } else {
            $item = Item::updateOrCreate($validated);
        }

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
            'type'    => 'save',
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
            'is_unique' => (bool) $item->is_unique,
            'refreshInventory' => $success['success'],
            'refreshChoices' => $success['success'],
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
        return View::make('page.js.partials.item_list_div', ['items' => $story->items->sortBy('name')]);
    }

    /**
     * @param CharacterItem $characterItem
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function throwAway(CharacterItem $characterItem)
    {
        $success = $characterItem->delete();

        return response()->json([
           'refreshInventory' => $success,
           'refreshContent' => $success,
        ]);
    }

    /**
     * List all items for a given story
     *
     * @param \App\Models\Story $story
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function modalList(Story $story): \Illuminate\Contracts\View\View
    {
        $view = View::make('page.partials.modal_list_items', [
            'items' => $story->items
        ]);

        return $view;
    }

    public function list(Request $request, Story $story): \Illuminate\Contracts\View\View
    {
        $view = View::make('page.partials.select_item', [
            'items' => $story->items->sortBy('name')->pluck('name', 'id')->toArray(),
            'selectId' => $request->get('selectId'),
        ]);

        return $view;
    }

    public function details(Item $item)
    {
        $view = View::make('item.partials.edit_item', [
            'item' => $item
        ]);

        return $view;
    }
}
