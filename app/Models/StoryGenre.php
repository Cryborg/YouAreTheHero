<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoryGenre extends Model
{
    protected $table = 'story_genre';
    protected $guarded = ['id'];

    public $timestamps = false;
}
