<?php

use Illuminate\Database\Seeder;

class CharacterFieldTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('character_field')->delete();
        
        \DB::table('character_field')->insert(array (
            0 => 
            array (
                'character_id' => 84,
                'field_id' => 11,
                'value' => 40,
            ),
            1 => 
            array (
                'character_id' => 84,
                'field_id' => 12,
                'value' => 15,
            ),
            2 => 
            array (
                'character_id' => 85,
                'field_id' => 11,
                'value' => 6,
            ),
            3 => 
            array (
                'character_id' => 85,
                'field_id' => 12,
                'value' => 6,
            ),
        ));
        
        
    }
}