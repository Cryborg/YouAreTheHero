<?php

namespace App\Traits;

use App\Models\Success;
use App\Models\User;
use Illuminate\Support\Facades\Session;

trait UserSuccess
{
    public function addSuccess(User $user, Success $success)
    {
        $result = array_filter($user->successes()->syncWithoutDetaching($success));

        if (!empty($result)) {
            $descriptionKey = 'success.' . $success->title . '_description';
            $description = includeAsJsString('layouts.partials.user_success');

            if (!Session::has('successes')) {
                Session::put('successes', []);
            }

            Session::push('successes', [
                'heading'     => trans('success.' . $success->title),
                'description' => str_replace('[[description]]', trans($descriptionKey), $description),
            ]);

            return [
                'success' => true
            ];
        }

        Session::remove('successes');

        return [
            'success' => false
        ];
    }
}
