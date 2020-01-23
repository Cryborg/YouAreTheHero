<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
        $this->authorize('isAdmin');

        $data = [
            'title' => trans('admin.title'),
            'usersCount' => User::all()->count(),
            'storiesCount' => Story::all()->count(),
        ];

        $view = View::make('admin.index', $data);

        return $view;
    }

    public function getStories()
    {
        $this->authorize('isAdmin');

        $data = [
            'title' => trans('admin.statistics_title'),
            'stories' => Story::all(),
        ];

        $view = View::make('admin.stories', $data);

        return $view;
    }

    public function getUsers()
    {
        $this->authorize('isAdmin');

        $data = [
            'title' => trans('admin.users_title'),
            'users' => User::all(),
        ];

        $view = View::make('admin.users', $data);

        return $view;
    }
}
