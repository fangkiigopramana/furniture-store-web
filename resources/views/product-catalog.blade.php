<!-- Start Product Section -->
<section>
    <div class="product-section">
        <div class="container">
            <div class="row">
                <div class="mb-3">
                    <label for="searchItemInput" class="form-label">Cari</label>
                    <input type="text" class="form-control" v-model="searchItemInput" id="searchItemInput" placeholder="Masukkan nama barang">
                </div>
            </div>
            <div class="row" id="product-container">
                <!-- Start Column-->
                @foreach ($products as $product )
                <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0" key="{{$loop->iteration}}">
                    <a class="product-item" href="javascript:void(0);">
                        <img src="{{$product['img_link']}}" alt="Image" class="img-fluid product-thumbnail">
                        <h3 class="product-title">{{ $product['name'] }}</h3>
                        <strong class="product-price">{{ $product['price'] }}</strong>

                        <span class="icon-cross">
                            <img src="../assets/images/cross.svg" class="img-fluid">
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