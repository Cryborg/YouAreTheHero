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
        if (!$character->spendMoney($item->default_price)) {
            return false;
        }

        // Add the item to the character inventory
        $inventory = Inventory::firstOrNew([
            'character_id' => $character->id,
            'item_id' => $item->id,
        ]);

        $inventory->quantity += 1;
        $inventory->save();

        return true;
    }

    public static function effects(Character $character, Item $item)
    {
        $effects = $item->effects;
        $caracs  = $character->sheet;

        foreach ($caracs ?? [] as $name => $carac) {
            if (array_key_exists($name, $effects)) {
                switch ($effects[$name]['operator']) {
                    case '+':
                        $caracs[$name] += $effects[$name]['quantity'];
                        break;
                    case '-':
                        $caracs[$name] -= $effects[$name]['quantity'];
                        break;
                    case '*':
                        $caracs[$name] *= $effects[$name]['quantity'];
                        break;
                    case '/':
                        $caracs[$name] /= $effects[$name]['quantity'];
                        break;
                }

                $caracs[$name] = ceil($caracs[$name]);
                if ($caracs[$name] <= 0) $caracs[$name] = 0;
            }
        }

        $character->sheet = $caracs;

        $character->save();
    }
}
