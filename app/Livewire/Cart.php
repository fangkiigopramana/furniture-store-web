<?php

namespace App\Livewire;

use App\Models\Cart as ModelsCart;
use Livewire\Component;

class Cart extends Component
{
    public function render()
    {
        $carts = ModelsCart::all();
        $total_price_cart = $carts->sum('total_price');

        return view('cart', [
            'carts' => $carts,
            'total_price_cart' => $total_price_cart,
        ]);
    }
}
