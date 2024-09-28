<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Product;
use App\Services\FurnitureAPIService;
use App\Services\ProductService;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class ProductCatalog extends Component
{

    public function addToCart(Product $product)
    {

        $cartItem = Cart::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->update([
                'quantity' => DB::raw('quantity + 1'),
            ]);
        } else {
            Cart::create(
                [
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price,
                ]
            );
        }

        toast($product->name . ' ditambahkan ke keranjang!', 'success');
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
