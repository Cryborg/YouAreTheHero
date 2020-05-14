<?php

use Illuminate\Database\Seeder;

class FieldsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('fields')->delete();
        
        \DB::table('fields')->insert(array (
            0 => 
            array (
                'id' => 1,
                'story_id' => 4,
                'full_name' => 'Vitesse',
                'short_name' => 'VTS',
                'min_value' => 1,
                'max_value' => 10,
                'start_value' => 1,
                'order' => 1,
                'created_at' => '2020-05-12 14:56:09',
                'updated_at' => '2020-05-12 14:56:09',
            ),
            1 => 
            array (
                'id' => 2,
                'story_id' => 4,
                'full_name' => 'Force',
                'short_name' => 'FOR',
                'min_value' => 1,
                'max_value' => 10,
                'start_value' => 1,
                'order' => 1,
                'created_at' => '2020-05-12 14:56:22',
                'updated_at' => '2020-05-12 14:56:22',
            ),
            2 => 
            array (
                'id' => 3,
                'story_id' => 4,
                'full_name' => 'Endurance',
                'short_name' => 'END',
                'min_value' => 1,
                'max_value' => 10,
                'start_value' => 1,
                'order' => 1,
                'created_at' => '2020-05-12 14:58:41',
                'updated_at' => '2020-05-12 14:58:41',
            ),
        ));
        
        
    }
}