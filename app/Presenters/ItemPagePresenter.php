<?php

namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class ItemPagePresenter extends Presenter
{
    public function verb()
    {
        return trans('actions.' . $this->entity->verb);
    }
}
