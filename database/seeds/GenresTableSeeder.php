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
                'label' => 'Comédie',
            ),
            1 =>
            array (
                'id' => 2,
                'label' => 'Drame',
            ),
            2 =>
            array (
                'id' => 3,
                'label' => 'Thriller',
            ),
            3 =>
            array (
                'id' => 4,
                'label' => 'Science-fiction',
            ),
            4 =>
            array (
                'id' => 5,
                'label' => 'Fantastique',
            ),
            5 =>
            array (
                'id' => 6,
                'label' => 'Horreur',
            ),
            6 =>
            array (
                'id' => 7,
                'label' => 'Policier',
            ),
            7 =>
            array (
                'id' => 8,
                'label' => 'Fantasy',
            ),
            8 =>
            array (
                'id' => 9,
                'label' => 'Aventure',
            ),
            9 =>
            array (
                'id' => 10,
                'label' => 'Conte',
            ),
            10 =>
            array (
                'id' => 11,
                'label' => 'Historique',
            ),
            11 =>
            array (
                'id' => 12,
                'label' => 'Jeunesse',
            ),
        ));


    }
}
