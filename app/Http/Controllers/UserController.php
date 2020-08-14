<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    public function getProfile(\Illuminate\Support\Facades\Request $request, User $user = null)
    {
        $data = [
            'title' => trans('user.profile_title'),
            'user' => $user ?? auth()->user(),
        ];

        $view = 'user.profile';

        if ($user !== null) {
            $view = 'user.profile_readonly';
        }

        return View::make($view, $data);
    }

    public function store(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => '',
            'last_name' => '',
            'username' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'confirmed|min:8'
        ]);

        if ($validator->fails())
        {
            return Redirect::to(route('user.profile'))->withErrors($validator);
        }

        $user->update($validator->validate());

        return Redirect::to(route('user.profile'));
    }
}
