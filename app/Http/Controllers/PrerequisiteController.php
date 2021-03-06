<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Prerequisite;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PrerequisiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Page $page)
    {
        if ($request->ajax()) {
            $itemId = $request->get('item', null);

            if (empty($itemId)) {
                $itemId = optional($page->story->currency)->id;
            }

            Prerequisite::updateOrCreate([
                'page_id'   => $page->id,
                'prerequisiteable_type' => $request->get('type'),
                'prerequisiteable_id' => $itemId,
            ], [
                'quantity' => $request->get('quantity'),
                'operator' => Prerequisite::getOperator($request->get('operator', '>=')),
            ]);

            return response()->json([
                'success' => true,
                'type' => 'save',
            ]);
        }

        abort(JsonResponse::HTTP_NOT_FOUND);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Prerequisite $prerequisite
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request, Prerequisite $prerequisite)
    {
        if ($request->ajax()) {
            $deleted = $prerequisite->delete();

            return response()->json([
                'success' => $deleted,
                'type' => 'delete'
            ]);
        }

        abort(JsonResponse::HTTP_NOT_FOUND);
    }

    /**
     * @param \App\Models\Page $page
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function list(Page $page)
    {
        $view = View::make('page.partials.prerequisites_list', [
            'page' => $page
        ]);

        return $view;
    }
}
