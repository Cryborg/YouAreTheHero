<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $guarded = ['id'];

    public $timestamps = false;

    public function stories()
    {
        return $this->belongsToMany(Story::class, 'story_genres');
    }
}
