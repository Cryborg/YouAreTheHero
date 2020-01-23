<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    public function getProfile(\Illuminate\Support\Facades\Request $request)
    {
        $data = [
            'title' => trans('user.profile_title')
        ];

        $view = View::make('user.profile', $data);

        return $view;
    }

    public function store(Request $request)
    {
        $validated = Validator::validate($request->all());

        User::where('id', Auth::id())->update($validated);

        return Redirect::to(route('user.profile'));
    }
}
