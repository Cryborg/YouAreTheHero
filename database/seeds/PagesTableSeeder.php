<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pages')->delete();
        
        \DB::table('pages')->insert(array (
            0 => 
            array (
                'id' => '0528b4c3-3586-3fb6-90d1-f47338b04d8c',
                'story_id' => 5,
                'number' => 33,
                'is_first' => 0,
                'is_last' => 0,
                'title' => '76',
                'content' => 'C\'est un groupe contenant l\'une des deux guerrières de l\'expédition qui se dirige vers les hautes herbes.
La présence de la soldate ne sera pas de trop face aux dangers que peut représenter cette jungle. Celle-ci
semble d\'ailleurs gagner du terrain sur le minéral qui recouvrait jusqu\'ici intégralement le sol.
En formation losange, le groupe s\'aventure dans les hautes herbes, qui empêchent de voir à plus de
quelques pattes de distance. Parfois, le champ de tiges se fend sur un fourré imposant. Nul animal n\'en
sort pour se jeter sur les fourmis, et leur odorat ne détecte pour l\'instant aucune présence de créature
autre que celle de minuscules insectes trop peu nutritifs pour qu\'on en fasse la chasse.
Par ailleurs, la multitude d\'odeurs que perçoivent les fourmis les déroute : certaines senteurs leur sont
totalement inconnues. On croise ainsi un certain nombre de végétaux que la mémoire collective ne
reconnaît pas.
Une fourmi découvre une tige métallique, supportant une plaque faite de la même matière. La planche
est tâchée par une substance synthétique à moitié érodée.
[img: panneau avec écrit dessus «Parc de la T… d\'Or» et cage derrière]
On tombe ensuite sur des rangées de tiges métalliques, entre lesquelles les fourmis passent aisément.
Elles découvrent alors, à moitié enterrés ou reposant sur de larges rochers, des squelettes de
mammifères, qui devaient être assez imposants. Les os sont parfaitement nettoyés : leur mort doit être
ancienne. Le groupe ne s\'attarde pas davantage, traverse à nouveau une ligne de barres en métal, et
continue de se frayer un chemin dans les hautes herbes. La vue depuis le sol ne leur étant d\'aucune
utilité dans cet environnement, les fourmis s\'en remettent à leur flair : elles sentent une humidité
provenant de la direction du soleil couchant, tandis qu\'ailleurs, l\'environnement présente la même
atmosphère sèche que précédemment.
Si votre fourmi est une sexuée ou qu\'elle est accompagnée par un mâle, elle (ou ce dernier) peut prendre
son envol pour avoir une vision aérienne des environs : allez alors au 56.
Sinon, lancez un dé. Si le résultat est compris entre 1 et 4, le groupe s\'orientera naturellement en
direction de l\'atmosphère humide : rendez-vous au 72. Sinon, les fourmis ne prêteront pas attention à
l\'eau contenue dans l\'air et continueront leur route dans des territoires plus secs. Allez alors au 107. Si 
votre protégée dispose de phéromones de séduction, elle peut néanmoins convaincre le groupe de se
rendre où elle le désire (ignorez alors le lancer de dé et choisissez la direction à prendre).',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 22:37:05',
                'updated_at' => '2019-12-19 22:37:33',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => '0602edde-89e0-37e3-8b20-9ecc0102b9da',
                'story_id' => 5,
                'number' => 23,
                'is_first' => 0,
                'is_last' => 0,
                'title' => '8',
                'content' => 'Battant des ailes de plus en plus rapidement tout en poursuivant sa course, la fourmi prend finalement
son envol. Ses ailes minces et rigides lui évitent d\'avoir besoin d\'élan pour atteindre promptement sa
vitesse maximale, et lui permettent d\'effectuer des virages rapides… mais sur une longue distance, les
oiseaux sont plus rapides que les sexués. Or, le volatile prend en chasse votre fourmi, attiré par les légers
bruissements de ses ailes et ses mouvements vifs, espérant que son goût sera meilleur que celui de ses
congénères. Malgré ses quelques esquisses d\'esquive, la fourmi ne parvient pas à dévier suffisamment
de la trajectoire de l\'oiseau. Si son vol saccadé lui permet d\'éviter un coup de bec pouvant s\'avérer fatal,
elle s\'écrase néanmoins contre le poitrail de l\'animal, puis par réflexe, plante ses griffes au milieu des
plumes, cherchant quelque prise dans la chair même de l\'animal. Elle ne parvient pas à planter ses pattes 
dans le corps du volatile, car elles patinent sans discontinuer sur la surface duveteuse. La fourmi tombe
alors de la poitrine de l\'animal juste avant que celui-ci n\'abatte son bec sur son emplacement. Ayant
lâché prise, la fourmi, juste en dessous du volatile, bat à nouveau des ailes tandis que l\'oiseau rectifie sa
trajectoire pour en finir avec une attaque en piquée. Votre fourmi fond elle-même vers le sol, ayant
compris qu\'elle ne faisait guère le poids dans un combat aérien et préférant finalement rejoindre ses
congénères. Le bec du volatile manque de peu de transpercer sa carapace et l\'oiseau s\'écrase au sol, la
fourmi coincée sous une de ses ailes.
Il va falloir que votre insecte tienne 3 tours avant que ses congénères ne viennent à son secours et
poussent le volatile à reprendre de l\'altitude.
Dé :
1 : le volatile transperce votre fourmi de son bec. Elle meurt sur le coup. L\'oiseau se rendra bientôt
compte que le goût des sexués est aussi acide que celui des autres.
2 : l\'adversaire empoigne la fourmi dans ses serres et les referme violemment sur elle (elle perd 3 états
de Vitalité et Carapace).
3 : un violent coup de serre fait perdre 2 états de Vitalité et Carapaçonnage à votre fourmi.
4 : du fait d\'un coup latéral du bec, votre fourmi perd un état de Vitalité et Carapaçonnage.
5 : Votre fourmi esquive avec adresse les attaques du volatile.
6 : un violent coup de mandibule infligé à l\'une des pattes de l\'animal le fait reculer. Voyant que des
renforts arrivent, il préfère abandonner immédiatement le combat.
Si votre insecte survit, votre fourmi peut récupérer une plume qu\'a perdu le volatile dans ce combat
épique. Inscrivez plume sur le Feuille d\'aventure. Le groupe atteint ensuite le couvert des arbres avant
une nouvelle attaque, puis finit par rejoindre le chemin, qui se termine bientôt.',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 22:22:06',
                'updated_at' => '2019-12-19 22:25:32',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => '0b47389c-5aff-3d62-a749-8b16543f9d02',
                'story_id' => 5,
                'number' => 16,
                'is_first' => 0,
                'is_last' => 0,
                'title' => '86',
                'content' => 'La progression du groupe est pendant un temps masquée par les plantes qui jalonnent son parcours et
qui le forcent à desserrer sa position. Mais peu à peu, les végétaux deviennent moins nombreux, et
même les troncs se font plus rares. Les fourmis parviennent finalement sur un terrain d\'herbes abîmées
dépourvu de tout arbre. Et donc de toute ramification arborescente pouvant les cacher aux yeux
d\'éventuels prédateurs aériens…
Tandis que le groupe accélère instinctivement le pas, une ombre passe sur certaines fourmis. Puis une
des compagnes de votre insecte est fauchée par deux serres et emmenée dans les hauteurs, pour sans
doute être picorée avidement. Le goût acidulé des fourmis ne semble cependant pas au goût du volatile
puisqu\'il fait bientôt tomber le cadavre de la pauvre ouvrière au milieu du groupe affolé. Une paire de
serres vient ensuite renverser quelques membres du groupe, puis la créature à plume, volant toujours
plus au ras du sol, donne quelques coups de becs. Certaines fourmis parviennent à les éviter, d\'autres
sont transpercées. On essaie de contre-attaquer, mais les mandibules claquent systématiquement dans
le vide. Le temps que le groupe atteigne le bout de la clairière, il ne restera guère de survivantes…
Si votre fourmi est une artilleuse, ou si elle est accompagnée d\'une artilleuse, rendez-vous au 26 (sachez
que la fourmi qui tirera sur le volatile dépensera 4 gouttes d\'acide).
Si c\'est une sexuée et qu\'elle veut profiter de ses ailes pour fuir plus aisément le volatile, allez au 8.
Sinon, elle peut profiter du vol bas de l\'animal pour sauter sur ses serres puis fourrager dans ses plumes,
dans l\'espoir de lui infliger quelque blessure susceptible de lui faire abandonner la poursuite,
rendez-vous au 34.',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 16:12:04',
                'updated_at' => '2019-12-19 16:12:33',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => '11f72382-189b-3f06-9fd2-5f1adcd5b026',
                'story_id' => 5,
                'number' => 20,
                'is_first' => 0,
                'is_last' => 0,
                'title' => '60',
                'content' => 'Sunt dolores repellat error possimus qui sit. Quasi eos ad blanditiis occaecati. Explicabo a accusamus vero nulla unde quidem temporibus aperiam.',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 22:12:22',
                'updated_at' => '2019-12-19 22:12:41',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => '1e3302dd-a97a-3e80-a254-92ea7675859e',
                'story_id' => 5,
                'number' => 30,
                'is_first' => 0,
                'is_last' => 0,
                'title' => '44',
                'content' => 'Après le premier temps dédié au repérage des environs, le groupe se reforme au point de rendez-vous.
Les antennes s\'agitent, émettent de multiples phéromones, donnant la direction et la distance des
emplacements ayant des chances de contenir de la nourriture. On se repose un court moment, et on en
profite pour lécher ses blessures (votre fourmi regagne un état de Vitalité et Carapace). Puis diverses
équipes s\'organisent, pour explorer chacun de ces lieux. Les exploratrices en ont trouvé six.',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 22:32:38',
                'updated_at' => '2019-12-19 22:34:14',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => '1fe7b9fc-94dc-3319-84b5-c2860e7d5e4b',
                'story_id' => 5,
                'number' => 35,
                'is_first' => 0,
                'is_last' => 0,
                'title' => '94',
                'content' => 'Le groupe d\'exploration auquel s\'est jointe votre fourmi est constitué, mis à part elle, uniquement
d\'ouvrières (sauf éventuels compagnons spéciaux). Après une courte marche, il parvient aux gravats
censés contenir dans leur sous-sol quelque appétissante moisissure. On parvient finalement au panneau
de bois qui garde l\'entrée du souterrain. Bien qu\'en mauvais état, il ne permet à aucune des fourmis de
passer par les interstices qui se trouvent entre lui et l\'encadrement pierreux.
Vous pouvez décider que votre fourmi se fraie un passage dans le bois (si c\'est une guerrière, son
physique la prédispose à cette tâche et cela devient une obligation à moins d\'être accompagné par une
Grosse fourmi) : rendez-vous au 113.
Sinon, votre insecte peut patienter le temps que quelques ouvrières (ou la Grosse fourmi, si elle
l\'accompagne) ouvrent le passage : allez au 9.',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 22:38:19',
                'updated_at' => '2019-12-19 22:38:42',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => '23453cb7-feb9-3247-b859-1aaf7e36e0b9',
                'story_id' => 5,
                'number' => 15,
                'is_first' => 0,
                'is_last' => 0,
                'title' => '25',
                'content' => 'Alors que la petite troupe d\'incursion continue de suivre la piste tracée voilà presque une demi-saison
par des exploratrices chevronnées, une légère odeur de fauve vient titiller les antennes des fourmis.
L\'épais fumet caractéristique d\'un animal à sang chaud se rapproche. Le groupe stoppe sa progression et
les ouvrières se mettent à explorer les environs, tandis que les soldates restent groupées et tournent en
rond dans un périmètre restreint. Votre fourmi agite ses antennes et l\'odeur grandissante lui indique que
le mammifère se dirige bien dans leur direction. Une opportunité d\'emmagasiner des protéines, ou un
danger trop important pour le groupe ? Des vibrations dans le sol commencent déjà à se faire sentir…
Si votre fourmi est accompagnée d\'une artilleuse, ou si elle est elle-même capable de lancer des jets
d\'acide et que vous souhaitez utiliser cette capacité (dans ce cas, sachez qu\'elle dépensera 4 gouttes
d\'acide), allez au 43.
Sinon, allez au 74.',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 16:11:17',
                'updated_at' => '2019-12-19 16:11:40',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => '25ecb762-0083-37dc-a19c-cb4c20cda06c',
                'story_id' => 5,
                'number' => 18,
                'is_first' => 0,
                'is_last' => 0,
                'title' => '38',
                'content' => 'Sapiente magnam nostrum et vel magni amet aut. Culpa natus est eum officiis sit aut. Culpa laudantium ea minus aut eveniet animi maiores. Tenetur nihil nisi veniam molestiae quidem.',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 22:07:21',
                'updated_at' => '2019-12-19 22:08:16',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => '3442f8a3-3a40-3251-b4c8-445ff8c24595',
                'story_id' => 5,
                'number' => 6,
                'is_first' => 0,
                'is_last' => 0,
                'title' => '101',
                'content' => 'La fourmi descend au plus profond de la fourmilière. La température y est plus chaude, et les artères du
nid bouillonnent, déversant les ouvrières chargées du transport des innombrables œufs pondus par la
reine mère. L\'insecte se fraie un chemin au travers de ce flux de sang noir, pour finalement presser les
soldates gardant la chambre de la reine de lui permettre le passage. Les guerrières l\'identifient bien
comme un membre du nid et n\'ont donc rien à redire à son entrée en ce lieu, supposant qu\'elle a une
tâche quelconque à y accomplir. En effet, nulle fourmi ne se rend dans la chambre de la reine pour des
raisons oisives telles que le besoin hypothétique d\'une présence maternelle.
Franchissant des rangs de nourrices occupées à transporter les œufs, s\'immisçant au milieu du groupe
d\'ouvrières qui s\'occupe en permanence de la reine, la léchant et l\'abreuvant de nourriture, votre insecte
finit par obtenir un contact antennaire. S\'ensuit un échange de phéromones subtils. La reine conseille à
votre fourmi de faire des provisions pour une telle expédition, afin d\'avoir suffisamment de réserves
d\'énergie pour ce long voyage et mieux résister au froid nocturne. Elle ignore ce que son enfant trouvera
en quittant les territoires du nid, mais propose de partager avec lui quelques phéromones de sa
composition.
Si vous désirez que votre fourmi acquière une phéromone de guerre, qui stimulera toutes les
combattantes alliées dans un périmètre proche de votre fourmi, rendez-vous au 23.
Si vous préférez une phéromone de séduction, afin de pouvoir persuader ses compagnons de la conduite à
tenir, ou d\'attirer irrésistiblement les mâles reproducteurs qu\'elle pourra croiser durant son équipée
(éventualité peu probable), allez au 38.
Notez que pour obtenir une de ces phéromones, il vous faudra dépenser une unité de temps
supplémentaire. N\'oubliez pas que vous avez déjà dû retrancher 1 unité de temps pour parvenir jusqu’à la
reine.
S\'il ne reste pas assez de temps, ou si l\'acquisition de phéromones ne vous intéresse pas, rendez-vous au
12.',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 15:46:50',
                'updated_at' => '2019-12-19 15:53:00',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => '37d9a87e-bef5-3d1c-8778-690f03df33ea',
                'story_id' => 5,
                'number' => 17,
                'is_first' => 0,
                'is_last' => 0,
                'title' => '2',
                'content' => 'Ex quibusdam aut facilis facilis. Ullam est possimus consectetur repudiandae ab. Et eum debitis nostrum et repellendus quidem magni. Ipsum facilis velit eos ducimus.',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 17:46:01',
                'updated_at' => '2019-12-19 17:46:27',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => '497467f5-1596-3bc1-ab31-61efa3c684f6',
                'story_id' => 5,
                'number' => 9,
                'is_first' => 0,
                'is_last' => 0,
                'title' => '88',
                'content' => 'Le sentiment d\'urgence qui a été transmis à la fourmi lors de sa rencontre avec la soldate devient
insupportable, et elle décide de rejoindre l\'air libre. Elle remonte les innombrables étages de la
fourmilière et finalement émerge près du pied du dôme, dont l\'immensité tend vers les cimes des arbres.
Votre insecte quitte rapidement la sortie très fréquentée (les phéromones échangées sont tellement
nombreuses qu\'elles saturent ses antennes), puis retrouve le parfum de la soldate qui l\'a recrutée sur
une piste peu usitée, en direction du nord. Le groupe est parti sans l\'attendre. Ses pattes accélèrent le
mouvement sur le sol pour l\'instant tapissé de brindilles et dépourvu de végétaux, et la conduisent à ce
qui semble être une entrée secondaire de la fourmilière. Il peut paraître absurde de suivre une telle piste
qui semble destinée à revenir sur ses pas, mais les traces olfactives ne trompent pas, le passage de la
soldate par ici est récent. La fourmi ne se pose de toutes manières pas de questions et s\'enfonce à
nouveau dans la terre. Là, elle emprunte un couloir servant en fait de chemin souterrain jusqu\'à une
colonie du nord. Au bout de cette longue piste creusée, elle sort au niveau d’une ouverture proche du
dôme d\'une petite fourmilière. Et elle retrouve enfin le groupe, paré pour l\'expédition hors des
territoires du Nid…',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 15:56:45',
                'updated_at' => '2019-12-19 15:57:07',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => '6448d2e1-6a4b-388e-b597-c3485643e135',
                'story_id' => 5,
                'number' => 8,
                'is_first' => 0,
                'is_last' => 0,
                'title' => '12',
                'content' => 'Si cela n\'a pas déjà été fait, et s\'il vous reste suffisamment d\'unités de temps, votre fourmi peut :',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 15:50:45',
                'updated_at' => '2019-12-19 21:54:39',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => '646b1a31-3ada-306d-a779-14e5e1da5e8c',
                'story_id' => 5,
                'number' => 7,
                'is_first' => 0,
                'is_last' => 0,
                'title' => '108',
                'content' => 'La fourmi se rend tour à tour dans la salle des nymphes, sèche et assez chaude, puis dans celle des œufs,
humide et plutôt fraîche. Dans la première, elle a remarqué la nymphe d\'une fourmi énorme, une future
guerrière aux dimensions anormale. Une fois éclose, ce devrait être une combattante redoutable si sa
difformité ne lui occasionne pas des déficiences irrémédiables. Elle pourrait l\'emporter avec elle durant
l\'expédition, en la transportant entre ses mandibules, et sans doute pourra-elle se faire relayer par les
ouvrières qui composeront vraisemblablement le gros du convoi… Dans la salle des œufs, elle a pu
également observer de nombreuses piles de sphères blanchâtres, mais les nourrices ne se sont pas
attardées à lui dire ce qu\'elles contenaient. La fourmi pourrait cependant prendre deux œufs au hasard
et les emmener avec elle, soit pour s\'en servir comme réserve de nourriture si l\'équipée s\'avérait longue
et difficile, soit pour s\'en occuper, et attendre qu\'ils se transforment en nymphes puis en fourmis, en
espérant que ces renforts temporisés s\'avèrent utiles à ce moment-là.
Ajoutez une Grosse nymphe à votre inventaire ou Deux œufs non identifiés.
N\'oubliez pas de retrancher 3 unités de temps au total restant quelle que soit votre décision.
Il est temps de faire un autre choix d\'action : rendez-vous au 12.',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 15:47:35',
                'updated_at' => '2019-12-19 15:48:04',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => '64a8170e-4529-3a18-9d40-1fedaad83767',
                'story_id' => 5,
                'number' => 36,
                'is_first' => 0,
                'is_last' => 0,
                'title' => '29',
                'content' => 'Le fait que l\'édifice soit habité, même par des insectes de taille réduite, entraîne automatiquement que
le groupe auquel se joint votre fourmi contient une soldate. Le reste est naturellement composé
d\'ouvrières.
L\'équipe se met en route, et parvient sans encombre jusqu\'au bâtiment. Son ouverture béante,
devancée par des plaques de métal et un matériau transparent, permet au groupe de rester en bloc, et
les fourmis pénètrent dans ce lieu silencieux.
D\'épaisses colonnes montent dans les hauteurs, et de grandes pierres semblent avoir été taillées pour
former des êtres inconnus, visiblement assez savants pour découper la roche, et avec précision.
L\'ouvrière qui avait repéré l\'édifice indique par quelques phéromones inquiètes une direction : selon elle,
ce que contient le bâtiment dans cette région est étrange. Puis, balisant de parfums piquants un autre
chemin, elle avertit du danger des petits insectes sur lesquels elle est tombée (et face auxquels elle a
immédiatement battu en retraite), sans pouvoir en dire plus sur leur nature.
Lancez un dé pour savoir dans quelle direction le groupe va se diriger. Si vous obtenez 1 ou 2, les fourmis
se rendent dans l\'endroit signalé comme étrange. Allez au 22. Sinon, elles vont tenter de trouver la
source de nourriture des insectes, quittes à engager le combat. Rendez-vous au 19.
Si votre fourmi possède une phéromone de séduction, elle peut influencer le choix du groupe : décidez
alors du paragraphe où vous souhaitez vous rendre.',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 22:38:54',
                'updated_at' => '2019-12-19 22:39:41',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => '66eb9e9c-4401-3191-9967-eaf9d4a8e47d',
                'story_id' => 5,
                'number' => 29,
                'is_first' => 0,
                'is_last' => 0,
                'title' => '40',
                'content' => 'Créant une piste parfumée toute neuve pour les prochaines expéditions, il ne reste guère de chemin à
parcourir au groupe avant d\'arriver à la lisière de la forêt. Et bientôt, il fait face à un spectacle qui génère
quelques phéromones d\'inquiétude : un horizon gris et irrégulier, découpé par des barres sombres
plantées dans la terre.
Le groupe avance un peu, et passe devant une petite colline au parfum étrange : l\'émergence terreuse a
des relents de métal.
La marche se poursuit. Pas à pas, les fourmis avancent sur ce territoire inconnu. Le sol s\'avère noir et plat
en de nombreux endroits. Puis on croise les premières constructions, faites d\'une sorte de roche
inconnue et semblant avoir subi une puissante concussion. Toutes sont vides de vie et de nourriture.
Le groupe remarque cependant avec intérêt que sur cette étendue désertique jonchée de gravats, de
petites pousses commencent à sortir du sol aplati, fissurant la matière minérale étrange dont il est
recouvert.
Semant derrière elles des phéromones délimitant la nouvelle piste, les fourmis agitent leurs antennes,
cherchant à détecter quelque senteur indiquant la présence de nourriture. Mais l\'air ne recèle qu\'une
forte odeur minérale et d\'infimes effluves végétaux. On continue à avancer, en accélérant le pas, tandis
que les mystérieuses constructions se font de plus en plus nombreuses et hautes.
D\'un commun accord, les fourmis décident de s\'arrêter, car de nouvelles effluves difficilement
identifiables se font sentir. Puis chacune part dans une direction, en faisant de petits arcs de cercle pour
couvrir le plus possible le terrain à explorer.',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 22:31:44',
                'updated_at' => '2019-12-19 22:33:10',
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => '7efa51ac-4650-3968-927f-910f95fc6b64',
                'story_id' => 5,
                'number' => 28,
                'is_first' => 0,
                'is_last' => 0,
                'title' => '99',
                'content' => 'Une feuille est assez grande pour accueillir de deux à trois fourmis maximum. Assouvissant leur besoin
de rester groupées, les fourmis commencent par remplir au maximum chaque feuille, mais elles
apprennent rapidement que la loi de la gravité risque de leur faire couler leurs embarcations bien avant
d\'arriver à destination. Finalement, la plupart des feuilles n\'accueillent qu\'une seule fourmi.
Si la vôtre possède une plume, elle peut l\'utiliser à la place d\'une feuille, pour profiter de son étanchéité :
allez alors au 77. Sinon, elle se contentera d\'une feuille, comme les autres, et vous vous rendrez au 95',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 22:30:07',
                'updated_at' => '2019-12-19 22:30:51',
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => '81527581-7106-342e-af47-a1151abf81f3',
                'story_id' => 5,
                'number' => 39,
                'is_first' => 0,
                'is_last' => 0,
                'title' => '21',
                'content' => 'Le groupe, composé d\'ouvrières mais aussi de soldates, suit la piste menant à la mystérieuse cuve
chlorée. Arrivées à l\'entrée du bâtiment, les fourmis perçoivent de rapides vibrations dans le sol, de plus
en plus fortes. On recule et on se met en position de combat, les guerrières en première ligne. C\'est alors
qu\'au beau milieu du passage apparaît soudainement un gros mammifère qui, les crocs apparents, émet
de puissantes ondes sonores. Sa queue dressée derrière lui et son poil hérissé montrent qu\'il cherche à
dissuader les visiteurs de pénétrer dans son antre. L\'exploratrice qui a trouvé ce lieu a eu de la chance de
ne pas tomber seule sur cette énorme créature…
Si vous désirez que votre fourmi envoie des phéromones excitantes pour pousser ses congénères au
combat, rendez-vous au 3.
Si votre protégée est une sexuée, elle peut s\'envoler et chercher à pénétrer dans l\'édifice par le haut,
hors de portée de la bête. Allez alors au 42.
Sinon, votre insecte peut faire marche arrière, suivi par le groupe, naturellement guidé par la prudence.
Rendez-vous dans ce cas au 66.',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 22:41:38',
                'updated_at' => '2019-12-19 22:41:58',
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => '8e32b39a-0886-37f3-93fd-f606a88950a9',
                'story_id' => 5,
                'number' => 1,
                'is_first' => 1,
                'is_last' => 0,
                'title' => '1',
                'content' => 'Les quatre pattes arrière plantées dans une paroi à l\'aide de robustes paires de griffes, le bout de
l\'abdomen posé sur le sol, la fourmi sécrète à nouveau de la salive blanche pour en enduire à présent ses
mâchoires. Occupée par sa toilette, elle ne peut pour autant ignorer le flux de phéromones que lui
envoie la nouvelle venue, une soldate âgée dotée d\'épaisses mandibules arquées. Le manque croissant
de nourriture pousse le Nid à devenir de plus en plus téméraire, et la guerrière, par un subtil mélange
d\'hormones aériennes, l\'enjoint de l\'accompagner pour une expédition urgente. Il faut agrandir les
territoires du Nid, explorer le monde au-delà des limites établies, afin de trouver les ressources qui
manquent tant à la colonie. Les parfums de stress et d\'encouragement qu\'exhale l\'exploratrice
chasseresse finissent par convaincre la fourmi de l\'importance de la tâche : elle acquiesce en envoyant
quelques phéromones apaisantes.
La soldate va continuer à recruter quelques membres supplémentaires pour l\'expédition à venir, ce qui
laisse à votre protégée un peu de temps pour s\'y préparer. Elle pourrait :',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 15:40:08',
                'updated_at' => '2019-12-19 16:41:28',
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => '8f35f3c5-8bf4-327d-99ee-e6ab05ecdb06',
                'story_id' => 5,
                'number' => 37,
                'is_first' => 0,
                'is_last' => 0,
                'title' => '114',
                'content' => 'Une guerrière se joint au groupe, en raison de la présence probable d\'animaux à sang chaud dans ces
souterrains. Puis les fourmis suivent la piste de phéromones jusqu\'à un gouffre menant sous terre…
Elles descendent lentement des paliers comme taillés dans la pierre. Certaines trébuchent : des pattes
craquent ou dérapent, des carapaces résonnent contre les parois de pierre. Mais plus de phéromones de
peur que de mal. Le groupe atteint une des branches de l\'angoissant réseau. Le sol est recouvert de
pierres et de deux barres de métal qui se perdent dans l\'obscurité. Les fourmis sont habituées à vivre
dans le noir, sous terre. Elles sont néanmoins inquiètes du fait des vibrations lointaines qui font penser à
des cris de mammifères.
Du couloir principal, le groupe se divise en deux pour couvrir les deux directions. Votre fourmi suit le
mouvement en restant proche de ses compagnes, car les ondes sonores se font de plus en plus intenses.
Puis, un embranchement apparaît, et votre insecte n\'est plus qu\'avec une ouvrière. Le stress monte
d\'encore un cran quand la possibilité est donnée de continuer à suivre la voie ou de prendre un chemin
transversal plus réduit, sans barres de métal et moins pierreux. Dans la direction de la route principale,
nul son ne vient troubler les capteurs antennaires. En revanche, le passage perpendiculaire au chemin
principal émet des bruits caractéristiques d\'un animal de petite taille (car aigus).
Pour déterminer la direction que va prendre votre insecte, lancez un dé : si vous obtenez de 1 à 4, votre
fourmi s\'aventure dans le couloir transversal : rendez-vous au 93. Sinon, allez au 89 pour qu\'elle
poursuivre son chemin droit devant et laisse l\'ouvrière tenter sa chance dans le passage.
Si votre fourmi possède des phéromones de séduction, choisissez la direction qui vous convient, l\'ouvrière
se laissera convaincre. Par ailleurs, si vous le souhaitez, votre insecte peut même persuader sa compagne
de ne pas céder à son instinct d\'exploratrice et de l\'accompagner.',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 22:40:09',
                'updated_at' => '2019-12-19 22:40:33',
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => '943a46a7-3a3c-36f6-b8ca-efaa09395320',
                'story_id' => 5,
                'number' => 2,
                'is_first' => 0,
                'is_last' => 0,
                'title' => '117',
                'content' => 'L\'expédition risque de durer plusieurs jours, et être pleine d\'énergie sera un atout pour la survie,
notamment quand il faudra supporter le froid de la nuit. La fourmi se rend donc dans une des réserves
du Nid et remplit ses deux estomacs de mycélium, ce champignon cultivé sous terre, ainsi que de viande.
En sortant, elle croise plusieurs guerrières revenues de quelque patrouille et souhaitant se ravitailler. Un
bref contact antennaire et quelques échanges de phéromones l\'informent que, une fois n\'est pas
coutume, le temps est plutôt chaud et humide. L\'empressement de la soldate qui a recruté votre insecte
n\'en est que plus compréhensible, car depuis ce qui a été nommé « Le plus dur des Hivers », la
température trop basse ralentit les performances de ses congénères, les rendant moins productifs, et
plus vulnérables aux prédateurs.
Votre fourmi est passée à l’état Repue.
N\'oubliez pas de retrancher 2 unités de temps au total encore disponible.
Il est temps de faire un autre choix d\'action : rendez-vous au 12.',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 15:42:26',
                'updated_at' => '2019-12-19 15:43:39',
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => '9b55d164-5507-3c9e-a50e-1176f0edf292',
                'story_id' => 5,
                'number' => 31,
                'is_first' => 0,
                'is_last' => 0,
                'title' => '47',
                'content' => 'Si votre protégée a recruté un ou des compagnons, ceux-ci l\'accompagnent.
La fourmi s\'approche de l\'édifice dont le sommet semble se perdre dans les nues. La construction semble
avoir été faite d\'un seul bloc, puis percée d\'ouvertures réparties régulièrement le long de sa surface.
L\'une d\'elles, plus grande que les autres, se trouve au niveau de sol et c\'est tout naturellement que
l\'insecte se dirige dans sa direction. Passant entre deux grandes plaques de métal écartées de plusieurs
pattes l\'une de l\'autre, la fourmi pénètre dans un lieu où l\'air est concentré en particules de toutes
sortes, souvent blanches et minérales, mais aussi des restes de moisissures desséchées. La fourmi reste
au milieu du large passage à découvert qui se présente à elle, pour balayer de ses yeux globuleux
l\'ensemble des environs. S\'y trouvent alignés deux rangées de blocs de pierre en forme de cylindre, qui
sont assez haut pour atteindre la paroi supérieure. L\'exploratrice agite à nouveau ses antennes. Aux
effluves qu\'elle perçoit, il semblerait qu\'aucun être vivant ne se trouve dans les parages. Accélérant sa
marche, elle parvient au bout de cette immense caverne. Là, elle découvre un passage grimpant de
manière incroyablement régulière ; la pierre semble avoir été taillée sous forme de paliers. Avec des
bonds suffisamment puissants ou quelques prises pour ses griffes, la fourmi n\'aura aucun mal à gravir 
cette voie qui devrait au final la mener en haut de l\'édifice… Mais peut-être qu\'un autre chemin est
possible, non loin du premier : deux panneaux métallique légèrement entrouverts laissent passer un
léger courant d\'air, il pourrait être intéressant de voir ce qui se cache derrière.
Si la fourmi décide de prendre le passage grimpant de manière régulière, rendez-vous au 59. Si elle
décide de passer entre les deux battants métalliques, allez au 62. Si elle est sexuée, elle peut également
ressortir et prendre son envol jusqu\'en haut de l\'édifice, en espérant que les courants aériens situés à
une telle hauteur ne la fasse pas trop virevolter (rendez-vous alors au 31).',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 22:33:15',
                'updated_at' => '2019-12-19 22:33:36',
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 'a3972bc8-8441-3fd2-bf8d-d3d7f7df4122',
                'story_id' => 5,
                'number' => 19,
                'is_first' => 0,
                'is_last' => 0,
                'title' => '23',
                'content' => 'Eius quidem debitis aut sapiente. Et autem libero id corporis aut deserunt accusantium. Sed error ipsum doloribus sed iure ut numquam.',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 22:08:57',
                'updated_at' => '2019-12-19 22:09:37',
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 'a6a67782-1453-3ef1-bf30-dd36693e0562',
                'story_id' => 5,
                'number' => 27,
                'is_first' => 0,
                'is_last' => 0,
                'title' => '52',
                'content' => 'La fourmi transporte une à une ses congénères à l\'autre rive. Les multiples allers et retour la fatigue mais
l\'esprit de groupe et l\'importance de sa mission la soutiennent.
Finalement, chaque exploratrice arrive à bon port.
N\'oubliez pas de diminuer la Faim de votre fourmi d\'un niveau.
Rendez-vous au 40.',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 22:29:24',
                'updated_at' => '2019-12-19 22:29:41',
                'deleted_at' => NULL,
            ),
            23 => 
            array (
                'id' => 'a8e00d08-e879-3bbd-8bde-b52b50c7900f',
                'story_id' => 5,
                'number' => 14,
                'is_first' => 0,
                'is_last' => 0,
                'title' => '92',
                'content' => 'Chaque fourmi se presse contre ses compagnes, cherchant à utiliser au maximum la place offerte par le
creux. Certaines grimpent même sur leurs congénères, quitte à glisser sur les chitines, par crainte de la
pluie à venir. Mais le manque de place demeure. Si votre fourmi a amené avec elle une grosse nymphe,
elle doit l\'abandonner, ou plutôt, afin, que son transport n\'ait pas été vain, s\'en nourrir avec ses
compagnes (elle regagne un niveau de Faim).
Tandis que le groupe se fait compact plus que jamais, les projectiles mortels commencent à tomber du
ciel. Une goutte acide s\'abat sur le thorax d\'une ouvrière exposée, qui est projetée sur le côté et agonise,
pattes et mandibules agitées de violentes saccades. Le trou suffit à peine pour une quinzaine de fourmis
et quelques autres pertes sont subies (notez que si votre fourmi avait recruté un ou des compagnons, ces
derniers sont décédés).
Les griffes plantées dans le sol ou le bois, les survivantes s\'endorment peu à peu avec le froid qui
s\'immisce dans la nuit noire. Leur sommeil sera néanmoins troublé par les vibrations qu\'engendrent les
chutes de projectiles liquides.
Au petit matin, alors que la terre a absorbé la majeure partie de l\'acidité, le groupe encore affaibli par le
froid décide de se remettre en route sans tarder. Les odeurs d\'acides oléiques émises par les cadavres de
leurs anciennes compagnes ne sont en effet guère réjouissantes.',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 16:09:50',
                'updated_at' => '2019-12-19 16:12:41',
                'deleted_at' => NULL,
            ),
            24 => 
            array (
                'id' => 'b9ef1b4e-7cf6-37a0-9951-2f05d2fc24b1',
                'story_id' => 5,
                'number' => 38,
                'is_first' => 0,
                'is_last' => 0,
                'title' => 'Qui illum et rerum aut',
                'content' => 'Omnis molestiae reiciendis quis officiis nisi qui accusamus. Quo et magnam et nobis doloremque asperiores veniam. Et modi odit nihil ut.',
                'prerequisites' => NULL,
                'layout' => NULL,
                'is_checkpoint' => 1,
                'created_at' => '2019-12-19 22:41:16',
                'updated_at' => '2019-12-19 22:41:16',
                'deleted_at' => NULL,
            ),
            25 => 
            array (
                'id' => 'ba8b5412-c56b-36a9-bb3d-c0e851ee2fe3',
                'story_id' => 5,
                'number' => 21,
                'is_first' => 0,
                'is_last' => 0,
                'title' => '86',
                'content' => 'La progression du groupe est pendant un temps masquée par les plantes qui jalonnent son parcours et
qui le forcent à desserrer sa position. Mais peu à peu, les végétaux deviennent moins nombreux, et
même les troncs se font plus rares. Les fourmis parviennent finalement sur un terrain d\'herbes abîmées
dépourvu de tout arbre. Et donc de toute ramification arborescente pouvant les cacher aux yeux
d\'éventuels prédateurs aériens…
Tandis que le groupe accélère instinctivement le pas, une ombre passe sur certaines fourmis. Puis une
des compagnes de votre insecte est fauchée par deux serres et emmenée dans les hauteurs, pour sans
doute être picorée avidement. Le goût acidulé des fourmis ne semble cependant pas au goût du volatile
puisqu\'il fait bientôt tomber le cadavre de la pauvre ouvrière au milieu du groupe affolé. Une paire de
serres vient ensuite renverser quelques membres du groupe, puis la créature à plume, volant toujours
plus au ras du sol, donne quelques coups de becs. Certaines fourmis parviennent à les éviter, d\'autres
sont transpercées. On essaie de contre-attaquer, mais les mandibules claquent systématiquement dans
le vide. Le temps que le groupe atteigne le bout de la clairière, il ne restera guère de survivantes…',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 22:14:21',
                'updated_at' => '2019-12-19 22:25:10',
                'deleted_at' => NULL,
            ),
            26 => 
            array (
                'id' => 'cf066c88-314f-3df0-be2a-4eacad2dfe32',
                'story_id' => 5,
                'number' => 4,
                'is_first' => 0,
                'is_last' => 0,
                'title' => '57',
                'content' => 'De manière naturelle, la fourmi artilleuse produit elle-même l\'acide dans son sac à venin, lentement.
Mais elle peut accélérer sa création en absorbant certaines substances. Dans une réserve de simples, elle
ne tarde pas à trouver instinctivement ce qui lui permettra de générer rapidement davantage d\'acide
formique en très peu de temps. Elle mâche puis avale quelques morceaux d\'herbe choisis, et tapote son
abdomen effilé, avant de repartir aussitôt. Nul besoin de rester immobile pour que la production de jus
corrosif soit fortement accentuée, et d\'autres tâches l\'appellent.
Augmentez votre nombre total de gouttes d\'acides au maximum (10).
N\'oubliez pas de retrancher 2 unités de temps au total encore disponible.',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 15:45:03',
                'updated_at' => '2019-12-19 16:45:00',
                'deleted_at' => NULL,
            ),
            27 => 
            array (
                'id' => 'd2b94bb0-cb20-32d2-b35d-545b69980e77',
                'story_id' => 5,
                'number' => 13,
                'is_first' => 0,
                'is_last' => 0,
                'title' => '63',
                'content' => 'Votre fourmi lance quelques phéromones d\'excitation et d\'encouragement à la suivre, puis elle reprend
sa marche sur la piste odorante. Ce genre d\'initiative personnelle est inhabituel mais finalement, c\'est
bientôt tout le groupe qui se retrouve à suivre cette espèce de meneuse. Hélas, le temps passe sans
qu\'on découvre un abri adéquat, et l\'humidité devient suffisamment importante pour annoncer l\'arrivée
imminente de la pluie. Consensus immédiat, les fourmis agrippent avec leurs mandibules de grosses
feuilles et s\'en servent comme d\'un bouclier contre les projectiles mortels qui ne vont pas tarder à
tomber. Ces protections n\'auront hélas qu\'une durée temporaire, car l\'acide, bien que moyennement
concentré, finira par transpercer le trop fin rempart végétal.
Le groupe maintient sa vive allure malgré le froid et les premières gouttes corrosives qui s\'écrasent
contre les feuilles. Même si le bouclier végétal tient pour l\'instant bon, les griffes piétinent dans la terre
meuble qui commence à s\'acidifier, occasionnant des brûlures de plus en plus vives. Votre fourmi perd un
état de Vitalité et Carapace. Seule la chance permettra au groupe de survivre à ce cataclysme.
Lancez un dé. Si le résultat est pair, rendez-vous au 79. Dans le cas contraire, allez au 85.',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 16:09:18',
                'updated_at' => '2019-12-19 16:09:40',
                'deleted_at' => NULL,
            ),
            28 => 
            array (
                'id' => 'd38a2175-baaf-3c40-b16d-0d7685fb3943',
                'story_id' => 5,
                'number' => 22,
                'is_first' => 0,
                'is_last' => 0,
                'title' => '26',
                'content' => 'Assise sur son abdomen, la fourmi ajuste sa visée puis envoie quelques gouttes au volatile qui se
préparait à la frôler. L\'odeur piquante de l\'acide et la corrosion qu\'il engendre renvoie le volatile vers les
cieux tandis qu\'une odeur de plumes grillées se fait sentir. Les vibrations légères mais quasiment
continues de l\'air laissent à penser que l\'oiseau émet des ondes sonores de douleur.
Le groupe se presse de regagner la protection des branches aux feuilles biscornues. Quelques pertes sont
à dénombrer, mais cela aurait pu être bien pire. Un moment plus tard, le groupe rejoint la piste, qui se
termine bientôt sur un obstacle redoutable.',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 22:15:12',
                'updated_at' => '2019-12-19 22:24:40',
                'deleted_at' => NULL,
            ),
            29 => 
            array (
                'id' => 'd62fbb3b-5fe6-3d99-a698-57c6cae4e72f',
                'story_id' => 5,
                'number' => 12,
                'is_first' => 0,
                'is_last' => 0,
                'title' => '115',
                'content' => 'Le groupe continue sa marche, qu\'il essaie de rendre la plus rapide possible malgré la diminution
progressive de la température. Finalement, une fourmi découvre un creux dans un arbre qui pourrait
servir d\'abri. Mais sa taille réduite risquerait de rendre vulnérable à la pluie les fourmis se trouvant à sa
limite externe. C\'est pourquoi on hésite à poursuivre encore la marche.
Si vous désirez que votre insecte donne le déclic qui manque pour la poursuite de la marche, rendez-vous
au 63.
Si vous pensez que ce lieu conviendra, dirigez-vous au 92.',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 16:08:37',
                'updated_at' => '2019-12-19 16:08:56',
                'deleted_at' => NULL,
            ),
            30 => 
            array (
                'id' => 'dc6f77ab-c3f3-36ad-ace6-862e1025c052',
                'story_id' => 5,
                'number' => 11,
                'is_first' => 0,
                'is_last' => 0,
                'title' => '110',
                'content' => 'Votre fourmi prévient par contact antennaire quelques membres du groupe compact, qui font
immédiatement passer l\'information à leurs voisins. Bientôt, tout le monde suit la piste parfumée que
votre insecte a tracée en direction du terrier.
Les guerrières s\'engouffrent les premières dans le trou et n\'y découvrent aucune présence autre que
quelques petits insectes grisâtres, habitués à vivre dans l\'humidité de la terre et peu goûteux. La
discrétion de l\'endroit et l\'ancienneté des odeurs qui y demeurent laissent à penser qu\'il y a de bonnes
chances de le groupe ne soit pas dérangé durant la nuit, quand la petite communauté sera paralysée,
endormie par le froid.
D\'un commun accord, les fourmis décident donc de faire de ce trou leur antre. Elles ancrent leurs griffes
dans le sol, bloquent leurs articulations, et se préparent à l\'endormissement. Une soldate restée alerte
montera la garde près de l\'entrée le plus longtemps possible, mais il est certain que le froid aura
également raison d\'elle. Les gouttes tombées du ciel qui s\'abattent un long moment après l\'arrivée au
refuge martèlent la terre et stressent les fourmis, sensibles à fleur de carapace envers les vibrations. Le
manque de chaleur finit cependant par inhiber toute sensation.
Au petit matin, le groupe s\'éveille lentement. Les premières fourmis réveillées lèchent leurs compagnes
encore immobiles et leur donnent des petits coups d\'antennes, puis tentent, de récupérer un peu
d\'énergie au-dehors, cherchant en vain la présence de quelque rayon de soleil possédant une intensité
suffisante.
Quand tout le monde est éveillé, quand les pattes sont dégourdies et qu\'on estime qu’il est temps de
repartir, chacune prend la mesure du retard qui a été pris en s\'abritant aussi rapidement de la pluie. Le
groupe ressent le besoin de s\'éloigner de la piste pour rattraper le retard et couper court en direction du
Nord, quitte à emprunter un chemin peu sûr car non balisé.
Si votre fourmi est capable de sécréter des phéromones de séduction et que vous pensez sage de
continuer à suivre la piste parfumée, rendez-vous au 60.
Sinon, avec son consensus habituel, le groupe décide de tenter un raccourci. Allez au 86.',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 16:07:53',
                'updated_at' => '2019-12-19 16:08:25',
                'deleted_at' => NULL,
            ),
            31 => 
            array (
                'id' => 'e4807008-33b4-33a4-a19e-790cabf8be61',
                'story_id' => 5,
                'number' => 24,
                'is_first' => 0,
                'is_last' => 0,
                'title' => '34',
                'content' => 'Votre fourmi profite d\'un passage à ras le sol du volatile pour faire un pas de côté et sauter dans sa
direction. La mandibule plantée dans son ventre, les griffes patinant un instant sur le duvet fin avant de
s\'enfoncer durablement dans la chair de l\'animal, l\'insecte est désormais solidement fixé à ce prédateur
aérien. Ce dernier prend d\'ailleurs de l\'altitude, tentant de se débarrasser de la fourmi et craignant
l\'arrivée d\'autres assaillantes. Votre créature gravit peu à peu l\'amas de chair emplumée et parvient à se
loger à la naissance des deux ailes ; l\'oiseau peine alors à la viser de ses coups de bec. La position de la
fourmi n\'est cependant pas stable, du fait du vol erratique et violent du volatile. Le vent fouette les
antennes de l\'insecte, et quand sa mandibule n\'est plus enfoncée dans la chair palpitante, ses griffes
lâchent peu à peu prise, face à ces plumes ondoyantes et ce duvet hérissé de peur et de douleur.
Finalement, après une descente en piquée qui a amené la fourmi au niveau du cou de l\'oiseau, une
remontée brutale l’envoie assez bas, entre les deux ailes du volatile. Aussitôt, un bec fond sur elle, tandis
que les larges membres emplumés battent derechef dans le but de la faire tomber.
Il va falloir affaiblir et fatiguer suffisamment le volatile pour qu\'il se pose. Votre fourmi doit tenir 6 tours
ou enlever 6 états de Vitalité à l\'oiseau.
Dé :
1 : Les ailes font valser la fourmi, qui lâche prise et s\'en va dans les airs. La chute aurait pu la blesser
grièvement… fort heureusement, elle est récupérée au vol par les serres de l\'oiseau qui l\'achève d\'un
coup de bec.
2 : Cherchant avant tout à raffermir ses prises, l\'insecte ne peut guère esquiver le coup de bec,
heureusement maladroit, qui vient le piquer au thorax (elle perd trois états de Vitalité et Carapace).
3 : La fourmi ne lâche pas prise, la mandibule enfoncée dans la chair de l\'animal, mais un coup latéral de
bec vient heurter sa carapace (elle perd deux états de Vitalité et Carapace).
4 : Le volatile échoue dans ses tentatives de désarçonner ou de picorer votre fourmi.
5 : De ses mandibules, votre fourmi laboure la chair de l\'animal (il perd deux états de Vitalité).
6 : Votre protégée parvient à découper un bout de chair de l\'animal ((il perd trois états de Vitalité).
Si votre fourmi remporte le combat, le volatile s\'écrase au sol et le reste du groupe a tôt fait de fondre
sur lui et de lui déchiqueter sa chair. La viande de la créature permet à votre insecte de récupérer tous
ses niveaux de Faim. Il peut également emporter avec lui une des plumes du volatile. Inscrivez plume sur
le Feuille d\'aventure.
Après ce copieux festin, les fourmis reprennent leur route et rejoignent finalement la piste parfumée.
Celle-ci se termine devant un nouveau défi.',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 22:22:49',
                'updated_at' => '2019-12-19 22:26:10',
                'deleted_at' => NULL,
            ),
            32 => 
            array (
                'id' => 'e4a14291-b11e-3381-b271-48367f154db6',
                'story_id' => 5,
                'number' => 26,
                'is_first' => 0,
                'is_last' => 0,
                'title' => '64',
                'content' => 'Mandibules et mâchoires creusent lentement un tunnel humide. Les pattes patinent sur la terre meuble,
les antennes trempent dans le mucus glaiseux. Finalement, des brindilles et des branches viennent
supporter le passage dont la construction épuise le groupe (votre fourmi perd 4 états de Faim).
Néanmoins, les exploratrices parviennent à rejoindre l\'autre rive, sans perte.',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 22:28:40',
                'updated_at' => '2019-12-19 22:31:36',
                'deleted_at' => NULL,
            ),
            33 => 
            array (
                'id' => 'e91c3382-b4fd-33a1-bf97-98cd1c88c57a',
                'story_id' => 5,
                'number' => 10,
                'is_first' => 0,
                'is_last' => 0,
                'title' => '100',
                'content' => 'Outre la soldate qui l\'a recrutée, la fourmi tombe antennes à antennes avec une autre guerrière aux
mandibules aiguisées, ainsi qu\'une vingtaine d\'ouvrières, qui serviront à rapporter le gibier et autre
denrées comestibles qui devraient être obtenues au fil de la mission. Votre insecte sent que les
phéromones stimulantes de la soldate ont décru en intensité… En partie parce que l\'expédition est
lancée, mais aussi parce que la température commence déjà à baisser ; il ne reste plus très longtemps
avant la tombée du jour. Le froid qui s\'ensuivra endormira les fourmis et les rendra vulnérables aux
prédateurs. Il faut avancer dès maintenant et trouver un abri de fortune.
On se remet donc en route. Consensus immédiat, le groupe se resserre derrière les soldates, bien
compact, pour éviter de se disperser au cours de la marche. Il ne forme plus qu\'un amas dur, gris et
véloce qui dissuadera certains prédateurs. Puis la centaine de pattes se met en branle, suivant une vieille
piste odorante déjà établie par d\'autres exploratrices.
Les fourmis se déplacent aussi vite que faire se peut, se bousculant parfois. Les griffes s\'enfoncent et
sortent de terre des milliers de fois sans faillir, mais les efforts fournis dépensent de l\'énergie et la
température décroît peu à peu. Votre fourmi perd un niveau de Faim. Les antennes s\'agitent quand elles
détectent l\'humidité grandissante dont se charge l\'air. Il est probable que la pluie se mette bientôt à
tomber, et une seule goutte bien placée peut s\'avérer fatale pour une fourmi.
Votre insecte ainsi que quelques-uns de ses congénères s\'écartent du groupe principal pour commencer
à chercher un abri. Il est encore un peu tôt pour cela, mais la douloureuse expérience de la pluie qu\'ont
eu les fourmis ces dernières saisons a engendré, par surcompensation, une nervosité excessive. Par
chance, votre fourmi tombe sur l\'entrée d\'un terrier. Les odeurs qu\'il dégage sont assez effacées et guère
identifiables. Sans doute quelque animal à poils et à sang chaud l\'occupait-il il y a quelques temps.
Si vous pensez qu\'il faut dès à présent se rendre dans ce refuge suffisamment vaste pour toutes, quitte à
retarder un peu l\'expédition, rendez-vous au 110.
Si vous préférez que votre fourmi ne prévienne pas ses congénères et que le groupe continue encore un
moment son avancée, allez au 115.',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 15:57:28',
                'updated_at' => '2019-12-19 15:57:43',
                'deleted_at' => NULL,
            ),
            34 => 
            array (
                'id' => 'eb3c68b8-1daf-3034-a68c-6d4f3b79e687',
                'story_id' => 5,
                'number' => 34,
                'is_first' => 0,
                'is_last' => 0,
                'title' => '65',
                'content' => 'L\'exploratrice qui a découvert l\'endroit n\'ayant pas détecté la présence de quelconques êtres vivants,
l\'expédition dans laquelle se retrouve votre fourmi est composée uniquement d\'ouvrières (à moins
qu\'elle n\'ait amené avec elle une ou deux autres fourmis d’un autre type depuis le nid, qui
l\'accompagnent alors). Le groupe parvient bientôt jusqu\'à l\'édifice, qui comporte une large ouverture, au
pied de laquelle se trouvent des monceaux de minéral translucide, assez coupants. Les fourmis évitent
les obstacles sans peine et suivent le chemin balisé de phéromones qu\'a émises la première exploratrice.
Sur cette route, leur odorat leur confirme que des moisissures s\'échappent bien de certains cylindres
métalliques. Elles n\'en croisent aucun intact, jusqu\'à ce qu\'elles parviennent au bout de la piste de
phéromones. Là, elles tombent sur deux conteneurs totalement hermétiques. Les ouvrières s\'avèrent
cependant incapables de les découper avec leurs petites mandibules pour en vérifier le contenu, qui
peut être considérable… Or, les fourmis sont beaucoup plus attachées aux faits qu\'aux potentialités,
qu\'elles ont des difficultés à appréhender : si le contenu des cylindres n\'est pas garanti, elles préfèreront
ne pas s\'en encombrer.
Si votre fourmi (ou une de ses compagnes) possèdent deux gouttes d\'acide en réserve, rendez-vous au
30.
Si votre insecte possède des mandibules aiguisées et qu\'elle souhaite les utiliser sur le métal, allez au 87.
Sinon, il ne reste plus au groupe qu\'à explorer le reste des environs : rendez-vous au 46.',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 22:37:48',
                'updated_at' => '2019-12-19 22:38:06',
                'deleted_at' => NULL,
            ),
            35 => 
            array (
                'id' => 'efb2f3a3-9c3e-3c2e-be54-b72dd10c2f81',
                'story_id' => 5,
                'number' => 25,
                'is_first' => 0,
                'is_last' => 0,
                'title' => '71',
                'content' => 'A la température basse caractéristique de ce qui a été nommé « Le plus dur des Hivers » vient s\'ajouter à
présent l\'humidité du ruisseau qui fait face à votre fourmi et ses compagnes. Les fourmis ne savent pas
nager, et le courant rendrait de toutes manières cette entreprise dangereuse pour tout insecte capable
de se débrouiller dans cet élément visqueux (telle est sa consistance aux yeux de ces petites créatures).
Pourtant, il va bien falloir contourner l\'obstacle.
Instinctivement, le groupe commence à planter ses mandibules dans la terre, cherchant où elle est le
plus friable, afin de creuser un profond tunnel au-dessous du cours d\'eau. Mais procéder ainsi prendra
énormément de temps et d\'énergie…
Une possible opportunité serait d\'utiliser un sexué pour s\'en servir comme transport aérien : la fourmi
ailée transporterait ses congénères une à une sur l\'autre rive, et cela serait nettement plus rapide.
Une dernière solution serait de se servir de feuilles d\'arbres pour en faire des radeaux de fortune : ce
genre d\'embarcation ne manque pas alentour, et si le courant est favorable, on pourrait rejoindre la
berge opposée sans effort.
Quel que soit votre choix, sachez que le chemin parcouru dernièrement a baissé le niveau de Faim de
votre fourmi d’un niveau.',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 22:23:35',
                'updated_at' => '2019-12-19 22:29:55',
                'deleted_at' => NULL,
            ),
            36 => 
            array (
                'id' => 'fb772269-a27c-3f16-bebc-d6b04ed690da',
                'story_id' => 5,
                'number' => 32,
                'is_first' => 0,
                'is_last' => 0,
                'title' => '80',
                'content' => 'La fourmi peut choisir d\'explorer :
L\'objectif du groupe est de rassembler 10 unités de nourriture. Les sous-groupes qui ont été formés ne
sont pas assez nombreux pour visiter tous les lieux : il y aura 3 séries d\'explorations. A la fin de chaque
exploration, le niveau de Faim de votre insecte baissera d\'un niveau, en raison des efforts qu\'il aura
produit (cela sera précisé dans le texte).
Avant de choisir une destination, si votre fourmi transporte une nymphe, rendez-vous au immédiatement
au 37. De même, si elle a amené avec elle des œufs, allez au 109.
Si vous avez notez les mots Lieu inconnu sur la Feuille d\'aventure, votre fourmi l\'ajoute à la liste des
propositions d\'exploration : pour s\'y rendre, vous irez au 91.
Avec le temps, la réserve d\'acide des éventuelles artilleuses présentes dans le groupe (votre fourmi et/ou
un compagnon spécial) a pu se reconstituer quelque peu : ajoutez 2 gouttes à chaque réserve d\'acide.',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 22:34:23',
                'updated_at' => '2019-12-19 22:41:09',
                'deleted_at' => NULL,
            ),
            37 => 
            array (
                'id' => 'fbab9c67-beab-3f27-91fe-959efe6583f3',
                'story_id' => 5,
                'number' => 5,
                'is_first' => 0,
                'is_last' => 0,
                'title' => '106',
                'content' => 'La fourmi ignore de combien de ses congénères sera composé le groupe qui partira en expédition, mais il
peut être vital de renforcer sa force de frappe et de le rendre suffisamment éclectique pour répondre à
toute éventualité. Utilisant sa sensibilité aux champs magnétiques pour savoir quelle direction prendre à
l’intérieur du Nid, elle peut choisir d\'aller chercher l\'aide d\'un sexué, afin de bénéficier de sa perception
supérieure (rendez-vous alors au 2), ou aller demander le renfort de soldates, qu\'elles soient artilleuses
ou dotées de puissantes mandibules (allez au 97).',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 15:45:59',
                'updated_at' => '2019-12-19 15:52:41',
                'deleted_at' => NULL,
            ),
            38 => 
            array (
                'id' => 'fe835b07-0a51-33bd-99cc-af62093052af',
                'story_id' => 5,
                'number' => 3,
                'is_first' => 0,
                'is_last' => 0,
                'title' => '73',
                'content' => 'La fourmi erre pendant plusieurs secondes dans les tunnels. Partout, les pattes grouillent, les mâchoires
creusent, et les antennes frétillent d\'informations. Elle finit par trouver une paroi renforcée par de petits
cailloux. Se frottant les bords des mandibules contre la pierre, elle les rend davantage coupantes
qu\'auparavant.
Votre insecte gagne un bonus de 1 au dé, durant les combats au corps à corps, cumulable avec n\'importe
quel autre avantage. Néanmoins, l\'usure menace ses mandibules affutées et certains combats ou
épreuves particulièrement éprouvants pourront venir à bout de cet avantage.
N\'oubliez pas de retrancher 3 unités de temps au total encore disponible.',
                'prerequisites' => NULL,
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-19 15:44:11',
                'updated_at' => '2019-12-19 17:41:21',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}