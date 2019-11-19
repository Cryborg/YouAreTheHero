<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \App\User;

class Story extends Model
{
    public function getUser()
    {
        return User::where('id', $this->user_id)->first();
    }
}
