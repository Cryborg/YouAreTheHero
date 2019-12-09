<?php

namespace App\Admin\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Item;
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
     * @param Request $request
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

        $page = Page::where('story_id', $request->story_id)->where('id', $request->page_id)->first();
        $form->textarea('content', 'Contenu')->rules('required|min:3')
            ->value($page->content ?? '');

        $form->multipleSelect('items', __('admin.items'))
            ->options( Item::all()->mapWithKeys(function($item){
                $affect = array_keys($item->effects)[0];
                $operator = $item->effects[$affect]['operator'] === '*' ? 'x' : $item->effects[$affect]['operator'];
                $price = $item->default_price;

                return [ $item->id => $item->name.' - effects : '. "{$affect} : {$operator}{$item->effects[$affect]['quantity']} | price : $price"];
            }));

        $form->hidden('csrf-token')->value(csrf_token());
        $form->hidden('page_id')->value($page->id ?? '');

        return $form->render();
    }
}
