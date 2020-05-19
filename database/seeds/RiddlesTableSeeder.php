<?php

use Illuminate\Database\Seeder;

class RiddlesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('riddles')->delete();
        
        \DB::table('riddles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'page_id' => 16,
                'answer' => '8191',
                'type' => 'integer',
                'target_page_text' => NULL,
                'target_page_id' => NULL,
                'item_id' => 4,
                'title' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'page_id' => 74,
                'answer' => '235711',
                'type' => 'integer',
                'target_page_text' => NULL,
                'target_page_id' => NULL,
                'item_id' => 6,
                'title' => 'Digicode',
            ),
            2 => 
            array (
                'id' => 3,
                'page_id' => 75,
                'answer' => 'picsou',
                'type' => 'string',
                'target_page_text' => 'Accéder aux dossiers personnels',
                'target_page_id' => 76,
                'item_id' => NULL,
                'title' => 'Mot de passe',
            ),
        ));
        
        
    }
}