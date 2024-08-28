<?php

namespace App\Livewire;

use App\Models\Cart as ModelsCart;
use App\Services\FurnitureAPIService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Cart extends Component
{
    public function render()
    {
        $carts = ModelsCart::all();

        return view('cart', [
            'carts' => $carts
        ]);
    }
}
