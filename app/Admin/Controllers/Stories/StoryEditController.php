<?php

namespace App\Admin\Controllers\Stories;

use App\Models\Genre;
use App\Models\Story;
use Doctrine\DBAL\Schema\View;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Layout\Content;

/**
 * Class StoryEditController
 * @package App\Admin\Controllers\Stories
 */
class StoryEditController extends AdminController
{
    /**
     * Set description for following 4 action pages.
     *
     * @var array
     */
    protected $description = [
        'edit' => 'Edit',
    ];

    /**
     * @param $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return Admin::content(static function (Content $content) use ($id) {

            $form = new Form(new Story());
            $form->tools(function (Form\Tools $tools) {
                $tools->disableList();
                $tools->disableDelete();
                $tools->disableView();
            });

            $form->footer(function ($footer) {
                $footer->disableReset();
                $footer->disableViewCheck();
                $footer->disableEditingCheck();
                $footer->disableCreatingCheck();
            });

            $form->setAction(route('admin.story.update', ['id' => $id]));
            $form->display('id', 'ID');
            $form->text('title', 'Story title')->rules('required|min:3');

            $form->multipleSelect('genres', __('common.genres'))
                ->options(Genre::all()->pluck('label', 'id'));

            $content->row($form->edit($id))->view('admin.story.story', ['story_id' => $id]);
        });
    }
}
