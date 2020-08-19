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
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'story_id' => 5,
                'genre_id' => 4,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'story_id' => 6,
                'genre_id' => 9,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'story_id' => 8,
                'genre_id' => 2,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'story_id' => 8,
                'genre_id' => 3,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'story_id' => 8,
                'genre_id' => 5,
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'story_id' => 8,
                'genre_id' => 6,
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'story_id' => 9,
                'genre_id' => 9,
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'story_id' => 10,
                'genre_id' => 8,
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'story_id' => 10,
                'genre_id' => 9,
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'story_id' => 11,
                'genre_id' => 9,
                'deleted_at' => '2020-05-28 15:31:50',
            ),
            11 => 
            array (
                'story_id' => 11,
                'genre_id' => 9,
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'story_id' => 12,
                'genre_id' => 4,
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'story_id' => 12,
                'genre_id' => 9,
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'story_id' => 13,
                'genre_id' => 9,
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'story_id' => 14,
                'genre_id' => 5,
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'story_id' => 15,
                'genre_id' => 5,
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'story_id' => 15,
                'genre_id' => 9,
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'story_id' => 16,
                'genre_id' => 8,
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'story_id' => 17,
                'genre_id' => 1,
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'story_id' => 18,
                'genre_id' => 5,
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'story_id' => 19,
                'genre_id' => 8,
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'story_id' => 20,
                'genre_id' => 2,
                'deleted_at' => NULL,
            ),
            23 => 
            array (
                'story_id' => 21,
                'genre_id' => 2,
                'deleted_at' => NULL,
            ),
            24 => 
            array (
                'story_id' => 22,
                'genre_id' => 5,
                'deleted_at' => NULL,
            ),
            25 => 
            array (
                'story_id' => 22,
                'genre_id' => 6,
                'deleted_at' => NULL,
            ),
            26 => 
            array (
                'story_id' => 22,
                'genre_id' => 7,
                'deleted_at' => NULL,
            ),
            27 => 
            array (
                'story_id' => 22,
                'genre_id' => 8,
                'deleted_at' => NULL,
            ),
            28 => 
            array (
                'story_id' => 22,
                'genre_id' => 9,
                'deleted_at' => NULL,
            ),
            29 => 
            array (
                'story_id' => 23,
                'genre_id' => 9,
                'deleted_at' => '2020-08-14 09:52:11',
            ),
            30 => 
            array (
                'story_id' => 23,
                'genre_id' => 9,
                'deleted_at' => NULL,
            ),
            31 => 
            array (
                'story_id' => 24,
                'genre_id' => 7,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}