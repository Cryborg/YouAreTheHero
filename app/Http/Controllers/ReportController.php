<?php

namespace App\Http\Controllers;

use App\Bases\ControllerBase;
use App\Classes\Constants;
use App\Models\Inbox\Thread;
use App\Models\Page;
use App\Models\Report;
use App\Models\Story;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class ReportController extends ControllerBase
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
     * @param \Illuminate\Http\Request $request
     *
     * @param \App\Models\Page         $page
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, Page $page)
    {
        $validated = Validator::validate($request->all(), [
            'to' => 'required',
            'error_type' => 'required',
            'comment' => 'required|min:10',
        ]);

        $to = null;
        $comment = htmlentities($validated['comment']);

        switch ($validated['to']) {
            case Constants::AUTHOR:
                $to = $page->story->author->id;
                break;
            case Constants::ROLE_MODERATOR:
                $to = User::where('role', Constants::ROLE_MODERATOR)->get(['id'])->pluck('id')->toArray();
                break;
        }

        $comment = (string) View::make('inbox.templates.report', [
            'page' => $page,
            'errorType' => $validated['error_type'],
            'comment' => $comment,
        ])->render();

        $result = $this->authUser
            ->subject(trans('inbox.templates.report.message_title'))
            ->writes($comment)
            ->to($to)
            ->send();

        return response()->json([
            'success' => $result['thread'] instanceof Thread,
            'type'    => 'save',
        ]);
    }

    /**
     * @param \App\Models\Report $report
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Report $report)
    {
        return response()->json([
            'success' => $report->delete(),
            'type'    => 'delete',
        ]);
    }
}
