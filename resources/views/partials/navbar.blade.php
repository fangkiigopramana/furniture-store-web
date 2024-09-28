<nav class="navbar bg-success-emphasis navbar navbar-expand-lg custom-navbar sticky-top">
    <div class="container">
        <a class="navbar-brand text-white" href="#">Furni Store</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                <li class="nav-item {{ Route::is('home') ? 'active' : '' }}" key="index">
                    <a class="nav-link" aria-current="page" href="{{route('home')}}" wire:navigate title="This link direct to home"> Home </a>
                </li>
                @hasanyrole('Buyer')
                <li class="nav-item {{ Route::is('product_catalog') ? 'active' : '' }}" key="index">
                    <a class="nav-link" aria-current="page" href="{{route('product_catalog')}}" wire:navigate title="This link direct to Product Catalogue<"> Product Catalogue</a>
                </li>
                <li class="nav-item {{ Route::is('myorder') ? 'active' : '' }}" key="index">
                    <a class="nav-link" aria-current="page" href="{{route('myorder')}}" wire:navigate title="This link direct to My orders">Pesananku </a>
                </li>
                <li class="nav-item {{ Route::is('cart') ? 'active' : '' }}" key="index">
                    <a class="nav-link" aria-current="page" href="{{route('cart')}}" wire:navigate title="This link direct to My orders">Keranjang </a>
                </li>
                @endhasanyrole
                
                @hasanyrole('Seller')
                <li class="nav-item {{ Route::is('my-product') ? 'active' : '' }}" key="index">
                    <a class="nav-link" aria-current="page" href="{{route('my-product')}}" title="This link direct to Your Products" wire:navigate>Produk saya</a>
                </li>
                <li class="nav-item" key="index">
                    <a class="nav-link" aria-current="page" href="#" title="This link direct to Order">Profile Toko</a>
                </li>
                <li class="nav-item {{ Route::is('orders') ? 'active' : '' }}" key="index">
                    <a class="nav-link" aria-current="page" href="#" title="This link direct to Order">Penjualan</a>
                </li>
                @endhasanyrole
                @auth
                <li>
                    <a class="nav-link" href="{{route('sign-out')}}" wire:navigate>Sign out</a>
                </li>
                @endauth
            @guest                    
            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                <li class="nav-item {{ Route::is('login') ? 'active' : '' }}">
                    <a class="nav-link fw-semibold fs-7" href="{{route('login')}}" wire:navigate>Sign In</a>
                </li>
                <li class="nav-item {{ Route::is('sign-up') ? 'active' : '' }}">
                    <a class="nav-link fw-semibold fs-7" href="{{route('sign-up')}}" wire:navigate>Sign Up</a>
                </li>
            </ul>
            @endguest
        </div>
    </div>
</nav>