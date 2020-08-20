<?php

namespace App\Presenters;

use App\Classes\Action;
use App\Models\Character;
use Illuminate\Support\Facades\Auth;
use Laracasts\Presenter\Presenter;

class PagePresenter extends Presenter
{
    public function content()
    {
        $characterName = null;
        $characterId = getSession('character_id');

        if (empty($characterId)) {
            $characterName = 'NomDuPersonnage';
        } else {
            $character = Character::where('id', $characterId)->first();

            if ($character) {
                $characterName = $character->name;
            }
        }

        // List of all placeholders
        // FIXME: factorize this, for the moment it is set in PageController
        $placeholders = [
            'character_name' => $characterName,
        ];
        $content = null;

        foreach ($placeholders as $key => $placeholder) {
            $content = str_replace('[[' . $key . ']]', $placeholder, $this->entity->content);
        }

        $this->entity->content = $content;

        // Methods to run on a part of the text.
        //  For example : stutter[Bouh] will display something like 'B...B...Bouh'
        $methods = [
            'stutter'
        ];
        $content = null;

        foreach ($methods as $method) {
            $pattern = $method . '\[([^\]]*)\]';
            preg_match_all('/' . $pattern . '/', $this->entity->content, $matches, PREG_SET_ORDER);

            foreach ($matches as $match) {
                $this->entity->content = str_replace($match[0], Action::$method($match[1]), $this->entity->content);
            }
        }

        // Check if there are some other placeholders, such as Descriptions
        if ($this->entity->descriptions()->count() > 0) {
            foreach ($this->entity->descriptions as $description)
            {
                $replacementText = '<a tabindex="0" role="button" data-trigger="hover" data-placement="top" data-toggle="popover" title="'
                                   . $description->keyword . '" data-content="' . htmlentities($description->description)
                                   . '"><span class="icon-eye text-lightgrey mr-1"></span>' . $description->keyword . '</a>';
                $this->entity->content = str_replace('{{' . $description->keyword . '}}', $replacementText, $this->entity->content);
            }
        }

        return $this->entity->content;
    }

    public function short_content()
    {
        // Only show the first characters of the page, between <p></p>
        $pContent = $this->get_string_between($this->entity->content, '<p>', '</p>');
        $content = mb_strlen($pContent) > 200 ? mb_substr($pContent, 0, 200) . '...' : $pContent;

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
