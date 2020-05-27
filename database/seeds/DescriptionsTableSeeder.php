<?php

use Illuminate\Database\Seeder;

class DescriptionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('descriptions')->delete();

        \DB::table('descriptions')->insert(array (
            0 =>
            array (
                'id' => 1,
                'page_id' => 1,
                'keyword' => 'futur',
                'description' => '<p>Le futur, c\'est quand le passé n\'est plus que de l\'histoire... Ca veut rien dire mais au moins j\'ai un texte long et qui pourra tout faire bugguer si je me plante :p</p>',
            ),
            1 =>
            array (
                'id' => 2,
                'page_id' => 1,
                'keyword' => 'innovations',
                'description' => '<p>Les innovations c\'est compliqué...</p><p>Mais bon, on s\'en fout après tout :D</p>',
            ),
            2 =>
            array (
                'id' => 3,
                'page_id' => 74,
                'keyword' => 'une porte',
                'description' => '<p>Aucune poignée, pas de gonds que tu puisses démonter, tu as beau pousser rien ne se passe.</p>',
            ),
            3 =>
            array (
                'id' => 4,
                'page_id' => 74,
                'keyword' => 'digicode',
                'description' => '<p>Un pavé numérique standard, il faut taper un code à 6 chiffres pour débloquer je ne sais quoi.</p>',
            ),
            4 =>
            array (
                'id' => 5,
                'page_id' => 74,
                'keyword' => 'carnet de notes',
                'description' => '<p>La première page est noircie de formules mathématiques compliquées.</p><p>La seconde en revanche contient une liste de nombres premiers : 2, 3, 5, 7, 11 puis le reste jusqu\'à 97. Passionnant.</p>',
            ),
            5 =>
            array (
                'id' => 7,
                'page_id' => 74,
                'keyword' => 'tableau très moche',
                'description' => '<p>Vraiment hideux. L\'auteur doit pourtant en être très fier vu qu\'il l\'a signé : &quot;Renbrante&quot;. Ok, même ça il aurait dû s\'abstenir.</p>',
            ),
            6 =>
            array (
                'id' => 8,
                'page_id' => 74,
                'keyword' => 'entassement de livres',
                'description' => '<p>Une douzaine de romans, autant de biographies. Oh, et un Picsou magazine.</p>',
            ),
        ));
    }
}
