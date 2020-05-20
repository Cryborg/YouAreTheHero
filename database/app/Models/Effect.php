<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Effect extends Model
{
    protected $guarded = ['id'];

    public function item()
    {
        return $this->hasMany(Item::class);
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}
