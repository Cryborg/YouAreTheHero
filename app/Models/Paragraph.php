<?php

namespace App\Models;

use Faker\Provider\Uuid;
use Illuminate\Database\Eloquent\Model;

class Paragraph extends Model
{
    public $incrementing = false;

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
