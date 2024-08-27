<nav class="navbar-dark bg-dark navbar navbar-expand-lg custom-navbar sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#">Furni Store</a>
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
                <li class="nav-item {{ Route::is('faq') ? 'active' : '' }}" key="index">
                    <a class="nav-link" aria-current="page" href="{{route('faq')}}" wire:navigate title="This link direct to Faq"> FAQ </a>
                </li>
                @endhasanyrole
                
                @hasanyrole('Seller')
                <li class="nav-item {{ Route::is('my_products') ? 'active' : '' }}" key="index">
                    <a class="nav-link" aria-current="page" href="#" title="This link direct to Your Products">Produk saya</a>
                </li>
                <li class="nav-item {{ Route::is('orders') ? 'active' : '' }}" key="index">
                    <a class="nav-link" aria-current="page" href="#" title="This link direct to Order">Pesanan</a>
                </li>
                @endhasanyrole
            </ul>
            @auth                    
            <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                <li>
                    <div class="dropdown text-end">
                        <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                        </a>
                        <ul class="dropdown-menu text-small">
                            <li><p class="dropdown-item fw-bolder">{{Auth::user()->name . ' - ' . Auth::user()->getRoleNames()[0]}}</p></li>
                            <li><hr class="dropdown-divider"></li>
                            @hasanyrole('Buyer')
                            <li><a class="dropdown-item" href="#">Profil Pengguna</a></li>
                            <li><a class="dropdown-item" href="#">Pesanan</a></li>
                            @endhasanyrole
                            
                            @hasanyrole('Seller')
                            <li><a class="dropdown-item" href="#">Profil Toko</a></li>
                            <li><a class="dropdown-item" href="#">Laporan Penjualan</a></li>
                            @endhasanyrole
                            <li><a class="dropdown-item" href="{{route('sign-out')}}" wire:navigate>Sign out</a></li>
                        </ul>
                        </div>
                </li>
                <li><a class="nav-link" href="#"><img src="{{asset('/assets/images/cart.svg')}}" alt="Cart Image"></a></li>
            </ul>
            @endauth
            @guest                    
            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                <li class="nav-item {{ Route::is('sign-in') ? 'active' : '' }}">
                    <a class="nav-link fw-semibold fs-7" href="{{route('sign-in')}}" wire:navigate>Sign In</a>
                </li>
                <li class="nav-item {{ Route::is('sign-up') ? 'active' : '' }}">
                    <a class="nav-link fw-semibold fs-7" href="{{route('sign-up')}}" wire:navigate>Sign Up</a>
                </li>
            </ul>
            @endguest
        </div>
    </div>
</nav>