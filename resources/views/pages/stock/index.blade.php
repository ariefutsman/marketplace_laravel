@extends('layouts.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Stock Products</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</div>

<section class="content">
    <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Stock Products</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 50px">No</th>
                                    <th >Product Name</th>
                                    <th>Stock</th>
                                    <th>Penambahan</th>
                                    <th style="width: 100px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $key => $product)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->stock }}</td>
                                        <form action="{{ route('admin.stock.update', $product->id) }}" method="POST">
                                            @csrf
                                            <td>
                                                <input type="number" name="penambahan" class="form-control" placeholder="0" required>
                                            </td>
                                            <td>
                                                <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                            </td>
                                            
                                        </form>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
           
       
    </div><!-- /.container-fluid -->
</section>

@endsection