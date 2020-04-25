<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RiddleController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Story  $story
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, Page $page)
    {
        $success = true;

        $validated = $request->validate([
            'answer'        => 'required',
            'item_id'       => 'required',
            'target_page'   => 'required',
            'target_text'   => 'required',
            'type'          => 'required',
        ]);

        $validated['type'] = $validated['type'] == 1 ? 'integer' : 'string';

        if ($page->riddle) {
            $page->riddle()->update($validated);
        } else {
            $page->riddle()->create($validated);
        }

        return response()->json([
            'success' => $success,
            'riddle' => $page->riddle
        ]);
    }
}
