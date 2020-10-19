<?php

namespace App\Models;

use App\Presenters\ChoicePresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laracasts\Presenter\PresentableTrait;

class Choice extends Model
{
    use SoftDeletes;
    use PresentableTrait;

    protected $presenter  = ChoicePresenter::class;

    protected $guarded = ['id'];

    protected $keyType = 'string';

    public $timestamps = false;

    protected $casts = [
        'hidden' => 'boolean',
    ];

    /**
     * Get the page.
     */
    public function pageFrom()
    {
        return $this->belongsTo(Page::class, 'page_from', 'id');
    }

    /**
     * Get the page.
     */
    public function pageTo()
    {
        return $this->belongsTo(Page::class, 'page_to', 'id');
    }
}
