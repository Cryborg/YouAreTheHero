<?php

namespace App\Admin\Controllers\Stories;

use App\Models\Story;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Illuminate\Support\Facades\Auth;

/**
 * Class StoriesListController
 * @package App\Admin\Controllers
 */
class StoriesListController extends AdminController
{

    /**
     * Make a grid builder.
     *
     * @return Content
     */
    public function list()
    {
        return Admin::content(static function (Content $content) {

            $content->header('List Stories');

            $content->body(Admin::grid(Story::class, function (Grid $grid) {
                $grid->model()->where('user_id', '=', Auth::id());

                $grid->id('id');
                $grid->column('title', 'Title');
                $grid->column('description', 'Description');
                $grid->column('description', 'Description');

                $grid->is_published(__('admin.is_published'))->display(function ($released) {
                    return $released ? 'Yes' : '-';
                });
            }));
        });
    }
}
