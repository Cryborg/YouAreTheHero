<?php

use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('genres')->delete();

        \DB::table('genres')->insert(array (
            0 =>
            array (
                'id' => 1,
                'label' => 'writing_genre_humor',
            ),
            1 =>
            array (
                'id' => 2,
                'label' => 'writing_genre_drama',
            ),
            2 =>
            array (
                'id' => 3,
                'label' => 'writing_genre_thriller',
            ),
            3 =>
            array (
                'id' => 4,
                'label' => 'writing_genre_science_fiction',
            ),
            4 =>
            array (
                'id' => 5,
                'label' => 'writing_genre_fantastic',
            ),
            5 =>
            array (
                'id' => 6,
                'label' => 'writing_genre_horror',
            ),
            6 =>
            array (
                'id' => 7,
                'label' => 'writing_genre_detective',
            ),
            7 =>
            array (
                'id' => 8,
                'label' => 'writing_genre_fantasy',
            ),
            8 =>
            array (
                'id' => 9,
                'label' => 'writing_genre_adventure',
            ),
            9 =>
            array (
                'id' => 10,
                'label' => 'writing_genre_tale',
            ),
            10 =>
            array (
                'id' => 11,
                'label' => 'writing_genre_historical',
            ),
            11 => array (
                'id' => 12,
                'label' => 'writing_genre_short_story',
            ),
            12 => array (
                'id' => 13,
                'label' => 'writing_genre_tutorial',
            ),
            13 => array (
                'id' => 14,
                'label' => 'writing_genre_romance',
            ),
        ));


    }
}
