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
                'title' => NULL,
                'answer' => '8191',
                'type' => 'integer',
                'target_page_text' => NULL,
                'target_page_id' => NULL,
                'item_id' => 4,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'page_id' => 74,
                'title' => 'Digicode',
                'answer' => '235711',
                'type' => 'integer',
                'target_page_text' => NULL,
                'target_page_id' => NULL,
                'item_id' => 6,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'page_id' => 75,
                'title' => 'Mot de passe',
                'answer' => 'picsou',
                'type' => 'string',
                'target_page_text' => 'Accéder aux dossiers personnels',
                'target_page_id' => 76,
                'item_id' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'page_id' => 151,
                'title' => NULL,
                'answer' => 'Rien',
                'type' => 'string',
                'target_page_text' => NULL,
                'target_page_id' => NULL,
                'item_id' => NULL,
                'deleted_at' => '2020-06-20 07:56:04',
            ),
            4 => 
            array (
                'id' => 5,
                'page_id' => 151,
                'title' => NULL,
                'answer' => 'Rien',
                'type' => 'string',
                'target_page_text' => NULL,
                'target_page_id' => NULL,
                'item_id' => NULL,
                'deleted_at' => '2020-06-20 07:59:44',
            ),
            5 => 
            array (
                'id' => 6,
                'page_id' => 151,
                'title' => NULL,
                'answer' => 'Rien',
                'type' => 'string',
                'target_page_text' => NULL,
                'target_page_id' => NULL,
                'item_id' => 24,
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'page_id' => 160,
                'title' => NULL,
                'answer' => '532',
                'type' => 'integer',
                'target_page_text' => 'Sortir de la pièce',
                'target_page_id' => 161,
                'item_id' => NULL,
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'page_id' => 168,
                'title' => NULL,
                'answer' => 'azerty',
                'type' => 'string',
                'target_page_text' => 'Je peux avancer !',
                'target_page_id' => 169,
                'item_id' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}