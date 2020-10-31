<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Laracasts\Presenter\PresentableTrait;

class Story extends Model
{
    use PresentableTrait, SoftDeletes, HasFactory;

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
        $page = Page::where('story_id', $this->id)
                    ->where('is_first', true)
                    ->first();

        if ($page) {
            return $page;
        }

        return Page::factory()->create([
            'story_id' => $this->id,
        ]);
    }

    public function getUnusedItems()
    {
        $unusedItems = collect();

        $this->items->each(static function (Item $item) use ($unusedItems) {
            // Unused items
            if (!$item->isUsed()) {
                $unusedItems->push($item);
            }
        });

        return $unusedItems;
    }

    public function getUnusedFields()
    {
        $unusedFields = collect();

        $this->fields->each(static function ($field) use ($unusedFields) {
            // Unused fields
            if (
                (!$field->actions || ($field->actions && $field->actions->count() === 0))  // Unused in actions
                && $field->prerequisites->count() === 0                                    // Unused in prerequisites
            ) {
                $unusedFields->push($field);
            }
        });

        return $unusedFields;
    }

    public function fields()
    {
        return $this->hasMany(Field::class);
    }

    public function people()
    {
        return $this->hasMany(Person::class);
    }

    public function options()
    {
        return $this->hasOne(StoryOption::class);
    }

    public function author()
    {
        return $this->hasOne(\App\Models\User::class, 'id', 'user_id');
    }

    /**
     * @return \App\Models\Character|null
     */
    public function currentCharacter()
    {
        return Character::where('user_id', Auth::id())
            ->where('story_id', $this->id)->first();
    }

    public function reports()
    {
        return $this->hasManyThrough(Report::class, Page::class);
    }

    public function maxPointsToShare(): int
    {
        $max = 0;

        $this->fields()->each(static function ($field) use (&$max) {
            $max += $field->max_value - $field->min_value;
        });

        return $max;
    }
}
