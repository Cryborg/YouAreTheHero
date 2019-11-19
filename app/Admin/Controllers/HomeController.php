<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Story;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class HomeController extends Controller
{
    public function index()
    {
        return Admin::content(static function (Content $content) {

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
    }
}
