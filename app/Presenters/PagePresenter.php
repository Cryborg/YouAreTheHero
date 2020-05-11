<?php

namespace App\Presenters;

use App\Models\Character;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laracasts\Presenter\Presenter;

class PagePresenter extends Presenter
{
    public function content()
    {
        $routeName = Route::currentRouteName();

        if ($routeName === 'story.play') {
            $character = Character::where([
                'story_id' => getSession('story_id'),
                'user_id' => Auth::id(),
            ])->firstOrFail();

            // List of all placeholders
            // FIXME: factorize this, for the moment the other is set in PageController
            $placeholders = [
                'character_name' => $character->name,
            ];
            $content      = null;

            foreach ($placeholders as $key => $placeholder) {
                $content = str_replace('[[' . $key . ']]', $placeholder, $this->entity->content);
            }
        } else {
            // Only show the first characters of the page, between <p></p>
            $pContent = $this->get_string_between($this->entity->content, '<p>', '</p>');
            $content = mb_strlen($pContent) > 200 ? mb_substr($pContent, 0, 200) . '...' : $pContent;
        }

        return $content;
    }

    private function get_string_between($string, $start, $end)
    {
        $string = " " . $string;
        $ini    = strpos($string, $start);
        if ($ini == 0) {
            return "";
        }
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }
}
