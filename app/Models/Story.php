<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \App\Models\User;

class Story extends Model
{
    protected $fillable = ['title'];

    protected $casts = [
        'sheet_config' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function genres()
    {
        $storyGenre = StoryGenre::where('story_id', $this->id)->first();
        $genres = Genre::where('id', $storyGenre->genre_id)->get();

        $aGenres = [];

        foreach ($genres as $genre) {
            $aGenres[] = __($genre->label);
        }

        return $aGenres;
    }
}
