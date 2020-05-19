<?php

use Illuminate\Database\Seeder;

class StoryOptionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('story_options')->delete();
        
        \DB::table('story_options')->insert(array (
            0 => 
            array (
                'id' => 1,
                'story_id' => 4,
                'has_character' => 1,
                'has_stats' => 1,
                'stat_attribution' => 'player',
                'points_to_share' => 10,
                'created_at' => '2020-05-09 14:04:38',
                'updated_at' => '2020-05-09 14:04:47',
            ),
            1 => 
            array (
                'id' => 2,
                'story_id' => 5,
                'has_character' => 0,
                'has_stats' => 0,
                'stat_attribution' => 'player',
                'points_to_share' => 10,
                'created_at' => '2020-05-12 11:26:15',
                'updated_at' => '2020-05-12 11:26:15',
            ),
            2 => 
            array (
                'id' => 3,
                'story_id' => 6,
                'has_character' => 0,
                'has_stats' => 0,
                'stat_attribution' => 'player',
                'points_to_share' => 10,
                'created_at' => '2020-05-17 09:19:23',
                'updated_at' => '2020-05-17 09:19:23',
            ),
        ));
        
        
    }
}