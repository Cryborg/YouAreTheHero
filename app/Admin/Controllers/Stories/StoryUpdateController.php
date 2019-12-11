<?php

namespace App\Admin\Controllers\Stories;

use App\Http\Controllers\Controller;
use App\Models\Genre;
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
        $story = Story::find($id);
        $story->update(['title' => $request->title]);
        $genres = $request->genres;

        array_pop($genres);
        $story->genres()->sync($genres);

        return back()->with ('ok', __ ('Le profil a bien été mis à jour'));
    }
}
