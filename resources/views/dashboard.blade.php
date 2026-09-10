@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 fw-bold mb-0">Halo, {{ auth()->user()->name }}! 👋</h1>
        <p class="text-muted mb-0 small">Selamat datang di {{ config('app.name') }}.</p>
    </div>
    <a href="{{ route('products.index') }}" class="btn btn-primary">
        <i class="bi bi-grid"></i> Lihat Katalog
    </a>
</div>

<div class="row g-3 mb-4">
    <div class="col-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bg-primary-subtle rounded-3 p-3 text-primary fs-4">
                    <i class="bi bi-box-seam"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold">{{ $stats['products'] }}</div>
                    <div class="text-muted small">Jumlah Produk</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bg-success-subtle rounded-3 p-3 text-success fs-4">
                    <i class="bi bi-chat-dots"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold">{{ $stats['comments'] }}</div>
                    <div class="text-muted small">Jumlah Komentar</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bg-warning-subtle rounded-3 p-3 text-warning fs-4">
                    <i class="bi bi-people"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold">{{ $stats['users'] }}</div>
                    <div class="text-muted small">Jumlah Pengguna</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h5 fw-bold mb-0">Produk Terbaru</h2>
    <a href="{{ route('products.index') }}" class="small text-decoration-none">Lihat semua <i class="bi bi-arrow-right"></i></a>
</div>

@if ($recentProducts->isEmpty())
    <div class="alert alert-info mb-0">
        <i class="bi bi-info-circle me-1"></i> Belum ada produk yang tersedia.
    </div>
@else
    <div class="row g-3">
        @foreach ($recentProducts as $product)
            <div class="col-sm-6 col-lg-3">
                <div class="card h-100 shadow-sm border-0">
                    <img src="{{ $product->imageUrl() }}" class="card-img-top product-thumb" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h6 class="card-title fw-semibold text-truncate">{{ $product->name }}</h6>
                        <p class="card-text text-primary fw-bold mb-2">{{ $product->formattedPrice() }}</p>
                        <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-primary w-100">
                            <i class="bi bi-eye"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection