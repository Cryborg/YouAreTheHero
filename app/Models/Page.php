<?php

namespace App\Models;

use App\Models\Prerequisite;
use Faker\Provider\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class Page extends Model
{
    use SoftDeletes;

    protected $primaryKey   = 'uuid';

    protected $keyType      = 'string';

    public    $incrementing = false;

    protected $guarded      = ['uuid'];

    // Casts JSON as array
    protected $casts = [
        'is_first'      => 'boolean',
        'is_last'       => 'boolean',
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

        static::creating(static function ($page) {
            // String ID so that we prevent cheating
            $page->uuid       = Uuid::uuid();
            $page->number   = $page::where('story_id', '=', $page->story_id)
                                   ->count() + 1;
            $page->is_first = $page->number === 1;
        }
        );

    }

    public function story()
    {
        return $this->belongsTo(Story::class);
    }

    public function actions()
    {
        return $this->hasMany(Action::class);
    }

    /**
     * Get the available choices for the current page
     *
     */
    public function choices()
    {
        $pages = Cache::remember('choices_' . $this->uuid, Config::get('app.story.cache_ttl'), function () {
            $pageLinks = PageLink::where('page_from', $this->uuid)->get();

            if ($pageLinks) {
                return Page::whereIn('pages.uuid', $pageLinks->pluck('page_to'))
                       ->select([
                           'page_link.page_to',
                           'page_link.link_text',
                           'pages.*'
                       ])
                       ->join('page_link', 'page_link.page_to', '=', 'pages.uuid')
                       ->get();
            }

            return collect();
        });

        return $pages ?? collect();
    }

    /**
     * Get the pages leading to the current page
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function parents()
    {
        return PageLink::where('page_to', $this->uuid)
                       ->select([
                               'page_link.link_text',
                               'pages.*',
                           ]
                       )
                       ->join('pages', 'pages.uuid', '=', 'page_link.page_from')
                       ->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|\Illuminate\Support\Collection
     */
    public function getPotentialChildren()
    {
        // Exclude:
        // - the current page
        // - the already bound children
        $potentialPages = Page::where('story_id', $this->story_id)
                              ->whereNotIn('uuid', $this->choices()
                                                      ->pluck('uuid')
                                                      ->toArray()
                              )
                              ->whereNotIn('uuid', [$this->uuid])
                              ->orderBy('title', 'asc')
                              ->get();

        return $potentialPages;
    }

    /**
     * @param array $data
     *
     * @return \App\Models\Action
     * @throws \Illuminate\Validation\ValidationException
     */
    public function addAction(array $data)
    {
        $validated = Validator::validate($data, [
                'item_id'  => 'required',
                'verb'     => 'required',
                'quantity' => 'required',
            ]
        );

        $validated['page_uuid'] = $this->uuid;

        return Action::create($validated);
    }

    public function prerequisites()
    {
        return \App\Models\Prerequisite::with('prerequisiteable')
                                       ->where('page_uuid', $this->uuid)
                                       ->get();
    }
}
