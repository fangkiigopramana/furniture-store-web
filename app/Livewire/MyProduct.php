<?php

namespace App\Livewire;

use App\Services\FurnitureAPIService;
use Livewire\Attributes\Rule;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class MyProduct extends Component
{
    public $types = [];
    public $token = "";
    
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
        $login = $service->login(auth()->user()->email, auth()->user()->password);
        $this->token = $login['token'];

        if (empty($login)) {
            Alert::error('Gagal Tambah Data','Bukan Akun Seller');
        }

        $datas = [
            'name' => $this->name,
            'type' => $this->type_product,
            'seller' => auth()->user()->name,
            'description' => $this->description,
            'price' => $this->price,
            'img_link' => $this->img_link,
        ];

        $service->addNewProduct($this->token, $datas);
        dd($service->allProduct(''));
    }

    public function render()
    {
        $service = new FurnitureAPIService();
        $products = $service->allProduct('');

        return view('my-product', [
            'products' => $products,
            'types' => $this->types
        ]);
    }
}
