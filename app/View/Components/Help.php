<?php

namespace App\View\Components;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

class Help extends Component
{
    private $page;

    /**
     * Create a new component instance.
     *
     * @param string $page
     */
    public function __construct(string $page)
    {
        $this->page = $page;
    }

    /**
     * Get help according to the app's language
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $userLanguage = App::getLocale();
        $layout = 'layouts.partials.help.' . $userLanguage . '.' . $this->page;

        if (View::exists($layout)) {
            return view($layout);
        }

        return view('layouts.partials.help.' . App::getFallbackLocale() . '.' . $this->page);
    }
}
