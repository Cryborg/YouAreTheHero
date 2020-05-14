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
                'id' => 2,
                'title' => 'Un nouveau départ',
                'description' => 'Description de l\'histoire',
                'user_id' => 1,
                'locale' => 'fr_FR',
                'layout' => 'play1',
                'is_published' => 0,
                'created_at' => '2019-11-12 16:29:44',
                'updated_at' => '2020-05-14 03:48:11',
            ),
            1 => 
            array (
                'id' => 3,
                'title' => 'Deuxième histoire',
                'description' => 'Ma description top moumoutte',
                'user_id' => 2,
                'locale' => 'fr_FR',
                'layout' => 'play1',
                'is_published' => 0,
                'created_at' => '2019-11-12 16:29:44',
                'updated_at' => '2020-01-02 16:29:44',
            ),
            2 => 
            array (
                'id' => 4,
                'title' => 'Trouvez Charlie',
            'description' => 'Histoire sans queue ni tête, juste pour montrer les possibilités offertes par le site :)

<div class="alert alert-info d-flex flex-row w-50"><i class="glyphicon glyphicon-info-sign mr-3"></i><div>Certaines des énigmes ne peuvent être résolues qu\'en recherchant sur internet !</div></div>',
            'user_id' => 1,
            'locale' => 'fr_FR',
            'layout' => 'play1',
            'is_published' => 0,
            'created_at' => '2020-05-09 14:04:38',
            'updated_at' => '2020-05-11 19:43:35',
        ),
        3 => 
        array (
            'id' => 5,
            'title' => 'LE Titre',
            'description' => 'Lisez mon histoire... Et plus vite que ça !',
            'user_id' => 5,
            'locale' => 'fr_FR',
            'layout' => 'play1',
            'is_published' => 0,
            'created_at' => '2020-05-12 11:26:15',
            'updated_at' => '2020-05-12 11:36:55',
        ),
    ));
        
        
    }
}