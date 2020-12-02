<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();

        static::deleting(static function ($equipment) {
            // Also delete the relation with the items
            $items = Item::where('equipment_id', $equipment->id)->get();

            $items->each(function ($item) {
                $item->update([
                    'equipment_id' => null
                ]);
            });
        });
    }
}
