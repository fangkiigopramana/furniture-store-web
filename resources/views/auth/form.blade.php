<section>
    <div class="product-section">
        <div class="container w-50">
            <form class="text-left" wire:submit="{{ $title == "Sign In" ? "validation" : "save" }}">
                @csrf
                <h1 class="h3 mb-5 fw-bold text-center">{{ $title }}</h1>
                @if ($title == "Sign Up")
                    <div class="mb-3">
                        <label for="name" class="form-label">Username</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name"
                            value="{{ old("name", " ") }}" placeholder="Masukkan Username..." aria-describedby="nameHelp" required @if ($title !== "Sign In") autofocus @endif>
                        @error('name')
                            <div id="namelHelp" class="form-text text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select" aria-label="Default select role" wire:model="role" required>
                            <option selected>Pilih Role</option>
                            <option value="Buyer">Pembeli</option>
                            <option value="Seller">Penjual</option>
                        </select>
                    </div>
                @endif

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model="email"
                        value="{{ old("email", " ") }}" placeholder="Masukkan email address..." aria-describedby="emailHelp" required @if ($title == "Sign In") autofocus @endif>
                    @error('email')
                        <div id="emailHelp" class="form-text text-danger">{{$message}}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" wire:model="password" id="password" placeholder="Masukkan password..." aria-describedby="passwordHelp" required>
                        <button type="button" class="btn btn-secondary" id="togglePasswordBtn">
                            <i class="bi bi-eye-fill"></i>
                        </button>
                    </div>
                    @error('password')
                        <div id="passwordlHelp" class="form-text text-danger">{{$message}}</div>
                    @enderror
                </div>

                <button class="btn btn-primary w-100 py-2 rounded-5" type="submit">{{ $title }}</button>
            </form>
            <p>
                @if ($title == "Sign In")
                    Don't have an account? <a href="{{ route('sign-up') }}" wire:navigate>Sign Up Now!</a>
                @else
                    Already an account? <a href="{{ route('login') }}" wire:navigate>Sign In Now!</a>
                @endif
            </p>
        </div>
    </div>
</section>

@push('script')
<script>
    document.getElementById('togglePasswordBtn').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    });
</script>
@endpush
