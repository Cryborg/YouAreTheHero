<?php

namespace App\Models;

use App\Presenters\PagePresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laracasts\Presenter\PresentableTrait;

class Page extends Model
{
    use PresentableTrait;
    use SoftDeletes;

    public const ENDING_BAD     = 'bad';

    public const ENDING_GOOD    = 'good';

    public const ENDING_NEUTRAL = 'neutral';

    protected $presenter  = PagePresenter::class;

    protected $primaryKey = 'id';

    protected $keyType    = 'string';

    protected $guarded    = ['id'];

    protected $touches    = ['story'];

    protected $casts      = [
        'is_first'      => 'boolean',
        'is_last'       => 'boolean',
        'is_checkpoint' => 'boolean',

        'verbs_page'      => 'array',
        'verbs_inventory' => 'array',
    ];

    /**
     * @return BelongsTo
     */
    public function story(): BelongsTo
    {
        return $this->belongsTo(Story::class);
    }

    /**
     * Show items in pages
     * Except when there is a character_id that is different from the Auth::id()
     * because that would mean the item has been thrown away by another character
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function items()
    {
        $query = $this->belongsToMany(Item::class)
                      ->withPivot([
                                      'id',
                                      'quantity',
                                      'price',
                                      'character_id',
                                  ])
                      ->wherePivot('character_id', null);

        if (!empty(getSession('character_id'))) {
            $query->orWherePivot('character_id', getSession('character_id'));
        }

        return $query;
    }

    /**
     * Get the available choices for the current page
     *
     * @return \Illuminate\Support\Collection|mixed
     */
    public function choices()
    {
        return $this->belongsToMany(Page::class, 'choices', 'page_from', 'page_to', 'id')
                    ->withPivot('link_text');
    }

    /**
     * Get the pages leading to the current page
     */
    public function parents()
    {
        return $this->belongsToMany(Page::class, 'choices', 'page_to', 'page_from', 'id')
                    ->withPivot('link_text');
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

            // Don't include the choices already bound to the page
                              ->whereNotIn('id',
                                           $this->choices->pluck('id')
                                                         ->toArray())

            // And of course don't include this page
                              ->whereNotIn('id', [$this->id])
                              ->orderBy('title', 'asc')
                              ->get();

        return $potentialPages;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function prerequisites()
    {
        return Prerequisite::with('prerequisiteable')
                           ->where('page_id', $this->id)
                           ->get();
    }

    /**
     * @return HasOne
     */
    public function riddle(): HasOne
    {
        return $this->hasOne(Riddle::class);
    }

    public function descriptions()
    {
        return $this->hasMany(Description::class);
    }

    public function actions()
    {
        return $this->morphMany(Action::class, 'actionable');
    }

    public function fields()
    {
        return $this->triggers()
                    ->where('actionable_type', 'field')
                    ->with('actionable');
    }

    public function triggers()
    {
        return $this->morphMany(Action::class, 'trigger')
                    ->with('actionable');
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
