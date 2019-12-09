<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $fillable = ['title'];

    /**
     * Get the pages.
     */
    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    /**
     * Get the genres.
     */
 /*   public function genres()
    {
        return $this->hasManyThrough(
            Genre::class,
            StoryGenre::class,
            'story_id',
            'id',
            'id',
            'genre_id'
        );
    }*/

    protected $casts = [
        'sheet_config' => 'array',
    ];

    public function genres()
    {
        return $this->hasMany(Genre::class, 'id');
    }

   /* public function genres()
    {
        return $this->BelongsToMany(Genre::class, 'story_genre');
    }*/

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
