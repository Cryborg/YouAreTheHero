<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genre extends Model
{
    protected $guarded = ['id'];

    public $timestamps = false;

    public $casts = [
        'hidden' => 'boolean'
    ];

    public function stories(): BelongsToMany
    {
        return $this->belongsToMany(Story::class, 'story_genre');
    }
}
