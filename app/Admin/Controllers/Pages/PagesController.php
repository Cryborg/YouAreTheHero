<?php

namespace App\Admin\Controllers\Pages;

use App\Models\Genre;
use App\Models\Page;
use App\Models\Story;
use App\Models\StoryGenres;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

/**
 * Class PagesController
 * @package App\Admin\Controllers
 */
class PagesController extends AdminController
{
    /**
     * @return Content
     */
    public function list(Story $story)
    {
        return Admin::content(function (Content $content) use ($story) {

            $content->header('Pages Stories');

            $content->body(Admin::grid(Page::class, static function (Grid $grid) use ($story) {

                // Only show the pages for this particular story
                $grid->model()->where('story_id', '=', $story->id);

                // Place the first page at the beginning and the last one at the end
                $grid->model()->orderBy('is_first', 'desc');
                $grid->model()->orderBy('is_last', 'asc');
                $grid->model()->orderBy('created_at', 'asc');

                // No need for this, we will have our own creation layout
                $grid->disableCreateButton();

                $grid->column('title', __('admin.title'));

                $grid->is_first(__('admin.is_first_page'))->display(function ($released) {
                    return $released ? 'Yes' : '-';
                });
                $grid->is_last(__('admin.is_last_page'))->display(function ($released) {
                    return $released ? 'Yes' : '-';
                });

                $grid->column('layout', __('admin.layout'));
                $grid->created_at();

            }));
        });
    }
}
