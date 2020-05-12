<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $guarded = ['id'];

    public function prerequisites()
    {
        return $this->morphMany(Prerequisite::class, 'prerequisiteable');
    }

    public function story()
    {
        return $this->belongsTo(Story::class);
    }
}
