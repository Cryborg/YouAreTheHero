<?php

use Illuminate\Database\Seeder;

class ChoicesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('choices')->delete();
        
        \DB::table('choices')->insert(array (
            0 => 
            array (
                'id' => 86,
                'page_from' => 1,
                'page_to' => 2,
                'link_text' => 'Le départ',
            ),
            1 => 
            array (
                'id' => 87,
                'page_from' => 2,
                'page_to' => 3,
                'link_text' => 'Déboussolé',
            ),
            2 => 
            array (
                'id' => 88,
                'page_from' => 3,
                'page_to' => 4,
                'link_text' => 'Chercher à en savoir plus sur cette planète',
            ),
            3 => 
            array (
                'id' => 89,
                'page_from' => 3,
                'page_to' => 5,
                'link_text' => 'Redescendre en ville',
            ),
            4 => 
            array (
                'id' => 90,
                'page_from' => 4,
                'page_to' => 6,
                'link_text' => 'En savoir plus sur la carte de priorité orange',
            ),
            5 => 
            array (
                'id' => 91,
                'page_from' => 4,
                'page_to' => 7,
                'link_text' => 'Plus d\'info sur la carte priorité blanche',
            ),
            6 => 
            array (
                'id' => 92,
                'page_from' => 7,
                'page_to' => 8,
                'link_text' => 'Prendre congé',
            ),
            7 => 
            array (
                'id' => 93,
                'page_from' => 6,
                'page_to' => 8,
                'link_text' => 'Prendre congé',
            ),
            8 => 
            array (
                'id' => 94,
                'page_from' => 8,
                'page_to' => 9,
                'link_text' => 'Redescendre',
            ),
            9 => 
            array (
                'id' => 95,
                'page_from' => 9,
                'page_to' => 10,
                'link_text' => 'A propos du Centre',
            ),
            10 => 
            array (
                'id' => 96,
                'page_from' => 10,
                'page_to' => 11,
                'link_text' => 'Souvenir de la conversation avec le responsable de la sécurité du Centre',
            ),
            11 => 
            array (
                'id' => 97,
                'page_from' => 29,
                'page_to' => 30,
                'link_text' => 'Relever le défi',
            ),
            12 => 
            array (
                'id' => 98,
                'page_from' => 29,
                'page_to' => 31,
                'link_text' => 'J\'ai trop peur',
            ),
            13 => 
            array (
                'id' => 99,
                'page_from' => 12,
                'page_to' => 14,
                'link_text' => 'Entrer dans le manoir',
            ),
            14 => 
            array (
                'id' => 100,
                'page_from' => 12,
                'page_to' => 15,
                'link_text' => 'Abandonner',
            ),
            15 => 
            array (
                'id' => 101,
                'page_from' => 14,
                'page_to' => 16,
                'link_text' => 'Porte de gauche',
            ),
            16 => 
            array (
                'id' => 102,
                'page_from' => 14,
                'page_to' => 17,
                'link_text' => 'Porte de droite',
            ),
            17 => 
            array (
                'id' => 103,
                'page_from' => 14,
                'page_to' => 18,
                'link_text' => 'Monter les escaliers',
            ),
            18 => 
            array (
                'id' => 104,
                'page_from' => 18,
                'page_to' => 19,
                'link_text' => 'Porte licorne',
            ),
            19 => 
            array (
                'id' => 105,
                'page_from' => 18,
                'page_to' => 20,
                'link_text' => 'Porte dragon',
            ),
            20 => 
            array (
                'id' => 106,
                'page_from' => 18,
                'page_to' => 21,
                'link_text' => 'Porte centaure',
            ),
            21 => 
            array (
                'id' => 107,
                'page_from' => 18,
                'page_to' => 22,
                'link_text' => 'Porte satyre',
            ),
            22 => 
            array (
                'id' => 108,
                'page_from' => 16,
                'page_to' => 14,
                'link_text' => 'Sortir de la pièce',
            ),
            23 => 
            array (
                'id' => 110,
                'page_from' => 22,
                'page_to' => 27,
                'link_text' => 'Boire du vin',
            ),
            24 => 
            array (
                'id' => 111,
                'page_from' => 22,
                'page_to' => 28,
                'link_text' => 'Fermer les rideaux',
            ),
            25 => 
            array (
                'id' => 112,
                'page_from' => 18,
                'page_to' => 14,
                'link_text' => 'Retourner dans le hall',
            ),
        ));
        
        
    }
}