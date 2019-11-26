<?php

namespace App\Admin\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

/**
 * Class PageCreateController
 * @package App\Admin\Controllers\Pages
 */
class PageCreateController extends Controller
{
    /**
     * @param Request $request
     * @return void
     */
    public function create(Request $request)
    {
        $page = new Page();

        $page->description = $request->description;
        $page->description = $request->description;
        $page->save();

        return back()->with('ok', __ ('Le profil a bien été mis à jour'));
    }
}
