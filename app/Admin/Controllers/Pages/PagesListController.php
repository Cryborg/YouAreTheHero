<?php

namespace App\Admin\Controllers\Pages;

use App\Models\Page;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

/**
 * Class PagesListController
 * @package App\Admin\Controllers
 */
class PagesListController extends AdminController
{
    /**
     * @return Content
     */
    public function list()
    {
        return Admin::content(function (Content $content) {

            $content->header('Pages Stories');

            $content->body(Admin::grid(Page::class, static function (Grid $grid) {
                $grid->id('id');
                $grid->column('page_uuid', 'UUID');
                $grid->column('title', 'Title');
                $grid->column('is_first', 'Is first page');
                $grid->column('is_last', 'Is last page');
                $grid->column('layout', 'Layout');

            }));
        });
    }
}
