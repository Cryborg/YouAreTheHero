<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoryGenres extends Model
{
    protected $table = 'story_genres';

    protected $guarded = ['id'];

    public $timestamps = false;
}
