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

    public static function boot() {
        parent::boot();

        self::deleting(function(Field $field) {
            $field->prerequisites()->delete();
            $field->items()->sync([]);
        });
    }

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
        return $this->belongsToMany(Item::class)
            ->withPivot(['operator', 'quantity']);
    }
}
