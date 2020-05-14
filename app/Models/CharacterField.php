<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CharacterField extends Model
{
    protected $guarded = ['id'];

    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}
