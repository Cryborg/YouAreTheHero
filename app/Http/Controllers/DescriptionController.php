<?php

namespace App\Http\Controllers;

use App\Models\Description;
use App\Models\Page;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class DescriptionController extends Controller
{
    public function showModal(Request $request, Page $page)
    {
        if ($request->ajax()) {
            $view = View::make(
                'page.partials.modal_descriptions',
                [
                    'descriptions' => $page->descriptions,
                ]
            );

            return $view;
        }

        abort(JsonResponse::HTTP_NOT_FOUND);
    }

    public function store(Request $request, Page $page)
    {
        $this->authorize('edit', $page->story);

        $validated = Validator::validate($request->all(), [
            'keyword' => 'required',
            'description' => 'required'
        ]);

        return $page->descriptions()->updateOrCreate(
            ['keyword' => $request->get('keyword')],
            $validated
        );
    }

    public function delete(Description $description)
    {
        $this->authorize('edit', $description->page);

        $description->delete();
    }
}
