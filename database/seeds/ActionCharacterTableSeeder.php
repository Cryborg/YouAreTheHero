<?php

use Illuminate\Database\Seeder;

class ActionCharacterTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('action_character')->delete();

        \DB::table('action_character')->insert(array (
            0 =>
            array (
                'character_id' => 19,
                'action_id' => 1,
            ),
            1 =>
            array (
                'character_id' => 27,
                'action_id' => 1,
            ),
            2 =>
            array (
                'character_id' => 29,
                'action_id' => 2,
            ),
            3 =>
            array (
                'character_id' => 29,
                'action_id' => 3,
            ),
            4 =>
            array (
                'character_id' => 29,
                'action_id' => 4,
            ),
            5 =>
            array (
                'character_id' => 29,
                'action_id' => 5,
            ),
            6 =>
            array (
                'character_id' => 30,
                'action_id' => 1,
            ),
            7 =>
            array (
                'character_id' => 70,
                'action_id' => 6,
            ),
            8 =>
            array (
                'character_id' => 70,
                'action_id' => 7,
            ),
            9 =>
            array (
                'character_id' => 75,
                'action_id' => 6,
            ),
            10 =>
            array (
                'character_id' => 75,
                'action_id' => 7,
            ),
            11 =>
            array (
                'character_id' => 77,
                'action_id' => 6,
            ),
            12 =>
            array (
                'character_id' => 77,
                'action_id' => 7,
            ),
            13 =>
            array (
                'character_id' => 78,
                'action_id' => 6,
            ),
            14 =>
            array (
                'character_id' => 78,
                'action_id' => 7,
            ),
            15 =>
            array (
                'character_id' => 79,
                'action_id' => 6,
            ),
            16 =>
            array (
                'character_id' => 79,
                'action_id' => 7,
            ),
            17 =>
            array (
                'character_id' => 81,
                'action_id' => 6,
            ),
            18 =>
            array (
                'character_id' => 81,
                'action_id' => 7,
            ),
            19 =>
            array (
                'character_id' => 83,
                'action_id' => 6,
            ),
            20 =>
            array (
                'character_id' => 83,
                'action_id' => 7,
            ),
            21 =>
            array (
                'character_id' => 84,
                'action_id' => 6,
            ),
            22 =>
            array (
                'character_id' => 84,
                'action_id' => 7,
            ),
            23 =>
            array (
                'character_id' => 85,
                'action_id' => 6,
            ),
        ));


    }
}
