<?php

namespace App\View\Components;

use App\Models\Story;
use Illuminate\View\Component;

class RateStory extends Component
{
    public $story;

    /**
     * Create a new component instance.
     *
     * @param \App\Models\Story $story
     */
    public function __construct(Story $story)
    {
        $this->story = $story;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.rate-story');
    }
}
