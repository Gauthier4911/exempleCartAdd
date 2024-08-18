<?php

namespace App\Livewire;

use App\Models\Products;
use Livewire\Component;


class AddToCart extends Component
{
    public $cart = [];
    public $totalQuantity = 0;

    public function mount()
    {
        $this->cart = session()->get('cart', []);
        $this->calculateTotalQuantity();
    }

    public function addToCart($productId)
    {
        $product = Products::find($productId);

        if (!$product) {
            return;
        }

        if (isset($this->cart[$productId])) {
            $this->cart[$productId]['quantity']++;
        } else {
            $this->cart[$productId] = [
                "product" => $product,
                "quantity" => 1
            ];
        }

        session()->put('cart', $this->cart);
        $this->calculateTotalQuantity();

    }

    public function calculateTotalQuantity()
    {
        $this->totalQuantity = array_sum(array_column($this->cart, 'quantity'));
    }

    public function render()
    {
        return view('livewire.add-to-cart', [
            'products' => Products::all(),
            'totalQuantity' => $this->totalQuantity,
        ]);
    }
}
