<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Inventory extends Component
{
    public $items;

    protected $listeners = ['inventory_change' => 'render'];

    public function render()
    {
        return view('livewire.inventory');
    }
}
