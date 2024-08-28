<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Services\FurnitureAPIService;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class ProductCatalog extends Component
{


    public function addToCart(FurnitureAPIService $service, $product_name)
    {
        $product = $service->oneProduct(200, $product_name);
        $product_name = $product['name'];
        $price = $product['price'];

        $cartItem = Cart::where('user_id', auth()->id())
            ->where('product_name', $product_name)
            ->first();

        if ($cartItem) {
            $cartItem->update([
                'quantity' => DB::raw('quantity + 1'),
                'total_price' => DB::raw("total_price + $price")
            ]);
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_name' => $product_name,
                'quantity' => 1,
                'total_price' => $price
            ]);
        }

        Alert::success('Sukses', 'Tambah ke keranjang berhasil');
        return $this->redirect('/product-catalog', true);
    }

    #[Url()] 
    public $search = '';

    public function render(FurnitureAPIService $furnitureService)
    {
        $all_products = $furnitureService->allProduct($this->search);
        return view('product-catalog', [
            'products' => $all_products,
        ]);
    }
}
