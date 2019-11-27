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

        $page->description = $request->description;
        $page->story_id = $request->story_id;

        $page->save();

        return back()->with('ok', __ ('Le profil a bien été mis à jour'));
    }
}
