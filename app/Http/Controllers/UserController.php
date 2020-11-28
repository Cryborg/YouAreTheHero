<?php

namespace App\Http\Controllers;

use App\Bases\ControllerBase;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Spatie\Activitylog\Models\Activity;

class UserController extends ControllerBase
{
    public function getProfile(\Illuminate\Support\Facades\Request $request, User $user = null)
    {
        $view = 'user.profile';

        if ($user !== null) {
            $view = 'user.profile_readonly';
        }

        $user = $user ?? $this->authUser;

        $lastLoggedActivity = Activity::where('causer_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $data = [
            'title'      => trans('user.profile_title'),
            'user'       => $user,
            'activities' => $lastLoggedActivity,
        ];

        return View::make($view, $data);
    }

    public function store(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'email'        => 'required|email|unique:users,email,' . $user->id,
            'first_name'   => '',
            'last_name'    => '',
            'optin_system' => '',
            'password'     => 'confirmed|min:8',
            'show_help'    => '',
            'username'     => 'required',
        ]);

        if ($validator->fails())
        {
            return Redirect::to(route('user.profile'))->withErrors($validator);
        }

        $update = $validator->validate();
        $update['optin_system'] = $request->has('optin_system') ? 1 : 0;
        $update['show_help'] = $request->has('show_help') ? 1 : 0;
        $user->update($update);

        return Redirect::to(route('user.profile'));
    }
}
