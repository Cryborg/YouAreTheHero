<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoryOption extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $casts   = [
        'has_character' => 'boolean',
        'has_stats'     => 'boolean',
    ];
}
