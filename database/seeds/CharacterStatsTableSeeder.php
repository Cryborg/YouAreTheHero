<?php

use App\Models\CharacterStat;
use Illuminate\Database\Seeder;

class CharacterStatsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('character_stats')->delete();

        \DB::table('character_stats')->insert(array (
            0 =>
            array (
                'id' => 1,
                'character_id' => 1,
                'stat_story_id' => 1,
                'value' => 2,
                'created_at' => '2020-01-10 15:34:18',
                'updated_at' => NULL,
            ),
        ));


    }
}