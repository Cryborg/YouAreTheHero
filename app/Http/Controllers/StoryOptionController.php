<?php

namespace App\Http\Controllers;

use App\Classes\Constants;
use App\Models\Story;
use Illuminate\Http\Request;

class StoryOptionController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Story  $story
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Story $story)
    {
        $option = $value = null;

        switch ($request->get('option'))
        {
            case 'has_character':
            case 'has_stats':
                $option = $request->get('option');
                $value = $request->get('value') === 'true';
                break;
            case 'stat_attribution_player':
                $option = 'stat_attribution';
                $value = 'player';
                break;
            case 'stat_attribution_dice':
                $option = 'stat_attribution';
                $value = 'dice';
                break;
            case 'inventory_slots':
                $option = 'inventory_slots';
                $value = $request->get('value');
                break;
            case 'genre_male':
                $option = 'character_genre';
                $value = Constants::GENRE_MALE;
                break;
            case 'genre_female':
                $option = 'character_genre';
                $value = Constants::GENRE_FEMALE;
                break;
            case 'genre_both':
                $option = 'character_genre';
                $value = Constants::GENRE_BOTH;
                break;
            case 'points_to_share':
                $option = 'points_to_share';
                $value = $request->get('value') ?? 10;
                break;
        }

        $success = $story->story_options()->updateOrCreate(['story_id' => $story->id], [
            $option => $value
        ]);

        return response()->json([
            'success' => $success,
        ]);
    }
}
