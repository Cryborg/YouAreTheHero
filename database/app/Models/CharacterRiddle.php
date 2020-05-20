<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CharacterRiddle extends Model
{
    protected $guarded = ['id'];

    public function riddle()
    {
        return $this->belongsTo(Riddle::class);
    }
}
