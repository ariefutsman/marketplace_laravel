@extends('layouts.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Orders</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title">Daftar Transaksi Masuk</h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped m-0">
                        <thead class="bg-light">
                            <tr>
                                <th width="50">No</th>
                                <th>Nama Pemesan</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Catatan</th>
                                <th>Produk</th>
                                <th>Qty</th>
                                <th>Total Harga</th>
                                <th>Tanggal Order</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $key => $order)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->address }}</td>
                                <td>
                                    {{-- Menggunakan notes (dengan s) sesuai field di database --}}
                                    <span class="badge {{ $order->notes ? 'badge-info' : 'badge-secondary' }}">
                                        {{ $order->notes ?? '-' }}
                                    </span>
                                </td>
                                <td>{{ $order->product->product_name }}</td>
                                <td>{{ $order->total_item }}</td>
                                <td class="text-nowrap">
                                    <strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong>
                                </td>
                                <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center py-4 text-muted">Belum ada pesanan masuk.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection