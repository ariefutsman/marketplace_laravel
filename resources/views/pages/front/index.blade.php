@extends('layouts.front')

@section('content')
<div class="container mt-4">
    <h3>Portal Marketplace</h3>
    <div class="row">
        
        @foreach($products as $product)
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm">
                <img src="{{ asset('storage/'.$product->product_image) }}" class="card-img-top" alt="{{ $product->product_name }}">
                <div class="card-body">
                    <h5 class="card-title text-primary">{{ $product->product_name }}</h5>
                    <p class="card-text text-muted">{{ $product->category->category_name }}</p>
                    <h6 class="font-weight-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</h6>
                    <button class="btn btn-sm btn btn-success w-100 mt-2" 
                            data-bs-toggle="modal" data-bs-target="#modalDetail{{ $product->id }}">
                        Detail
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal Detail & Pembelian -->
        <div class="modal fade" id="modalDetail{{ $product->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <img src="{{ asset('storage/'.$product->product_image) }}" class="img-fluid border rounded">
                            </div>
                            <div class="col-md-6">
                                <h4 class="text-primary">{{ $product->product_name }}</h4>
                                <p class="text-muted small">Sisa Stok: <strong>{{ $product->stock }}</strong></p>
                                <hr>
                                
                                <!-- Form Pembelian -->
                                <form action="{{ route('marketplace.order.process') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Jumlah Pesanan</label>
                                        <input type="number" name="total_item" 
                                               class="form-control @error('total_item') is-invalid @enderror" 
                                               value="1" min="1" max="{{ $product->stock }}">
                                        {{-- Pesan Error Kustom dari Controller akan muncul di sini --}}
                                        @error('total_item')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Alamat Pengiriman</label>
                                        <textarea name="address" class="form-control" rows="3" required placeholder="Contoh: Jl. Papan Indah No. 123"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Catatan (Opsional)</label>
                                        <input type="text" name="notes" class="form-control" placeholder="Contoh: Warna Hitam, Ukuran XL">
                                    </div>

                                    @auth
                                        <button type="submit" class="btn btn-primary w-100">Beli Sekarang</button>
                                    @else
                                        <div class="alert alert-warning small py-2">
                                            Silakan login terlebih dahulu untuk melakukan pemesanan.
                                        </div>
                                        <a href="{{ route('login') }}" class="btn btn-warning w-100">Login untuk Membeli</a>
                                    @endauth
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection