<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();

        $categories = Category::all();

        return view('pages.product.index', compact('products', 'categories'));
        
    }

    public function store(Request $request)
    {
        $request->validate([
            
            'product_name' => 'required',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,|max:2048',
            'product_description' => 'required',
        ]);

        $image =$request->file('product_image');

        $imagePath = $image->store('products', 'public');

        Product::create([
            'category_id' => $request->category_id,     
            'product_name' => $request->product_name,
            'price' => $request->price,
            'stock' => $request->stock,
            'product_image' => $imagePath,
            'product_description' => $request->product_description,
        ]);

        return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }

    // fungsi edit
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('pages.product.edit', compact('product', 'categories'));
    }

    //fungsi update
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'product_name' => 'required',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'product_image' => 'image|mimes:jpeg,png,jpg,|max:2048',
            'product_description' => 'required',
        ]);    
        
        $data = [
            'category_id' => $request->category_id,     
            'product_name' => $request->product_name,
            'price' => $request->price,
            'stock' => $request->stock,
            'product_description' => $request->product_description,
            ];

            if($request->hasFile('product_image')){

                //hapus gambar lama
                if($product->product_image){
                    Storage::disk('public')->delete($product->product_image);
                }

                //upload gambar baru
                $image = $request->file('product_image');

                $data['product_image'] = $imagePath = $image->store('products', 'public');

                

            }
            $product->update($data);
            return redirect()->route('product.index')->with('success', 'Product updated successfully.');
         }



    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        Storage::disk('public')->delete($product->product_image);

        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully.');
    }

    //menampilkan halaman stock product
    public function stockIndex()
    {
        $products = Product::all(); //mengambil semua data produk
        return view('pages.stock.index', compact('products'));
    }   

    //fungsi update stock produk
    public function updateStock(Request $request, $id)
    {
        $request->validate([
            'penambahan' => 'required|numeric|min:1',
        ]);

        $product = Product::findOrFail($id);

        //fungsi increment untuk menambah stock produk
        $product->increment('stock', $request->penambahan);

        return redirect()->back()->with('success', 'Stock updated successfully.');
    }
}

