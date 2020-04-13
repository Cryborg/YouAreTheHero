<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnsweredRiddle extends Model
{
    protected $guarded = ['id'];

    public function riddle()
    {
        return $this->belongsTo(Riddle::class);
    }
}
