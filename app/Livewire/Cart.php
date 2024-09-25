<?php

namespace App\Livewire;

use Midtrans\Snap;
use Midtrans\Config;
use Livewire\Component;
use App\Models\Transaction;
use App\Models\Cart as ModelsCart;
use App\Services\FurnitureAPIService;

class Cart extends Component
{
    public $total_purchase = 0;
    public $checkedItems = [];

    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

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

    public function removeCart($id)
    {
        $deleted_cart = ModelsCart::destroy($id);
        if ($deleted_cart) {
            toast('Berhasil hapus item', 'success');
        }
        return $this->redirect('/cart', true);
    }

    public function checkout()
    {
        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $this->total_purchase,
            ),
            'customer_details' => array(
                'first_name' => auth()->user()->name,
                'last_name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'phone' => '08111222333',
            ),
        );

        $transaction = Snap::createTransaction($params);
        Transaction::create([
            'user_id' => auth()->user()->id,
            'total_amount' => $this->total_purchase,
            'transaction_date' => now(),
            'snap_token' => $transaction->token
        ]);

        foreach ($this->checkedItems as $id_cart) {
            ModelsCart::find($id_cart)->delete();
        }

        return redirect()->away($transaction->redirect_url);
    }

    public function render(FurnitureAPIService $service)
    {
        $carts = ModelsCart::where('user_id', auth()->user()->id)->get();;

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
