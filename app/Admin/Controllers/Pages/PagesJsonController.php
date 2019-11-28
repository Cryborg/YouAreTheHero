<?php

namespace App\Admin\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Page_link;
use Encore\Admin\Layout\Content;

/**
 * Class PagesController
 * @package App\Admin\Controllers
 */
class PagesJsonController extends Controller
{
    /**
     * @param $id
     * @return Content
     */
    public function json($id)
    {
        $pages = Page::where('story_id', $id)
            ->orderBy('number', 'asc')
            ->get();

        $tree = [];
        $clears = [];
        $numTree = 0;
        foreach ($pages as $k => $page) {
            if (!in_array($page->id, $clears, true)) {
                $tree[$numTree]['uuid'] = $page->id;
                $tree[$numTree]['id'] = $page->number;
                $tree[$numTree]['text'] = $page->number;
                $pagesLink = Page_link::where('page_from', $page->id)->get();
                foreach ($pagesLink as $c => $pageLink) {
                    $pageChildren = Page::where('id', $pageLink->page_to)->first();
                    $tree[$numTree]['children'][$c]['id'] = $pageChildren->number;
                    $tree[$numTree]['children'][$c]['text'] = $pageChildren->number;
                    $tree[$numTree]['children'][$c]['page_from'] = $pageLink->page_from;
                    $clears[] = $pageChildren->id;
                }
                $numTree++;
            }
        }

        if (empty($tree)) {
            $tree[0]['id'] = 0;
            $tree[0]['text'] = 'The first page !';
        }

        return response()->json($tree);
    }
}
