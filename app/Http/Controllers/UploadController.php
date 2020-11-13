<?php

namespace App\Http\Controllers;

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
}
