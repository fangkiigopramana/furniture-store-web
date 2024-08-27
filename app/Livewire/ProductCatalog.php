<?php

namespace App\Livewire;

use App\Services\FurnitureAPIService;
use Livewire\Component;

class ProductCatalog extends Component
{
    public function render(FurnitureAPIService $furnitureService)
    {
        $all_products = $furnitureService->allProduct();
        return view('product-catalog',[
            'products' => $all_products
        ]);
    }
}
