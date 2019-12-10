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
        'prerequisites' => 'array',
        'is_first' => 'boolean',
        'is_last' => 'boolean',
        'is_checkpoint' => 'boolean',
    ];

    protected $rawItems;

    private $description;

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
                    // If this is an Item
                    if (isset($pageItem['item'])) {
                        // Check if the item has already been used/picked-up, whatever
                        $usedItem = UniqueItemsUsed::where([
                            'character_id' => session('character_id'),
                            'item_id' => $pageItem['item'],
                        ])->first();

                        // If not, we can display it
                        if ($usedItem === null) {
                            $item = Item::where('id', $pageItem['item'])->first();

                            if ($item) {
                                $items[] = [
                                    'item'   => $item,
                                    'verb'   => $pageItem['verb'],
                                    'amount' => $pageItem['amount'],
                                ];
                            }
                        }
                    }

                    $page->rawItems[] = $pageItem;
                }
                $page->items = $items;
            }
        });
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function addItem(array $data): bool
    {
        $this->items = array_merge($this->rawItems ?? [], [$data]);
        return $this->save();
    }

    public function story()
    {
        return $this->belongsTo(Story::class);
    }

    public function pages()
    {
        //TODO: récupérer le pagelink::title

        return $this->hasManyThrough(Page::class, PageLink::class, 'page_from', 'id', 'id', 'page_to');
    }
}
