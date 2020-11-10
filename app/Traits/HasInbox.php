<?php

namespace App\Traits;

use App\Models\Inbox\Participant;
use Carbon\Carbon;
use App\Events\NewMessageDispatched;
use App\Events\NewReplyDispatched;
use App\Models\Inbox\Thread;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

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

    /**
     * @param $subject
     *
     * @return $this
     */
    public function subject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @param $message
     *
     * @return $this
     */
    public function writes($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @param $users
     *
     * @return $this
     */
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
        $this->recipients[] = $this->id;
        $thread = $this->findAlreadyExistingThread($this->recipients);
        $isNewThread = false;

        if (empty($thread)) {
            $thread = $this->threads()->create([
                'subject' => $this->subject,
            ]);
            $isNewThread = true;
        }

        // Message
        $message = $thread->messages()->create([
            'user_id' => $this->id,
            'body'    => $this->message
        ]);

        // Sender
        if ($isNewThread) {
            Participant::create([
                'user_id'   => $this->id,
                'thread_id' => $thread->id,
                'seen_at'   => Carbon::now()
            ]);
        }

        if ($isNewThread && count($this->recipients)) {
            $thread->addParticipants($this->recipients);
        }

        if ($thread instanceof Thread) {
            event(new NewMessageDispatched($thread, $message));
        }

        return [
            'thread'  => $thread,
            'isNew'   => $isNewThread,
            'message' => $message,
        ];
    }

    /**
     * Check if a thread with the exact same recipients already exists. Return it if it does.
     *
     * @param $recipients
     *
     * @return Thread|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    private function findAlreadyExistingThread($recipients)
    {
        $query = Participant::select('thread_id')
            ->whereIn('user_id', $recipients)
            ->groupBy('thread_id')
            ->havingRaw('count(*) = ?', [count($recipients)])
            ->first()
        ;

        if ($query instanceof Participant) {
            return Thread::where('id', $query->thread_id)->first();
        }

        return null;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Thread $thread
     *
     * @return \Illuminate\Database\Eloquent\Model
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
    public function threads(): HasMany
    {
        return $this->hasMany($this->threadClass);
    }

    /**
     *
     * @param bool $withTrashed
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function participated($withTrashed = false)
    {
        $query = $this->belongsToMany($this->threadClass, $this->participantsTable, 'user_id', 'thread_id')
                      ->withPivot('seen_at')
                      ->withTimestamps();

        if ( ! $withTrashed) {
            $query->whereNull("{$this->participantsTable}.deleted_at");
        }

        return $query;
    }

    /**
     * Get the threads that have been sent to the user.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function received()
    {
        return $this->participated()->latest('threads.updated_at');
    }

    /**
     * Get the threads that have been sent by a user.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function sent()
    {
        return $this->participated()
                    ->where("threads.user_id", $this->id)
                    ->latest('updated_at');
    }

    /**
     * Get unread messages
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function unread()
    {
        return $this->received()->whereNull('seen_at');
    }
}
