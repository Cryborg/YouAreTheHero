<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Field extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];
    protected $casts = [
        'hidden' => 'boolean'
    ];

    public function prerequisites()
    {
        return $this->morphMany(Prerequisite::class, 'prerequisiteable');
    }

    public function story()
    {
        return $this->belongsTo(Story::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    /**
     * So we can know wether the field is used or not
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function effects()
    {
        return $this->belongsToMany(Effect::class);
    }
}
