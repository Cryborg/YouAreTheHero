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
                'updated_at' => '2020-05-18 20:37:21',
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

<div class="alert alert-info d-flex flex-row w-50"><i class="icon-info mr-3 display-6 text-primary"></i><div>Certaines des énigmes ne peuvent être résolues qu\'en recherchant sur internet !</div></div>',
            'user_id' => 1,
            'locale' => 'fr_FR',
            'layout' => 'play1',
            'is_published' => 0,
            'created_at' => '2020-05-09 14:04:38',
            'updated_at' => '2020-05-18 13:30:39',
        ),
        3 =>
        array (
            'id' => 5,
            'title' => 'LE Titre',
            'description' => 'Lisez mon histoire... Et plus vite que ça !',
            'user_id' => 7,
            'locale' => 'fr_FR',
            'layout' => 'play1',
            'is_published' => 0,
            'created_at' => '2020-05-12 11:26:15',
            'updated_at' => '2020-05-12 11:36:55',
        ),
        4 =>
        array (
            'id' => 6,
            'title' => 'Test',
            'description' => 'Test',
            'user_id' => 1,
            'locale' => 'fr_FR',
            'layout' => 'play1',
            'is_published' => 0,
            'created_at' => '2020-05-17 09:19:23',
            'updated_at' => '2020-05-17 15:59:26',
        ),
        5 =>
        array (
            'id' => 7,
            'title' => 'Escape game',
        'description' => 'Dans la série "Ni queue ni tête" ! :)

Un petit exemple d\'escape game qu\'il est possible d\'écrire sans aucune connaissance technique !',
        'user_id' => 1,
        'locale' => 'fr_FR',
        'layout' => 'play1',
        'is_published' => 0,
        'created_at' => '2020-05-18 18:04:22',
        'updated_at' => '2020-05-19 09:14:59',
    ),
));


    }
}
