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
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 87,
                'page_from' => 2,
                'page_to' => 3,
                'link_text' => 'Déboussolé',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 88,
                'page_from' => 3,
                'page_to' => 4,
                'link_text' => 'Chercher à en savoir plus sur cette planète',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 89,
                'page_from' => 3,
                'page_to' => 5,
                'link_text' => 'Redescendre en ville',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 90,
                'page_from' => 4,
                'page_to' => 6,
                'link_text' => 'En savoir plus sur la carte de priorité orange',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 91,
                'page_from' => 4,
                'page_to' => 7,
                'link_text' => 'Plus d\'info sur la carte priorité blanche',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 92,
                'page_from' => 7,
                'page_to' => 8,
                'link_text' => 'Prendre congé',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 93,
                'page_from' => 6,
                'page_to' => 8,
                'link_text' => 'Prendre congé',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 94,
                'page_from' => 8,
                'page_to' => 9,
                'link_text' => 'Redescendre',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 95,
                'page_from' => 9,
                'page_to' => 10,
                'link_text' => 'A propos du Centre',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 96,
                'page_from' => 10,
                'page_to' => 11,
                'link_text' => 'Souvenir de la conversation avec le responsable de la sécurité du Centre',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 97,
                'page_from' => 29,
                'page_to' => 30,
                'link_text' => 'Relever le défi',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 98,
                'page_from' => 29,
                'page_to' => 31,
                'link_text' => 'J\'ai trop peur',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 99,
                'page_from' => 12,
                'page_to' => 14,
                'link_text' => 'Entrer dans le manoir',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 100,
                'page_from' => 12,
                'page_to' => 15,
                'link_text' => 'Abandonner',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 101,
                'page_from' => 14,
                'page_to' => 16,
                'link_text' => 'Porte de gauche',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 102,
                'page_from' => 14,
                'page_to' => 17,
                'link_text' => 'Porte de droite',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 103,
                'page_from' => 14,
                'page_to' => 18,
                'link_text' => 'Monter les escaliers',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 104,
                'page_from' => 18,
                'page_to' => 19,
                'link_text' => 'Porte licorne',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 105,
                'page_from' => 18,
                'page_to' => 20,
                'link_text' => 'Porte dragon',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 106,
                'page_from' => 18,
                'page_to' => 21,
                'link_text' => 'Porte centaure',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 107,
                'page_from' => 18,
                'page_to' => 22,
                'link_text' => 'Porte satyre',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 108,
                'page_from' => 16,
                'page_to' => 14,
                'link_text' => 'Sortir de la pièce',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            23 => 
            array (
                'id' => 110,
                'page_from' => 22,
                'page_to' => 27,
                'link_text' => 'Boire du vin',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            24 => 
            array (
                'id' => 111,
                'page_from' => 22,
                'page_to' => 28,
                'link_text' => 'Fermer les rideaux',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            25 => 
            array (
                'id' => 112,
                'page_from' => 18,
                'page_to' => 14,
                'link_text' => 'Retourner dans le hall',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            26 => 
            array (
                'id' => 131,
                'page_from' => 72,
                'page_to' => 73,
                'link_text' => 'Je le sens pas, bye !',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            27 => 
            array (
                'id' => 132,
                'page_from' => 72,
                'page_to' => 74,
                'link_text' => 'Je suis gonflé à bloc !',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            28 => 
            array (
                'id' => 133,
                'page_from' => 74,
                'page_to' => 75,
                'link_text' => 'Utiliser l\'ordinateur',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            29 => 
            array (
                'id' => 134,
                'page_from' => 75,
                'page_to' => 77,
                'link_text' => 'Cliquer sur "Mot de passe oublié"',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            30 => 
            array (
                'id' => 135,
                'page_from' => 75,
                'page_to' => 74,
                'link_text' => 'Essayer autre chose',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            31 => 
            array (
                'id' => 136,
                'page_from' => 77,
                'page_to' => 75,
                'link_text' => 'Revenir à  l\'écran de connexion',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            32 => 
            array (
                'id' => 137,
                'page_from' => 76,
                'page_to' => 74,
                'link_text' => 'Eteindre l\'ordinateur',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            33 => 
            array (
                'id' => 138,
                'page_from' => 74,
                'page_to' => 81,
                'link_text' => 'Utiliser la clé bleue',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            34 => 
            array (
                'id' => 139,
                'page_from' => 81,
                'page_to' => 74,
                'link_text' => 'Retourner dans la première pièce',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            35 => 
            array (
                'id' => 140,
                'page_from' => 83,
                'page_to' => 93,
                'link_text' => 'L\'accueil',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            36 => 
            array (
                'id' => 142,
                'page_from' => 81,
                'page_to' => 102,
                'link_text' => 'Test',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            37 => 
            array (
                'id' => 143,
                'page_from' => 93,
                'page_to' => 103,
                'link_text' => 'Retour au hall d\'entrée',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            38 => 
            array (
                'id' => 144,
                'page_from' => 93,
                'page_to' => 104,
                'link_text' => 'Se diriger vers l\'acceuil',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            39 => 
            array (
                'id' => 145,
                'page_from' => 43,
                'page_to' => 46,
                'link_text' => 'Choix 1',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            40 => 
            array (
                'id' => 146,
                'page_from' => 43,
                'page_to' => 44,
                'link_text' => 'Choix 2',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            41 => 
            array (
                'id' => 147,
                'page_from' => 44,
                'page_to' => 55,
                'link_text' => 'Choix bizarre',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            42 => 
            array (
                'id' => 148,
                'page_from' => 44,
                'page_to' => 54,
                'link_text' => 'Choix "raisonnable"',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            43 => 
            array (
                'id' => 149,
                'page_from' => 6,
                'page_to' => 7,
                'link_text' => 'Et la priorité blanche ?',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            44 => 
            array (
                'id' => 150,
                'page_from' => 7,
                'page_to' => 6,
                'link_text' => 'Et la priorité orange ?',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            45 => 
            array (
                'id' => 151,
                'page_from' => 125,
                'page_to' => 126,
                'link_text' => 'J\'appelle un ami',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            46 => 
            array (
                'id' => 152,
                'page_from' => 125,
                'page_to' => 127,
                'link_text' => 'Je mange une banane',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            47 => 
            array (
                'id' => 153,
                'page_from' => 126,
                'page_to' => 128,
                'link_text' => 'Je lui lance une banane',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            48 => 
            array (
                'id' => 154,
                'page_from' => 126,
                'page_to' => 129,
                'link_text' => 'Je m\'enfuis en courant',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            49 => 
            array (
                'id' => 155,
                'page_from' => 131,
                'page_to' => 132,
                'link_text' => 'Je vais voir ce qu\'il se passe',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            50 => 
            array (
                'id' => 156,
                'page_from' => 132,
                'page_to' => 133,
                'link_text' => 'Rejoindre les villageois',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            51 => 
            array (
                'id' => 157,
                'page_from' => 133,
                'page_to' => 134,
                'link_text' => 'Continuer d\'écouter',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            52 => 
            array (
                'id' => 158,
                'page_from' => 134,
                'page_to' => 135,
                'link_text' => 'Se porter volontaire',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            53 => 
            array (
                'id' => 159,
                'page_from' => 135,
                'page_to' => 136,
                'link_text' => 'Quelques jours plus tard',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            54 => 
            array (
                'id' => 160,
                'page_from' => 136,
                'page_to' => 137,
                'link_text' => 'Les équipes',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            55 => 
            array (
                'id' => 161,
                'page_from' => 137,
                'page_to' => 138,
                'link_text' => 'Aller vers les montagnes',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            56 => 
            array (
                'id' => 162,
                'page_from' => 137,
                'page_to' => 139,
                'link_text' => 'Aller vers le nord',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            57 => 
            array (
                'id' => 163,
                'page_from' => 137,
                'page_to' => 140,
                'link_text' => 'Aller au sud-est',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            58 => 
            array (
                'id' => 164,
                'page_from' => 104,
                'page_to' => 143,
                'link_text' => 'Je désire devenir millionnaire',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            59 => 
            array (
                'id' => 165,
                'page_from' => 104,
                'page_to' => 144,
                'link_text' => 'Je désire une chambre simple',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            60 => 
            array (
                'id' => 166,
                'page_from' => 104,
                'page_to' => 145,
                'link_text' => 'Je désire partir d\'ici',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            61 => 
            array (
                'id' => 167,
                'page_from' => 143,
                'page_to' => 147,
                'link_text' => 'N\'importe quoi',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            62 => 
            array (
                'id' => 169,
                'page_from' => 143,
                'page_to' => 149,
                'link_text' => 'Rien, je rigolai',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            63 => 
            array (
                'id' => 170,
                'page_from' => 143,
                'page_to' => 150,
                'link_text' => 'Ma belle-mère',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            64 => 
            array (
                'id' => 172,
                'page_from' => 103,
                'page_to' => 104,
                'link_text' => 'Se diriger vers l\'acceuil',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            65 => 
            array (
                'id' => 173,
                'page_from' => 151,
                'page_to' => 152,
                'link_text' => 'énigme',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            66 => 
            array (
                'id' => 174,
                'page_from' => 154,
                'page_to' => 156,
                'link_text' => 'Choix 1',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            67 => 
            array (
                'id' => 176,
                'page_from' => 154,
                'page_to' => 157,
                'link_text' => 'Vers titre',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            68 => 
            array (
                'id' => 177,
                'page_from' => 158,
                'page_to' => 159,
                'link_text' => 'Sortir de la pièce',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            69 => 
            array (
                'id' => 178,
                'page_from' => 159,
                'page_to' => 160,
                'link_text' => 'Utiliser la longue-vue',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            70 => 
            array (
                'id' => 180,
                'page_from' => 161,
                'page_to' => 162,
                'link_text' => 'Après le jardin',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            71 => 
            array (
                'id' => 181,
                'page_from' => 166,
                'page_to' => 167,
                'link_text' => 'Dis-moi comment je m\'appelle',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            72 => 
            array (
                'id' => 182,
                'page_from' => 167,
                'page_to' => 168,
                'link_text' => 'Continuer la présentation',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            73 => 
            array (
                'id' => 183,
                'page_from' => 169,
                'page_to' => 170,
                'link_text' => 'Regarder bêtement la porte',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            74 => 
            array (
                'id' => 184,
                'page_from' => 170,
                'page_to' => 169,
                'link_text' => 'Retour aux objets',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            75 => 
            array (
                'id' => 185,
                'page_from' => 169,
                'page_to' => 171,
                'link_text' => 'Ouvrir la porte',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            76 => 
            array (
                'id' => 186,
                'page_from' => 166,
                'page_to' => 172,
                'link_text' => 'J\'ai pas envie de jouer',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            77 => 
            array (
                'id' => 187,
                'page_from' => 171,
                'page_to' => 173,
                'link_text' => 'Je ne prends aucun risque',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            78 => 
            array (
                'id' => 188,
                'page_from' => 173,
                'page_to' => 174,
                'link_text' => 'Terminer le didacticiel',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            79 => 
            array (
                'id' => 189,
                'page_from' => 171,
                'page_to' => 175,
                'link_text' => 'Appelle moi Superman',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            80 => 
            array (
                'id' => 190,
                'page_from' => 171,
                'page_to' => 176,
                'link_text' => 'C\'est parti pour le marathon !',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            81 => 
            array (
                'id' => 192,
                'page_from' => 176,
                'page_to' => 174,
                'link_text' => 'Terminer le didacticiel',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            82 => 
            array (
                'id' => 193,
                'page_from' => 175,
                'page_to' => 174,
                'link_text' => 'Terminer le didacticiel',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            83 => 
            array (
                'id' => 194,
                'page_from' => 178,
                'page_to' => 179,
                'link_text' => 'Faire le.tour des indics',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            84 => 
            array (
                'id' => 195,
                'page_from' => 179,
                'page_to' => 180,
                'link_text' => 'Aller voir Bob',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            85 => 
            array (
                'id' => 196,
                'page_from' => 179,
                'page_to' => 181,
                'link_text' => 'Aller parler à Sara',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
            86 => 
            array (
                'id' => 197,
                'page_from' => 181,
                'page_to' => 182,
                'link_text' => 'Bien sûr !',
                'hidden' => 0,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}