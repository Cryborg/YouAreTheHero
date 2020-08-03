<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Action extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function actionable()
    {
        return $this->morphTo();
    }

    public function triggers()
    {
        return $this->morphTo();
    }
}
