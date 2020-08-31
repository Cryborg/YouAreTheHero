<?php

namespace App\Http\Controllers;

use App\Mail\PendingStory;
use App\Mail\SiteUpdate;
use App\Models\User;

class MailController extends Controller
{
    /**
     * Preview an email
     *
     * @param \App\Models\User $user
     * @param string           $mailable
     *
     * @return \App\Mail\PendingStory|\App\Mail\SiteUpdate
     */
    public function preview(User $user, string $mailable)
    {
        switch ($mailable) {
            case 'pending_story':
                return new PendingStory($user);

            case 'site_update':
                return new SiteUpdate($user);
        }

    }
}
