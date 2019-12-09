<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $fillable = ['title', 'genres'];

    /**
     * Get the pages.
     */
    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    protected $casts = [
        'sheet_config' => 'array',
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'story_genre');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
