<h3>Insérer des variables</h3>

<p>
    Il permet également d'insérer des variables, comme le nom du personnage par exemple. Pour cela, il faut que l'option soit sélectionnée
    dans les paramètres de l'histoire. Ensuite, en cliquant sur le bouton @editorbutton(Variables) de l'éditeur, sélectionne Nom du personnage pour insérer
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
    si le joueur a choisi de nommer son personnage <b>{{ Auth::user()->username }}</b> bien sûr :)
</div>

<h3>Insérer des descriptions</h3>

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
<p>
    Pour ajouter ce genre d'effet, écris ton texte normalement. Puis, une fois terminé, clique sur le bouton @editorbutton(Descriptions) de l'éditeur. Dans le champ "Mot(s)-clé"
    se trouvera "une lampe", pour reprendre notre exemple précédent. Et dans la Description, tu trouveras un éditeur allégé permettant d'écrire
    le descriptif du mot-clé.
</p>
