<?php

use Illuminate\Database\Seeder;

class StoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('stories')->delete();
        
        \DB::table('stories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Emergence',
                'description' => 'Par Alexis Ravel<br>http://litteraction.fr/sites/default/files/emergence_0.pdf',
                'user_id' => 1,
                'locale' => 'fr_FR',
                'layout' => 'play1',
                'sheet_config' => NULL,
                'is_published' => 0,
                'created_at' => '2019-12-19 16:29:44',
                'updated_at' => '2019-12-19 16:29:44',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Un nouveau départ',
                'description' => 'Description de l\'histoire',
                'user_id' => 1,
                'locale' => 'fr_FR',
                'layout' => 'play1',
                'sheet_config' => NULL,
                'is_published' => 0,
                'created_at' => '2019-12-19 16:29:44',
                'updated_at' => '2019-12-19 16:29:44',
            ),
        ));
        
        
    }
}