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
     *
     * @param array                 $action
     *
     * @return bool
     */
    public static function buy(Character $character, Item $item, array $action): bool
    {
        if (!$character->spendMoney($action['price'] > 0 ?: $item->default_price)) {
            return false;
        }

        // Add the item to the character inventory
        // or increase the quantity if it already exists
        $inventory = Inventory::firstOrNew([
            'character_id' => $character->id,
            'item_id' => $item->id,
        ]);

        ++$inventory->quantity;
        $inventory->save();

        return true;
    }

    /**
     * @param \App\Models\Character $character
     * @param \App\Models\Item      $item
     *
     * @return bool
     * @throws \Exception
     */
    public static function sell(Character $character, Item $item, array $action): bool
    {
        if (!$character->addMoney($action['price'] > 0 ?: $item->default_price)) {
            return false;
        }

        return self::give($character, $item);
    }

    /**
     * @param \App\Models\Character $character
     * @param \App\Models\Item      $item
     *
     * @return bool
     * @throws \Exception
     */
    public static function give(Character $character, Item $item): bool
    {
        // Remove the item from the inventory
        try {
            $inventory = Inventory::where([
                'item_id'      => $item->id,
                'character_id' => $character->id,
            ])->firstOrFail();

            if ($inventory->quantity === 1) {
                return $inventory->delete();
            } else {
                --$inventory->quantity;
                return $inventory->save();
            }
        } catch (\Exception $e) {
            throw new \Exception("Couldn't delete the item. Reason: " . $e->getMessage());
        }
    }

    /**
     * @param \App\Models\Character $character
     * @param \App\Models\Item      $item
     */
    public static function effects(Character $character, Item $item): void
    {
        $allEffects = $item->effects;
        $characterStats  = $character->character_stats;

        foreach ($allEffects as $context => $effects) {
            switch ($context) {
                case 'character_stat':
                    foreach ($characterStats as $stat) {
                        foreach ($effects as $effect) {
                            if ($stat->stat_story_id == $effect['stat_story_id']) {
                                switch ($effect['operator']) {
                                    case '+':
                                        $stat->value += $effect['quantity'];
                                        break;
                                    case '-':
                                        $stat->value -= $effect['quantity'];
                                        break;
                                    case '*':
                                        $stat->value *= $effect['quantity'];
                                        break;
                                    case '/':
                                        $stat->value /= $effect['quantity'];
                                        break;
                                }
                            }
                        }

                        $stat->save();
                    }
                    break;
                default:
                    break;
            }
        }
    }
}
