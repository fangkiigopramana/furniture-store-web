<?php

namespace App\Livewire;

use Midtrans\Snap;
use Midtrans\Config;
use Livewire\Component;
use App\Models\Transaction;
use App\Models\Cart as ModelsCart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\FurnitureAPIService;
use Illuminate\Support\Facades\Auth;

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
        try {
            $params = array(
                'transaction_details' => array(
                    'order_id' => 'ORDER-' . rand(),
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
            $new_order = Order::create([
                'user_id' => auth()->user()->id,
                'order_date' => now(),
                'total_amount' => $this->total_purchase,
                'snap_token' => $transaction->token,
            ]);


            $carts = ModelsCart::with('product')
                ->where('user_id', auth()->user()->id)
                ->whereIn('id', $this->checkedItems)
                ->get(['product_id', 'quantity', 'price']);

            foreach ($carts as $item) {
                OrderItem::create([
                    'order_id' => $new_order->id,
                    'product_id' => $item->product->id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                    'subtotal' => $item->product->price * $item->quantity,
                ]);
            }

            foreach ($carts as $cart) {
                $cart->delete();
            }
            return $this->redirect('/product-catalog',true);
        } catch (\Exception $e) {

            session()->flash('error', 'Checkout gagal. Silakan coba lagi.');
            return redirect()->back();
        }
    }


    public function render()
    {
        $carts = ModelsCart::with(['user', 'product'])
            ->where('user_id', auth()->id())
            ->get();

        return view('cart', [
            'carts' => $carts,
            'sum' => $this->total_purchase
        ]);
    }
}
