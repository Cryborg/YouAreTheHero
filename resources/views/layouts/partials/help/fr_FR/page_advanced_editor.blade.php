<h3>Insérer des variables</h3>

<div class="ml-4 justify-content-end">
    <p>
        Il permet également d'insérer des variables, comme le nom du personnage par exemple. Pour cela, il faut que l'option soit sélectionnée
        dans les paramètres de l'histoire. Ensuite, en cliquant sur le bouton @editorbutton(Variables) de l'éditeur, sélectionne "Personnage principal" pour insérer
        "[[character_name]]" dans ton texte, à l'endroit où le nom doit être écrit. Ainsi, le texte suivant :
    </p>
    <div class="example text-monospace">
        Bonjour [[character_name]] !
    </div>
    <div>
        Deviendra :
    </div>
    <div class="example">
        Bonjour {{ Auth::user()->username }} !
    </div>
    <div>
        si le joueur a choisi de nommer son personnage <b>{{ Auth::user()->username }}</b> bien sûr :)
    </div>
</div>

<h3>Insérer une commande</h3>

<div class="ml-4 justify-content-end">
    <h4><i>stutter[&lt;mot à bégayer&gt;]</i> (bégayer)</h4>
    <div class="ml-4 justify-content-end">
        <div class="example text-monospace">
            # Editeur<br>
            Bonjour stutter[Monsieur], stutter[comment] allez-vous ?<br>
            <br>
            # Résultat<br>
            Bonjour M...Monsieur, c...c...comment allez-vous ?
        </div>
    </div>

    <h4><i>genre[&lt;masculin&gt;|&lt;féminin&gt;]</i> (genre du personnage)</h4>
    <div class="ml-4 justify-content-end">
        <p>
            En créant une histoire, tu as la possibilité de choisir le sexe du personnage principal. Si tu le fais, les joueurs
            n'auront pas d'autre choix que de créer un personnage de ce sexe.
        </p>
        <p>
            En revanche si tu choisis de leur laisser le choix il faut bien que ton texte le reflète dans la conjugaison, voire
            dans certains mots. Prenons un exemple concret.
        </p>
        <div class="example text-monospace">
            # Editeur<br>
            Es-tu genre[content|contente] de genre[ton costard|ta robe] ?
        </div>
        <p>
            Si le joueur a fait de son personnage principal un homme, cela donnera :
        </p>
        <div class="example text-monospace">
            Es-tu content de ton costard ?
        </div>
        <p>
            En revanche, s'il a choisi une femme :
        </p>
        <div class="example text-monospace">
            Es-tu contente de ta robe ?
        </div>
    </div>

    <h4><i>reverse[&lt;mot à écrire à l'envers&gt;]</i> (Ecrire à l'envers)</h4>
    <div class="ml-4 justify-content-end">
        <div class="example text-monospace">
            # Editeur<br>
            Dans le miroir Monsieur donne reverse[Monsieur].<br>
            <br>
            # Résultat<br>
            Dans le miroir Monsieur donne rueisnoM.
        </div>
    </div>

    <h4><i>random[&lt;terme1|terme2...&gt;]</i> (Choisir un nombre ou une chaîne de caractère au hasard)</h4>
    <div class="ml-4 justify-content-end">
        <div class="example text-monospace">
            # Editeur<br>
            Tu lances le dé. Dommage, un random[1|6].<br>
            Il faut croire que random[ta patte de lapin|ton chapeau de cow-boy|ton caleçon troué] porte-bonheur n'agit plus...<br>
            <br>
            # Résultat<br>
            Tu lances le dé. Dommage, un 4.<br>
            Il faut croire que ton chapeau de cow-boy porte-bonheur n'agit plus...
        </div>
    </div>

    <h4><i>if[&lt;variable/opérateur/valeur|afficher si vrai|afficher si faux&gt;]</i> (Conditionner un affichage)</h4>
    <div class="ml-4 justify-content-end">
        Opérateurs disponibles :<br>
        <ul>
            <li>>= : supérieur ou égal</li>
            <li><= : inférieur ou égal</li>
            <li>= : strictement égal</li>
        </ul>
        <div class="example text-monospace">
            # Editeur<br>
            if[Force>=3|Tu es très fort !|Dommage mauviette !]<br>
            <br>
            # Résultat si la Force du personnage est >= 3<br>
            Tu es très fort !<br>
            <br>
            # Résultat si la Force du personnage est < 3<br>
            Dommage mauviette !
        </div>
    </div>
</div>

<h3>Insérer des descriptions</h3>

<div class="ml-4 justify-content-end">
    <p>
        Le bouton @editorbutton(Descriptions) de l'éditeur permet d'afficher une petite fenêtre de description sur certains termes du texte.
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

    <h4>Comment ajouter cela dans mon texte ?</h4>

    <p>
        Pour ajouter ce genre d'effet, écris ton texte normalement. Puis, une fois terminé, clique sur le bouton @editorbutton(Descriptions) de l'éditeur. Dans le champ "Mot(s)-clé"
        se trouvera "une lampe", pour reprendre notre exemple précédent. Et dans la Description, tu trouveras un éditeur allégé permettant d'écrire
        le descriptif du mot-clé.
    </p>

    <p>
        Enfin, une fois ceci fait et la fenêtre de création fermée, tu n'as plus qu'à entourer ton mot-clé dans ton texte ("une lampe")
        avec des doubles accolades : <code>&#123;&#123;une lampe&#125;&#125;</code>.
    </p>

    <p>Ainsi, l'exemple précédent sera écrit de cette manière :</p>

    <div class="example">
        Au fond de la pièce se trouve un bureau sur lequel trône &#123;&#123;une lampe&#125;&#125;, éclairant un poste de travail particulièrement bien rangé.
        Même &#123;&#123;la corbeille à papier&#125;&#125; semble neuve, tant elle est propre.
    </div>

</div>
