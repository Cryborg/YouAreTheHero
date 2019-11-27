<?php

namespace App\Admin\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Encore\Admin\Layout\Content;

/**
 * Class PagesController
 * @package App\Admin\Controllers
 */
class PagesJsonController extends Controller
{
    /**
     * @param $storyId
     * @return Content
     */
    public function json($storyId)
    {
        $user = Page::where('story_id', $storyId);
dd($user->get());
        return (string) $user;

    }
}
