<?php

namespace App\Traits;

use App\Models\Inbox\Message;
use App\Models\Inbox\Participant;
use Carbon\Carbon;
use App\Events\NewMessageDispatched;
use App\Events\NewReplyDispatched;
use App\Models\Inbox\Thread;

trait HasInbox
{
    protected $subject, $message;
    protected $recipients = [];
    protected $threadsTable, $messagesTable, $participantsTable;
    protected $threadClass, $participantClass;

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array $attributes
     *
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        $this->threadsTable = 'threads';
        $this->messagesTable = 'messages';
        $this->participantsTable = 'participants';

        $this->threadClass = config('inbox.models.thread');
        $this->participantClass = config('inbox.models.participant');

        parent::__construct($attributes);
    }

    public function subject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    public function writes($message)
    {
        $this->message = $message;

        return $this;
    }

    public function to($users)
    {
        if (is_array($users)) {
            $this->recipients = array_merge($this->recipients, $users);
        } else {
            $this->recipients[] = $users;
        }

        return $this;
    }


    /**
     * Send new message
     *
     * @return mixed
     */
    public function send()
    {
        $thread = $this->threads()->create([
                                               'subject' => $this->subject,
                                           ]);

        // Message
        $message = $thread->messages()->create([
                                                   'user_id' => $this->id,
                                                   'body' => $this->message
                                               ]);

        // Sender
        $participantClass = $this->participantClass;
        $participantClass::create([
                                      'user_id' => $this->id,
                                      'thread_id' => $thread->id,
                                      'seen_at' => Carbon::now()
                                  ]);

        if (count($this->recipients)) {
            $thread->addParticipants($this->recipients);
        }

        if ($thread) {
            event(new NewMessageDispatched($thread, $message));
        }

        return $thread;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Thread $thread
     *
     * @return \Illuminate\Http\Response
     */
    public function reply($thread)
    {
        if ( ! is_object($thread)) {
            $threadClass = $this->threadClass;
            $thread = $threadClass::whereId($thread)->firstOrFail();
        }

        $thread->activateAllParticipants();

        $message = $thread->messages()->create([
                                                   'user_id' => $this->id,
                                                   'body' => $this->message
                                               ]);

        // Add replier as a participant
        $participantClass = $this->participantClass;
        $participant = $participantClass::firstOrCreate([
                                                            'thread_id' => $thread->id,
                                                            'user_id' => $this->id
                                                        ]);

        $participant->seen_at = Carbon::now();
        $participant->save();

        $thread->updated_at = Carbon::now();
        $thread->save();

        event(new NewReplyDispatched($thread, $message));

        return $message;
    }

    /**
     * Get user threads
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function threads()
    {
        return $this->hasMany($this->threadClass);
    }

    /**
     *
     * @param bool $withTrashed
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function participated($withTrashed = false)
    {
        $query = Thread::select(['threads.id', 'threads.subject', 'threads.updated_at', 'messages.user_id', 'messages.body', 'messages.created_at as message_created_at'])
            ->where('messages.user_id', '!=', $this->id)
            ->whereRaw($this->id . ' in (select user_id from messages where thread_id = threads.id)')
            ->join('messages', 'messages.thread_id', '=', 'threads.id')
            ->groupByRaw('threads.id')
            ;

        return $query;
    }

    /**
     * Get the threads that have been sent to the user.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function received()
    {
        return $this->participated()->latest('threads.updated_at');
    }

    /**
     * Get the threads that have been sent by a user.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function sent()
    {
        return $this->participated()
                    ->where("{$this->threadsTable}.user_id", $this->id)
                    ->latest('updated_at');
    }

    /**
     * Get unread messages
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function unread()
    {
        return $this->received()->whereNull('seen_at');
    }
}
