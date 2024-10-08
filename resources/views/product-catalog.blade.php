<!-- Start Product Section -->
<section>
    <div class="product-section">
        <div class="container">
            <div class="row">
                <div class="mb-3">
                    <label for="searchItemInput" class="form-label">Cari</label>
                    <input type="text" class="form-control" wire:model.live="search" placeholder="Masukkan nama barang">
                </div>
            </div>
            <div class="row" id="product-container">
                <!-- Start Column-->
                @foreach ($products as $product )
                <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0" wire:key="{{ $product['name'] }}">
                    <a class="product-item" type="button" wire:click="addToCart('{{ $product['id'] }}')">
                        <img src="{{$product['img_link']}}" alt="Image" class="img-fluid product-thumbnail">
                        <h3 class="product-title">{{ $product['name'] }}</h3>
                        <strong class="product-price">{{ $product['price'] }}</strong>

                        <span class="icon-cross">
                            <img src="../assets/images/cart.svg" class="img-fluid p-3">
                        </span>
                    </a>
                </div>
                @endforeach
                <!-- End Column -->
            </div>
        </div>
    </div>
</section>
<!-- End Product Section -->