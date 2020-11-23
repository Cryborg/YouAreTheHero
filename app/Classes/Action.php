<?php

namespace App\Classes;

use App\Models\Character;
use App\Models\Field;
use App\Models\Item;
use App\Models\Story;
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
        $options = $character->story->options;

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
     * Apply all the effects of an item on the character
     *
     * @param \App\Models\Character $character
     * @param \App\Models\Item      $item
     *
     * @return bool
     */
    public static function applyEffects(Character $character, Item $item): bool
    {
        $item->fields()
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
     * @return Character|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    protected static function getCharacter()
    {
        $characterId = getSession('character_id');
        return Character::where('id', $characterId)->first();
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
        $character = self::getCharacter();

        $genre       = Constants::GENRE_FEMALE;
        $split       = explode('|', $text);

        if ($character !== null) {
            $genre = $character->genre;
        }

        // There must be 2 values, no more, no less
        if (count($split) !== 2) {
            return self::displayError(trans('functions.genre.errors.parameters'));
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

    /**
     * Reverse the text.
     * Example: "Reversed" becomes "desreveR"
     *
     * @param $text
     *
     * @return string
     */
    public static function reverse($text): string
    {
        $reversed = '';

        for ($i = strlen($text) - 1; $i >= 0; $i--) {
            $reversed .= substr($text, $i, 1);
        }

        return $reversed;
    }

    /**
     * Gives a random number.
     *
     * @param $text
     *
     * @return int
     * @throws \Exception
     */
    public static function random($text)
    {
        $split = explode('|', $text);

        // If there is exactely 2 integers, return a random number between the 2
        if ((count($split) === 2) && is_numeric($split[0]) && is_numeric($split[1])) {
            return random_int($split[0], $split[1]);
        }

        $randomKey = array_rand($split);

        return $split[$randomKey];
    }

    public static function if($text, Story $story = null)
    {
        $split = explode('|', $text);
        $split = array_map('trim', $split);
        $condition = self::evaluateCondition($story, $split[0]);

        if ($condition === true) {
            return $split[1];
        }

        return $split[2] ?? '';
    }

    private static function evaluateCondition($story, string $text)
    {
        if (!$story instanceof Story) {
            return false;
        }

        $characterId = getSession('character_id');
        $character   = Character::where('id', $characterId)->first();

        $gte = strpos($text, '&gt;=');
        $lte = strpos($text, '&lt;=');
        $eq = strpos($text, '=');

        if ($gte !== false)
        {
            $split = explode('&gt;=', $text);

            $field = Field::where('story_id', $story->id)
                ->where('name', $split[0])
                ->first();

            if ($field && $character) {
                $characterField = $character->fields()
                    ->withPivot('value')
                    ->where('field_id', $field->id)->first();

                return $characterField->pivot->value >= $split[1];
            }

        }

        if ($lte !== false)
        {
            $split = explode('&lt;=', $text);

            $field = Field::where('story_id', $story->id)
                ->where('name', $split[0])
                ->first();

            if ($field && $character) {
                $characterField = $character->fields()
                    ->withPivot('value')
                    ->where('field_id', $field->id)->first();

                return $characterField->pivot->value <= $split[1];
            }

        }

        if ($eq !== false)
        {
            $split = explode('=', $text);

            $field = Field::where('story_id', $story->id)
                ->where('name', $split[0])
                ->first();

            if ($field && $character) {
                $characterField = $character->fields()
                    ->withPivot('value')
                    ->where('field_id', $field->id)->first();

                return $characterField->pivot->value == $split[1];
            }

        }
    }

    /**
     * @param      $value
     * @param null $story
     *
     * @return string
     */
    public static function variable($value, $story = null)
    {
        try {
            $character = self::getCharacter();

            $split = explode('.', $value);

            if (count($split) !== 2) {
                return $value;
            }

            if ($split[1] === 'name') {
                return $split[0];
            }

            if ($split[1] === 'value') {
                if ($character) {
                    $pivot = optional($character->fields()
                                                ->where('name', $split[0])
                                                ->first())->pivot;

                    if ($pivot) {
                        return $pivot->value;
                    }

                    return self::displayError(trans('variables.does_not_exist', ['variable' => $split[0]]));
                }

                return random_int(1, 10);
            }
        } catch (\Exception $e) {
            return self::displayError($value);
        }
    }

    private static function displayError($error)
    {
        return '<b class="text-red">## ERREUR: ' . $error . ' ##</b>';
    }
}
