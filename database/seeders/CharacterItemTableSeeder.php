<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CharacterItemTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('character_item')->delete();

        \DB::table('character_item')->insert(array (
            0 =>
            array (
                'id' => 6,
                'character_id' => 32,
                'item_id' => 24,
                'quantity' => 0,
                'is_used' => 0,
                'taken' => 0,
            ),
            1 =>
            array (
                'id' => 7,
                'character_id' => 38,
                'item_id' => 33,
                'quantity' => 1,
                'is_used' => 0,
                'taken' => 0,
            ),
            2 =>
            array (
                'id' => 8,
                'character_id' => 38,
                'item_id' => 35,
                'quantity' => 1,
                'is_used' => 0,
                'taken' => 0,
            ),
            3 =>
            array (
                'id' => 9,
                'character_id' => 38,
                'item_id' => 30,
                'quantity' => 1,
                'is_used' => 0,
                'taken' => 0,
            ),
            4 =>
            array (
                'id' => 10,
                'character_id' => 38,
                'item_id' => 27,
                'quantity' => 1,
                'is_used' => 0,
                'taken' => 0,
            ),
            5 =>
            array (
                'id' => 11,
                'character_id' => 38,
                'item_id' => 36,
                'quantity' => 1,
                'is_used' => 0,
                'taken' => 0,
            ),
            6 =>
            array (
                'id' => 26,
                'character_id' => 84,
                'item_id' => 43,
                'quantity' => 1,
                'is_used' => 1,
                'taken' => 1,
            ),
            7 =>
            array (
                'id' => 30,
                'character_id' => 84,
                'item_id' => 41,
                'quantity' => 1,
                'is_used' => 0,
                'taken' => 1,
            ),
            8 =>
            array (
                'id' => 31,
                'character_id' => 84,
                'item_id' => 40,
                'quantity' => 1,
                'is_used' => 0,
                'taken' => 1,
            ),
            9 =>
            array (
                'id' => 32,
                'character_id' => 85,
                'item_id' => 43,
                'quantity' => 1,
                'is_used' => 0,
                'taken' => 1,
            ),
        ));


    }
}
