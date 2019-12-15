<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
