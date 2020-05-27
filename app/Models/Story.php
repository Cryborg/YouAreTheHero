<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Laracasts\Presenter\PresentableTrait;

class Story extends Model
{
    use PresentableTrait;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
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
                $story['user_id'] = $authId;
            }
        });

        static::created(static function($page)
        {
            Cache::forget('stories.list');
        });

        static::deleting(function ($story) { // before delete() method call this
            $story->pages->each(function($page) {
                $page->delete();
            });
            $story->fields->each(function($field) {
                $field->delete();
            });

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
            ->orderBy('id', 'desc')
            ->first();

        return $page;
    }

    /**
     * Get the pages.
     */
    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    /**
     * @param string|null $page_id
     *
     * @return \App\Models\Page|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function getCurrentPage(string $page_id = null)
    {
        if ($page_id !== null) {
            return Page::where('id', $page_id)->first();
        }

        // Don't Fail here as we create the page later
        return Page::where('story_id', $this->id)
            ->where('is_first', true)
            ->first();
    }

    public function fields()
    {
        return $this->hasMany(Field::class);
    }

    public function story_options()
    {
        return $this->hasOne(StoryOption::class);
    }

    public function author()
    {
        return $this->hasOne(\App\Models\User::class, 'id', 'user_id');
    }

    public function currentCharacter()
    {
        return Character::where('user_id', Auth::id())
            ->where('story_id', $this->id)->first();
    }
}
