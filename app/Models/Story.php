<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Laracasts\Presenter\PresentableTrait;

class Story extends Model
{
    use PresentableTrait;

    protected $presenter = 'App\\Presenters\\StoryPresenter';

    protected $guarded = ['id'];

    protected $casts = [
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'story_genre');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the last created page of a given story.
     * Used in StoriesController/ajaxList to display the last created page for the selected story.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function getLastCreatedPage()
    {
        $page = Page::where([
            'story_id' => $this->id,
        ])
            ->orderBy('uuid', 'desc')
            ->first();

        return $page;
    }

    /**
     * Get the pages.
     */
    public function pages()
    {
        return $this->hasMany(Page::class, 'uuid');
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    /**
     * @param string|null $page_uuid
     *
     * @return \App\Models\Page|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function getCurrentPage(string $page_uuid = null)
    {
        if ($page_uuid !== null) {
            return Page::where('uuid', $page_uuid)->first();
        }

        // Don't Fail here as we create the page later
        return Page::where('story_id', $this->id)
            ->where('is_first', true)
            ->first();
    }

    public function stat_stories()
    {
        return $this->hasMany(StatStory::class);
    }

    public function story_options()
    {
        return $this->hasOne(StoryOptions::class);
    }
}
