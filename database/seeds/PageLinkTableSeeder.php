<?php

use Illuminate\Database\Seeder;

class PageLinkTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('page_link')->delete();

        \DB::table('page_link')->insert(array (
                                            0 =>
                                                array (
                                                    'id' => 86,
                                                    'page_from' => '1',
                                                    'page_to' => '2',
                                                    'link_text' => 'Le départ',
                                                ),
                                            1 =>
                                                array (
                                                    'id' => 87,
                                                    'page_from' => '2',
                                                    'page_to' => '3',
                                                    'link_text' => 'Déboussolé',
                                                ),
                                            2 =>
                                                array (
                                                    'id' => 88,
                                                    'page_from' => '3',
                                                    'page_to' => '4',
                                                    'link_text' => 'Chercher à en savoir plus sur cette planète',
                                                ),
                                            3 =>
                                                array (
                                                    'id' => 89,
                                                    'page_from' => '3',
                                                    'page_to' => '5',
                                                    'link_text' => 'Redescendre en ville',
                                                ),
                                            4 =>
                                                array (
                                                    'id' => 90,
                                                    'page_from' => '4',
                                                    'page_to' => '6',
                                                    'link_text' => 'En savoir plus sur la carte de priorité orange',
                                                ),
                                            5 =>
                                                array (
                                                    'id' => 91,
                                                    'page_from' => '4',
                                                    'page_to' => '7',
                                                    'link_text' => 'Plus d\'info sur la carte priorité blanche',
                                                ),
                                            6 =>
                                                array (
                                                    'id' => 92,
                                                    'page_from' => '7',
                                                    'page_to' => '8',
                                                    'link_text' => 'Prendre congé',
                                                ),
                                            7 =>
                                                array (
                                                    'id' => 93,
                                                    'page_from' => '6',
                                                    'page_to' => '8',
                                                    'link_text' => 'Prendre congé',
                                                ),
                                            8 =>
                                                array (
                                                    'id' => 94,
                                                    'page_from' => '8',
                                                    'page_to' => '9',
                                                    'link_text' => 'Redescendre',
                                                ),
                                            9 =>
                                                array (
                                                    'id' => 95,
                                                    'page_from' => '9',
                                                    'page_to' => '10',
                                                    'link_text' => 'A propos du Centre',
                                                ),
                                            10 =>
                                                array (
                                                    'id' => 96,
                                                    'page_from' => '10',
                                                    'page_to' => '11',
                                                    'link_text' => 'Souvenir de la conversation avec le responsable de la sécurité du Centre',
                                                ),

                                        ));


    }
}
