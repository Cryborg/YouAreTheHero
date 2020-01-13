<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prerequisite extends Model
{
    protected $guarded = ['id'];

    public function prerequisiteable()
    {
        return $this->morphTo();
    }
}
