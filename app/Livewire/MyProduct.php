<?php

namespace App\Livewire;

use App\Services\FurnitureAPIService;
use Livewire\Attributes\Rule;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class MyProduct extends Component
{
    public $types = [];
    
    #[Rule('required')]
    public $name = "";
    public $type_product = "";
    public $description = "";
    public $price = "";
    public $img_link = "";

    public function mount()
    {
        $service = new FurnitureAPIService();

        // Mengambil data produk dan jenis produk saat komponen di-mount
        $get_types = $service->allType();
        $this->types = array_map(function($get_types) {
            return $get_types['name'];
        }, $get_types);
    }

    public function storeNewProduct()
    {

        $service = new FurnitureAPIService();

        if (empty(auth()->user())) {
            Alert::error('Gagal Tambah Data','Bukan Akun Seller');
        }

        
        $datas = [
            'name' => $this->name,
            'type' => $this->type_product,
            'seller_email' => auth()->user()->email,
            'description' => $this->description,
            'price' => $this->price,
            'img_link' => $this->img_link,
        ];

        $service->addNewProduct(session('token'), $datas);

        return redirect('/my-product');
    }

    public function render()
    {
        $service = new FurnitureAPIService();
        $products = $service->getProductByOwner(auth()->user()->email);

        return view('my-product', [
            'products' => $products,
            'types' => $this->types
        ]);
    }
}
