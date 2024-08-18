<?php

namespace App\Livewire;

use Livewire\Component;

class CartComponent extends Component
{
    public $cart;

    public function mount()
    {
        $this->cart = session()->get('cart', []);
    }

    public function updateQuantity($productId, $change)
    {
        foreach ($this->cart as &$item) {
            if ($item['product']->id == $productId) {
                $item['quantity'] += $change;

                // Ensure quantity doesn't go below 1
                if ($item['quantity'] < 1) {
                    $item['quantity'] = 1;
                }

                // Update session
                session()->put('cart', $this->cart);
                break;
            }
        }
    }

    public function removeFromCart($productId)
    {
        $this->cart = array_filter($this->cart, function ($item) use ($productId) {
            return $item['product']->id != $productId;
        });

        // Update session
        session()->put('cart', $this->cart);
    }

    public function render()
    {
        $subtotal = array_sum(array_map(function ($item) {
            return $item['product']->price * $item['quantity'];
        }, $this->cart));

        return view('livewire.cart-component', [
            'cart' => $this->cart,
            'subtotal' => $subtotal,
            'total' => $subtotal // Update this if you have additional charges
        ]);
    }
}
