@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Produk</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</div>

<section class="content">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="product_name">Nama Produk</label>
                    <input type="text" name="product_name" class="form-control @error('product_name') is-invalid @enderror" value="{{ old('product_name', $product->product_name) }}" >
                    @error('product_name')  
                    <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Kategori Produk</label>
                    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->category_name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')  
                    <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price) }}" >
                            @error('price')  
                            <span class="invalid-feedback">{{$message}}</span>
                            @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Stok</label>
                        <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $product->stock) }}" >
                        @error('stock')  
                        <span class="invalid-feedback">{{$message}}</span>
                        @enderror
                </div>
            
                <div class="form-group">
                    <label>Gambar Produk</label>
                    @if($product->product_image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $product->product_image) }}" width="150">
                        </div>
                    @endif

                    <input type="file" name="product_image" class="form-control @error('product_image') is-invalid @enderror">
                    <small>Kosongkan jika tidak ingin mengganti gambar:</small>

                    @error('product_image')  
                    <span class="invalid-feedback">{{$message}}</span>
                    @enderror

                </div>

                <div class="form-group">
                    <label>Deskripsi Produk</label>
                    <textarea name="product_description" class="form-control @error('product_description') is-invalid @enderror" >{{ old('product_description', $product->product_description) }}</textarea>
                    @error('product_description')  
                    <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>


                {{-- tombol kembali/batal --}}
                <div class="form-group">
                    <a href="{{ route('product.index') }}" class="btn btn-secondary">Batal</a>

                    {{-- tombol update --}}
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

            </form>
        </div>
    </div>
</section>

@endsection