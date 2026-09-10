@extends('layouts.app')

@section('title', $product->name)

@section('content')
<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Katalog</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ str()->limit($product->name, 30) }}</li>
    </ol>
</nav>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm overflow-hidden">
            <img src="{{ $product->imageUrl() }}" class="img-fluid product-detail-image" alt="{{ $product->name }}">
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h1 class="h3 fw-bold mb-0">{{ $product->name }}</h1>
                    <span class="badge text-bg-primary">{{ $product->formattedPrice() }}</span>
                </div>
                <p class="text-muted small mb-3">
                    <i class="bi bi-person"></i> Ditambahkan oleh {{ $product->user->name }}
                    · {{ $product->created_at->format('d M Y') }}
                </p>

                <hr>

                <h6 class="fw-semibold"><i class="bi bi-card-text"></i> Deskripsi</h6>
                <p class="text-muted mb-4">{{ $product->description ?: 'Tidak ada deskripsi untuk produk ini.' }}</p>

                <div class="bg-light border rounded-3 p-3 d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted d-block">Harga</small>
                        <span class="fs-4 fw-bold text-primary">{{ $product->formattedPrice() }}</span>
                    </div>
                    <button class="btn btn-primary btn-lg" disabled>
                        <i class="bi bi-cart-plus"></i> Pesan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm mt-4">
    <div class="card-body p-4">
        <h5 class="fw-bold mb-3">
            <i class="bi bi-chat-left-dots"></i> Komentar ({{ $product->comments->count() }})
        </h5>

        <form method="POST" action="{{ route('comments.store', $product) }}" class="mb-4">
            @csrf
            <label for="comment" class="form-label">Tambahkan Komentar</label>
            <div class="input-group">
                <textarea class="form-control @error('comment') is-invalid @enderror"
                          id="comment" name="comment" rows="2"
                          placeholder="Tulis pendapat anda tentang produk ini..."
                          required>{{ old('comment') }}</textarea>
            </div>
            @error('comment')
                <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary mt-2">
                <i class="bi bi-send"></i> Kirim Komentar
            </button>
        </form>

        <hr>

        @if ($product->comments->isEmpty())
            <div class="text-center text-muted py-4">
                <i class="bi bi-chat-square-dots display-5"></i>
                <p class="mt-2 mb-0">Belum ada komentar. Jadilah yang pertama berkomentar!</p>
            </div>
        @else
            <div class="d-flex flex-column gap-3">
                @foreach ($product->comments as $comment)
                    <div class="d-flex gap-3 p-3 bg-light rounded-3">
                        <div class="flex-shrink-0">
                            <div class="avatar-user">
                                {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                            </div>
                        </div>
                        <div class="w-100">
                            <div class="d-flex justify-content-between align-items-center">
                                <strong class="small">{{ $comment->user->name }}</strong>
                                <small class="text-muted">{{ $comment->created_at->format('d M Y, H:i') }}</small>
                            </div>
                            <p class="mb-0 mt-1">{{ $comment->comment }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection