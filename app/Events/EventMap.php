<?php

namespace App\Events;

use App\Listeners\SendNotification;

trait EventMap
{
    /**
     * All of the Inbox event / listener mappings.
     *
     * @var array
     */
    protected $events = [
        NewMessageDispatched::class => [
            SendNotification::class,
        ],

        NewReplyDispatched::class => [
            SendNotification::class,
        ],
    ];
}
