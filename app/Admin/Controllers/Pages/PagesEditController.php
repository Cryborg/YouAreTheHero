<?php

namespace App\Admin\Controllers\Pages;

use App\Models\Page;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Layout\Content;

/**
 * Class PagesEditController
 * @package App\Admin\Controllers\Pages
 */
class PagesEditController extends AdminController
{
    /**
     * @return Content
     */
    public function edit($id)
    {
        echo $id;
        return Admin::content(function (Content $content) {

            $content->header('Pages Stories');

            $content->body(Admin::grid(Page::class, static function (Form $form) {

            }));
        });
    }
}
