<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;

class StoriesController extends Controller
{
    public function list()
    {
        $stories = Story::all();

        return view('stories.list', compact('stories'));
    }
}
