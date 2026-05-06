<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'product_id' => 'required|exists:products,id',
        'total_item' => 'required|integer|min:1',
        'total_price'=> 'required|integer',
        'address'    => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    // 1. Cari Produk
    $product = \App\Models\Product::find($request->product_id);

    // 2. Cek apakah stok cukup
    if ($product->stock < $request->total_item) {
        return response()->json([
            'success' => false, 
            'message' => 'Stok tidak mencukupi!'
        ], 400);
    }

    $user = auth()->user();

    // 3. Simpan Order
    $order = Order::create([
        'product_id' => $request->product_id,
        'name'       => $user->name,
        'email'      => $user->email,
        'address'    => $request->address,
        'notes'      => $request->notes ?? '-',
        'total_item' => $request->total_item,
        'total_price'=> $request->total_price,
    ]);

    // 4. KURANGI STOK PRODUK
    $product->decrement('stock', $request->total_item);

    return response()->json([
        'success' => true,
        'message' => 'Pesanan berhasil dan stok berkurang!',
        'data'    => $order
    ], 201);
}
}