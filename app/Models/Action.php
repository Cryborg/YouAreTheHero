<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Laracasts\Presenter\PresentableTrait;

class Action extends Model
{
    use PresentableTrait;

    protected $presenter = 'App\\Presenters\\ActionPresenter';

    protected $guarded = ['id'];

    public $timestamps = false;

    public function item()
    {
        return $this->hasOne(Item::class, 'id', 'item_id');
    }
}
