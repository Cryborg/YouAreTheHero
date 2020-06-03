<?php

namespace App\Http\Controllers;

use App\Classes\Action;
use App\Models\ItemPage;
use App\Models\Effect;
use App\Models\Item;
use App\Models\Page;
use App\Models\Story;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
        $validated = Validator::validate($request->all(),
            [
                'name'          => 'required|min:2',
                'default_price' => 'required',
                'single_use'    => '',
                'story_id'      => 'required|exists:stories,id',
                'size'          => 'required|min:0',
                'effects'       => '',
            ]);

        $effects = $validated['effects'] ?? [];
        unset($validated['effects']);

        // Create the new item
        $item = Item::create($validated);

        foreach ($effects as $effect) {
            if ($effect['value'] != '') {
                Effect::updateOrCreate([
                    'field_id' => $effect['id'],
                    'item_id'  => $item->id,
                ],
                    [
                        'operator' => '+',
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

    public function take(Page $page, Item $item): JsonResponse
    {
        $isOk    = false;
        $message = null;

        $character = $page->story->currentCharacter();

        $itemPage = ItemPage::where([
            'item_id' => $item->id,
            'page_id' => $page->id,
        ])->first();

        // Perform the action
        switch ($itemPage->verb) {
            case 'buy':
                $isOk = Action::buy($character, $item);
                break;
            case 'sell':
                $isOk = Action::sell($character, $item);
                break;
            case 'give':
                $isOk = Action::give($character, $item);
                break;
            case 'take':
                if (isset($item)) {
                    if (Action::hasRoomLeftInInventory($character, $item)) {
                        $existingItem = $character->items()->where('items.id', $item->id)->first();

                        if ($existingItem) {
                            $existingItem->pivot->quantity++;
                            $existingItem->pivot->save();
                        } else {
                            $character->items()->attach([
                                    $item->id => ['quantity' => $itemPage->quantity ?? 1],
                                ]);
                        }

                        $isOk = true;
                    } else {
                        $message = trans('inventory.no_more_room');
                    }
                }

                break;
        }

        // Apply item effects, if applicable
        Action::effects($character, $item);

        // Check if the item used has the single_use flag,
        // and in this case it must not be shown again
        if ($item->single_use) {
            $character->items()->syncWithoutDetaching([$item->id => ['used' => true]]);
        }

        return response()->json([
            'result'    => $isOk,
            'money'     => $character->money,
            'singleuse' => $item->single_use,
            'message'   => $message,
        ],
            200);
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
}
