<?php

namespace App\Admin\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

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

        if (null !== $request->page_id) {
            Page::find($request->page_id)->update([
                'content' => $request->get('content'),
            ]);
        } else {
            $page = Page::create(
                [
                    'id' => $request->page_id,
                    'content' => $request->get('content'),
                    'story_id' => $request->story_id,
                ]
            );

            if ($request->has('page_parent')) {
                $pageLink = new PageLink();
                $pageLink->page_from = $request->page_parent;
                $pageLink->page_to = $page->id;
                $pageLink->link_text = 'toto';
                $pageLink->save();
            }
        }

        Session::flash('success', 'File has been uploaded successfully!');
        return View::make('partials/flash-messages');
    }
}
