<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EffectsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('effects')->delete();

        \DB::table('effects')->insert(array (
            0 =>
            array (
                'id' => 1,
                'item_id' => 41,
                'field_id' => 11,
                'operator' => '*',
                'quantity' => 2,
                'created_at' => '2020-08-13 06:52:34',
                'updated_at' => '2020-08-13 06:52:34',
            ),
            1 =>
            array (
                'id' => 2,
                'item_id' => 40,
                'field_id' => 12,
                'operator' => '+',
                'quantity' => 4,
                'created_at' => '2020-08-13 06:52:34',
                'updated_at' => '2020-08-13 06:52:34',
            ),
        ));
    }
}
