<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Services\FurnitureAPIService;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Rule;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class ProductCatalog extends Component
{

    #[Rule('required')]
    public string $product_name = "";

    public function addToCart(FurnitureAPIService $service)
    {
        $price = $service->oneProduct(1, $this->product_name)['price'];
        $product_name =$this->product_name;

        $cart = Cart::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'product_name' => $product_name
            ],
            [
                'quantity' => DB::raw('quantity + 1'),
                'total_price' => DB::raw("($price * (quantity + 1))")
            ]
        );
        Alert::success('Sukses','Tambah ke keranjang berhasil');
    }

    public function render(FurnitureAPIService $furnitureService)
    {
        $all_products = $furnitureService->allProduct();
        return view('product-catalog',[
            'products' => $all_products
        ]);
    }
}
