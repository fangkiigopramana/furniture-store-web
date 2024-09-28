<section class="container pt-5">
    <h2 class="mb-3">My Orders</h2>
    <div class="row">
        
        @foreach ($items as $item)            
        <div class="col-sm-12 col-md-6 mb-3 mb-sm-3">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <p class="mb-0 fw-bold">Store Name</p>
                        <p class="mb-0 text-danger">Order statuse</p>
                    </div>
                </div>
                <div class="card-body">
                    @foreach ($item->orderItems as $order)
                        
                    <div class="row g-0">
                        <!-- Kolom gambar -->
                        <div class="col-12 col-md-3">
                            <img src="{{$order->product->img_link}}"
                                class="img-fluid rounded w-100" alt="...">
                        </div>
                        
                        <!-- Kolom konten -->
                        <div class="col-12 col-md-9 px-3 mt-3 mt-md-0">
                            <h5 class="card-title">{{$order->product->name}}</h5>
                            
                            <!-- Cashback dan Quantity -->
                            <div class="d-flex justify-content-between">
                                <p class="mb-0 text-danger">Free Cashback</p>
                                <p class="mb-0 text-muted">{{'x'.$order->quantity}}</p>
                            </div>
                
                            <!-- Harga -->
                            <div class="d-flex justify-content-between mb-3">
                                <p class="mb-0">Price</p>
                                <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center">
                                        <p class="mb-0 text-decoration-line-through me-2" style="font-size: 12px">Rp 29.000</p>
                                        <p class="mb-0 fw-bold">{{'Rp '.number_format($order->subtotal, 0, ',', '.')}}</p>
                                    </div>
                                </div>
                            </div>
                
                        </div>
                    </div>
                    @endforeach
                    <!-- Tombol -->
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-danger me-2">Batalkan pesanan</button>
                        <button type="button" class="btn btn-success">Bayar sekarang</button>
                    </div>
                </div>                
            </div>
        </div>
        @endforeach

    </div>
</section>
