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
            'item_id'       => 'present',
            'target_page'   => 'required_with:target_text',
            'target_text'   => 'required_with:target_page',
            'type'          => 'required',
        ]);

        $validated['type'] = $validated['type'] == 1 ? 'integer' : 'string';

        $validated = array_filter($validated);

        optional($page->riddle)->delete();

        $page->riddle()->create($validated);

        $page->load('riddle');

        return response()->json([
            'success' => $success,
            'riddle' => $page->riddle,
            'page_title' => optional($page->riddle->page)->title,
            'item_name' => optional($page->riddle->item)->name
        ]);
    }
}
