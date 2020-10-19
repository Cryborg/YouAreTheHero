<?php

namespace App\Presenters;

use App\Traits\TextModifiers;
use Laracasts\Presenter\Presenter;

class ChoicePresenter extends Presenter
{
    use TextModifiers;

    /**
     * Modify the link text
     *
     * @return mixed
     */
    public function link_text()
    {
        return $this->getModifiedText($this->entity, 'link_text');
    }
}
