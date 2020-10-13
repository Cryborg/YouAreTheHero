<?php

namespace App\Classes;

use App\Models\Character;
use App\Models\Item;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

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
        $character->items()
                  ->attach($item);

        return true;
    }

    /**
     * Check if there is room left in the inventoy for another item
     *
     * @param \App\Models\Character $character
     * @param \App\Models\Item      $item
     *
     * @return bool
     */
    public static function hasRoomLeftInInventory(Character $character, Item $item): bool
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

    /**
     * @param \App\Models\Character $character
     * @param \App\Models\Item      $item
     *
     * @return bool
     * @throws \Exception
     */
    public static function sell(Character $character, Item $item): bool
    {
        if ($character->items()
                      ->count() > 0) {
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
                                              'item_id' => $item->id,
                                              'character_id' => $character->id,
                                          ])
                                  ->first();

            if (!$inventory) {
                return false;
            }
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
     * Apply all the effects of an item on the character
     *
     * @param \App\Models\Character $character
     * @param \App\Models\Item      $item
     *
     * @return bool
     */
    public static function applyEffects(Character $character, Item $item): bool
    {
        $item->effects()
             ->each(static function ($effect) use ($character) {
                 $character->fields()
                           ->each(static function ($field) use ($effect) {
                               if ($field->id === $effect->field_id) {
                                   switch ($effect['operator']) {
                                       case '+':
                                           $field->pivot->value += $effect->quantity;
                                           break;
                                       case '-':
                                           $field->pivot->value -= $effect->quantity;
                                           break;
                                       case '*':
                                           $field->pivot->value *= $effect->quantity;
                                           break;
                                       case '/':
                                           $field->pivot->value /= $effect->quantity;
                                           break;
                                   }
                               }

                               return $field->pivot->save();
                           });
             });

        return true;
    }

    /**
     * @param $text
     *
     * @return string
     */
    public static function stutter($text): string
    {
        $stuttering = '';

        for ($i = 1; $i <= Arr::random([
                                           1,
                                           2,
                                       ]); $i++) {
            $stuttering .= Str::substr($text, 0, 1) . '...';
        }

        $stuttering .= $text;

        return $stuttering;
    }

    /**
     * @param $text
     *
     * @return string
     */
    public static function genre($text): string
    {
        $characterId = getSession('character_id');
        $character   = Character::where('id', $characterId)
                                ->first();
        $genre       = Constants::GENRE_FEMALE;
        $split       = explode('|', $text);

        if ($character !== null) {
            $genre = $character->genre;
        }

        // There must be 2 values, no more, no less
        if (count($split) !== 2) {
            return '!!genre[' . $text . ']!!';
        }

        switch ($genre) {
            case Constants::GENRE_MALE:
                return $split[0];
            case Constants::GENRE_FEMALE:
                return $split[1];
            default:
                return $text;
        }
    }
}
