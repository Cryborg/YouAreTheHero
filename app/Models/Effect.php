<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Effect extends Model
{
    protected $guarded = ['id'];

    public function items()
    {
        return $this->belongsToMany(Item::class);
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}
