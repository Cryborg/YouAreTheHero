<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Item extends Model
{
    use PresentableTrait;

    protected $presenter = 'App\\Presenters\\ItemPresenter';

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
}
