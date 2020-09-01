<?php

namespace App\Http\Controllers;

use App\Mail\DefaultMessage;
use App\Mail\PendingStory;
use App\Mail\SiteUpdate;
use App\Models\Story;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function getIndex(): \Illuminate\Contracts\View\View
    {
        $this->authorize('isAdmin');

        $lastUpdate = new \DateTime('1 month ago');
        $data = [
            'title' => trans('admin.title'),
            'usersCount' => User::all()->count(),
            'storiesCount' => Story::where('is_published', true)->count(),
            'activeDraftsCount' => Story::where('is_published', false)
                                        ->where('updated_at', '>=', $lastUpdate)->count(),
        ];

        return View::make('admin.index', $data);
    }

    /**
     * @return \Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function getStories(): \Illuminate\Contracts\View\View
    {
        $this->authorize('isAdmin');

        $data = [
            'title' => trans('admin.statistics_title'),
            'stories' => Story::all(),
        ];

        return View::make('admin.stories', $data);
    }

    /**
     * @return \Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function getUsers(): \Illuminate\Contracts\View\View
    {
        $this->authorize('isAdmin');

        $data = [
            'title' => trans('admin.users_title'),
            'users' => User::orderByDesc('created_at')->get(),
        ];

        return View::make('admin.users', $data);
    }
}
