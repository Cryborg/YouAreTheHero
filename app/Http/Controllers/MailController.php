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
     * @param array|User               $users
     * @param string|null              $mailable
     *
     * @return mixed
     */
    public function send(Request $request, User|array $users, string $mailable = null)
    {
        if ($users instanceof User) {
            $users = [$users];
        }

        switch ($mailable) {
            case 'pending_story':
                foreach ($users as $recipient) {
                    Mail::to($recipient)->send(new PendingStory($users));
                }
                break;
            case 'site_update':
                foreach ($users as $recipient) {
                    Mail::to($recipient)->send(new SiteUpdate($users));
                }
                break;
            default:
                foreach ($users as $recipient) {
                    Mail::to($recipient)->send(new DefaultMessage($users, $request->get('send_message')));
                }
                break;
        }

        return redirect()->route('user.profile');
    }

    public function index()
    {

    }
}
