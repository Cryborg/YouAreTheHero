<?php

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('items')->delete();

        \DB::table('items')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Phéromone de séduction',
                'default_price' => 0,
                'story_id' => 1,
                'effects' => '{"stat":[{"stat_story_id":1,"operator":"+","quantity":1},{"stat_story_id":2,"operator":"+","quantity":2}]}',
                'single_use' => 1,
                'created_at' => '2019-12-20 15:47:37',
                'updated_at' => '2019-12-20 15:47:37',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Phéromone de guerre',
                'default_price' => 0,
                'story_id' => 1,
                'effects' => NULL,
                'single_use' => 1,
                'created_at' => '2019-12-20 15:47:37',
                'updated_at' => '2019-12-20 15:47:37',
                'deleted_at' => NULL,
            ),
        ));


    }
}
