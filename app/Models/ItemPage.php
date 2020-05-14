<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use App\Presenters\ItemPagePresenter;

class ItemPage extends Model
{
    use PresentableTrait;

    protected $presenter = ItemPagePresenter::class;

    protected $guarded = ['id'];
    protected $table = 'item_page';

    public $timestamps = false;
}
