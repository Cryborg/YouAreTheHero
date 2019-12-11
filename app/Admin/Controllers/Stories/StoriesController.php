<?php

namespace App\Admin\Controllers\Stories;

use App\Models\Story;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

/**
 * Class StoriesController
 * @package App\Admin\Controllers
 */
class StoriesController extends AdminController
{

    /**
     * Make a grid builder.
     *
     * @return Content
     */
    public function list()
    {
        return Admin::content(static function (Content $content) {

            $content->header(__('common.stories_list'));

            $content->body(Admin::grid(Story::class, function (Grid $grid) {
                $grid->disableRowSelector();
                $grid->disableExport();

                $grid->id('id')->setAttributes(['width' => '5%']);
                $grid->column('title', __('admin.title'));

                $grid->column('genres', __('common.genres'))->display(function($items){
                    $labels = [];
                    foreach ($items as $item) {
                        $labels[] = $item['label'];
                    }

                    return implode(', ', $labels);
                });

                $grid->column('locale', __('admin.language'))->setAttributes(['width' => '10%']);
                $grid->column('layout', __('admin.layout'))->setAttributes(['width' => '10%']);

                $grid->is_published(__('admin.is_published'))->display(function ($released) {
                    return $released ? __('common.oui') : '-';
                })->setAttributes(['width' => '10%']);
            }));
        });
    }
}
