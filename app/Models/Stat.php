<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    protected $guarded = ['id'];

    public function prerequisites()
    {
        return $this->morphMany(Prerequisite::class, 'prerequisiteable');
    }
}
