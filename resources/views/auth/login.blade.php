@extends("layouts.app")
@section("content")
    <section>
        <div class="product-section">
            <div class="container">
                <form class="text-center" action="{{ route("login.authenticate") }}" method="POST">
                    @csrf
                    <h1 class="h3 mb-5 fw-bold">Login</h1>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingEmail" name="email"
                            value="{{ old("email", " ") }}" placeholder="Masukkan email address..." required>
                        <label for="floatingEmail">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword" name="password"
                            placeholder="Masukkan password..." required>
                        <label for="floatingPassword">Password</label>
                    </div>
                    <button class="btn btn-primary w-100 py-2 rounded-5" type="submit">Sign in</button>
                </form>
            </div>
        </div>
    </section>
@endsection
