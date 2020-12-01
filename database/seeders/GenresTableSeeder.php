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
                'label' => 'humor',
            ),
            1 =>
            array (
                'id' => 2,
                'label' => 'drama',
            ),
            2 =>
            array (
                'id' => 3,
                'label' => 'thriller',
            ),
            3 =>
            array (
                'id' => 4,
                'label' => 'science_fiction',
            ),
            4 =>
            array (
                'id' => 5,
                'label' => 'fantastic',
            ),
            5 =>
            array (
                'id' => 6,
                'label' => 'horror',
            ),
            6 =>
            array (
                'id' => 7,
                'label' => 'detective',
            ),
            7 =>
            array (
                'id' => 8,
                'label' => 'fantasy',
            ),
            8 =>
            array (
                'id' => 9,
                'label' => 'adventure',
            ),
            9 =>
            array (
                'id' => 10,
                'label' => 'tale',
            ),
            10 =>
            array (
                'id' => 11,
                'label' => 'historical',
            ),
            11 => array (
                'id' => 12,
                'label' => 'short_story',
            ),
            12 => array (
                'id' => 13,
                'label' => 'tutorial',
            ),
            13 => array (
                'id' => 14,
                'label' => 'romance',
            ),
        ));


    }
}
