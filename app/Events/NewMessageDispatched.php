<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewMessageDispatched
{
    use Dispatchable, SerializesModels;

    public $thread, $message;

    /**
     * Create a new event instance.
     *
     * @param $thread
     * @param $message
     */
    public function __construct($thread, $message)
    {
        $this->thread = $thread;
        $this->message = $message;
    }
}


