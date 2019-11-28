<?php

namespace App\Admin\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

/**
 * Class PageCreateController
 * @package App\Admin\Controllers\Pages
 */
class PageStoreController extends Controller
{
    /**
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $page = Page::create(
            [
                'content' => $request->get('content'),
                'story_id' => $request->get('story_id'),
                'is_first' => $request->get('is_first'),
                'is_last' => $request->get('is_last'),
            ]
        );

        return back()->with('Ok');
    }
}
