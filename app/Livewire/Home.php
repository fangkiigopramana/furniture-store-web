<?php

namespace App\Livewire;

use App\Services\FurnitureAPIService;
use Livewire\Component;

class Home extends Component
{
    public function render(FurnitureAPIService $furnitureService)
    {
        $best_products = $furnitureService->allProduct(3);
        $types = $furnitureService->allType();

        return view('home', compact('best_products','types'));
    }
}
