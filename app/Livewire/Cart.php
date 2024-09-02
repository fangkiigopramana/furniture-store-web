<?php

namespace App\Livewire;

use App\Models\Cart as ModelsCart;
use App\Services\FurnitureAPIService;
use Livewire\Component;

class Cart extends Component
{
    public $total_purchase = 0;
    public $checkedItems = [];

    public function increase($product_id)
    {
        $product = ModelsCart::findOrFail($product_id);
        $product->quantity++;
        $product->save();

        // Hanya update total_purchase jika item sudah checked
        if (in_array($product_id, $this->checkedItems)) {
            $this->total_purchase += $product->price;
        }
    }

    public function decrease($product_id)
    {
        $product = ModelsCart::findOrFail($product_id);
        if ($product->quantity > 1) {
            $product->quantity--;
            $product->save();

            // Hanya update total_purchase jika item sudah checked
            if (in_array($product_id, $this->checkedItems)) {
                $this->total_purchase -= $product->price;
            }
        }
    }

    public function checkedCart($itemId)
    {
        $product = ModelsCart::findOrFail($itemId);

        if (in_array($itemId, $this->checkedItems)) {
            $this->checkedItems = array_diff($this->checkedItems, [$itemId]);
            $this->total_purchase -= ($product->price * $product->quantity);
        } else {
            $this->checkedItems[] = $itemId;
            $this->total_purchase += ($product->price * $product->quantity);
        }
    }

    public function removeCart($id){
        $deleted_cart = ModelsCart::destroy($id);
        if($deleted_cart){
            toast('Berhasil hapus item', 'success');
        }
        return $this->redirect('/cart', true);
    }

    public function render(FurnitureAPIService $service)
    {
        $carts = ModelsCart::all();

        foreach ($carts as $cart) {
            $productDetails = $service->allProduct($cart->product_name);
            $cart->seller = $productDetails[0]['seller_name'] ?? null;
            $cart->image_url = $productDetails[0]['img_link'] ?? null;
        }

        return view('cart', [
            'carts' => $carts,
            'sum' => $this->total_purchase
        ]);
    }
}
