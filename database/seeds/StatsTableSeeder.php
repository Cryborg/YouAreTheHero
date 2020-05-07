<?php

use Illuminate\Database\Seeder;

class StatsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('stats')->delete();

        \DB::table('stats')->insert(array (
            0 =>
            array (
                'id' => 1,
                'full_name' => 'Vitesse',
                'short_name' => 'VTS',
            ),
            1 =>
            array (
                'id' => 2,
                'full_name' => 'Force',
                'short_name' => 'FOR',
            ),
            2 =>
            array (
                'id' => 3,
                'full_name' => 'Agilité',
                'short_name' => 'AGI',
            ),
            3 =>
            array (
                'id' => 4,
                'full_name' => 'Intelligence',
                'short_name' => 'INT',
            ),
            4 =>
            array (
                'id' => 5,
                'full_name' => 'Discrétion',
                'short_name' => 'DIS',
            ),
            5 =>
            array (
                'id' => 6,
                'full_name' => 'Perception',
                'short_name' => 'PER',
            ),
            6 =>
            array (
                'id' => 7,
                'full_name' => 'Charisme',
                'short_name' => 'CHA',
            ),
        ));


    }
}
