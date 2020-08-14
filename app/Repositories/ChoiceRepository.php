<?php

namespace App\Repositories;

use App\Models\Character;
use App\Models\CharacterField;
use App\Models\Choice;
use App\Models\Field;
use App\Models\Item;
use App\Models\Page;
use App\Models\Prerequisite;
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
            $fulfilled = false;

            $choice->load('pageTo');
            $pageTo = $choice->pageTo;

            if ($pageTo && $pageTo->prerequisites()
                                  ->count() > 0) {
                foreach ($pageTo->prerequisites() as $prerequisite) {
                    switch (get_class($prerequisite->prerequisiteable)) {
                        case Field::class:
                            $fulfilled = $thisRepo->isStatPrerequisitesFulfilled($prerequisite, $character);
                            break;
                        case Item::class:
                            $fulfilled = $thisRepo->isItemPrerequisitesFulfilled($prerequisite->prerequisiteable, $character);
                            break;
                    }
                }
            } else {
                $fulfilled = true;
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
        if (!$currentPage->is_last && count($currentPage->filtered_choices) === 0) {
            activity()
                ->performedOn($currentPage)
                ->useLog('dead_end')
                ->log('The player has nowhere to go!');
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
     * @param \App\Models\Prerequisite   $prerequisite
     * @param \App\Models\Character      $character
     *
     * @return bool
     */
    private function isStatPrerequisitesFulfilled(Prerequisite $prerequisite, Character $character): bool
    {
        foreach ($character->fields as $field) {
            if ($field->name === $prerequisite->prerequisiteable->name && $field->pivot->value >= $prerequisite->quantity) {
                return true;
            }
        }

        return false;
    }

    private function isItemPrerequisitesFulfilled(Item $requiredItem, Character $character): bool
    {
        foreach ($character->items as $item) {
            if ($item->id === $requiredItem->id) {
                return true;
            }
        }

        return false;
    }
}
