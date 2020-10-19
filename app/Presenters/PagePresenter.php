<?php

namespace App\Presenters;

use App\Traits\TextModifiers;
use Laracasts\Presenter\Presenter;

class PagePresenter extends Presenter
{
    use TextModifiers;

    /**
     * Modify the content
     *
     * @return mixed
     */
    public function content()
    {
        $this->getModifiedText($this->entity, 'content');

        return $this->getWithDescriptions($this->entity, 'content');
    }

    /**
     * Modify the title
     *
     * @return mixed
     */
    public function title()
    {
        return $this->getModifiedText($this->entity, 'title');
    }
}
