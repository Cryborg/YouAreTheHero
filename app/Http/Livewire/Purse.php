<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Purse extends Component
{
    public $character;
    public $money;

    protected $listeners = ['money_change' => 'render'];

    public function render()
    {
        return view('livewire.purse');
    }
}
