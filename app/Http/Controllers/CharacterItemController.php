<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\CharacterItem;
use App\Models\Item;
use App\Models\Location;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

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

        return Response::json([
            'refreshInventory' => $success,
            'refreshContent' => $success,
            'refreshSheet' => $success,
            'refreshChoices' => $success,
        ]);
    }

    /**
     * When the character reads a map, he can go to the locations written on it
     * even if he/she never went there.
     *
     * @param \App\Models\Character $character
     * @param \App\Models\Item      $item
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function itemUseMap(Character $character, Item $item)
    {
        try {
            $item->triggers->each(static function ($trigger) use ($character) {
                if ($trigger->actionable instanceof Location) {
                    $character->locations()
                              ->syncWithoutDetaching($trigger->actionable);
                }

                // Mark the action as done if it is unique
                if ($trigger->unique) {
                    $character->actions()->syncWithoutDetaching($trigger);
                }
            });

            // Mark the item as used
            $character->items()->syncWithoutDetaching([
                $item->id => [
                    'is_used' => true,
                ]
            ]);

            return Response::json([
                'success' => true,
                'refreshLocations' => true
            ]);
        } catch (\Exception $e) {
            return Response::json([
                'success' => false,
                'message' => $e->getMessage(),
                'type' => 'save',
            ]);
        }
    }
}
