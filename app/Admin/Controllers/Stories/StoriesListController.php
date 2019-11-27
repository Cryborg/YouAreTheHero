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
                $grid->disableRowSelector();

                $grid->model()->where('user_id', '=', Auth::id());

                $grid->id('id')->setAttributes(['width' => '5%']);
                $grid->column('title', __('admin.title'))   ;
                $grid->column('locale', __('admin.language'))->setAttributes(['width' => '10%']);
                $grid->column('layout', __('admin.layout'))->setAttributes(['width' => '10%']);

                $grid->is_published(__('admin.is_published'))->display(function ($released) {
                    return $released ? 'Yes' : '-';
                })->setAttributes(['width' => '10%']);
            }));
        });
    }
}
