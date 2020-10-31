<?php

namespace Database\Seeders;

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
            3 =>
            array (
                'story_id' => 8,
                'genre_id' => 2,

            ),
            4 =>
            array (
                'story_id' => 8,
                'genre_id' => 3,

            ),
            5 =>
            array (
                'story_id' => 8,
                'genre_id' => 5,

            ),
            6 =>
            array (
                'story_id' => 8,
                'genre_id' => 6,

            ),
            7 =>
            array (
                'story_id' => 9,
                'genre_id' => 9,

            ),
            8 =>
            array (
                'story_id' => 10,
                'genre_id' => 8,

            ),
            9 =>
            array (
                'story_id' => 10,
                'genre_id' => 9,

            ),
            11 =>
            array (
                'story_id' => 11,
                'genre_id' => 9,

            ),
            12 =>
            array (
                'story_id' => 12,
                'genre_id' => 4,

            ),
            13 =>
            array (
                'story_id' => 12,
                'genre_id' => 9,

            ),
            14 =>
            array (
                'story_id' => 13,
                'genre_id' => 9,

            ),
            15 =>
            array (
                'story_id' => 14,
                'genre_id' => 5,

            ),
            16 =>
            array (
                'story_id' => 15,
                'genre_id' => 5,

            ),
            17 =>
            array (
                'story_id' => 15,
                'genre_id' => 9,

            ),
            18 =>
            array (
                'story_id' => 16,
                'genre_id' => 8,

            ),
            19 =>
            array (
                'story_id' => 17,
                'genre_id' => 1,

            ),
            20 =>
            array (
                'story_id' => 18,
                'genre_id' => 5,

            ),
            21 =>
            array (
                'story_id' => 19,
                'genre_id' => 8,

            ),
            22 =>
            array (
                'story_id' => 20,
                'genre_id' => 2,

            ),
            23 =>
            array (
                'story_id' => 21,
                'genre_id' => 2,

            ),
            24 =>
            array (
                'story_id' => 22,
                'genre_id' => 5,

            ),
            25 =>
            array (
                'story_id' => 22,
                'genre_id' => 6,

            ),
            26 =>
            array (
                'story_id' => 22,
                'genre_id' => 7,

            ),
            27 =>
            array (
                'story_id' => 22,
                'genre_id' => 8,

            ),
            28 =>
            array (
                'story_id' => 22,
                'genre_id' => 9,

            ),
            30 =>
            array (
                'story_id' => 23,
                'genre_id' => 9,

            ),
            31 =>
            array (
                'story_id' => 24,
                'genre_id' => 7,

            ),
        ));


    }
}
