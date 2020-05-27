<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Effect extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($effect) {
            $effect->field->delete();
            $effect->item->delete();
        });
    }

    public function item()
    {
        return $this->hasMany(Item::class);
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}
