<section class="container pt-5">
    <h2 class="mb-3">Keranjang</h2>
    @if ($carts->count() === 0)
        <div class="alert alert-danger align-items-center" role="alert">
            <p class="text-center mb-0">
                Keranjang anda kosong
            </p>
        </div>
    @else
        <div class="row mt-3">
            @foreach ($carts as $cart)
            <div class="col-sm-12 col-md-6 mb-3 mb-sm-3">
                        <div class="mb-3 card text-center">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-start fw-bold mb-0">Toko {{ $cart->user->name }}</p>
                                    <p class="text-start text-success fst-italic fw-bold mb-0">BEBAS ONGKIR</p>
                                </div>
                                <div class="form-check">
                                    <label for="checkbox-{{ $cart->id }}" class="form-check-label">
                                        Pilih
                                    </label>
                                    <input id="checkbox-{{ $cart->id }}" class="form-check-input" type="checkbox"
                                        wire:click="checkedCart({{ $cart->id }})">
                                </div>
                            </div>
                            <div class="card-body d-flex justify-content-between py-3">
                                <div class="p-2 flex-fill text-center">
                                    <img src="{{ $cart->product->img_link }}" class="img-thumbnail" width="200" height="200"
                                        alt="...">
                                </div>
                                <div class="p-2 flex-fill">
                                    <ul class="list-unstyled text-start mb-4">
                                        <li>{{ $cart->product->name }}</li>
                                        <li class="fw-bold">{{ "Rp " . number_format($cart->price, 0, " ", ".") }}</li>
                                    </ul>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex me-5">
                                            <div class="me-3">
                                                <i class="bi bi-pencil-square fs-4"></i>
                                            </div>
                                            <div class="me-3">
                                                <i class="bi bi-heart fs-4 addWishlistButton" onclick="addToWishlist()"></i>
                                            </div>
                                            <div>
                                                <a class="icon-link icon-link-hover text-danger"
                                                    style="--bs-icon-link-transform: translate3d(0, -.125rem, 0);"
                                                    wire:click="removeCart('{{ $cart->id }}')">
                                                    <i class="bi bi-trash fs-4"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="input-group d-flex justify-content-center align-items-center">
                                            <button class="btn btn-outline-secondary btn-sm" type="button"
                                                wire:click="decrease('{{ $cart->id }}')">-</button>
                                            <span class="form-control text-center px-3">{{ $cart->quantity }}</span>
                                            <button class="btn btn-outline-secondary btn-sm" type="button"
                                                wire:click="increase('{{ $cart->id }}')">+</button>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach
        </div>
        <div class="alert alert-primary fixed-bottom container-fluid p-3 mb-0" role="alert">
            <div class="d-flex justify-content-between align-items-center container">
                <p wire:poll class="mb-0 fs-5">Total: <span
                        class="fw-bold">{{ "Rp " . number_format($sum, 0, "", ".") }}</span></p>
                <a type="button" class="btn btn-success btn-lg" wire:click="checkout">Checkout</a>
            </div>
        </div>
    @endif


</section>

@push("script")
    <script>
        function addToWishlist() {
            var element = document.getEle
            element.classList.remove("bi-heart");
            element.classList.add("bi-heart-fill");
        }
    </script>
@endpush
