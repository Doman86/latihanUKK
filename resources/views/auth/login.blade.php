@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5 col-lg-4">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-4 p-md-5">
                <div class="text-center mb-4">
                    <div class="display-6 text-primary mb-2"><i class="bi bi-shop"></i></div>
                    <h2 class="fw-bold mb-1">Selamat Datang!</h2>
                    <p class="text-muted small">Masuk untuk mengakses katalog produk.</p>
                </div>

                <form method="POST" action="{{ route('login.attempt') }}" novalidate>
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email') }}"
                                   placeholder="nama@email.com" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password"
                                   placeholder="Masukkan password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 fw-semibold">
                        <i class="bi bi-box-arrow-in-right"></i> Masuk
                    </button>
                </form>

                <hr class="my-4">

                <p class="text-center text-muted small mb-0">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="fw-semibold">Daftar sekarang</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection