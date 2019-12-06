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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    /**
     * @return array
     */
    public function genres(): array
    {
        $aGenres = [];

        $storyGenre = StoryGenre::where('story_id', $this->id)->first();

        if ($storyGenre) {
            $genres = Genre::where('id', $storyGenre->genre_id)
                           ->get();

            foreach ($genres as $genre) {
                $aGenres[] = __($genre->label);
            }
        }

        return $aGenres;
    }
}
