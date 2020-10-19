<?php

namespace App\Traits;

use App\Classes\Action;
use App\Models\Character;
use App\Models\CharacterPerson;
use App\Models\Person;
use App\Models\Story;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait TextModifiers
{
    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string                              $field
     *
     * @return mixed
     */
    public function getModifiedText(Model $model, string $field)
    {
        $characterName = null;
        $characterId = getSession('character_id');
        $storyId = getSession('story_id');
        $story = Story::where('id', $storyId)->first();
        $character = null;

        if (empty($characterId)) {
            $characterName = Auth::user()->first_name;

            if (empty(Auth::user()->first_name)) {
                $characterName = 'Barbapapa';
            }
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

        $story->people()->each(function ($person) use (&$placeholders, $character) {
            $placeholders['person.' . $person->order . '.firstname'] = $this->getPersonName($person, $character)->first_name;
            $placeholders['person.' . $person->order . '.lastname'] = $this->getPersonName($person, $character)->last_name;
            $placeholders['person.' . $person->order . '.fullname'] = $person->first_name . ' ' . $person->last_name;
            $placeholders['person.' . $person->order . '.role'] = $person->role;
        });

        foreach ($placeholders as $key => $placeholder) {
            $model->$field = str_replace('[[' . $key . ']]', $placeholder, $model->$field);
        }

        // Methods to run on a part of the text.
        //  For example : stutter[Bouh] will display something like 'B...B...Bouh'
        //                genre[un homme|une femme] affichera le texte correspondant [au genre masculin|au genre féminin]
        $methods = [
            'stutter',
            'genre'
        ];

        foreach ($methods as $method) {
            $pattern = $method . '\[([^\]]*)\]';
            preg_match_all('/' . $pattern . '/', $model->$field, $matches, PREG_SET_ORDER);

            foreach ($matches as $match) {
                $model->$field = str_replace($match[0], Action::$method($match[1]), $model->$field);
            }
        }

        return $model->$field;
    }

    public function getWithDescriptions(Model $model, string $field)
    {
        // Check if there are some other placeholders, such as Descriptions
        if ($model->descriptions()->count() > 0) {
            foreach ($model->descriptions as $description)
            {
                $replacementText = '<a tabindex="0" role="button" data-trigger="hover" data-placement="top" data-toggle="popover" title="'
                                   . $description->keyword . '" data-content="' . htmlentities($description->description)
                                   . '"><span class="icon-eye text-lightgrey mr-1"></span>' . $description->keyword . '</a>';
                $model->$field = str_replace('{{' . $description->keyword . '}}', $replacementText, $model->$field);
            }
        }

        return $model->$field;
    }

    /**
     * Returns the name of the character: either the one set by the author, or the overriden one given by the player
     *
     * @param \App\Models\Person $person
     * @param null               $character
     */
    private function getPersonName(Person $person, $character = null)
    {
        if ($character !== null) {
            $character->load('people');
            $customPerson = CharacterPerson::where('person_id', $person->id)
                                           ->where('character_id', $character->id)
                                           ->first();

            if ($customPerson) {
                return $customPerson;
            }
        }

        return $person;
    }
}
