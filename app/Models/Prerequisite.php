<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prerequisite extends Model
{
    protected $guarded = ['id'];

    public function stats()
    {
        $this->morphMany(Stat::class, 'stat');
    }

    public function items()
    {
        $this->morphMany(Item::class, 'item');
    }
}
