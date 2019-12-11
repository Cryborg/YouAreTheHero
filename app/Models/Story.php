<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

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
        'is_published' => 'boolean',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(static function ($story) {
            $authId = Auth::id();

            if ($authId) {
                $story['user_id'] = Auth::id();
            }
        });

        static::created(static function($page)
        {
            Cache::forget('stories.list');
        });
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'story_genres');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the last created page of a given story
     *
     * @param \App\Models\Story $story
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function getLastCreatedPage()
    {
        $page = Page::where([
            'story_id' => $this->id,
        ])
            ->orderBy('id', 'desc')
            ->first();

        return $page;
    }
}
