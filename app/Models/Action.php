<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    public function actionable()
    {
        return $this->morphTo();
    }

    public function trigger()
    {
        return $this->morphTo();
    }
}
