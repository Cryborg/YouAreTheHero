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
                'id' => 1,
                'story_id' => 2,
                'is_first' => 1,
                'is_last' => 0,
                'title' => 'Prologue',
                'content' => '<p>Je n\'ai jamais été très grand fan de science-fiction. La science est déjà elle-même tellement mystérieuse que je n\'ai jamais eu le besoin d\'aller chercher ailleurs une autre source d\'émerveillement.</p><p>Gamin déjà, je m\'imaginais traversant l\'espace à bord d\'un vaisseau que j\'aurais moi-même construit. J\'avais commencé dans mon jardin, mais je me suis vite rendu compte que cet assemblage de bouts de bois n\'allait pas aller bien loin...</p><p>Comme beaucoup de personnes, j\'ai souvent cherché à savoir ce que le futur nous apporterait. C\'est probablement ce qui m\'a fait m\'intéresser aux sciences dans un premier temps. Et la carrière militaire me permettait de travailler sur des projets que j\'imaginais passionnants.</p><p>Mais ce temps est révolu. La science, le futur, les innovations, j\'ai tout devant moi. De mes yeux je contemple la vraie version de ce que sera le futur de l\'humanité.</p>',
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-21 16:28:07',
                'updated_at' => '2019-12-21 16:34:01',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'story_id' => 2,
                'is_first' => 0,
                'is_last' => 0,
                'title' => 'Le départ',
                'content' => '<p>- Je ne m’attendais pas à vous trouver ici, Commandeur.</p><p>- Vous savez ce que c’est avec ces essais, on n’est jamais trop prudent. Je préfère assurer mes arrières et checker les instruments avant de confier ma vie à cet engin, aussi perfectionné soit-il.</p><p>- Je vous comprends Commandeur, mais, sans vouloir vous manquer de respect, j’ai peur que les techniciens ne le prennent mal : ils risquent d’y voir un manque de confiance. Surtout...</p><p>- ...venant d’un militaire vous voulez dire ? Laissez-les penser ce qu’ils veulent, la seule chose qui m’importe est qu’ils aient fait correctement leur boulot. Après, ils peuvent dire ce qu’ils veulent de moi, ce n’est pas ce qui m’empêchera de dormir ce soir.</p><p>- Oui Commandeur. Douzième sous-sol, nous y sommes. Bonne journée Monsieur.</p><p>- Merci Colonel.</p><p>Mon premier jour. Enfin ! Après toutes ces années de recherche, d’échecs et de frustrations, nous y voici. Le premier essai en vol réel d’un engin spatial qui n’ait pas une taille à faire pâlir la Tour Eiffel.</p><p>Finies les fusées, navettes spatiales et autres lanceurs tout juste capables de sortir de notre atmosphère. Terminée cette époque où l’humanité restait clouée au sol de sa vieille Terre parce qu’elle avait toujours eu des sueurs froides à l’idée de réduire le budget militaire au profit de la recherche spatiale.</p><p>Je m’emporte un peu, j’avoue. Mais pas tant que ça si cet essai réussi. Car si c’est le cas, nous pourrons alors commencer la véritable conquête spatiale que les écrivains de science-fiction nous ont longtemps décrite, sans que jamais nous ne nous en approchions.</p><p>Ce magnifique vaisseau monoplace est en passe de devenir une légende, le premier d’une longue lignée, l’ancêtre de tous les vols interstellaires. Et qui sait ? On ne sera plus là dans un siècle, mais EFB-U5 trônera peut-être au beau milieu d’un musée, se targuant d’être celui par lequel, tant d’années auparavant, tout a commencé.</p><p>- Tous les systèmes sont opérationnels, Commandeur. Nous attendons votre check-list.</p><p>    </p><p>Il était hors de question que je ne sois pas le premier à le piloter, pas après les sacrifices qu’il m’a demandé. Je ne me suis pas marié et d’aucuns diraient que je suis passé à côté de ma vie en laissant ainsi ma carrière passer avant tout le reste.</p><p>Mais je ne regrette rien. Absolument rien ! Pour une seule raison, celle qui me fait me retrouver ici aujourd’hui, à cet endroit : EFB-U5. Ou plutôt, Phoebe comme j’ai pris l’habitude de l’appeler en m’adressant à elle.</p><p>Je sais que les gens en plaisantent, et pas forcément dans les registres les moins graveleux. Mais je serais curieux de savoir si un être humain a déjà été à ce point lié à une IA que nous le sommes tous les deux. J’en doute, mais je n’ai pas envie de vérifier. Pour moi, cette union est indispensable pour la réussite du projet. Et si j’en retire de la satisfaction, quel mal peut-il en résulter ?</p><br><p>- Phoebe à Contrôle, tous les systèmes sont au vert. Ouvrez la coupole, je sors faire un tour.</p><p>- Contrôle à EFB-U5, bien reçu. La coupole est en cours d’ouverture. Compte à rebours initialisé à 60 secondes, confirmez.</p><br><p>- Bien reçu Contrôle, 60 secondes.</p><p>Évidemment que je suis d’accord avec vos comptes à rebours, comme si j’avais le choix.</p><p>- La coupole est ouverte, début du compte à rebours.</p><p>Et nous y voici. Plus qu’une minute avant de savoir si nos techniciens et ingénieurs, avec leurs airs supérieurs, ont mérité leurs salaires. Si j’y reste à cause d’une boulette, je promets de revenir les hanter jusqu’à la fin de leurs jours.</p><p><span style="font-size: 11pt; font-family: Arial; background-color: transparent; font-style: italic; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;"><br></p><p>    <span style="font-size: 11pt; font-family: Arial; background-color: transparent; font-style: italic; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">50 secondes</p><p>Je m’étais promis de rester calme, zen. Après tout, ce n’est pas comme si j’avais l’avenir de l’humanité entre mes mains gantées. Et puis, voyons le bon côté des choses : si jamais j’y reste, personne ne pourra me le reprocher.</p><p><span style="font-size: 11pt; font-family: Arial; background-color: transparent; font-style: italic; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;"><br></p><p>    <span style="font-size: 11pt; font-family: Arial; background-color: transparent; font-style: italic; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">40 secondes</p><p>Relax, tout va bien se passer. Ce vaisseau a beau être expérimental, c’est tout de même le dernier d’une longue série. Les deux derniers prototypes se sont même plutôt bien comportés. Les seuls incidents notables que nous avons relevé sur ces versions étaient mineurs.</p><p><span style="font-size: 11pt; font-family: Arial; background-color: transparent; font-style: italic; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;"><br></p><p>    <span style="font-size: 11pt; font-family: Arial; background-color: transparent; font-style: italic; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">30 secondes</p><p><span style="font-size: 11pt; font-family: Arial; background-color: transparent; font-style: italic; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;"><br></p><p>Alors il n’y a aucune raison de s’en faire. Au pire, je dérive en orbite en attendant les secours. Ou je n\'arrive pas si haut et je m’éjecte, prêt à être récupéré par les sentinelles qui patrouillent déjà là-haut, sur le qui-vive.</p><p><span style="font-size: 11pt; font-family: Arial; background-color: transparent; font-style: italic; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;"><br></p><p>    <span style="font-size: 11pt; font-family: Arial; background-color: transparent; font-style: italic; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">20 secondes</p><p>Tous les voyants sont encore au vert, je lance les moteurs. Bien. Ça ronronne, c’est un gentil matou ça.</p><p><span style="font-size: 11pt; font-family: Arial; background-color: transparent; font-style: italic; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;"><br></p><p>    <span style="font-size: 11pt; font-family: Arial; background-color: transparent; font-style: italic; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">15 secondes</p><p>Quelle excitation !! Le rêve de toute une vie trouve son apogée ici, là, maintenant.</p><p><span style="font-size: 11pt; font-family: Arial; background-color: transparent; font-style: italic; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;"><br></p><p>    <span style="font-size: 11pt; font-family: Arial; background-color: transparent; font-style: italic; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">10 secondes</p><p>Dernière ligne droite, ça va dépoter moi je vous le dis !</p><p><span style="font-size: 11pt; font-family: Arial; background-color: transparent; font-style: italic; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;"><br></p><p>    <span style="font-size: 11pt; font-family: Arial; background-color: transparent; font-style: italic; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">5 secondes</p><p>- Contrôle à EFB-U5, tout est OK pour nous.</p><p>Un peu tard dans le cas contraire, non ?</p><p><span style="font-size: 11pt; font-family: Arial; background-color: transparent; font-style: italic; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;"><br></p><p>    <span style="font-size: 11pt; font-family: Arial; background-color: transparent; font-style: italic; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">...3</p><p>    <span style="font-size: 11pt; font-family: Arial; background-color: transparent; font-style: italic; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">...2</p><p>    <span style="font-size: 11pt; font-family: Arial; background-color: transparent; font-style: italic; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">...1</p><p>    <span style="font-size: 11pt; font-family: Arial; background-color: transparent; font-style: italic; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">...</p><p><span style="font-size: 11pt; font-family: Arial; background-color: transparent; font-style: italic; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;"><br></p>',
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-21 16:34:31',
                'updated_at' => '2019-12-21 16:39:49',
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'story_id' => 2,
                'is_first' => 0,
                'is_last' => 0,
                'title' => 'Déboussolé',
                'content' => '<p>J’aurais dû demander un guide à la sortie du Centre. Comment est-ce que je suis censé m’y retrouver dans une ville que je ne connais pas ? Rectification : dans un monde que je ne connais pas !</p><p>Même les gens me regardent bizarrement. On m’a certifié que j’étais habillé d’une manière tout à fait classique, bien que j’aie beaucoup de mal à le croire. Et pourtant, je n’arrive pas à me fondre dans la foule, les regards semblent systématiquement tournés vers moi.</p><p>Bon, du calme mon vieux, vas pas te faire un ulcère pour ça. T’es débrouillard non ? Alors débrouilles-toi !</p><p>Mais pourquoi est-ce que je les ai laissés me donner toute la journée de libre ? D’accord, j’étais pas très frais en me réveillant ce matin. Idées embrouillées, plus de repères, ça n’aide évidemment pas à se remettre au boulot. Mais de là à m’envoyer me perdre dans cette ville tentaculaire...</p><p>Car elle est tout simplement inimaginable : la plate-forme d\'observation sur laquelle je me trouve surplombe de 500 mètres toutes les autres constructions de la ville. Le temps pur sans un nuage permet même de voir la courbure de la planète.</p><p>- Vous venez d\'arriver ?</p><p>Pris par surprise, je me retourne pour me trouver face à face avec un homme entre deux âges, tout souriant et avec l\'air de pouvoir attendre ma réponse en tenant cette posture indéfiniment. Ce qu\'il faillit faire, tant je fus interloqué par cette soudaine rencontre. Mais je me repris et tenta une réponse que j\'espérais crédible.</p><p>- A vrai dire, oui, tout est nouveau pour moi, je suis monté dans l\'espoir d\'avoir une sorte de déclic quant à ma prochaine destination, mais j\'avoue que je ne m\'attendais pas à ce que je suis en train de contempler.</p><p>- Oh, mais c\'est que vous venez probablement de la Périphérie alors ! J\'imagine que l\'absence de route peut désorienter au premier abord. Le bloc compact que vous avez sous les yeux n\'est pas qu\'une ville, elle s\'étend sur l\'intégralité de la planète. Seules les capsules à grande vitesse en émergent, ainsi que les Tours bien entendu.</p><p>Bon, il me semble bien sympathique ce bonhomme, et il me semble très enclin à partager son savoir sur cette ville. Ceci dit, j\'ai des personnes à aller voir, il ne faudrait peut-être pas trop que je tarde.</p>',
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-21 16:40:48',
                'updated_at' => '2019-12-21 16:42:35',
                'deleted_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'story_id' => 2,
                'is_first' => 0,
                'is_last' => 0,
                'title' => 'Trévise',
                'content' => '<p>- Excusez-moi Monsieur, pourriez-vous m\'expliquer comme vous le feriez à un enfant de cinq ans ? Comme vous le disiez très justement, je viens de la Périphérie et je voudrais bien comprendre ce que vous pourriez m’apprendre.</p><p>Autant prétendre être ce qu\'il pense que je suis, ça m\'évitera des questions auxquelles je ne pourrais répondre. Mais il faudra quand même que je me renseigne sur cette Périphérie dont je prétends venir.</p><p>- Bien sûr, avec plaisir ! Comme vous pouvez le voir, la surface est striée de filaments qui semblent onduler et refléter de façon fugace la lumière : ce sont les tubes de transport à grande vitesse. Dans chacun d\'eux circulent des capsules, la plupart monoplace, avec un confort spartiate, mais d\'autres sont bien plus spacieuses et luxueuses. Elles permettent de rallier n\'importe quel point du globe en un peu plus d\'une heure. Mais elles nécessitent une carte spécifique pour pouvoir être empruntées, et ce n\'est pas donné à tout le monde ! Ces chanceux possèdent une carte de couleur orange qui leur permet de faire ces trajets.</p><p>Les personnes n\'ayant pas les moyens d\'en avoir une doivent se contenter d\'un accès Jaune maximum, voire Blanc pour les moins chanceux, et ils circulent dans les tubes inférieurs, sous la surface. Oh, c\'est suffisant pour la plupart d\'entre nous vous savez. Pour aller au travail ou rendre visite à des amis, un accès basique aux transports est tout ce dont nous avons besoin.</p><p>Bien sûr, tout le monde n\'est pas aussi bien loti. Certains vivent sans-carte et doivent emprunter les interminables couloirs du sous-sol. Je vous déconseille vivement de vous y promener, vous risqueriez bien plus que votre argent.</p><p>En tant que touriste, vous n\'aurez que peu l\'occasion de voir le ciel, si ce n\'est en utilisant une des Tours, comme celle-ci. Ce sont nos seuls petits moments d\'échappatoire. En dehors de cela, l\'alternance jour/nuit est maintenue artificiellement sur toute la planète. Il y a des décalages horaires aussi, tout pour que notre physiologie n\'ait pas à souffrir d\'une trop longue absence de nuit ou, au contraire, d\'un trop plein de lumière.</p><p>- Tout ce que vous me décrivez est tellement étrange ! Je n\'avais encore jamais vu une telle planète. C\'est gentil à vous de me la faire découvrir.</p><p>&nbsp; &nbsp;<span style="font-size: 11pt; font-family: Arial; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">- C\'est normal vous savez, j\'ai vécu toute ma vie ici et j\'ai vu défiler pas mal de gens. J\'aime rendre service, et le meilleur moyen que j\'ai trouvé, c\'est de me rendre dans une Tour et distiller mon savoir et mon expérience. C\'est qu\'on s\'y perd très vite quand on n\'a pas l\'habitude !</p><p>- J\'espère ne pas à en faire l\'expérience ! Mais... cela va vous paraître étrange, mais je viens seulement de me rendre compte que je ne connais pas le nom de cette planète ?</p><p>- Vous êtes un drôle de touriste vous dites-donc ! Vous ne savez vraiment pas où vous vous trouvez ?</p><p>- Et bien non en fait. C\'est une longue histoire et je préférerais ne pas en parler. Je ne sais pas non plus combien de temps mes affaires vont me retenir ici, mais j\'aimerais tout de même connaître le nom de l\'endroit que je vais habiter pendant quelques temps.</p><p>- Vous êtes bien mystérieux, vous ! Mais soit, vous vous trouvez sur Trévise, la planète-ville, ou la ville-planète, comme il vous plaira. Mis à part dans les parcs, vous ne trouverez pas un brin d\'herbe sur toute la surface. Quarante milliards de personnes y habitent. Oui oui, je vous assure que ce nombre n\'est pas exagéré, c\'est la population telle qu\'elle a été estimée il y a cinq ans. Car bien sûr, pas moyen de faire un recensement plus fréquent avec autant d\'âmes au mètre carré !</p><p>- Je suppose alors que toutes vos cultures sont hors-sols ?</p><p>&nbsp; -<span style="font-size: 11pt; font-family: Arial; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;"> Bien sûr ! Du moins, pour le peu que nous produisons. Les cultures hydroponiques sont trop peu nombreuses, aussi devons-nous faire appel à de l\'approvisionnement extérieur. En fait, nous avons plusieurs planètes nous fournissant les matières premières et autres denrées nécessaires à notre survie. Ainsi que le recyclage, et tout ce que notre écosystème ne nous permet plus de faire. Nous ne sommes plus autonomes depuis bien longtemps, et sur bien des plans.</p><p>Et ils me laissent me balader au milieu de tout ça, alors que je ne connais rien de cet environnement, de cette culture, de ces gens... J\'ai eu de la chance de tomber sur cet homme trop heureux d\'avoir quelqu\'un avec qui discuter... même si je dois lui paraître totalement idiot avec mes questions.</p>',
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-21 16:42:42',
                'updated_at' => '2019-12-21 21:11:54',
                'deleted_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'story_id' => 2,
                'is_first' => 0,
                'is_last' => 1,
                'title' => 'Et reprehenderit quidem aliquam aut',
                'content' => '<p>Quo mollitia rerum voluptates officia repudiandae optio eum. Autem vero illum corrupti ut. Debitis nemo aut non accusantium est voluptatem qui. Voluptatum et quia perferendis est ex.</p>',
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-21 16:45:24',
                'updated_at' => '2019-12-21 16:45:34',
                'deleted_at' => NULL,
            ),
            5 =>
            array (
                'id' => 6,
                'story_id' => 2,
                'is_first' => 0,
                'is_last' => 0,
                'title' => 'Priorité orange',
                'content' => '<p>- Pouvez-vous m\'en dire plus sur cette carte de priorité Orange ?</p><p>- Bien sûr ! Il faut être né avec une tétine en or dans la bouche pour bénéficier de cette carte !</p><p>Tiens, chez moi on aurait plutôt dit une cuillère...</p><p>- ... ou bien que vous ayez fait fortune, ce qui est encore plus rare. Sur les quarante milliards d\'habitants que compte Trévise, une infime partie est concernée : riches héritiers, petits génies de la finance, personnalités de tous les milieux artistiques ou politiques,...&nbsp;Ils ont besoin d\'être en urgence quelque part ? Orange ! Aucun spatioport n\'est libre ? Un se libère ! Les détenteurs de ces cartes ont priorité sur l\'écrasante majorité des mortels de cette planète !</p><p><br></p>',
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-21 21:14:48',
                'updated_at' => '2019-12-21 21:18:08',
                'deleted_at' => NULL,
            ),
            6 =>
            array (
                'id' => 7,
                'story_id' => 2,
                'is_first' => 0,
                'is_last' => 0,
                'title' => 'Priorité blanche',
                'content' => '<p>- Et la priorité Blanche, à qui est-elle destinée ?</p><p>- Et bien, voyez-vous c\'est un sujet assez sensible. En bref, ces cartes ne donnent qu\'une priorité mineure, tout juste capables de vous faire voyager dans les tubes inférieurs. Leurs détenteurs sont étroitement surveillés. Voyez, sur cette planète, la pauvreté est très mal venue. Aussi, les personnes possédant cette carte sont reconnus en tant que tel, et souvent méprisés. Je n\'en ai jamais vu un seul monter à une Tour, de peur de se faire remarquer je suppose. Pourtant, les Tours sont les seuls endroits qui ne soient pas enterrés et auxquels ces cartes puissent accéder.</p><p>Et bien c\'est mon jour de chance on dirait, heureusement que je n\'ai croisé que peu de gens lors de mon ascension jusqu\'ici. Je vais soigneusement laisser ma carte Blanche cachée au fin fond de ma poche...</p><p>- Comme je vous disais, les Blanches sont surveillées, mais elles servent également de mouchards car elles permettent de géolocaliser précisément son porteur. Bien évidemment peu de gens sont au courant de cette pratique... trop peu éthique.</p><p>- Mais alors, vous, comment êtes-vous au courant de cette pratique ?</p><p>- Parce que j\'y ai travaillé, figurez-vous. Et parce que savoir regarder là où il faut est un don qu\'il faut cultiver pour glaner des informations à côté desquelles le quidam lambda passera sans les voir. Ne faites pas l\'erreur de me prendre pour un fou ou un illuminé, je ne suis rien de tout cela. Je sais ce que j\'avance, je n\'ai pas besoin de plus, je n\'embête personne.</p><p>D\'accord... ça commence à devenir un peu trop n\'importe quoi à mon goût là. Et puis, s\'il a dit vrai... cela veut dire que je risque d\'attirer l\'attention sur lui rien qu\'en étant à côté de lui.</p>',
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-21 21:15:24',
                'updated_at' => '2019-12-21 21:24:39',
                'deleted_at' => NULL,
            ),
            7 =>
            array (
                'id' => 8,
                'story_id' => 2,
                'is_first' => 0,
                'is_last' => 0,
                'title' => 'Prendre congé',
                'content' => '<p>- Merci beaucoup pour toutes ces informations, Monsieur, vous avez été très aimable.</p><p>- Mais au plaisir ! Peut-être à une prochaine fois sur une autre Tour !</p><p>Mais oui mais oui, peut-être...</p>',
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-21 21:24:42',
                'updated_at' => '2019-12-21 21:27:20',
                'deleted_at' => NULL,
            ),
            8 =>
            array (
                'id' => 9,
                'story_id' => 2,
                'is_first' => 0,
                'is_last' => 0,
                'title' => 'En bas de la tour',
                'content' => '<p>Il n\'y a pas plus de monde que tout à l\'heure en bas de la Tour. Je ne sais même pas quelle heure il est, et aucun moyen de me repérer. Cette étoile a une luminosité semblable à celle de mon Soleil, mais il est beaucoup plus gros dans le ciel.</p><p>Tiens ? Je pensais qu\'ils ne se déplaçaient qu\'avec leurs tubes ? J\'ai l\'impression que je distingue une sorte de vaisseau dans le ciel. Trop de luminosité, je n\'arrive pas à voir. Ils n\'ont pas prévu ça au Centre ? De simples lunettes de soleil m\'auraient été bien utiles !</p><p>Je suis complètement paumé dans cette ville, comment est-ce que je vais bien pouvoir découvrir quoi que ce soit en déambulant à l\'aveuglette dans ce dédale ? Le mieux serait que je retourne au Centre et que je leur pose des questions à eux. Après tout, ce sont eux qui m\'ont "recueilli". Ils doivent bien savoir certaines choses...</p>',
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-21 21:27:52',
                'updated_at' => '2019-12-21 21:29:03',
                'deleted_at' => NULL,
            ),
            9 =>
            array (
                'id' => 10,
                'story_id' => 2,
                'is_first' => 0,
                'is_last' => 0,
                'title' => 'A propos du Centre',
                'content' => '<p>S\'il y a bien quelque chose que l\'on n\'a pas rechigné à me dire, c\'est bien ce à quoi servait le Centre.</p><p>D\'abord siège du gouvernement planétaire, puis de la Fédération née de la fusion de plusieurs systèmes stellaires voisins, ce bâtiment a une histoire bien remplie. Mais si j\'en crois mes sources, des laborantins fiers de leur boulot, c\'est au cours de ces dernières siècle que l\'Histoire a été bouleversée, et que, de simple bâtiment administratif, le Centre est devenu actif, le centre névralgique de la recherche scientifique du coin, la Fédération comme ils l\'appellent, quoi que ce puisse représenter.</p><p>Siège de toutes les connaissances, c\'est aussi dans ses murs que se trouve l\'une des bases de données les mieux documentées de la Galaxie. Il paraît qu\'elle contient chaque once de savoir de l\'Humanité depuis la nuit des temps. J\'irais bien y jeter un oeil, par curiosité.</p><p>Dans un registre plus personnel, c\'est ici que je suis né. Symboliquement, bien sûr. C\'est ici que l\'on m\'a sorti du frigo en fait. D\'ailleurs je ne sais toujours pas pourquoi, ni même comment je m\'y suis retrouvé. Je vais devoir cuisiner des gens si je veux avoir des réponses. Et à mon avis, vu l\'empressement qu\'ils ont montré à me jeter dehors ce matin, ce ne sera pas une mince affaire...</p>',
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-21 21:30:32',
                'updated_at' => '2019-12-21 21:31:26',
                'deleted_at' => NULL,
            ),
            10 =>
            array (
                'id' => 11,
                'story_id' => 2,
                'is_first' => 0,
                'is_last' => 0,
                'title' => 'Le responsable de la sécurité du Centre',
                'content' => '<p>- Je crois avoir été assez patient, je suis en droit d\'avoir des réponses sur les circonstances de mon "arrivée" parmi vous.</p><p>Je sens que ce gars va me donner du fil à retordre. Il semble vouloir me cacher des choses, mais je compte bien lui montrer que je peux être coriace moi aussi.</p><p>- Écoutez Monsieur, je ne vous demande pas quelque chose que vous êtes dans l\'impossibilité de me donner, simplement de me dire comment je me suis retrouvé ici, dans ce Centre, alors que j\'étais en plein essai d\'un prototype de vaisseau spatial. Et qui plus est, après au moins plusieurs siècles si j\'en juge par l\'étendue de ce que vous appelez la Fédération. Alors quoi que vous puissiez me dire, je doute que cela me surprenne plus que ce que j\'ai déjà découvert par moi-même.</p><p>- Je suis tout à fait capable de comprendre que vous puissiez avoir des questions à poser, et croyez-moi, nous en avons aussi. Mais pas forcément du même ordre. Mon but, en tant que responsable de la sécurité du Centre, est de protéger ses intérêts de toute menace potentielle, quelle qu\'elle soit. Et croyez-moi, un spationaute débarquant de nulle part à bord d\'un vaisseau antédiluvien est considéré comme une menace potentielle.</p><p>- Comment ça venant de nulle part ? Je viens de la Terre tout de même, le berceau de l\'humanité ! Vous ne pouvez pas prétendre que ce n\'est rien !</p><p>- De la... Terre vous dites ? Le berceau de l\'humanité ? Je ne suis pas sûr de bien comprendre, Monsieur.... ?</p><p>- Appelez-moi [[character_name]], tout simplement.</p><p>- Bien, [[character_name]]. Laissez-moi vous poser une question : vous dites être parti de la Terre il y a peu de temps, bien que vous ignoriez quand exactement, puisqu\'il semblerait que vous vous soyiez évanoui.</p><p>- Rectification grand chef : je sais exactement quand je suis parti : le 12 janvier 2023, huit heures du matin, tapantes. C\'est la durée de mon évanouissement que je ne connais pas. Quel jour sommes-nous ? Suis-je dans un univers parallèle ? Non parce que si c\'est ça, il faut le dire, ça m\'arrangerais. Ça expliquerait tout d\'un coup et je n\'aurais plus ce début de migraine qui me guette à force de chercher une explication à ma situation.</p><p>- Je crains qu\'il vous faille attendre pour obtenir certaines réponses. Je ne suis pas habilité à vous répondre au-delà d\'une certaine limite, et celle-ci a déjà été atteinte.</p><p>- Dites, elle est un peu juste votre limite, non ? J\'ai à peine commencé à réfléchir aux questions que je pourrais vous poser que vous ne pouvez déjà plus répondre ?</p><p>- Désolé [[character_name]], nous allons devoir vous poser des questions avant que nous puissions répondre à certaines des vôtres.</p><p><br></p><p>Ben voyons...</p>',
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2019-12-21 21:32:30',
                'updated_at' => '2020-05-14 03:48:11',
                'deleted_at' => NULL,
            ),
            11 =>
            array (
                'id' => 12,
                'story_id' => 4,
                'is_first' => 1,
                'is_last' => 0,
                'title' => 'Prologue',
                'content' => '<p>Charlie est parti se cacher, et comme d\'hab impossible de le retrouver ! Heureusement,&nbsp; nous sommes en plein confinement, il n\'y aurait donc pas grand-monde sur votre chemin, et il devrait être simple de le trouver avec son pull horrible.</p><p>Mais... il y a l\'air d\'y avoir beaucoup de pièces dans ce manoir, non ?</p>',
                'layout' => NULL,
                'is_checkpoint' => 0,
                'created_at' => '2020-05-09 14:04:38',
                'updated_at' => '2020-05-09 14:07:21',
                'deleted_at' => NULL,
            ),
            13 =>
            array (
                'id' => 14,
                'story_id' => 4,
                'is_first' => 0,
                'is_last' => 0,
                'title' => 'Le hall d\'entrée',
                'content' => '<p>Vraiment impressionnant, il faut bien le dire. Un escalier double se présente devant toi, menant à 4 portes à l\'étage. Deux autres portes imposantes se trouvent à ta gauche et à ta droite. Où veux-tu aller ?</p>',
                'layout' => NULL,
                'is_checkpoint' => 1,
                'created_at' => '2020-05-09 14:49:56',
                'updated_at' => '2020-05-10 07:43:08',
                'deleted_at' => NULL,
            ),
            14 =>
            array (
                'id' => 15,
                'story_id' => 4,
                'is_first' => 0,
                'is_last' => 1,
                'title' => 'Quel courage !',
                'content' => '<p>Bravo, ton courage n\'a pas d\'égal ! Tu sors en courant de la propriété, Charlie ira donc seul sur l\'île enchanteresse où vous deviez vivre comme des rois.</p>',
                'layout' => NULL,
                'is_checkpoint' => 0,
                'created_at' => '2020-05-09 14:50:54',
                'updated_at' => '2020-05-09 14:53:41',
                'deleted_at' => NULL,
            ),
            15 =>
            array (
                'id' => 16,
                'story_id' => 4,
                'is_first' => 0,
                'is_last' => 0,
                'title' => 'La salle de bal',
                'content' => '<p>Une bonne centaine de personnes tiendraient facilement dans cette salle... Mais pour ça, il aurait fallu qu\'elle soit rangée. Pour le moment elle est encombrée d\'un tas d’œuvres d\'art dont la plupart sont recouvertes d\'un drap blanc, tout comme de nombreux meubles.</p><p>Au milieu de tout ce fatras vieillissant tu remarques une petite lumière clignotante qui jure avec le décor. En t\'approchant tu te rends compte qu\'il s\'agit d\'un clavier numérique, probablement pour taper un code.</p>',
                'layout' => NULL,
                'is_checkpoint' => 0,
                'created_at' => '2020-05-10 07:43:13',
                'updated_at' => '2020-05-10 09:03:12',
                'deleted_at' => NULL,
            ),
            16 =>
            array (
                'id' => 17,
                'story_id' => 4,
                'is_first' => 0,
                'is_last' => 0,
                'title' => 'La galerie de portraits',
                'content' => '<p>Tu arrives dans une pièce toute en longueur, dont les murs sont couverts de portraits de gens pas aimables. Tu imagines qu\'il s\'agit des différents propriétaires et de leurs familles, car il doit bien y avoir plusieurs dizaines de tableaux, de différentes époques.</p><p><br></p>
<div class="row"><div class="col-2">
<img src="https://upload.wikimedia.org/wikipedia/commons/3/34/Marin_mersenne.jpg" style="width: 100%">
</div>
<div class="col">
<p>Sous le plus ancien, un peu à part des autres et représentant un moine, se trouve une plaque dorée où est gravé :</p><p>"Marin MERSENNE</p><p>Projet GIMPS</p><p>Merci pour ton M5 !"</p>
</div></div>
<p><br></p><p>Un peu cryptique comme inscription, peut-être qu\'il s\'agit d\'un indice pour une énigme ?</p>',
                'layout' => NULL,
                'is_checkpoint' => 0,
                'created_at' => '2020-05-10 07:43:26',
                'updated_at' => '2020-05-11 11:48:57',
                'deleted_at' => NULL,
            ),
            17 =>
            array (
                'id' => 18,
                'story_id' => 4,
                'is_first' => 0,
                'is_last' => 0,
                'title' => 'Premier étage',
                'content' => '<p>Les 4 portes ont toutes l\'air plus lugubres les unes que les autres, chacune ornée d\'un animal légendaire : une licorne, un dragon, un centaure et un satyre. Bizarrement aucune n\'a de poignée, mais tu remarques à la gauche de chacune d\'elles une petite fente dans laquelle on pourrait glisser une pièce, ou peut-être un médaillon.</p>',
                'layout' => NULL,
                'is_checkpoint' => 0,
                'created_at' => '2020-05-10 07:43:34',
                'updated_at' => '2020-05-10 08:51:11',
                'deleted_at' => NULL,
            ),
            18 =>
            array (
                'id' => 19,
                'story_id' => 4,
                'is_first' => 0,
                'is_last' => 0,
                'title' => 'Chambre licorne',
                'content' => 'Aut eaque fuga harum mollitia iste ullam ut sapiente. Ut ut et molestiae ut necessitatibus. Fugiat quam et voluptatum unde non non.',
                'layout' => NULL,
                'is_checkpoint' => 0,
                'created_at' => '2020-05-10 08:51:14',
                'updated_at' => '2020-05-11 06:26:43',
                'deleted_at' => NULL,
            ),
            19 =>
            array (
                'id' => 20,
                'story_id' => 4,
                'is_first' => 0,
                'is_last' => 0,
                'title' => 'Chambre dragon',
                'content' => 'Laudantium quisquam reiciendis reprehenderit enim sapiente. Quibusdam non consectetur culpa culpa. Voluptatem vel suscipit eaque consectetur accusamus quibusdam.',
                'layout' => NULL,
                'is_checkpoint' => 0,
                'created_at' => '2020-05-10 08:51:32',
                'updated_at' => '2020-05-10 08:51:46',
                'deleted_at' => NULL,
            ),
            20 =>
            array (
                'id' => 21,
                'story_id' => 4,
                'is_first' => 0,
                'is_last' => 0,
                'title' => 'Chambre centaure',
                'content' => 'Perspiciatis optio aut iusto ullam voluptatibus sed minima non. Aut sit non distinctio soluta culpa. Enim qui harum minus quia quaerat distinctio reprehenderit.',
                'layout' => NULL,
                'is_checkpoint' => 0,
                'created_at' => '2020-05-10 08:51:47',
                'updated_at' => '2020-05-11 06:26:38',
                'deleted_at' => NULL,
            ),
            21 =>
            array (
                'id' => 22,
                'story_id' => 4,
                'is_first' => 0,
                'is_last' => 0,
                'title' => 'Chambre satyre',
                'content' => '<p style="text-indent: 28.8px; "><span style="font-size: 14.4px;">La chambre vient visiblement d\'être refaite. Un mur entier est recouvert de feuilles de vignes et un portrait de Dionysos trône juste au-dessus d\'un énorme lit.</span></p><p style="text-indent: 28.8px; "><span style="font-size: 14.4px;">Sur une petite table de chevet est posée une carafe de ce qui semble être du vin. De lourds rideaux ornent les fenêtres et laissent entrer une chaleureuse lumière.</span></p>',
                'layout' => NULL,
                'is_checkpoint' => 0,
                'created_at' => '2020-05-10 08:52:00',
                'updated_at' => '2020-05-11 19:43:35',
                'deleted_at' => NULL,
            ),
            26 =>
            array (
                'id' => 27,
                'story_id' => 4,
                'is_first' => 0,
                'is_last' => 0,
                'title' => 'Rerum ut necessitatibus ratione quibusdam',
                'content' => '<p>Facere qui est voluptatem voluptatem. Eos modi vero corrupti doloremque. Dolor porro harum temporibus voluptas odio distinctio. Sint assumenda modi alias tenetur et.</p>',
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2020-05-11 19:40:43',
                'updated_at' => '2020-05-11 19:40:43',
                'deleted_at' => NULL,
            ),
            27 =>
            array (
                'id' => 28,
                'story_id' => 4,
                'is_first' => 0,
                'is_last' => 0,
                'title' => 'Minima accusamus tenetur quam autem',
                'content' => '<p>Tempore doloribus temporibus consequatur consequatur. Non reprehenderit officia beatae hic voluptatem dolorem. Et deleniti sit qui culpa.</p>',
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2020-05-11 19:42:05',
                'updated_at' => '2020-05-11 19:42:05',
                'deleted_at' => NULL,
            ),
            28 =>
            array (
                'id' => 29,
                'story_id' => 5,
                'is_first' => 1,
                'is_last' => 0,
                'title' => 'Introduction',
                'content' => '<p>L\'aventure commence... Je trouve vraiment ce texte d\'introduction très immersif, ça donne tout de suite le ton de l\'histoire.</p>',
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2020-05-12 11:26:16',
                'updated_at' => '2020-05-12 11:31:30',
                'deleted_at' => NULL,
            ),
            29 =>
            array (
                'id' => 30,
                'story_id' => 5,
                'is_first' => 0,
                'is_last' => 1,
                'title' => 'Un héros à la hauteur',
                'content' => '<p>Je vois que vous êtes un vrai héros !</p>',
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2020-05-12 11:32:56',
                'updated_at' => '2020-05-12 11:36:55',
                'deleted_at' => NULL,
            ),
            30 =>
            array (
                'id' => 31,
                'story_id' => 5,
                'is_first' => 0,
                'is_last' => 1,
                'title' => 'Une poule mouillée sans honneur',
                'content' => 'Je ne demandais pas grand chose, pourtant...',
                'layout' => 'play1',
                'is_checkpoint' => 0,
                'created_at' => '2020-05-12 11:34:36',
                'updated_at' => '2020-05-12 11:36:42',
                'deleted_at' => NULL,
            ),
        ));


    }
}
