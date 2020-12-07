<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    /**
     * User avatar upload
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return false|string
     */
    public function avatar(Request $request)
    {
        $path = $request->file('avatar')->store('avatars');

        return $path;
    }

    /**
     * Images upload (in stories)
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return false|string
     */
    public function image(Request $request)
    {
        $storyId = getSession('story_id');

        $path = Storage::url($request->file('file')->store('images/stories/' . $storyId));

        return Response::json([
            'path' => $path
        ]);
    }

    public function cover(Request $request, Story $story)
    {
        // TODO: crop image
        $path = Storage::url($request->file('file')->store('images/stories/' . $story->id));
        $filename = pathinfo($path);
        $story->cover = $filename['filename'] . '.' . $filename['extension'];
        $story->save();

        return Response::json([
            'path' => $path
        ]);
    }
}
