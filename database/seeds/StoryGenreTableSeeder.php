<?php

use Illuminate\Database\Seeder;

class StoryGenreTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('story_genre')->delete();
        
        \DB::table('story_genre')->insert(array (
            0 => 
            array (
                'story_id' => 5,
                'genre_id' => 2,
            ),
            1 => 
            array (
                'story_id' => 5,
                'genre_id' => 4,
            ),
            2 => 
            array (
                'story_id' => 6,
                'genre_id' => 9,
            ),
        ));
        
        
    }
}