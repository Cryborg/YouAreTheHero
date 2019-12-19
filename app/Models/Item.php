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
     * Get the pageLinks.
     */
    public function pages()
    {
        return $this->belongsToMany(Page::class, 'action_page');
    }

    public function actionPages()
    {
        return $this->belongsToMany(ActionPage::class);
    }
}
