<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Inbox\Message;
use App\Models\Inbox\Thread;

class MessageDispatched extends Notification
{
    use Queueable;

    public $thread, $message, $participant;

    /**
     * Create a new notification instance.
     *
     * @param Thread  $thread
     * @param Message $message
     * @param         $participant
     */
    public function __construct($thread, $message, $participant)
    {
        $this->thread = $thread;
        $this->message = $message;
        $this->participant = $participant;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return config('inbox.notifications.via', [
            'mail'
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'thread_id' => $this->thread->id,
            'message_id' => $this->message->id,
            'isReply' => $this->thread->messages()->count() >= 2,
        ];
    }

    /**
     * Get the database representation of the notification.
     *
     * @param  mixed $notifiable
     *
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'thread_id' => $this->thread->id,
            'message_id' => $this->message->id,
            'isReply' => $this->thread->messages()->count() >= 2,
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     * @throws \Throwable
     */
    public function toMail($notifiable)
    {
        $buttonUrl = route('inbox.show', $this->thread);
        $lastMessage = $this->thread->messages->last();
        $greeting = trans('inbox.message_from', ['username' => $lastMessage->user->username]);

        return (new MailMessage)
            ->success()
            ->subject(config('app.name') . ' - ' . trans('inbox.notifications.subject'))
            ->greeting($greeting)
            ->line($this->message->body)
            ->action(trans('inbox.notifications.button_view_message'), $buttonUrl);
    }
}
