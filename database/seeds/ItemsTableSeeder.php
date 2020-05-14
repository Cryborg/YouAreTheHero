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
        ));
        
        
    }
}