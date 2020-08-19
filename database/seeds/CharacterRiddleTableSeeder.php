<?php

use Illuminate\Database\Seeder;

class CharacterRiddleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('character_riddle')->delete();
        
        \DB::table('character_riddle')->insert(array (
            0 => 
            array (
                'character_id' => 32,
                'riddle_id' => 6,
            ),
            1 => 
            array (
                'character_id' => 84,
                'riddle_id' => 8,
            ),
        ));
        
        
    }
}