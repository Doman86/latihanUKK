@extends('layouts.app')

@section('title', 'Katalog Produk')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h1 class="h3 fw-bold mb-0"><i class="bi bi-grid"></i> Katalog Produk</h1>
        <p class="text-muted mb-0 small">Temukan produk terbaik untuk anda.</p>
    </div>
    <form method="GET" action="{{ route('products.index') }}" class="d-flex w-100 w-md-auto" style="max-width: 320px;">
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
            <input type="text" name="search" class="form-control" value="{{ $search }}"
                   placeholder="Cari produk..." aria-label="Cari produk">
            <button class="btn btn-primary" type="submit">Cari</button>
        </div>
    </form>
</div>

@if ($products->isEmpty())
    <div class="text-center py-5">
        <i class="bi bi-inbox display-3 text-muted"></i>
        <p class="text-muted mt-3 mb-0">Produk tidak ditemukan.</p>
    </div>
@else
    <div class="row g-4">
        @foreach ($products as $product)
            <div class="col-sm-6 col-md-4">
                <div class="card h-100 shadow-sm border-0 product-card">
                    <div class="position-relative">
                        <img src="{{ $product->imageUrl() }}" class="card-img-top product-thumb" alt="{{ $product->name }}">
                        @if ($product->comments_count ?? false)
                            <span class="badge text-bg-dark position-absolute top-0 end-0 m-2">
                                <i class="bi bi-chat-dots"></i> {{ $product->comments_count }}
                            </span>
                        @endif
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-semibold text-truncate">{{ $product->name }}</h5>
                        <p class="card-text text-muted small product-desc">{{ $product->description ?: 'Tidak ada deskripsi.' }}</p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <span class="text-primary fw-bold fs-5">{{ $product->formattedPrice() }}</span>
                            <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
@endif
@endsection