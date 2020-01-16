<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatStory extends Model
{
    protected $table = 'stat_story';
    protected $guarded = ['id'];

    public function story()
    {
        return $this->belongsTo(Story::class);
    }
}
