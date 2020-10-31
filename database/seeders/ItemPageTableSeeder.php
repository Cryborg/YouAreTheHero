<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ItemPageTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('item_page')->delete();

        \DB::table('item_page')->insert(array (
            0 =>
            array (
                'id' => 1,
                'item_id' => 18,
                'page_id' => 140,
                'quantity' => 1,
                'price' => 8,
                'character_id' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'item_id' => 2,
                'page_id' => 62,
                'quantity' => 1,
                'price' => 1,
                'character_id' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'item_id' => 6,
                'page_id' => 72,
                'quantity' => 1,
                'price' => 1,
                'character_id' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'item_id' => 36,
                'page_id' => 154,
                'quantity' => 1,
                'price' => 0,
                'character_id' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'item_id' => 35,
                'page_id' => 154,
                'quantity' => 1,
                'price' => 0,
                'character_id' => NULL,
            ),
            5 =>
            array (
                'id' => 6,
                'item_id' => 33,
                'page_id' => 154,
                'quantity' => 1,
                'price' => 0,
                'character_id' => NULL,
            ),
            6 =>
            array (
                'id' => 7,
                'item_id' => 29,
                'page_id' => 154,
                'quantity' => 1,
                'price' => 0,
                'character_id' => NULL,
            ),
            7 =>
            array (
                'id' => 8,
                'item_id' => 30,
                'page_id' => 154,
                'quantity' => 1,
                'price' => 0,
                'character_id' => NULL,
            ),
            8 =>
            array (
                'id' => 9,
                'item_id' => 31,
                'page_id' => 154,
                'quantity' => 1,
                'price' => 0,
                'character_id' => NULL,
            ),
            9 =>
            array (
                'id' => 10,
                'item_id' => 28,
                'page_id' => 154,
                'quantity' => 1,
                'price' => 0,
                'character_id' => NULL,
            ),
            10 =>
            array (
                'id' => 11,
                'item_id' => 27,
                'page_id' => 154,
                'quantity' => 1,
                'price' => 0,
                'character_id' => NULL,
            ),
            11 =>
            array (
                'id' => 12,
                'item_id' => 26,
                'page_id' => 154,
                'quantity' => 1,
                'price' => 0,
                'character_id' => NULL,
            ),
            12 =>
            array (
                'id' => 13,
                'item_id' => 34,
                'page_id' => 154,
                'quantity' => 1,
                'price' => 0,
                'character_id' => NULL,
            ),
            13 =>
            array (
                'id' => 14,
                'item_id' => 37,
                'page_id' => 158,
                'quantity' => 1,
                'price' => 0,
                'character_id' => NULL,
            ),
            14 =>
            array (
                'id' => 15,
                'item_id' => 40,
                'page_id' => 171,
                'quantity' => 1,
                'price' => 1,
                'character_id' => NULL,
            ),
            15 =>
            array (
                'id' => 16,
                'item_id' => 41,
                'page_id' => 171,
                'quantity' => 1,
                'price' => 1,
                'character_id' => NULL,
            ),
            16 =>
            array (
                'id' => 17,
                'item_id' => 43,
                'page_id' => 169,
                'quantity' => 1,
                'price' => 1,
                'character_id' => NULL,
            ),
        ));


    }
}
