<?php

namespace App\Admin\Controllers\Stories;

use App\Models\Story;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;

/**
 * Class StoryCreateController
 * @package App\Admin\Controllers\Stories
 */
class StoryCreateController extends Controller
{
    public $form;

    /**
     * Set description for following 4 action pages.
     *
     * @var array
     */
    protected $description = [
        'create' => 'Create'
    ];

    /**
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        $form = new Form(new Story());
        $form->setAction(route('admin.story.store'));

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
        $user = Admin::user();

        $form->text('title', 'Story title')->rules('required|min:3');
        $form->text('description', 'Description')->rules('required|min:3');
        $form->hidden('user_id')->value($user->getAuthIdentifier());
        $this->form = $form;

        $content->row($form);

        return $content;
    }

    /**
     * @param Request $request
     * @return Redirector
     */
    public function store(Request $request)
    {
        $story = new Story();

        $story->title = $request->title;
        $story->description = $request->description;
        $story->user_id = $request->user_id;

        $story->save();

        return redirect()->route('admin.stories.list');
    }
}
