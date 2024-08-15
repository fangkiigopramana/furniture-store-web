<nav class="navbar-dark bg-dark navbar navbar-expand-lg custom-navbar sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#">Furni Store</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                <li class="nav-item {{ Route::is('home') ? 'active' : '' }}" key="index">
                    <a class="nav-link" aria-current="page" href="{{route('home')}}" title="This link direct to home"> Home </a>
                </li>
                <li class="nav-item {{ Route::is('shop') ? 'active' : '' }}" key="index">
                    <a class="nav-link" aria-current="page" href="{{route('shop')}}" title="This link direct to Shop"> Shop </a>
                </li>
            </ul>
            @auth                    
            <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                <li>
                    <div class="dropdown text-end">
                        <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                        </a>
                        <ul class="dropdown-menu text-small">
                            <li><a class="dropdown-item" href="#">New project...</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#signout">Sign out</a></li>
                        </ul>
                        </div>
                </li>
                <li><a class="nav-link" href="cart.html"><img src="{{asset('/assets/images/cart.svg')}}" alt="Cart Image"></a></li>
            </ul>
            @endauth
            @guest                    
            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                <li class="nav-item {{ Route::is('login.index') ? 'active' : '' }}">
                    <a class="nav-link fw-semibold fs-7" href="{{route('login.index')}}">Login</a>
                </li>
                <li class="nav-item {{ Route::is('register.index') ? 'active' : '' }}">
                    <a class="nav-link fw-semibold fs-7" href="{{route('register.index')}}">Register</a>
                </li>
            </ul>
            @endguest
        </div>
    </div>
</nav>