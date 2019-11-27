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
        $page = new Page();

        $page->content = $request->get('content');
        $page->story_id = $request->get('story_id');
        $page->is_first = $request->has('is_first') ?? false;
        $page->is_last = $request->has('is_last') ?? false;

        $page->save();

        return back()->with('Ok');
    }
}
