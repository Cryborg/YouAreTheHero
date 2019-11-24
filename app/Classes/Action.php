<?php

namespace App\Classes;

use App\Models\Inventory;
use App\Models\Character;
use App\Models\Item;

class Action
{
    /**
     * @param \App\Models\Character $character
     * @param \App\Models\Item      $item
     */
    public static function buy(Character $character, Item $item): bool
    {
        // Remove the item price from the character money
        $newMoney = $character->money - $item->default_price;

        if ($newMoney < 0) {
            return false;
        }

        $character->update([
            'money' => $newMoney,
       ]);

        // Add the item to the character inventory
        $inventory = Inventory::firstOrNew([
            'character_id' => $character->id,
            'item_id' => $item->id,
        ]);

        $inventory->quantity += 1;
        $inventory->save();

        return true;
    }
}
