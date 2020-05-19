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
                'story_id' => 4,
                'category' => NULL,
                'name' => 'Médaillon licorne',
                'default_price' => 0,
                'single_use' => 1,
                'created_at' => '2020-05-10 08:53:15',
                'updated_at' => '2020-05-10 08:53:15',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'story_id' => 4,
                'category' => NULL,
                'name' => 'Médaillon dragon',
                'default_price' => 0,
                'single_use' => 1,
                'created_at' => '2020-05-10 08:53:49',
                'updated_at' => '2020-05-10 08:53:49',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'story_id' => 4,
                'category' => NULL,
                'name' => 'Médaillon centaure',
                'default_price' => 0,
                'single_use' => 1,
                'created_at' => '2020-05-10 08:54:14',
                'updated_at' => '2020-05-10 08:54:14',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'story_id' => 4,
                'category' => NULL,
                'name' => 'Médaillon satyre',
                'default_price' => 0,
                'single_use' => 1,
                'created_at' => '2020-05-10 08:54:22',
                'updated_at' => '2020-05-10 08:54:22',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'story_id' => 4,
                'category' => NULL,
                'name' => 'Carafe de vin',
                'default_price' => 0,
                'single_use' => 1,
                'created_at' => '2020-05-11 19:44:55',
                'updated_at' => '2020-05-11 19:44:55',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'story_id' => 7,
                'category' => NULL,
                'name' => 'Clé bleue',
                'default_price' => 0,
                'single_use' => 1,
                'created_at' => '2020-05-18 18:07:10',
                'updated_at' => '2020-05-18 18:07:10',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'story_id' => 7,
                'category' => NULL,
                'name' => 'Clé rose',
                'default_price' => 0,
                'single_use' => 1,
                'created_at' => '2020-05-18 18:07:15',
                'updated_at' => '2020-05-18 18:07:15',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'story_id' => 7,
                'category' => NULL,
                'name' => 'Clé verte',
                'default_price' => 0,
                'single_use' => 1,
                'created_at' => '2020-05-18 18:07:18',
                'updated_at' => '2020-05-18 18:07:18',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'story_id' => 7,
                'category' => NULL,
                'name' => 'Clé violette',
                'default_price' => 0,
                'single_use' => 1,
                'created_at' => '2020-05-18 18:07:22',
                'updated_at' => '2020-05-18 18:07:22',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'story_id' => 7,
                'category' => NULL,
                'name' => 'Clé à molette',
                'default_price' => 0,
                'single_use' => 1,
                'created_at' => '2020-05-18 18:07:29',
                'updated_at' => '2020-05-18 18:07:29',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'story_id' => 7,
                'category' => NULL,
                'name' => 'Médaillon bronze',
                'default_price' => 0,
                'single_use' => 1,
                'created_at' => '2020-05-18 18:07:48',
                'updated_at' => '2020-05-18 18:07:48',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'story_id' => 7,
                'category' => NULL,
                'name' => 'Médaillon argent',
                'default_price' => 0,
                'single_use' => 1,
                'created_at' => '2020-05-18 18:07:52',
                'updated_at' => '2020-05-18 18:07:52',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'story_id' => 7,
                'category' => NULL,
                'name' => 'Médaillon or',
                'default_price' => 0,
                'single_use' => 1,
                'created_at' => '2020-05-18 18:07:55',
                'updated_at' => '2020-05-18 18:07:55',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}