<?php

use Illuminate\Database\Seeder;

class StatStoryTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('stat_story')->delete();
        
        \DB::table('stat_story')->insert(array (
            0 => 
            array (
                'id' => 1,
                'story_id' => 1,
                'stat_full_name' => 'Vitesse',
                'stat_short_name' => 'VTS',
                'stat_min_value' => 1,
                'stat_max_value' => 10,
                'stat_start_value' => 1,
                'stat_order' => 1,
                'created_at' => '2020-01-10 15:33:26',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'story_id' => 1,
                'stat_full_name' => 'Force',
                'stat_short_name' => 'FRC',
                'stat_min_value' => 1,
                'stat_max_value' => 10,
                'stat_start_value' => 1,
                'stat_order' => 2,
                'created_at' => '2020-01-10 15:33:49',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}