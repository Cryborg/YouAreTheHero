<?php

namespace App\Models;

use Faker\Provider\Uuid;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    // Don't increment as we use UUIDs
    public $incrementing = false;

    // Cannot update these fields
    public $guarded = ['id'];

    // Casts JSON as array
    protected $casts = [
        'items' => 'array',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function($table)
        {
            // String ID so that we prevent cheating
            $table->id = (string) substr(Uuid::uuid(), 0, 32);
        });
    }
}
