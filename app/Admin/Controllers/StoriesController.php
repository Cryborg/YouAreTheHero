<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Story;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

/**
 * Class StoriesController
 * @package App\Admin\Controllers
 */
class StoriesController extends Controller
{
    /**
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Post');
            $content->description('Detail');

            $content->body(Admin::show(Story::findOrFail(1), function (Show $show) {

                $show->id('ID');
                $show->user_id();
                $show->title();
                $show->description();
                $show->created_at();
                $show->updated_at();

            }));
        });

        // Direct rendering view, Since v1.6.12
        $content->view('admin/dashboard', ['data' => 'foo']);
    }
}
