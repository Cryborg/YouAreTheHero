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
                'id' => 33,
                'page_from' => '8e32b39a-0886-37f3-93fd-f606a88950a9',
                'page_to' => '943a46a7-3a3c-36f6-b8ca-efaa09395320',
                'link_text' => 'Aller emmagasiner des réserves de nourriture, car le chemin risque d\'être long',
            ),
            1 => 
            array (
                'id' => 34,
                'page_from' => '8e32b39a-0886-37f3-93fd-f606a88950a9',
                'page_to' => 'fe835b07-0a51-33bd-99cc-af62093052af',
                'link_text' => 'Affuter ses mandibules contre un quelconque gravier',
            ),
            2 => 
            array (
                'id' => 35,
                'page_from' => '8e32b39a-0886-37f3-93fd-f606a88950a9',
                'page_to' => 'cf066c88-314f-3df0-be2a-4eacad2dfe32',
                'link_text' => 'Se ravitailler en acide',
            ),
            3 => 
            array (
                'id' => 36,
                'page_from' => '8e32b39a-0886-37f3-93fd-f606a88950a9',
                'page_to' => 'fbab9c67-beab-3f27-91fe-959efe6583f3',
                'link_text' => 'Aller chercher des renforts pour cette expédition qui s\'annonce ardue',
            ),
            4 => 
            array (
                'id' => 37,
                'page_from' => '8e32b39a-0886-37f3-93fd-f606a88950a9',
                'page_to' => '3442f8a3-3a40-3251-b4c8-445ff8c24595',
                'link_text' => '-Descendre au fin fond de la fourmilière pour demander aide et conseil à la reine mère',
            ),
            5 => 
            array (
                'id' => 38,
                'page_from' => '8e32b39a-0886-37f3-93fd-f606a88950a9',
                'page_to' => '646b1a31-3ada-306d-a779-14e5e1da5e8c',
                'link_text' => 'Aller jeter un coup d\'antenne dans le quartier des nourrices, pour emmener avec elle quelque nymphe ou œuf',
            ),
            6 => 
            array (
                'id' => 39,
                'page_from' => '943a46a7-3a3c-36f6-b8ca-efaa09395320',
                'page_to' => '6448d2e1-6a4b-388e-b597-c3485643e135',
                'link_text' => 'Il est temps de faire un autre choix d\'action',
            ),
            7 => 
            array (
                'id' => 40,
                'page_from' => '6448d2e1-6a4b-388e-b597-c3485643e135',
                'page_to' => 'fe835b07-0a51-33bd-99cc-af62093052af',
                'link_text' => 'Affuter ses mandibules contre un quelconque gravier',
            ),
            8 => 
            array (
                'id' => 41,
                'page_from' => '6448d2e1-6a4b-388e-b597-c3485643e135',
                'page_to' => 'cf066c88-314f-3df0-be2a-4eacad2dfe32',
                'link_text' => 'Se ravitailler en acide',
            ),
            9 => 
            array (
                'id' => 42,
                'page_from' => '6448d2e1-6a4b-388e-b597-c3485643e135',
                'page_to' => 'fbab9c67-beab-3f27-91fe-959efe6583f3',
                'link_text' => 'Aller chercher des renforts pour cette expédition qui s\'annonce ardue',
            ),
            10 => 
            array (
                'id' => 43,
                'page_from' => '6448d2e1-6a4b-388e-b597-c3485643e135',
                'page_to' => '3442f8a3-3a40-3251-b4c8-445ff8c24595',
                'link_text' => 'Descendre au fin fond de la fourmilière pour demander aide et conseil à la reine mère',
            ),
            11 => 
            array (
                'id' => 44,
                'page_from' => '6448d2e1-6a4b-388e-b597-c3485643e135',
                'page_to' => '646b1a31-3ada-306d-a779-14e5e1da5e8c',
                'link_text' => 'Aller jeter un coup d\'antenne dans le quartier des nourrices, pour emmener quelque nymphe ou œuf',
            ),
            12 => 
            array (
                'id' => 45,
                'page_from' => '6448d2e1-6a4b-388e-b597-c3485643e135',
                'page_to' => '943a46a7-3a3c-36f6-b8ca-efaa09395320',
                'link_text' => 'Aller emmagasiner des réserves de nourriture, car le chemin risque d\'être long',
            ),
            13 => 
            array (
                'id' => 46,
                'page_from' => '6448d2e1-6a4b-388e-b597-c3485643e135',
                'page_to' => '497467f5-1596-3bc1-ab31-61efa3c684f6',
                'link_text' => 'Si la réserve de temps est épuisée',
            ),
            14 => 
            array (
                'id' => 47,
                'page_from' => '497467f5-1596-3bc1-ab31-61efa3c684f6',
                'page_to' => 'e91c3382-b4fd-33a1-bf97-98cd1c88c57a',
                'link_text' => 'Rendez-vous au 100',
            ),
            15 => 
            array (
                'id' => 48,
                'page_from' => 'e91c3382-b4fd-33a1-bf97-98cd1c88c57a',
                'page_to' => 'dc6f77ab-c3f3-36ad-ace6-862e1025c052',
                'link_text' => 'Si vous pensez qu\'il faut dès à présent se rendre dans ce refuge suffisamment vaste pour toutes, quitte à retarder un peu l\'expédition',
            ),
            16 => 
            array (
                'id' => 49,
                'page_from' => 'e91c3382-b4fd-33a1-bf97-98cd1c88c57a',
                'page_to' => 'd62fbb3b-5fe6-3d99-a698-57c6cae4e72f',
                'link_text' => 'Si vous préférez que votre fourmi ne prévienne pas ses congénères et que le groupe continue encore un moment son avancée',
            ),
            17 => 
            array (
                'id' => 50,
                'page_from' => 'd62fbb3b-5fe6-3d99-a698-57c6cae4e72f',
                'page_to' => 'd2b94bb0-cb20-32d2-b35d-545b69980e77',
                'link_text' => 'Si vous désirez que votre insecte donne le déclic qui manque pour la poursuite de la marche, rendez-vous au 63.',
            ),
            18 => 
            array (
                'id' => 51,
                'page_from' => 'd62fbb3b-5fe6-3d99-a698-57c6cae4e72f',
                'page_to' => 'a8e00d08-e879-3bbd-8bde-b52b50c7900f',
                'link_text' => 'Si vous pensez que ce lieu conviendra, dirigez-vous au 92.',
            ),
            19 => 
            array (
                'id' => 52,
                'page_from' => 'a8e00d08-e879-3bbd-8bde-b52b50c7900f',
                'page_to' => '23453cb7-feb9-3247-b859-1aaf7e36e0b9',
                'link_text' => 'Rendez-vous au 25 si vous pensez comme l\'ensemble du groupe qu\'il vaut mieux continuer sur la piste parfumée, qui n\'a jusque là guère porté chance.',
            ),
            20 => 
            array (
                'id' => 53,
                'page_from' => 'a8e00d08-e879-3bbd-8bde-b52b50c7900f',
                'page_to' => '0b47389c-5aff-3d62-a749-8b16543f9d02',
                'link_text' => 'Si vous pensez qu\'il vaut mieux hâter cette expédition meurtrière et couper en direction du nord, vous pouvez vous rendre au 86 à condition que votre fourmi sache produire des phéromones de séduction.',
            ),
            21 => 
            array (
                'id' => 54,
                'page_from' => 'fe835b07-0a51-33bd-99cc-af62093052af',
                'page_to' => '6448d2e1-6a4b-388e-b597-c3485643e135',
                'link_text' => 'Il est temps de faire un autre choix d\'action : rendez-vous au 12.',
            ),
            22 => 
            array (
                'id' => 55,
                'page_from' => 'cf066c88-314f-3df0-be2a-4eacad2dfe32',
                'page_to' => '6448d2e1-6a4b-388e-b597-c3485643e135',
                'link_text' => 'Il est temps de faire un autre choix d\'action : rendez-vous au 12.',
            ),
            23 => 
            array (
                'id' => 56,
                'page_from' => '3442f8a3-3a40-3251-b4c8-445ff8c24595',
                'page_to' => '6448d2e1-6a4b-388e-b597-c3485643e135',
                'link_text' => 'S\'il ne reste pas assez de temps, ou si l\'acquisition de phéromones ne vous intéresse pas, rendez-vous au 12.',
            ),
            24 => 
            array (
                'id' => 57,
                'page_from' => '3442f8a3-3a40-3251-b4c8-445ff8c24595',
                'page_to' => '25ecb762-0083-37dc-a19c-cb4c20cda06c',
            'link_text' => 'Si vous préférez une phéromone de séduction, afin de pouvoir persuader ses compagnons de la conduite à tenir, ou d\'attirer irrésistiblement les mâles reproducteurs qu\'elle pourra croiser durant son équipée (éventualité peu probable), allez au 38.',
            ),
            25 => 
            array (
                'id' => 58,
                'page_from' => '3442f8a3-3a40-3251-b4c8-445ff8c24595',
                'page_to' => 'a3972bc8-8441-3fd2-bf8d-d3d7f7df4122',
                'link_text' => 'Si vous désirez que votre fourmi acquière une phéromone de guerre, qui stimulera toutes les combattantes alliées dans un périmètre proche de votre fourmi, rendez-vous au 23.',
            ),
            26 => 
            array (
                'id' => 59,
                'page_from' => '646b1a31-3ada-306d-a779-14e5e1da5e8c',
                'page_to' => '6448d2e1-6a4b-388e-b597-c3485643e135',
                'link_text' => 'Il est temps de faire un autre choix d\'action : rendez-vous au 12.',
            ),
            27 => 
            array (
                'id' => 60,
                'page_from' => 'dc6f77ab-c3f3-36ad-ace6-862e1025c052',
                'page_to' => '11f72382-189b-3f06-9fd2-5f1adcd5b026',
                'link_text' => 'Si votre fourmi est capable de sécréter des phéromones de séduction et que vous pensez sage de continuer à suivre la piste parfumée, rendez-vous au 60.',
            ),
            28 => 
            array (
                'id' => 61,
                'page_from' => 'dc6f77ab-c3f3-36ad-ace6-862e1025c052',
                'page_to' => 'ba8b5412-c56b-36a9-bb3d-c0e851ee2fe3',
                'link_text' => 'Sinon, avec son consensus habituel, le groupe décide de tenter un raccourci. Allez au 86.',
            ),
            29 => 
            array (
                'id' => 62,
                'page_from' => 'ba8b5412-c56b-36a9-bb3d-c0e851ee2fe3',
                'page_to' => 'd38a2175-baaf-3c40-b16d-0d7685fb3943',
            'link_text' => 'Si votre fourmi est une artilleuse, ou si elle est accompagnée d\'une artilleuse, rendez-vous au 26 (sachez que la fourmi qui tirera sur le volatile dépensera 4 gouttes d\'acide).',
            ),
            30 => 
            array (
                'id' => 63,
                'page_from' => 'ba8b5412-c56b-36a9-bb3d-c0e851ee2fe3',
                'page_to' => '0602edde-89e0-37e3-8b20-9ecc0102b9da',
                'link_text' => 'Si c\'est une sexuée et qu\'elle veut profiter de ses ailes pour fuir plus aisément le volatile, allez au 8.',
            ),
            31 => 
            array (
                'id' => 64,
                'page_from' => 'ba8b5412-c56b-36a9-bb3d-c0e851ee2fe3',
                'page_to' => 'e4807008-33b4-33a4-a19e-790cabf8be61',
                'link_text' => 'Sinon, elle peut profiter du vol bas de l\'animal pour sauter sur ses serres puis fourrager dans ses plumes, dans l\'espoir de lui infliger quelque blessure susceptible de lui faire abandonner la poursuite, rendez-vous au 34.',
            ),
            32 => 
            array (
                'id' => 65,
                'page_from' => 'd38a2175-baaf-3c40-b16d-0d7685fb3943',
                'page_to' => 'efb2f3a3-9c3e-3c2e-be54-b72dd10c2f81',
                'link_text' => 'Rendez-vous au 71.',
            ),
            33 => 
            array (
                'id' => 66,
                'page_from' => '0602edde-89e0-37e3-8b20-9ecc0102b9da',
                'page_to' => 'efb2f3a3-9c3e-3c2e-be54-b72dd10c2f81',
                'link_text' => 'Rendez-vous au 71.',
            ),
            34 => 
            array (
                'id' => 67,
                'page_from' => 'e4807008-33b4-33a4-a19e-790cabf8be61',
                'page_to' => 'efb2f3a3-9c3e-3c2e-be54-b72dd10c2f81',
                'link_text' => 'Rendez-vous au 71.',
            ),
            35 => 
            array (
                'id' => 68,
                'page_from' => 'efb2f3a3-9c3e-3c2e-be54-b72dd10c2f81',
                'page_to' => 'e4a14291-b11e-3381-b271-48367f154db6',
            'link_text' => 'Si le groupe se met à creuser un tunnel pour passer en-dessous du ruisseau (cela aura un coût de 4 états de Faim), rendez-vous au 64.',
            ),
            36 => 
            array (
                'id' => 69,
                'page_from' => 'efb2f3a3-9c3e-3c2e-be54-b72dd10c2f81',
                'page_to' => 'a6a67782-1453-3ef1-bf30-dd36693e0562',
            'link_text' => 'Si votre fourmi est un sexué ou qu\'un de ses congénères possède des ailes, rendez-vous au 52 si vous désirez utiliser cette capacité (l\'effort demandé coûtera 1 état de Faim, que ce soit votre fourmi qui vole ou un allié, car il faudra lui faire une trophallaxie pour qu\'il ait suffisamment d\'énergie).',
            ),
            37 => 
            array (
                'id' => 70,
                'page_from' => 'efb2f3a3-9c3e-3c2e-be54-b72dd10c2f81',
                'page_to' => '7efa51ac-4650-3968-927f-910f95fc6b64',
            'link_text' => 'Si vous préférez que le groupe utilise des feuilles comme radeaux pour passer le cours d\'eau, allez au 99 (si votre fourmi possède une plume, elle pourra l\'utiliser comme embarcation à la place d\'une feuille).',
            ),
            38 => 
            array (
                'id' => 71,
                'page_from' => 'e4a14291-b11e-3381-b271-48367f154db6',
                'page_to' => '66eb9e9c-4401-3191-9967-eaf9d4a8e47d',
                'link_text' => 'Rendez-vous au 40.',
            ),
            39 => 
            array (
                'id' => 72,
                'page_from' => '66eb9e9c-4401-3191-9967-eaf9d4a8e47d',
                'page_to' => '1e3302dd-a97a-3e80-a254-92ea7675859e',
                'link_text' => 'Votre fourmi peut attendre que ses alliées cartographient les lieux et balisent de phéromones des chemins sûrs vers quelque endroit intéressant ; rendez-vous alors au 44.',
            ),
            40 => 
            array (
                'id' => 73,
                'page_from' => '66eb9e9c-4401-3191-9967-eaf9d4a8e47d',
                'page_to' => '9b55d164-5507-3c9e-a50e-1176f0edf292',
                'link_text' => 'Elle peut aussi monter en haut d\'une grande construction avoisinante, dans l\'espoir d\'avoir une vue aérienne sur ce vaste lieu. Allez au 47.',
            ),
            41 => 
            array (
                'id' => 74,
                'page_from' => '1e3302dd-a97a-3e80-a254-92ea7675859e',
                'page_to' => 'fb772269-a27c-3f16-bebc-d6b04ed690da',
                'link_text' => 'Rendez-vous au 80 pour en savoir plus sur chacun d’eux.',
            ),
            42 => 
            array (
                'id' => 75,
                'page_from' => 'fb772269-a27c-3f16-bebc-d6b04ed690da',
                'page_to' => '0528b4c3-3586-3fb6-90d1-f47338b04d8c',
            'link_text' => 'Une petite forêt dont les végétaux ne sont pas les mêmes que ceux qu\'on trouve dans les territoires habituellement arpentés par les fourmis. Exotiques, ils composent une jungle naissante qui s\'étend à certaines constructions branlantes. La fourmi qui a découvert ce lieu n\'a pas osé s\'aventurer dans les hautes herbes et ne sait quel genre de créature peut s\'y trouver. (Si vous désirez que votre fourmi s\'y rende, il faudra aller au 76).',
            ),
            43 => 
            array (
                'id' => 76,
                'page_from' => 'fb772269-a27c-3f16-bebc-d6b04ed690da',
                'page_to' => 'eb3c68b8-1daf-3034-a68c-6d4f3b79e687',
            'link_text' => 'Un édifice très étendu, à deux étages. Dans cette grande surface se trouvent de courts cylindres métalliques intacts. Ceux qui ont déjà été ouverts ou percés laissent échapper des relents d\'une nourriture pourrie, mais les autres contiennent peut-être encore des aliments consommables. (Si vous désirez que votre insecte y aille, il faudra que vous vous rendiez au 65).',
            ),
            44 => 
            array (
                'id' => 77,
                'page_from' => 'fb772269-a27c-3f16-bebc-d6b04ed690da',
                'page_to' => '1fe7b9fc-94dc-3319-84b5-c2860e7d5e4b',
            'link_text' => 'Dans une des nombreuses constructions endommagées, une fourmi a trouvé un passage menant sous terre. Bloqué par un panneau de bois vermoulu, l\'exploratrice n\'a pas continué plus avant mais son odorat a détecté dans ce sous-sol la présence de champignons, qui pourraient bien être comestibles. (Si vous voulez que votre protégée s\'y rende, il faudra aller au 94).',
            ),
            45 => 
            array (
                'id' => 78,
                'page_from' => 'fb772269-a27c-3f16-bebc-d6b04ed690da',
                'page_to' => '64a8170e-4529-3a18-9d40-1fedaad83767',
            'link_text' => 'Dans un édifice assez vaste, une fourmi a trouvé d\'importantes quantités de bois étrangement transformé, mais elle a aussi et surtout détecté la présence de minuscules insectes, en assez grand nombre. Si on trouvait leur source de nourriture… (Si vous désirez que votre fourmi s\'y rende, il faudra aller au 29).',
            ),
            46 => 
            array (
                'id' => 79,
                'page_from' => 'fb772269-a27c-3f16-bebc-d6b04ed690da',
                'page_to' => '8f35f3c5-8bf4-327d-99ee-e6ab05ecdb06',
            'link_text' => 'Une exploratrice est tombée sur un large passage menant sous terre. Il semblerait qu\'il mène à un immense réseau de galeries, au sol pierreux et où reposent de longues barres de métal. Cette espèce de fourmilière géante semble cependant contenir quelques occupants : les faibles mais nombreuses ondes sonores qu\'a perçues l\'ouvrière qui a découvert cet endroit, ainsi que l\'odeur typique des mammifères qui s\'en dégage, laissent à penser que l\'endroit est habité. (Si vous voulez que votre insecte s\'y rende, il faudra aller au 114).',
            ),
            47 => 
            array (
                'id' => 80,
                'page_from' => 'fb772269-a27c-3f16-bebc-d6b04ed690da',
                'page_to' => '81527581-7106-342e-af47-a1151abf81f3',
            'link_text' => 'Un lieu des plus mystérieux a attiré les ocelles d\'une petite fourmi : dans un bâtiment à un seul étage mais étendu, se trouve un espèce d\'immense réservoir dont le fond est tapissé de chlore. Le réservoir est percé de conduits non explorés. (Si vous désirez que votre fourmi s\'y déplace, il faudra aller au 21).',
            ),
        ));
        
        
    }
}