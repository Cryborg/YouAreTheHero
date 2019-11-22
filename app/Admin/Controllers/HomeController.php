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


        });
    }
}
