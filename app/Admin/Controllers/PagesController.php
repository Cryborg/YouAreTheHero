<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

/**
 * Class PagesController
 * @package App\Admin\Controllers
 */
class PagesController extends Controller
{
    /**
     * @return Content
     */
    public function index()
    {

        return Admin::content(function (Content $content) {

            $content->header(__('common.title_pages'));
            $content->description(__('admin.detail'));

            $content->body(Admin::show(Page::findOrFail(1), function (Show $show) {

                $show->id('ID');
                $show->story_id();
                $show->is_first();
                $show->is_last();
                $show->title();
                $show->description();
                $show->layout();

            }));
        });

        // Direct rendering view, Since v1.6.12
        $content->view('admin/dashboard', ['data' => 'foo']);
    }
}
