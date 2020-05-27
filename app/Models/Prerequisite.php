<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prerequisite extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function prerequisiteable()
    {
        return $this->morphTo();
    }
}
