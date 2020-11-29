<?php

namespace App\Repositories;

use App\Classes\Constants;
use App\Models\Character;
use App\Models\Choice;
use App\Models\Currency;
use App\Models\Field;
use App\Models\Item;
use App\Models\Page;
use App\Models\Prerequisite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class ChoiceRepository
{
    /**
     * Get all the choices (links to the next page) based on page prerequisites.
     *
     * @param \App\Models\Page      $currentPage
     * @param \App\Models\Character $character
     *
     * @return mixed
     */
    public static function getFilteredChoicesFromPage(Page $currentPage, Character $character)
    {
        $thisRepo = new self;

        // Get all the choices (links to the next page(s)
        $allChoices         = $thisRepo->getAllChoicesForPage($currentPage);
        $finalChoices       = [];
        $unreachableChoices = [];

        // Check if there are prerequisites, and that they are fulfilled
        foreach ($allChoices as $choice) {
            $fulfilled = true;

            $choice->load('pageTo');
            $pageTo = $choice->pageTo;
            $nbPrerequisites = $pageTo->prerequisites()->count();

            if ($pageTo && $nbPrerequisites > 0)
            {
                $nbFulfilledPrerequisites = 0;
                foreach ($pageTo->prerequisites() as $prerequisite)
                {
                    switch (get_class($prerequisite->prerequisiteable)) {
                        case Field::class:
                            $fulfilled = $thisRepo->isStatPrerequisitesFulfilled($prerequisite, $character);
                            break;
                        case Item::class:
                            $fulfilled = $thisRepo->isItemPrerequisitesFulfilled($prerequisite, $character);
                            break;
                        case Currency::class:
                            $fulfilled = $thisRepo->isCurrencyPrerequisitesFulfilled($prerequisite, $character);
                            break;
                    }

                    $nbFulfilledPrerequisites += (int)$fulfilled;
                }

                $fulfilled = $nbFulfilledPrerequisites === $nbPrerequisites;
            }

            if ($fulfilled) {
                $finalChoices[] = $choice;
            } else {
                $unreachableChoices[] = $choice;
            }
        }

        $currentPage->filtered_choices    = $finalChoices;
        $currentPage->unreachable_choices = $unreachableChoices;

        // Log if there is no choice, and the story is not finished
        if (!$currentPage->is_last && count($currentPage->filtered_choices) === 0 && count($currentPage->unreachable_choices) === 0) {
            if (!Auth::user()
                     ->hasRole(Constants::ROLE_ADMIN)) {
                activity()
                    ->performedOn($currentPage)
                    ->useLog('dead_end')
                    ->log('The player has nowhere to go!');
            }
        }
    }

    /**
     * @param Page $page
     *
     * @return mixed
     */
    private function getAllChoicesForPage(Page $page)
    {
        $key = 'choices_' . $page->id;

        return Cache::remember($key, Config::get('app.story.cache_ttl'), function () use ($page, $key) {
            return Choice::where('page_from', $page->id)
                         ->get();
        }
        );
    }

    /**
     * @param \App\Models\Prerequisite $prerequisite
     * @param \App\Models\Character    $character
     *
     * @return bool
     */
    private function isStatPrerequisitesFulfilled(Prerequisite $prerequisite, Character $character): bool
    {
        foreach ($character->fields as $field) {
            if ($field->name === $prerequisite->prerequisiteable->name
                    && Prerequisite::isFulfilled($field->pivot->value, $prerequisite->operator, $prerequisite->quantity)) {
                return true;
            }
        }

        return false;
    }

    private function isItemPrerequisitesFulfilled(Prerequisite $prerequisite, Character $character): bool
    {
        foreach ($character->items as $item) {
            if ($item->id === $prerequisite->prerequisiteable->id
                    && Prerequisite::isFulfilled($item->pivot->quantity, $prerequisite->operator, $prerequisite->quantity)) {
                return true;
            }
        }

        return false;
    }

    private function isCurrencyPrerequisitesFulfilled($prerequisite, Character $character): bool
    {
        return Prerequisite::isFulfilled($character->money, $prerequisite->operator, $prerequisite->quantity);
    }
}
