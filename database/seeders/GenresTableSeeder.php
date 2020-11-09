<?php

namespace Database\Seeders;

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
                'label' => 'writing_genres.humor',
            ),
            1 =>
            array (
                'id' => 2,
                'label' => 'writing_genres.drama',
            ),
            2 =>
            array (
                'id' => 3,
                'label' => 'writing_genres.thriller',
            ),
            3 =>
            array (
                'id' => 4,
                'label' => 'writing_genres.science_fiction',
            ),
            4 =>
            array (
                'id' => 5,
                'label' => 'writing_genres.fantastic',
            ),
            5 =>
            array (
                'id' => 6,
                'label' => 'writing_genres.horror',
            ),
            6 =>
            array (
                'id' => 7,
                'label' => 'writing_genres.detective',
            ),
            7 =>
            array (
                'id' => 8,
                'label' => 'writing_genres.fantasy',
            ),
            8 =>
            array (
                'id' => 9,
                'label' => 'writing_genres.adventure',
            ),
            9 =>
            array (
                'id' => 10,
                'label' => 'writing_genres.tale',
            ),
            10 =>
            array (
                'id' => 11,
                'label' => 'writing_genres.historical',
            ),
            11 => array (
                'id' => 12,
                'label' => 'writing_genres.short_story',
            ),
            12 => array (
                'id' => 13,
                'label' => 'writing_genres.tutorial',
            ),
            13 => array (
                'id' => 14,
                'label' => 'writing_genres.romance',
            ),
        ));


    }
}
