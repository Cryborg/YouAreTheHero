<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checkpoint extends Model
{
    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function character(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Character::class);
    }
}
