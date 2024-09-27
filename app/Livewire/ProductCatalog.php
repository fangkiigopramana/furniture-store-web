<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Services\FurnitureAPIService;
use App\Services\ProductService;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class ProductCatalog extends Component
{

    public function addToCart(ProductService $service, $product_name)
    {
        $product = $service->allProduct($product_name)[0];
        $product_name = $product['name'];
        $price = $product['price'];

        $cartItem = Cart::where('user_id', auth()->id())
            ->where('product_name', $product_name)
            ->first();

        if ($cartItem) {
            $cartItem->update([
                'quantity' => DB::raw('quantity + 1'),
            ]);
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_name' => $product_name,
                'quantity' => 1,
                'price' => $price,
            ]);
        }

        toast($product_name . ' ditambahkan ke keranjang!', 'success');
        return $this->redirect('/product-catalog', true);
    }

    #[Url()]
    public $search = '';

    public function render(ProductService $furnitureService)
    {
        $all_products = $furnitureService->allProduct($this->search);
        return view('product-catalog', [
            'products' => $all_products,
        ]);
    }
}
