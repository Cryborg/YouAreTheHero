<?php

namespace App\View\Components;

use App\Models\Page;
use Illuminate\View\Component;

class ResetButton extends Component
{
    public $page;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.reset-button');
    }
}
