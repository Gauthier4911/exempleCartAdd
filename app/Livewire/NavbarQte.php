<?php

namespace App\Livewire;

use Livewire\Component;

class NavbarQte extends Component
{
    public $totalQuantity = 0;

    protected $listeners = ['cartUpdated' => 'updateTotalQuantity'];

    public function mount()
    {
        $this->updateTotalQuantity();
    }

    public function updateTotalQuantity()
    {
        $this->totalQuantity = count(session()->get('cart', []));
    }

    public function render()
    {
        return view('livewire.navbar-qte');
    }
}
