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
                'deleted_at' => NULL,
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
                'deleted_at' => NULL,
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
            'updated_at' => '2020-05-18 13:30:39',
            'deleted_at' => NULL,
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
            'deleted_at' => NULL,
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
            'updated_at' => '2020-05-28 03:03:53',
            'deleted_at' => '2020-05-28 03:03:53',
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
        'updated_at' => '2020-06-02 17:17:29',
        'deleted_at' => NULL,
    ),
    6 => 
    array (
        'id' => 8,
        'title' => 'Labyrinthe hôtel',
        'description' => 'Un hôtel perché en haut d\'une montagne ou plus personne ne vient.
Les habitants de la région disent que la montagne est hanté par le mal lui même.',
        'user_id' => 9,
        'locale' => 'fr_FR',
        'layout' => 'play1',
        'is_published' => 0,
        'created_at' => '2020-05-19 12:45:56',
        'updated_at' => '2020-07-17 12:49:11',
        'deleted_at' => NULL,
    ),
    7 => 
    array (
        'id' => 9,
        'title' => 'Le double-vie de Jean-Baptiste',
        'description' => '<p>Jean-Baptiste est ce qu’on appelle communément un homme ordinaire. Mais ça n\'a as toujours été le cas. Il endosse régulièrement le costume de son autre vie, celle de François-Baptiste de La Férié, un gentilhomme du XVIème siècle.</p>',
        'user_id' => 15,
        'locale' => 'fr_FR',
        'layout' => 'play1',
        'is_published' => 0,
        'created_at' => '2020-05-23 20:25:42',
        'updated_at' => '2020-05-23 20:25:42',
        'deleted_at' => NULL,
    ),
    8 => 
    array (
        'id' => 10,
        'title' => 'Test',
        'description' => 'n bbn',
        'user_id' => 11,
        'locale' => 'fr_FR',
        'layout' => 'play1',
        'is_published' => 0,
        'created_at' => '2020-05-25 20:39:10',
        'updated_at' => '2020-05-25 20:39:11',
        'deleted_at' => NULL,
    ),
    9 => 
    array (
        'id' => 11,
        'title' => 'Test',
        'description' => 'Ceci est un simple test',
        'user_id' => 16,
        'locale' => 'fr_FR',
        'layout' => 'play1',
        'is_published' => 1,
        'created_at' => '2020-05-28 15:19:04',
        'updated_at' => '2020-05-28 15:33:34',
        'deleted_at' => NULL,
    ),
    10 => 
    array (
        'id' => 12,
        'title' => 'Exil',
        'description' => 'C\'est parti !',
        'user_id' => 1,
        'locale' => 'fr_FR',
        'layout' => 'play1',
        'is_published' => 0,
        'created_at' => '2020-05-29 08:35:05',
        'updated_at' => '2020-06-02 14:51:59',
        'deleted_at' => NULL,
    ),
    11 => 
    array (
        'id' => 13,
        'title' => 'Le vrai coté obscur de la Force',
        'description' => 'Nous semblons oublier avec la technologie, la facilité et le temps qui passe que le monde est en fait géré par 2 forces. Le pouvoir obscur et le coté lumineux de la Force.
Je vous propose de retourner à la source, au fondement de ce qui nous anime pour mieux comprendre le présent et anticiper le futur',
        'user_id' => 17,
        'locale' => 'fr_FR',
        'layout' => 'play1',
        'is_published' => 0,
        'created_at' => '2020-06-02 14:59:05',
        'updated_at' => '2020-06-02 15:08:07',
        'deleted_at' => NULL,
    ),
    12 => 
    array (
        'id' => 14,
        'title' => 'test',
        'description' => 'fgdsf gd',
        'user_id' => 1,
        'locale' => 'fr_FR',
        'layout' => 'play1',
        'is_published' => 0,
        'created_at' => '2020-06-02 15:03:01',
        'updated_at' => '2020-06-12 17:58:16',
        'deleted_at' => '2020-06-12 17:58:16',
    ),
    13 => 
    array (
        'id' => 15,
        'title' => 'Le labyrinthe de l\'illusion',
        'description' => 'Tu décriras plus tard',
        'user_id' => 18,
        'locale' => 'fr_FR',
        'layout' => 'play1',
        'is_published' => 0,
        'created_at' => '2020-06-20 07:41:30',
        'updated_at' => '2020-06-20 09:58:50',
        'deleted_at' => NULL,
    ),
    14 => 
    array (
        'id' => 16,
        'title' => 'ORA',
        'description' => 'TEst',
        'user_id' => 19,
        'locale' => 'fr_FR',
        'layout' => 'play1',
        'is_published' => 0,
        'created_at' => '2020-06-20 17:07:37',
        'updated_at' => '2020-06-20 17:07:38',
        'deleted_at' => NULL,
    ),
    15 => 
    array (
        'id' => 17,
        'title' => 'Short story',
        'description' => 'C\'est l\'histoire d\'un short...',
        'user_id' => 1,
        'locale' => 'fr_FR',
        'layout' => 'play1',
        'is_published' => 0,
        'created_at' => '2020-06-21 09:51:54',
        'updated_at' => '2020-07-17 13:04:19',
        'deleted_at' => NULL,
    ),
    16 => 
    array (
        'id' => 18,
        'title' => 'Journal',
        'description' => 'Journal',
        'user_id' => 20,
        'locale' => 'fr_FR',
        'layout' => 'play1',
        'is_published' => 0,
        'created_at' => '2020-06-30 07:05:00',
        'updated_at' => '2020-06-30 07:05:00',
        'deleted_at' => NULL,
    ),
    17 => 
    array (
        'id' => 19,
        'title' => 'Fantasy World',
        'description' => 'J\'ai pas trouvé de titre alors j\'ai mis le premier truc qui m\'est venu !',
        'user_id' => 1,
        'locale' => 'fr_FR',
        'layout' => 'play1',
        'is_published' => 0,
        'created_at' => '2020-07-28 12:55:56',
        'updated_at' => '2020-07-28 17:35:00',
        'deleted_at' => NULL,
    ),
    18 => 
    array (
        'id' => 20,
        'title' => 'High School',
        'description' => 'A la fac, tu es la meilleure élève, la petite chouchoute que pas beaucoup de personne aime...',
        'user_id' => 13,
        'locale' => 'fr_FR',
        'layout' => 'play1',
        'is_published' => 0,
        'created_at' => '2020-08-05 16:41:59',
        'updated_at' => '2020-08-05 16:42:00',
        'deleted_at' => '2020-08-03 22:00:00',
    ),
    19 => 
    array (
        'id' => 21,
        'title' => 'High School',
        'description' => 'A la fac, tu es la meilleure élève, la petite chouchoute que pas beaucoup de personne aime...',
        'user_id' => 13,
        'locale' => 'fr_FR',
        'layout' => 'play1',
        'is_published' => 0,
        'created_at' => '2020-08-05 16:42:12',
        'updated_at' => '2020-08-06 13:49:40',
        'deleted_at' => NULL,
    ),
    20 => 
    array (
        'id' => 22,
        'title' => 'La traque de l\'ombre',
        'description' => 'Dans une fantasy hurbaine, une créature effraye la population. Vous êtes Steven Haimlich et votre mission sera de l\'arrêter.',
        'user_id' => 24,
        'locale' => 'fr_FR',
        'layout' => 'play1',
        'is_published' => 0,
        'created_at' => '2020-08-12 13:56:18',
        'updated_at' => '2020-08-12 13:56:19',
        'deleted_at' => NULL,
    ),
    21 => 
    array (
        'id' => 23,
        'title' => 'Didacticiel déguisé',
    'description' => 'Petite histoire sans histoire permettant de montrer toutes les possibilités offertes par l\'interface de création :)',
    'user_id' => 1,
    'locale' => 'fr_FR',
    'layout' => 'play1',
    'is_published' => 1,
    'created_at' => '2020-08-13 04:36:51',
    'updated_at' => '2020-08-17 04:47:50',
    'deleted_at' => NULL,
),
22 => 
array (
    'id' => 24,
    'title' => 'Câlins gratuits',
    'description' => 'Une nouvelle.drogue fait des ravages chez les jeunes. Tu dois enquêter !',
    'user_id' => 29,
    'locale' => 'fr_FR',
    'layout' => 'play1',
    'is_published' => 0,
    'created_at' => '2020-08-19 02:41:19',
    'updated_at' => '2020-08-19 03:35:06',
    'deleted_at' => NULL,
),
));
        
        
    }
}