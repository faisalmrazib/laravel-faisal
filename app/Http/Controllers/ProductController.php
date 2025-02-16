<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;


class ProductController extends Controller
{
    public function index_product()
    {
        $products = Product::paginate(9); // 9 produk per halaman
        return view('index_product', compact('products'));
    }

    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        $product = $query->paginate(9);
        return view('index_index', compact('products'));
    }

    public function create_product()
    {
        return view('create_product');
    }

    public function store_product(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:225',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock' => 'required|integer'
        ]);

        $imagePath = $request->file('image')->store('public/images');
        $imageName = basename($imagePath);

        // Simpan data produk ke database
        // Simpan data produk ke database
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imageName,
        ]);

        return redirect()->route('index_product')->with('success', 'Produk berhasil ditambahkan.');



        // Membersihkan input harga
        $price = str_replace(['.', ' IDR'], '', $request->input('price')); // Menghapus titik dan ' IDR'
        $price = (float)$price; // Mengonversi ke float


        $path = $request->file('image')->store('product', 'public'); // Simpan ke storage/app/public/products
        Product::create([
            'image' => $path,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $price,
            'stock' => $request->input('stock'),
            'image' => $request->file('image')->store('images'),
        ]);

        return redirect::route('index_product')->with('success', 'Product created successfully.');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id); // Single object
        return view('show_product', compact('products'));
    }

    public function show_product(Product $product)
    {
        return view('show_product', compact('product'));
    }

    public function add_to_cart(Product $product, Request $request)
    {
        $maxStock = $product->stock ?? PHP_INT_MAX;
        $request->validate([
            'quantity' => 'required|numeric|min:1|max:' . $maxStock,
        ]);

        $totalAmount = $product->price * $request->quantity;

        $cart = Cart::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($cart) {
            $cart->update([
                'quantity' => $cart->quantity + $request->quantity,
                'amount' => $cart->amount + $totalAmount,
            ]);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'amount' => $totalAmount, 
            ]);
        }

        return redirect('/cart')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }
    public function edit_product(Product $product)
    {
        return view('edit_product', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update product data
        $product->update($request->only('name', 'description', 'price', 'stock'));
        // Update data produk
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;

        // Jika ada gambar baru, update gambar
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            Storage::delete('public/images/' . $product->image);

            // Simpan gambar baru
            $imagePath = $request->file('image')->store('public/images');
            $imageName = basename($imagePath);
            $product->image = $imageName;
        }

        $product->save();

        return redirect()->route('index_product')->with('success', 'Product updated successfully.');
    }

    public function update_product(Product $product, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'required',
            'stock' => 'required'
        ]);

        $file = $request->file('image');
        $path = time() . '_' . $request->name . '_' . $file->getClientOriginalExtension();

        Storage::disk('local')->put('public/' . $path, file_get_contents($file));


        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $path,
            'stock' => $request->stock,
        ]);

        return redirect::route('show_product', $product);
    }

    public function delete_product(Product $product)
    {
        $product->delete();
        return redirect::route('index_product');
    }
}
