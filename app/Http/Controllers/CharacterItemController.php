<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\CharacterItem;
use App\Models\Item;
use Illuminate\Http\JsonResponse;

class CharacterItemController extends Controller
{
    /**
     * @param \App\Models\Character $character
     * @param \App\Models\Item      $item
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function itemUse(Character $character, Item $item): JsonResponse
    {
        $item = $character->items()
                          ->wherePivot('item_id', $item->id)
                          ->wherePivot('is_used', false)
                          ->first();

        $characterItem = CharacterItem::where('id', $item->pivot->id)->first();
        $success = $characterItem->use();

        return response()->json([
            'refreshInventory' => $success,
            'refreshContent' => $success,
            'refreshSheet' => $success,
            'refreshChoices' => $success,
        ]);
    }
}
