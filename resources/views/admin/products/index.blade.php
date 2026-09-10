@extends('layouts.app')

@section('title', 'Kelola Produk')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h1 class="h3 fw-bold mb-0"><i class="bi bi-gear"></i> Kelola Produk</h1>
        <p class="text-muted mb-0 small">Kelola seluruh produk pada katalog (tambah, edit, hapus).</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Produk
    </a>
</div>

@if ($products->isEmpty())
    <div class="text-center py-5 bg-white rounded-3 shadow-sm">
        <i class="bi bi-box display-3 text-muted"></i>
        <p class="text-muted mt-3 mb-0">Belum ada produk. Klik "Tambah Produk" untuk mulai.</p>
    </div>
@else
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Ditambahkan Oleh</th>
                        <th scope="col" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $index => $product)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" width="50" height="50"
                                     class="rounded-2 object-fit-cover border">
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $product->name }}</div>
                                <small class="text-muted">{{ str()->limit($product->description, 60) ?: 'Tanpa deskripsi' }}</small>
                            </td>
                            <td class="text-primary fw-semibold">{{ $product->formattedPrice() }}</td>
                            <td class="text-muted">
                                <i class="bi bi-person"></i> {{ $product->user->name }}
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.products.edit', $product) }}"
                                   class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form method="POST" action="{{ route('admin.products.destroy', $product) }}"
                                      class="d-inline" onsubmit="return confirm('Yakin ingin menghapus produk ini? Komentar terkait juga akan dihapus.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
@endsection