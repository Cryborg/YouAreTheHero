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

        static::creating(static function($page)
        {
            // String ID so that we prevent cheating
            $page->id = (string) substr(Uuid::uuid(), 0, 32);
        });

        static::retrieved(static function ($page)
        {
            $items = [];

            if ($page->items) {
                foreach ($page->items as $pageItem) {
                    $item = Item::where('id', $pageItem['item'])->first();
                    $items[] = [
                        'item'   => $item,
                        'verb'   => $pageItem['verb'],
                        'amount' => $pageItem['amount'],
                    ];
                }
                $page->items = $items;
            }
        });
    }
}
