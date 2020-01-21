<?php

namespace App\Presenters;

use App\Models\Character;
use Illuminate\Support\Facades\Auth;
use Laracasts\Presenter\Presenter;

class PagePresenter extends Presenter
{
    public function content()
    {
        $character = Character::where([
            'story_id' => getSession('story_id'),
            'user_id' => Auth::id(),
        ])->firstOrFail();

        // List of all placeholders
        $placeholders = [
            'character_name' => $character->name,
        ];
        $content = null;

        foreach ($placeholders as $key => $placeholder) {
            $content = str_replace('[[' . $key . ']]', $placeholder, $this->entity->content);
        }

        return $content;
    }
}
