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
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'page_id' => 1,
                'keyword' => 'innovations',
                'description' => '<p>Les innovations c\'est compliqué...</p><p>Mais bon, on s\'en fout après tout :D</p>',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'page_id' => 74,
                'keyword' => 'une porte',
                'description' => '<p>Aucune poignée, pas de gonds que tu puisses démonter, tu as beau pousser rien ne se passe.</p>',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'page_id' => 74,
                'keyword' => 'digicode',
                'description' => '<p>Un pavé numérique standard, il faut taper un code à <b>6 chiffres</b> pour débloquer je ne sais quoi.</p>',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'page_id' => 74,
                'keyword' => 'carnet de notes',
                'description' => '<p>La première page est noircie de formules mathématiques compliquées.</p><p>La seconde en revanche contient une liste de nombres premiers : 2, 3, 5, 7, 11 puis le reste jusqu\'à 97. Passionnant.</p>',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 7,
                'page_id' => 74,
                'keyword' => 'tableau très moche',
                'description' => '<p>Vraiment hideux. L\'auteur doit pourtant en être très fier vu qu\'il l\'a signé : &quot;Renbrante&quot;. Ok, même ça il aurait dû s\'abstenir.</p>',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 8,
                'page_id' => 74,
                'keyword' => 'entassement de livres',
                'description' => '<p>Un seul vrai livre relié, le reste sont des magazines Picsou, des Picsou Géant. Une bonne cinquantaine au bas mot.</p>',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 9,
                'page_id' => 168,
                'keyword' => 'ce genre de description',
            'description' => '<p>Tu peux écrire pas mal de choses là-dedans, et même mettre en <u>forme </u><i>certaines </i><b style="color: rgb(206, 0, 0);">choses</b>.</p><p>Pratique non ?</p><p style="text-align: right; "><span style="font-style: italic; color: rgb(206, 198, 206);">Le tutorialisateur fou</span></p>',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 11,
                'page_id' => 168,
                'keyword' => 'ce livre',
                'description' => '<p>Je suis sympa, voilà la solution de l\'énigme :&nbsp;</p><p><br></p><p style="text-align: center; "><b>azerty</b></p>',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}