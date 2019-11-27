<?php

namespace App\Admin\Controllers\Stories;

use App\Http\Controllers\Controller;
use App\Models\Story;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;

/**
 * Class StoryUpdateController
 * @package App\Admin\Controllers\Stories
 */
class StoryUpdateController extends Controller
{
    /**
     * @param $id
     * @param Request $request
     * @return void
     */
    public function update($id, Request $request)
    {
        $story = Story::where('id', $id)->firstOrFail();
        $story->update(['title' => $request->title]);

        return back()->with ('ok', __ ('Le profil a bien été mis à jour'));
    }
}
