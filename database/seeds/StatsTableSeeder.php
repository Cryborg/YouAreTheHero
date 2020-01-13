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
                'character_id' => 1,
                'stat_name' => 'Vitesse',
                'stat_value' => 2,
                'created_at' => '2020-01-10 15:34:18',
                'updated_at' => NULL,
            ),
        ));


    }
}
