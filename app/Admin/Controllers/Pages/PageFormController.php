<?php

namespace App\Admin\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Page;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;

/**
 * Class PagesFormController
 * @package App\Admin\Controllers\Pages
 */
class PageFormController extends Controller
{
    /**
     * @param Request $request
     * @return Content
     */
    public function form(Request $request)
    {
        $form = new Form(new Page());

        $form->setAction('#');

        $form->tools(function (Form\Tools $tools) {
            $tools->disableList();
            $tools->disableDelete();
            $tools->disableView();

            $tools->add('<a class="btn btn-sm btn-twitter" id="create_new_page"><i class="fa fa-plus"></i>&nbsp;&nbsp;Créer une nouvelle page</a>');
            $tools->add('<a class="btn btn-sm btn-success" id="create_new_children_page"><i class="fa fa-plus"></i>&nbsp;&nbsp;Créer une nouvelle page fille</a>');
            $tools->add('<a class="btn btn-sm btn-danger" id="delete_page"><i class="fa fa-trash"></i>&nbsp;&nbsp;Supprimer</a>');
        });

        $form->footer(function (Form\Footer $footer) {
            $footer->disableReset();
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });

        $form->textarea('content', 'Contenu')->rules('required|min:3');

        $form->multipleSelect('items', __('admin.items'))->options(Item::all()->pluck('name', 'id'));
        $form->edit($request->page_id);
        $form->hidden('csrf-token')->value(csrf_token());
        $form->hidden('page_id')->value($request->page_id ?? '');
        $form->hidden('story_id')->value($request->story_id ?? '');


        return $form->render();
    }
}
