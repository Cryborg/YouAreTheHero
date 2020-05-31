<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laracasts\Presenter\PresentableTrait;
use App\Presenters\ItemPagePresenter;

class ItemPage extends Model
{
    use PresentableTrait;
    use SoftDeletes;

    protected $presenter = ItemPagePresenter::class;

    protected $guarded = ['id'];
    protected $table = 'item_page';

    public $timestamps = false;

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
