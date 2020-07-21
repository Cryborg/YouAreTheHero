<div class="card">
    <div class="card-header">
        <h2>@lang('help.editor_title')</h2>
    </div>
    <div class="card-body">
        <h3>Insérer des variables</h3>

        <p>
            Il permet également d'insérer des variables, comme le nom du personnage par exemple. Pour cela, il faut que l'option soit sélectionnée
            dans les paramètres de l'histoire. Ensuite, en cliquant sur le bouton Variables de l'éditeur, sélectionne Nom du personnage pour insérer
            "[[character_name]]" dans ton texte, à l'endroit où le nom doit être écrit. Ainsi, le texte suivant :
        </p>
        <div class="example">
            Bonjour [[character_name]] !
        </div>
        <div>
            Deviendra :
        </div>
        <div class="example">
            Bonjour {{ Auth::user()->username }} !
        </div>
        <div>
            si le joueur a choisi de nommer son personnage <b>{{ Auth::user()->username }}</b> bien sûr.
        </div>

        <h3>Insérer des descriptions</h3>

        <p>
            Le bouton Descriptions de l'éditeur permet d'afficher une petite fenêtre de description sur certains termes du texte.
            Cela peut être particulièrement utile pour afficher plus d'informations sur un objet présent dans une pièce, sans avoir
            besoin de créer un lien vers une nouvelle page. Prenons un exemple tout simple :
        </p>
        <div class="example">
            Au fond de la pièce se trouve un bureau sur lequel trône <a tabindex="0" role="button" data-trigger="hover" data-placement="top" data-toggle="popover" title="" data-content="<p>Elle ressemble à celle de Pixar. Sûrement un fan.</p>" data-original-title="une lampe"><span class="icon-eye text-lightgrey mr-1"></span>une lampe</a>, éclairant un poste de travail particulièrement bien rangé.
            Même <a tabindex="0" role="button" data-trigger="hover" data-placement="top" data-toggle="popover" title="" data-content="<p>Au fond de la corbeille se trouve un papier chiffonné. En l'examinant tu remarques des petits dessins qui te rappellent tes cours de géométrie du collège.</p>" data-original-title="la corbeille à papier"><span class="icon-eye text-lightgrey mr-1"></span>la corbeille à papier</a> semble neuve, tant elle est propre.
        </div>
        <p>
            Tu remarqueras que les mots "une lampe" et "la corbeille à papier" sont précédés d'un petit icône. Lorsque tu passeras ta souris dessus,
            un court descriptif s'affichera.
        </p>
        <p>
            Pour ajouter ce genre d'effet, écris ton texte normalement. Puis, une fois terminé, clique sur le bouton Descriptions. Dans le champ "Mot(s)-clé"
            se trouvera "une lampe", pour reprendre notre exemple précédent. Et dans la Description, tu trouveras un éditeur allégé permettant d'écrire
            le descriptif du mot-clé.
        </p>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2>@lang('help.gameplay_title')</h2>
    </div>
    <div class="card-body">
        <p>
            Dans l'onglet Options situé en haut du graphique tu vas pouvoir ajouter des objets, énigmes et autres prérequis à tes pages.
        </p>

        <h3>Ajout d'objets</h3>

        <p>
            Clique sur le bouton <button class="btn btn-primary btn-sm text-white"><span class="icon-chest mr-2 text-white"></span>Ajouter un objet</button> dans la page pour accéder aux options disponibles. Le premier onglet Objet existant te permet de choisir
            un objet qui a déjà été créé pour cette histoire. S'il n'y en a aucun, passe à la partie suivante.
        </p>
        <p>
            Sélectionne l'objet que tu veux insérer sur la page, ainsi que la quantité, puis le prix. Lorsque le joueur cliquera sur l'objet,
            il l'achètera un par un au prix indiqué. Le prix peut être à zéro bien sûr, dans le cas où l'objet est ramassé par exemple, ou donné
            par un <a tabindex="0" role="button" data-trigger="hover" data-placement="top" data-toggle="popover" title="" data-content="<b>P</b>ersonnage <b>N</b>on <b>J</b>oueur. Personnage qui n'est pas contrôlé par un joueur." data-original-title="PNJ"><span class="icon-eye text-lightgrey mr-1"></span>PNJ</a>.
        </p>

        <h3>Ajout d'un prérequis</h3>

        <p>
            Il peut parfois être utile de ne pouvoir accéder à une page que si le joueur possède un objet en particulier, comme une clé. Clique sur
            <button class="btn btn-primary btn-sm text-white"><span class="icon-unlocking mr-2 text-white"></span>Ajouter un objet</button> pour afficher
            ce popup.
        </p>
        <p>
            Tu peux ici choisir quel objet doit être présent dans l'inventaire, et la quantité que le joueur doit posséder. Car, si une seule clé
            est en général nécessaire pour ouvrir une porte, il peut être nécessaire de posséder plusieurs pièces d'or pour payer le garde interdisant
            le passage d'un pont.
        </p>

        <h3>Ajout d'un bonus / malus</h3>

        <p>
            Certaines aventures ne sont pas de tout repos. Imaginons que le joueur arrive sur une page dans laquelle il tombe dans un piège. Il perdra peut-être
            un point de santé, et sera délesté de ses plus belles pièces d'équipement par les bandits ayant tendu ce piège. C'est en cliquant sur le bouton
            <button class="btn btn-primary btn-sm text-white"><span class="icon-unlocking mr-2 text-white"></span>Ajouter un bonus / malus</button> que tu vas pouvoir
            gérer cette situation.
        </p>

        <h3>Ajout d'une énigme</h3>

        <p>
            Que ce soit un coffre-fort dont il faut entrer la combinaison, ou un mot de passe à entrer sur un ordinateur, l'option
            <button class="btn btn-primary btn-sm text-white"><span class="icon-jigsaw-piece mr-2 text-white"></span>Ajouter une énigme</button>
            est là pour ça.
        </p>
        <p>
            Indique quelle sera la réponse et choisis l'objet à gagner. Tu peux également indiquer si tu veux que le joueur soit dirigé vers une page existante
            une fois qu'il a résolu l'énigme.
        </p>
    </div>
</div>
