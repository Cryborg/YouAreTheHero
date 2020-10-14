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


/**
 * @param string $key
 * @param        $value
 */
function setSession(string $key, $value): void
{
    $actualStorySession = collect(Session::get('story'));

    $newValue = collect([
        $key => $value,
    ]);

    Session::put([
        'story' => $actualStorySession->merge($newValue),
    ]);
}

/**
 * @param string $key
 *
 * @return array|string
 */
function getSession(string $key = null)
{
    $actualStorySession = Session::get('story');

    if ($key === null) {
        return $actualStorySession;
    }

    if ($actualStorySession) {
        return $actualStorySession[$key] ?? null;
    }

    return [];
}

function unsetSession()
{
    Session::remove('story');
}
