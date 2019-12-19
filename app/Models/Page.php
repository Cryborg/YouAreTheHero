<?php

namespace App\Models;

use Faker\Provider\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class Page extends Model
{
    use SoftDeletes;

    protected $primaryKey   = 'id';

    protected $keyType      = 'string';

    public    $incrementing = false;

    protected $guarded      = ['id'];

    // Casts JSON as array
    protected $casts = [
        'prerequisites' => 'array',
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
            $page->id       = Uuid::uuid();
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
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function choices()
    {
        $pagelink = Cache::remember('choices_' . $this->id, 1, function () {
            return PageLink::where('page_from', $this->id)
                           ->select([
                                   'page_link.link_text',
                                   'pages.*',
                               ]
                           )
                           ->join('pages', 'pages.id', '=', 'page_link.page_to')
                           ->get();
        }
        );

        return $pagelink;
    }

    /**
     * Get the pages leading to the current page
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function parents()
    {
        //TODO: use cache ?
        return PageLink::where('page_to', $this->id)
                       ->select([
                               'page_link.link_text',
                               'pages.*',
                           ]
                       )
                       ->join('pages', 'pages.id', '=', 'page_link.page_from')
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
                              ->whereNotIn('id', $this->choices()
                                                      ->pluck('id')
                                                      ->toArray()
                              )
                              ->whereNotIn('id', [$this->id])
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

        $validated['page_id'] = $this->id;

        return Action::create($validated);
    }
}
