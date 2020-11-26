<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class HelpBlock extends Component
{
    protected $user;
    public $help;

    /**
     * Create a new component instance.
     *
     * @param string $help
     */
    public function __construct(string $help)
    {
        $this->user = Auth::user();
        $this->help = $help;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        if ($this->user->show_help) {
            return view('components.help-block');
        }

        return '';
    }
}
