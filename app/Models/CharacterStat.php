<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CharacterStat extends Model
{
    protected $guarded = ['id'];

    public function stat_story()
    {
        return $this->belongsTo(StatStory::class);
    }
}
