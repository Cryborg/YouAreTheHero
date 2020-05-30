<?php

namespace App\Classes;

use App\Models\Character;
use App\Models\Item;

class Action
{
    /**
     * @param \App\Models\Character $character
     * @param \App\Models\Item      $item
     *
     * @return bool
     */
    public static function buy(Character $character, Item $item): bool
    {
        if (!$character->spendMoney($item->pivot->price)) {
            return false;
        }

        if (self::hasRoomLeftInInventory($character, $item) === false) {
            return false;
        }

        // Add the item to the character inventory
        // or increase the quantity if it already exists
        //$item = $character->items->where(-e($value))
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
    public static function sell(Character $character, Item $item): bool
    {
        if ($character->items()->count() > 0) {
            if (!$character->addMoney($item->pivot->price)) {
                return false;
            }

            return self::give($character, $item);
        }

        return false;
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
            ])->first();

            if (!$inventory) return false;
            --$inventory->quantity;

            if ($inventory->quantity <= 0) {
                return $inventory->delete();
            } else {
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
        $characterStats  = $character->fields;

        foreach ($allEffects as $context => $effects) {
            switch ($context) {
                case 'character_fields':
                    foreach ($characterStats as $stat) {
                        foreach ($effects as $effect) {
                            if ($stat->field_id == $effect['field_id']) {
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

    /**
     * Check if there is room left in the inventoy for another item
     *
     * @param \App\Models\Character $character
     * @param \App\Models\Item      $item
     *
     * @return bool
     */
    public static function hasRoomLeftInInventory(Character $character, Item $item)
    {
        $options = $character->story->story_options;

        if ($options) {
            if ($options->inventory_slots > -1) {
                $occupiedSlots = $item->size;
                $character->items->each(function ($item) use (&$occupiedSlots) {
                    $occupiedSlots += ($item->size * $item->pivot->quantity);
                });

                return $occupiedSlots <= $options->inventory_slots;
            }
        }

        return true;
    }
}
