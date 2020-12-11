<?php

namespace App\Classes;

class Constants
{
    public const ENDING_TYPE_GOOD  = 'good';
    public const ENDING_TYPE_BAD   = 'bad';
    public const ENDING_TYPE_DEATH = 'death';

    public const GENRE_MALE   = 'male';
    public const GENRE_FEMALE = 'female';
    public const GENRE_BOTH   = 'both';

    public const ROLE_ADMIN = 'admin';
    public const ROLE_DEVELOPER = 'developer';
    public const ROLE_MODERATOR = 'moderator';
    public const ROLE_MEMBER = 'member';
    public const ROLE_TEMPORARY = 'temp';

    public const AUTHOR = 'author';

    public const FUNCTIONS_LIST = [
        'genre',
        'if',
        'random',
        'reverse',
        'stutter',
    ];

    public const METHODS_LIST = [
        'genre',
        'if',
        'random',
        'reverse',
        'stutter',
        'variable'
    ];
}
