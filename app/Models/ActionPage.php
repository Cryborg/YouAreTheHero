<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class ActionPage extends Model
{
    protected $guarded = ['id'];

    public $timestamps = false;

    public $table = 'action_page';

    public function item()
    {
        return $this->hasOne(Item::class, 'id', 'item_id');
    }
}
