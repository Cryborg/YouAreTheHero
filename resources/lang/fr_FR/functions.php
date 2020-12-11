<?php

return [
    'label' => 'Fonctions',
    'help' => 'Insère des fonctions dans le texte afin de le modifier.',

    'genre' => [
        'errors' => [
            'parameters' => 'genre[] doit avoir exactement 2 paramètres'
        ],
        'example' => 'genre[ féminin | masculin ]',
        'help' => 'Permet de conjuguer une phrase selon le genre du personnage principal d\'une histoire.',
        'label' => 'Genre',
        'syntax' => 'genre[masculin|féminin]',
    ],
    'if' => [
        'example' => 'if[ vrai | faux ]',
        'label' => 'Condition',
        'syntax' => 'if[condition|vrai|faux]',
        'help' => 'Si la condition est remplie, écrire le bloc *vrai*. Sinon, écrire le bloc *faux*',
    ],
    'random' => [
        'example' => 'random[ 1 | 6 ]',
        'label' => 'Aléatoire',
        'syntax' => 'random[valeur1|valeur2|...]',
        'help' => 'Tire un mot au hasard dans la liste fournie, ou un nombre entre valeur1 et valeur2.',
    ],
    'reverse' => [
        'example' => 'reverse[ héros ]',
        'label' => 'Ecrire à l\'envers',
        'syntax' => 'reverse[mot]',
        'help' => 'Ecrit les lettres du mot de droite à gauche',
    ],
    'stutter' => [
        'example' => 'stutter[ Bonjour ]',
        'label' => 'Bégaiement',
        'syntax' => 'stutter[mot]',
        'help' => 'Ecrit le mot comme s\'il avait été prononcé en bégayant.',
    ],
];
