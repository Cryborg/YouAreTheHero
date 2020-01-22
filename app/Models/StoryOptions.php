<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoryOptions extends Model
{
    protected $table = 'story_options';

    public function story_options()
    {
        return $this->belongsTo(Story::class);
    }
}
