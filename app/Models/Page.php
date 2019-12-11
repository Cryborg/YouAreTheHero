<?php

namespace App\Models;

use Faker\Provider\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    public $incrementing = false;

    protected $guarded = ['id'];

    // Casts JSON as array
    protected $casts = [
        'prerequisites' => 'array',
        'is_first' => 'boolean',
        'is_last' => 'boolean',
        'is_checkpoint' => 'boolean',
    ];

    /**
     * Get the pageLinks.
     */
    public function pageLinks()
    {
        return $this->hasMany(PageLink::class, 'page_from');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(static function($page)
        {
            // String ID so that we prevent cheating
            $page->id = (string) substr(Uuid::uuid(), 0, 32);
            $page->number = $page::where('story_id', '=', $page->story_id)->count() + 1;
            $page->is_first = $page->number === 1;
        });

    }

    public function story()
    {
        return $this->belongsTo(Story::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'items_pages');
    }
}
