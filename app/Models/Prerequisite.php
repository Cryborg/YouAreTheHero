<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prerequisite extends Model
{
    protected $guarded = ['id'];

    public function items()
    {
        return $this->morphToMany(Item::class, 'prerequisite', Prerequisite::class, null, 'bouh', 'id');
    }
}
