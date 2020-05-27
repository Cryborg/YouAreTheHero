<?php

namespace App\Models;

use App\Presenters\PagePresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Laracasts\Presenter\PresentableTrait;

class Page extends Model
{
    use PresentableTrait;
    use SoftDeletes;

    protected $presenter    = PagePresenter::class;

    protected $primaryKey   = 'id';

    protected $keyType      = 'string';

    protected $guarded      = ['id'];

    protected $touches      = ['story'];

    protected $casts        = [
        'is_first'      => 'boolean',
        'is_last'       => 'boolean',
        'is_checkpoint' => 'boolean',
    ];

    public static function boot()
    {
        parent::boot();

        static::deleted(function($page)
        {
            // Delete the links that lead to the page we just deleted
            $page->links_to()->delete();
        });
    }

    /**
     * @return HasMany
     */
    public function links_to()
    {
        return $this->hasMany(Choice::class, 'page_to');
    }

    /**
     * @return BelongsTo
     */
    public function story(): BelongsTo
    {
        return $this->belongsTo(Story::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class)->withPivot(['id', 'verb', 'quantity', 'price']);
    }

    /**
     * Get the available choices for the current page
     *
     * @return \Illuminate\Support\Collection|mixed
     */
    public function choices()
    {
        return $this->belongsToMany(Page::class, 'choices', 'page_from', 'page_to', 'id')->withPivot('link_text');
    }

    /**
     * Get the pages leading to the current page
     */
    public function parents()
    {
        return $this->belongsToMany(Page::class, 'choices', 'page_to', 'page_from', 'id')->withPivot('link_text');
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
            ->whereNotIn('id', $this->choices
                                    ->pluck('id')
                                    ->toArray()
            )

            // And of course don't include this page
            ->whereNotIn('id', [$this->id])

            ->orderBy('title', 'asc')
            ->get();

        return $potentialPages;
    }

    /**
     * @param array $data
     *
     * @return \App\Models\ItemPage
     * @throws \Illuminate\Validation\ValidationException
     */
    public function addAction(array $data): ItemPage
    {
        $validated = Validator::validate($data, [
                'item_id'  => 'required',
                'verb'     => 'required',
                'quantity' => 'required',
            ]
        );

        $validated['page_id'] = $this->id;

        return ItemPage::create($validated);
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

    public function trigger()
    {
        return $this->morphMany(Action::class, 'trigger')->with('actionable');
    }

    public function fields()
    {
        return $this->trigger()->where('actionable_type', 'field')->with('actionable');
    }

}
