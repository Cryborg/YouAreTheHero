<?php

namespace App\Presenters;

use App\Models\Character;
use Illuminate\Support\Facades\Auth;
use Laracasts\Presenter\Presenter;

class PagePresenter extends Presenter
{
    public function content()
    {
        $storyId = getSession('story_id');

        if (!empty($storyId)) {
            $character = Character::where([
                'story_id' => getSession('story_id'),
                'user_id' => Auth::id(),
            ])->first();

            // List of all placeholders
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
