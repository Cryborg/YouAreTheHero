<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Person extends Model
{
    protected $guarded = ['id'];

    public function characters(): belongsToMany
    {
        return $this->belongsToMany(Character::class);
    }
}
