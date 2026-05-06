<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\Order;
use App\Models\Product;


class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     // Mengambil semua produk beserta kategorinya agar tidak error
        $products = Product::with('category')->get();

        // Mengirimkan variable $products ke view
        return view('pages.front.index', compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Ambil data produk dulu untuk validasi stok
        $product = Product::findOrFail($request->product_id);

        // 2. Validasi input
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'address' => 'required',
            'total_item' => 'required|numeric|min:1|max:' . $product->stock,
        ], [
            // Pesan error kustom untuk stok
            'total_item.max' => 'Maaf, jumlah pesanan melebihi stok yang tersedia (Maksimal: ' . $product->stock . ').',
        ]);

        // 3. Simpan Pesanan
        Order::create([
            'product_id' => $product->id,
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'address' => $request->address,
            'notes' => $request->notes, // Ambil dari input notes
            'total_item' => $request->total_item,
            'total_price' => $product->price * $request->total_item,
        ]);

        // 4. Kurangi stok produk
        $product->decrement('stock', $request->total_item);

        return redirect()->route('home-page')->with('success', 'Pesanan berhasil diproses!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
