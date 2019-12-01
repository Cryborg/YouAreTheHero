<?php

namespace App\Models;

use Faker\Provider\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    public $incrementing = false;

    protected $rawItems;

    protected $guarded = ['id'];

    // Casts JSON as array
    protected $casts = [
        'items' => 'array',
    ];

    /**
     * Get the pageLinks.
     */
    public function pageLinks()
    {
        return $this->hasMany(PageLink::class, 'page_from');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(static function($page)
        {
            // String ID so that we prevent cheating
            $page->id = (string) substr(Uuid::uuid(), 0, 32);
            $page->number = $page::where('story_id', '=', $page->story_id)->count() + 1;
            $page->is_first = $page->number === 1;
        });

        static::retrieved(static function ($page)
        {
            $items = [];

            if (null !== $page->items) {
                foreach ($items as $pageItem) {
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
}
