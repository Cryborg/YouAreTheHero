<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DefaultMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $body;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\User $user
     * @param string           $body
     */
    public function __construct(User $user, string $body)
    {
        $this->user = $user;
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.default_message');
    }
}
