<?php

namespace App\Livewire;

use App\Models\Order as ModelsOrder;
use App\Models\Transaction;
use Livewire\Component;

class Order extends Component
{
    public function render()
    {
        $myorders = ModelsOrder::with(['orderItems','orderItems.product','orderItems.product.seller'])->where('user_id',auth()->user()->id)->get();
        return view('order',[
            'items' => $myorders
        ]);
    }
}
