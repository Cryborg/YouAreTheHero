<?php

namespace App\Admin\Controllers\Stories;

use App\Models\Page;
use App\Models\Story;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
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
        $form = new Form(new Story());
        $form->setAction(route('admin.story.update', ['id' => $id]));

        $form->display('id', 'ID');

        $form->text('title', 'Story title')->rules('required|min:3');

        $form->submitted(function (Form $form) {

        });

        return $content
            ->title($this->title())
            ->description($this->description['edit'] ?? trans('admin.edit'))
            ->body($form->edit($id));
    }
}
