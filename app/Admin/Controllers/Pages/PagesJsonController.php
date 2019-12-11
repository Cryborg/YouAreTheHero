<?php

namespace App\Admin\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Encore\Admin\Layout\Content;
use Illuminate\Database\Eloquent\Collection;

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
        /** @var Collection $pages */
        $pages = Page::withoutTrashed()
            ->where('story_id', $id)
            ->orderBy('number', 'asc')
            ->get();

        $tree = [];
        $clears = [];
        $numTree = 0;
        foreach ($pages as $k => $page) {
            if (!in_array($page->id, $clears)) {
                $tree[$numTree]['uuid'] = $page->id;
                $tree[$numTree]['id'] = $page->id;
                $tree[$numTree]['text'] = 'Page : '.$page->number;

                $tree[$numTree]['children'] = $this->addtree($page->pageLinks, $clears);
                $clears[] = $page->id;
                $numTree++;
            }
        }

        if (empty($tree)) {
            $tree[0]['id'] = 0;
            $tree[0]['text'] = 'The first page !';
        }

        return response()->json($tree);
    }

    private function addtree ($pageLinks, &$clears) {
        $childrens = [];
        foreach ($pageLinks as $c => $pageChildren) {
            $childrens[$c]['id'] = $pageChildren->pageTo->id;
            $childrens[$c]['text'] = 'Page : '.$pageChildren->pageTo->number;
            $childrens[$c]['page_from'] = $pageChildren->pageFrom->id;
            $childrens[$c]['children'] = $this->addtree($pageChildren->pageTo->pageLinks, $clears);
            $clears[] =  $pageChildren->pageTo->id;
        }

        return $childrens;
    }
}
