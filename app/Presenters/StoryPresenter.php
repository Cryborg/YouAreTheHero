<?php

namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class StoryPresenter extends Presenter
{
    public function language()
    {
        return trans('common.' . $this->entity->locale);
    }
}
