<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;

class StoryOptionsController extends Controller
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
        }

        $success = $story->story_options()->update([
            $option => $value
        ]);

        return response()->json([
            'success' => $success,
        ]);
    }
}
