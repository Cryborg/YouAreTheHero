<?php

return [
    'label' => 'Fonctions',
    'help' => 'Insère des fonctions dans le texte afin de le modifier.',

    'genre' => [
        'label' => 'Genre',
        'syntax' => 'genre[masculin|féminin]',
        'help' => 'Permet de conjuguer une phrase selon le genre du personnage principal d\'une histoire.',
        'errors' => [
            'parameters' => 'genre[] doit avoir exactement 2 paramètres'
        ]
    ],
    'if' => [
        'label' => 'Condition',
        'syntax' => 'if[condition|vrai|faux]',
        'help' => 'Si la condition est remplie, écrire le bloc *vrai*. Sinon, écrire le bloc *faux*',
    ],
    'random' => [
        'label' => 'Aléatoire',
        'syntax' => 'random[valeur1|valeur2|...]',
        'help' => 'Tire un mot au hasard dans la liste fournie, ou un nombre entre valeur1 et valeur2.',
    ],
    'reverse' => [
        'label' => 'Ecrire à l\'envers',
        'syntax' => 'reverse[mot]',
        'help' => 'Ecrit les lettres du mot de droite à gauche',
    ],
    'stutter' => [
        'label' => 'Bégaiement',
        'syntax' => 'stutter[mot]',
        'help' => 'Ecrit le mot comme s\'il avait été prononcé en bégayant.',
    ],
];
