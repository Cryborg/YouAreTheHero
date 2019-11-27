<?php

namespace App\Models;

use Faker\Provider\Uuid;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    protected $rawItems;

    private $id;
    private $content;

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }


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

            if (null !== $page->items) {
                foreach ($page->items as $pageItem) {
                    // If this is an Item
                    if (isset($pageItem['item'])) {
                        // Check if the item has already been used/picked-up, whatever
                        $usedItem = Unique_items_used::where([
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
