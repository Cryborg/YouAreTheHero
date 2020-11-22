<?php

return [
    'label' => 'Functions',
    'help' => 'Insère des fonctions dans le texte afin de le modifier.',

    'genre' => [
        'label' => 'Genre',
        'syntax' => 'genre[male|female]',
        'help' => 'Permet de conjuguer une phrase selon le genre du personnage principal d\'une histoire.',
    ],
    'if' => [
        'label' => 'Condition',
        'syntax' => 'if[condition|true|false]',
        'help' => 'Si la condition est remplie, écrire le bloc *vrai*. Sinon, écrire le bloc *faux*',
    ],
    'random' => [
        'label' => 'Random',
        'syntax' => 'random[value1|value2|...]',
        'help' => 'Tire un mot au hasard dans la liste fournie, ou un nombre entre valeur1 et valeur2.',
    ],
    'reverse' => [
        'label' => 'Reverse string',
        'syntax' => 'reverse[word]',
        'help' => 'Ecrit les lettres du mot de droite à gauche',
    ],
    'stutter' => [
        'label' => 'Stutter',
        'syntax' => 'stutter[word]',
        'help' => 'Ecrit le mot comme s\'il avait été prononcé en bégayant.',
    ],
];
