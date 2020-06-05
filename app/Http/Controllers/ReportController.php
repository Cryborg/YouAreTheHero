<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Report;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class ReportController extends Controller
{
    /**
     * @param \App\Models\Story $story
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Story $story)
    {
        return View::make('report.index', [
            'story' => $story,
            'reports' => $story->reports
        ]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, Page $page)
    {
        $validated = Validator::validate($request->all(), [
            'error_type' => 'required',
            'comment' => 'required|min:10',
        ]);

        $validated['comment'] = htmlentities($validated['comment']);
        $validated['user_id'] = \Auth::id();

        return response()->json([
            'success' => $page->reports()->create($validated),
        ]);
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * @param  int  $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Report $report)
    {
        return response()->json([
            'success' => $report->delete()
        ]);
    }
}
