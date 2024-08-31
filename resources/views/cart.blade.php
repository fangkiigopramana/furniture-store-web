<section class="container pt-5">
    
    <div class="mt-3">

        @foreach ($carts as $cart)
            <div class="mb-3 card text-center">
                <div class="card-header d-flex justify-content-between">
                    <input class="form-check-input" type="checkbox" wire:click="checkedCart({{$cart->id}})">
                    <div class="p-2 flex-fill text-start fw-bold">Kreasi Pak Hasan</div>
                    <div class="p-2 flex-fill text-end text-success fst-italic fw-bold">BEBAS ONGKIR</div>
                </div>
                <div class="card-body d-flex justify-content-between py-3">
                    <div class="p-2 flex-fill text-center">
                        <img src="{{$cart->image_url}}"
                            class="img-thumbnail" width="200" height="200" alt="...">
                    </div>
                    <div class="p-2 flex-fill">
                        <ul class="list-unstyled text-start mb-4">
                            <li>{{ $cart->product_name }}</li>
                            <li class="fw-bold">{{ "Rp " . number_format($cart->price, 0, " ", ".") }}</li>
                        </ul>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex me-5">
                                <div class="me-3">
                                    <i class="bi bi-pencil-square fs-4"></i>
                                </div>
                                <div>
                                    <i class="bi bi-heart fs-4 addWishlistButton" onclick="addToWishlist()"></i>
                                </div>
                            </div>
                            <div class="input-group d-flex justify-content-center align-items-center">
                                <button class="btn btn-outline-secondary btn-sm" type="button" wire:click="decrease('{{ $cart->id }}')">-</button>
                                <span class="form-control text-center px-3">{{ $cart->quantity }}</span>
                                <button class="btn btn-outline-secondary btn-sm" type="button" wire:click="increase('{{ $cart->id }}')">+</button>
                            </div>                            
                        </div>

                    </div>

                </div>
            </div>
        @endforeach

    </div>
    <div class="alert alert-primary fixed-bottom container-fluid p-3 mb-0" role="alert">
        <div class="d-flex justify-content-between align-items-center container">
            <p wire:poll class="mb-0 fs-5">Total: <span class="fw-bold">{{ 'Rp '.number_format($sum, 0, '', '.') }}</span></p>
            <button type="button" class="btn btn-success btn-lg">Beli</button>
        </div>
    </div>
    
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
