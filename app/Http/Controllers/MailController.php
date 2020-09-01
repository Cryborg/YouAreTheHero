<?php

namespace App\Http\Controllers;

use App\Mail\DefaultMessage;
use App\Mail\PendingStory;
use App\Mail\SiteUpdate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User         $user
     * @param string                   $mailable
     *
     * @return mixed
     */
    public function send(Request $request, User $user, string $mailable)
    {
        switch ($mailable) {
            case 'pending_story':
                Mail::to($user->email)->send(new PendingStory($user));
                break;
            case 'site_update':
                Mail::to($user->email)->send(new SiteUpdate($user));
                break;
            default:
                Mail::to($user->email)->send(new DefaultMessage($user, $request->get('send_message')));
                break;
        }

        return redirect()->route('user.profile');
    }
}
