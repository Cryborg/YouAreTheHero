<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Story;
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

            $content->header('Pages');

            $content->body(Admin::show(Story::findOrFail(1), function (Show $show) {

                $show->id('ID');
                $show->content();
                $show->story_id();
                $show->prerequisites();

            }));
        });

        // Direct rendering view, Since v1.6.12
        $content->view('admin/dashboard', ['data' => 'foo']);
    }
}
