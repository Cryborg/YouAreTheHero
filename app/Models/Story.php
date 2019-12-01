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
    public function genres()
    {
        return $this->hasMany(Genre::class);
    }

    protected $casts = [
        'sheet_config' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function genres()
    {
        $storyGenre = Story_genres::where('story_id', $this->id)->first();
        $genres = Genre::where('id', $storyGenre->genre_id)->get();

        $aGenres = [];

        foreach ($genres as $genre) {
            $aGenres[] = __($genre->label);
        }

        return $aGenres;
    }
}
