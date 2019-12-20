<?php

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\Page;

class ItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $seduction = Item::create([
            'name'     => 'Phéromone de séduction',
            'story_id' => 5,
        ]
        );

        $page = Page::whereId('8e32b39a-0886-37f3-93fd-f606a88950a9')
                    ->first();
        $page->addAction([
            'item_id'    => $seduction->id,
            'verb'       => 'buy',
            'quantity'   => 1,
            'single_use' => true,
            'price'      => 1,
        ]
        );

        $guerre = Item::create([
            'name'     => 'Phéromone de guerre',
            'story_id' => 5,
        ]
        );

        $page = Page::whereId('3442f8a3-3a40-3251-b4c8-445ff8c24595')
                    ->first();
        $page->addAction([
            'item_id'    => $guerre->id,
            'verb'       => 'buy',
            'quantity'   => 1,
            'single_use' => true,
            'price'      => 1,
        ]
        );
        $page->addAction([
            'item_id'    => $seduction->id,
            'verb'       => 'buy',
            'quantity'   => 1,
            'single_use' => true,
            'price'      => 1,
        ]
        );
    }
}
