<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use \Illuminate\Support\Facades\Cache;

function getLanguages()
{
    return Cache::remember('app_languages', 3628800, function() {
        $languages = [];

        foreach (Config::get('app.languages') as $lang) {
            $languages[$lang] = trans('common.' . $lang);
        }

        return $languages;
    });
}
