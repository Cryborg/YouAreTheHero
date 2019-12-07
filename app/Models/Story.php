<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Laracasts\Flash\Flash;

class Story extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'sheet_config' => 'array',
        'is_published' => 'boolean',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(static function ($story) {
            $story['user_id'] = Auth::id();
        });

        static::created(static function($page)
        {
            Cache::forget('stories.list');
        });
    }

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
