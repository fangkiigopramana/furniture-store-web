@extends('layouts.app')
@section('page_name','Shop')
@section('content')
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
                <div class="row">
    
                    <!-- Start Column 1 -->
                    <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
                        <h2 class="mb-4 section-title">Crafted with excellent material.</h2>
                        <p class="mb-4">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. </p>
                        <p><a href="shop.html" class="btn">Explore</a></p>
                    </div> 
                    <!-- End Column 1 -->
    
                    <!-- Start Column-->
                    <!-- @foreach ($products as $product ) -->
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
                    <!-- @endforeach -->
                    <!-- End Column -->
    
                </div>
            </div>
        </div>
    </section>
    <!-- End Product Section -->
@endsection