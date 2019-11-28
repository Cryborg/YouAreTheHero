<?php

namespace App\Admin\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Encore\Admin\Form;
use Illuminate\Http\Request;

/**
 * Class PagesFormController
 * @package App\Admin\Controllers\Pages
 */
class PageFormController extends Controller
{
    /**
     * @return void
     */
    public function form(Request $request)
    {
        $form = new Form(new Page());
        $form->setAction('#');

        $form->tools(function (Form\Tools $tools) {
            $tools->disableList();
            $tools->disableDelete();
            $tools->disableView();
        });

        $form->footer(function (Form\Footer $footer) {
            $footer->disableReset();
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });

        $page = Page::where('story_id', $request->story_id)->where('number', $request->page_number)->first();
        $form->textarea('content', 'Contenu')->rules('required|min:3')->value($page->content);

        $form->hidden('csrf-token')->value(csrf_token());

        return $form->render();
    }
}
