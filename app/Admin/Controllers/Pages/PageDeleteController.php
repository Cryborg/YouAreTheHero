<?php

namespace App\Admin\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

/**
 * Class PageDeleteController
 * @package App\Admin\Controllers\Pages
 */
class PageDeleteController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function delete(Request $request)
    {
        Page::destroy($request->id);

        Session::flash('delete_page', 'Page has been deleted successfully!');
        return View::make('partials/flash-messages');
    }
}
