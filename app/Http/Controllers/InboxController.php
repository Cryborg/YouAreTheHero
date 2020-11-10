<?php

namespace App\Http\Controllers;

use App\Bases\ControllerBase;
use App\Classes\Constants;
use App\Models\Inbox\Thread;
use App\Models\User;
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
        $multiple = false;

        switch ($this->authUser->role) {
            case Constants::ROLE_ADMIN:
            case Constants::ROLE_MODERATOR:
                $recipients = User::get();
                $multiple = true;
                break;
            default:
                $recipients = User::whereIn('role', [Constants::ROLE_ADMIN])->get();
                break;
        }


        return view('inbox.index', compact('threads', 'recipients', 'multiple'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required',
            'recipients' => 'required',
        ]);

        $result = $this->authUser
                        ->subject($request->subject)
                        ->writes($request->body)
                        ->to($request->recipients)
                        ->send();

        $data = [
            'success' => $result['thread'] ? true : false,
            'isNew'   => $result['isNew'],
            'thread_id' => $result['thread']->id,
        ];

        if ($result['isNew'] === true) {
            $data['html'] = stripcslashes(includeAsJsString('inbox.partials.thread', ['thread' => $result['thread']]));
            $data['message'] = stripcslashes(includeAsJsString('inbox.partials.message', ['message' => $result['message']]));
        }

        return Response::json($data);

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
            'success' => true,
            'message' => stripcslashes(includeAsJsString('inbox.partials.message', ['message' => $message])),
        ]);
    }
}
