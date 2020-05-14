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
            ),
        ));
        
        
    }
}