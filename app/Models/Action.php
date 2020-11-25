<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Action extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'unique' => 'boolean',
    ];

    public function actionable()
    {
        return $this->morphTo('action');
    }

    public function triggerable()
    {
        return $this->morphTo('trigger');
    }
}
