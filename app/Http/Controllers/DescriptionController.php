<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class DescriptionController extends Controller
{
    public function list(Request $request, Page $page)
    {
        $view = View::make('page.partials.modal_popovers', [
            'descriptions' => $page->descriptions,
        ]);

        return $view;
    }
}
