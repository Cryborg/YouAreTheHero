<?php

namespace App\Http\Controllers;

use App\Bases\ControllerBase;
use App\Models\Inbox\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\JsonResponse;

class InboxController extends ControllerBase
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $user = auth()->user();
        if (request()->has('sent')) {
            $threads = $user->sent();
        } else {
            $threads = $user->received();
        }

        $threads = $threads->paginate(config('inbox.paginate', 10));

        return view('inbox.index', compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'body' => 'required',
            'recipients' => 'required|array',
        ]);

        $thread = auth()->user()
                        ->subject($request->subject)
                        ->writes($request->body)
                        ->to($request->recipients)
                        ->send();

        return redirect()
            ->route('inbox.index')
            ->with('message', [
                'type' => $thread ? 'success' : 'error',
                'text' => $thread ? trans('inbox.thread.sent') : trans('inbox.thread.whoops'),
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inbox\Thread  $thread
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Thread $thread)
    {
        if (request()->ajax()) {
            $thread = Thread::findOrFail($thread->id);

            $messages = $thread->messages()
                               ->get();

            $seen = $thread->participants()
                           ->where('user_id', auth()->id())
                           ->first();

            if ($seen && $seen->pivot) {
                $seen->pivot->seen_at = Carbon::now();
                $seen->pivot->save();
            } else {
                abort(JsonResponse::HTTP_NOT_FOUND);
            }

            return Response::json([
                'html' => View::make('inbox.partials.show', compact('messages', 'thread'))->render()
            ]);
        }

        abort(JsonResponse::HTTP_NOT_FOUND);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inbox\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inbox\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inbox\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Thread                    $thread
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function reply(Request $request, Thread $thread)
    {
        $thread = Thread::findOrFail($thread->id);

        $request->validate([
            'body' => 'required',
        ]);

        $message = $this->authUser
                         ->writes($request->body)
                         ->reply($thread);

        return Response::json([
            'message' => stripcslashes(includeAsJsString('inbox.partials.message', ['message' => $message])),
        ]);
    }
}
