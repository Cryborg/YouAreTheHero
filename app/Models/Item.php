<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use App\Presenters\ItemPresenter;

class Item extends Model
{
    use PresentableTrait;

    protected $presenter = ItemPresenter::class;

    protected $guarded   = ['id'];

    protected $casts     = [
        'effects'    => 'array',
        'single_use' => 'boolean',
    ];

    /**
     * Get the pages
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pages()
    {
        return $this->belongsToMany(Page::class, 'actions');
    }

    /**
     * Get actions that contain this item
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function actions()
    {
        return $this->belongsToMany(Action::class);
    }

    public function story()
    {
        return $this->belongsTo(Story::class);
    }

    public function prerequisites()
    {
        return $this->morphMany(Prerequisite::class, 'prerequisiteable');
    }
}
