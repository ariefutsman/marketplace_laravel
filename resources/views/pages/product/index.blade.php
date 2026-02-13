@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Products</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</div>


    <section class="content">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">Tambah Produk</button>
        </div>
        <div class="card-body">
            <table class="table table-bordered myTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        {{-- menambahkan kolom stock --}}
                        <th>Stok</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $key => $product)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->category->category_name }}</td>
                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->product_description }}</td>
                        <td><img src="{{ asset('storage/' . $product->product_image) }}" width="100"></td>
                        <td>
                        {{-- tombol edit --}}
                            <a href="{{ route ('product.edit', $product->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>

                        {{-- tombol hapus --}}
                        <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')"><i class="fas fa-trash"></i></button>
                        </form>
                        
                        </td>
                    </tr>
                    @endforeach
            </table>
        </div>
    </section>

    <!-- Modal Tambah Produk -->
    <div class="modal fade" id="modalTambah">
        <div class="modal-dialog">
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Produk</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label>Nama Produk</label>
                        <input type="text" name="product_name" class="form-control mb-2" placeholder="Masukan Nama Produk">
                        <label>Kategori Produk</label>
                        <select name="category_id" class="form-control mb-2">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                            @endforeach
                        </select>

                        <label>Harga</label>
                        <input type="number" name="price" class="form-control mb-2" placeholder="Masukan Harga Produk">

                        <label>Stok</label>
                        <input type="number" name="stock" class="form-control mb-2" placeholder="Masukan Stok Produk">

                        <label>Gambar Produk</label>
                        <input type="file" name="product_image" class="form-control mb-2">
                        
                        <label>Deskripsi Produk</label>
                        <textarea name="product_description" class="form-control mb-2" placeholder="Masukan Deskripsi Produk"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @endsection