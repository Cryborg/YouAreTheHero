<?php

namespace App\Admin\Controllers\Stories;

use App\Models\Story;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

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
                $grid->id('id');
                $grid->column('title', 'Title');
                $grid->column('description', 'Description');

            }));
        });
    }
}
