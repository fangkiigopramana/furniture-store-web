<section class="container pt-5">
    <div class="p-4 bg-white rounded shadow-sm">
        <h5 class="mb-4">Produk Saya</h5>

        <div class="d-flex align-items-center mb-5">
            <div class="me-3">
                <select class="form-select select2" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
            <div class="me-3">
                <select class="form-select select2" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
            <div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add New Product
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Product</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form wire:submit="storeNewProduct">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" wire:model="name" id="name" aria-describedby="nameHelp" required>
                                        @error('name')
                                            <div id="nameHelp" class="form-text text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="type" class="form-label">Type</label>
                                        <select class="form-select" wire:model="type_product" id="type" required>
                                            <option selected>Pilih Tipe</option>
                                            @foreach ($types as $item)
                                                <option value="{{$item}}">{{Str::apa($item)}}</option>
                                            @endforeach
                                        </select>
                                        @error('type')
                                            <div id="typeHelp" class="form-text text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Leave a comment here" id="description" wire:model="description" required></textarea>
                                        </div>
                                        @error('description')
                                            <div id="descriptionlHelp" class="form-text text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="number" min="1" class="form-control" wire:model="price" id="price" aria-describedby="emailHelp" required>
                                        @error('price')
                                            <div id="priceHelp" class="form-text text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="img_link" class="form-label">Image Link</label>
                                        <input type="text" class="form-control" wire:model="img_link" id="img_link" aria-describedby="imgHelp" required>
                                        @error('img_link')
                                            <div id="imgHelp" class="form-text text-danger">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">Add</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (isset($product))

            @foreach ($products as $product)
                <div class="d-flex align-items-center mb-5">
                    <!-- Product Image -->
                    <div class="me-3">
                        <img src="{{ $product["img_link"] }}" class="rounded border" alt="Product Image" width="75"
                            height="75">
                    </div>
                    <!-- Product Details -->
                    <div class="me-3" style="padding-right: 50px">
                        <p class="text-muted mb-1">{{ $product["type"] }}</p>
                        <p class="fw-bold text-dark mb-1" style="font-size: 20px;">{{ $product["name"] }}</p>
                        <p class="text-muted mb-0" style="font-size: 17px;">Happiness is A Butterfly</p>
                    </div>
                    <!-- Added Date -->
                    <div class="me-3" style="padding-right: 50px">
                        <p class="text-uppercase text-muted mb-1">Ditambahkan Pada</p>
                        <p class="fw-bold text-uppercase mb-0">20 Jan 2024</p>
                    </div>
                    <!-- Requirement -->
                    <div class="me-3" style="padding-right: 50px">
                        <p class="text-uppercase text-muted mb-1">Persyaratan</p>
                        <p class="fw-bold text-uppercase mb-0">Min. Diskon 20%</p>
                    </div>
                    <!-- Edit Button -->
                    <div class="m-auto">
                        <button type="button" class="btn btn-sm btn-warning">Edit</button>
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-center text-danger mb-5">
                Your product is empty
            </div>
        @endif

    </div>
</section>
