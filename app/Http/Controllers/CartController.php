<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Menampilkan detail cart berdasarkan ID
    public function show($id)
    {
        // Ambil single cart berdasarkan ID
        $cart = Cart::findOrFail($id);
        return view('show_cart', compact('cart'));
    }

    // Menampilkan semua cart milik user
    public function index()
    {
        // Ambil semua cart milik user
        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();
        $totalPrice = $cartItems->sum(function ($cartItem) {
            return $cartItem->amount;
        });

        $cart = Cart::where('user_id', auth()->id())->first();
        $discount = $cart && $cart->voucher ? $cart->voucher->discount : 0;
        $totalPriceAfterDiscount = $totalPrice - $discount;


        return view('index_cart', compact('cartItems', 'totalPrice', 'discount', 'totalPriceAfterDiscount'));
    }

    public function add_to_cart(Product $product, Request $request)
    {
        $maxStock = $product->stock ?? PHP_INT_MAX;
        $request->validate([
            'amount' => 'required|numeric|min:1|max:' . $maxStock,
        ]);

        $cart = Cart::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($cart) {
            $cart->update([
                'amount' => $cart->amount + $request->amount,
            ]);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id ?? 1,
                'amount' => $request->amount ?? 1,
                'quantity' => $request->quantity ?? 1, 
            ]);
        }

        return redirect()->route('index_cart')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);
        $user = Auth::user();

        $cartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->amount = $product->price * $cartItem->quantity;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'amount' => $product->price * $request->quantity
            ]);
        }

        return redirect('/cart')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }
    // Memperbarui quantity di cart
    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart->quantity = $request->quantity;
        $cart->amount = $cart->product->price * $request->quantity;
        $cart->save();

        return redirect('/cart')->with('success', 'Keranjang berhasil diperbarui!');
    }
    public function updateCartBulk(Request $request)
    {
        foreach ($request->quantities as $cartId => $quantity) {
            Cart::where('id', $cartId)->update(['quantity' => $quantity]);
        }
    
        return redirect()->back()->with('success', 'Cart updated successfully!');
    }
    

    // Menghapus produk dari cart
    public function delete(Request $request)
    {
        $cart = Cart::find($request->cart_id);
        if ($cart) {
            $cart->delete();
            return response()->json(['success' => true, 'message' => 'Produk dihapus dari keranjang']);
        } else {
            return response()->json(['success' => false, 'message' => 'Produk tidak ditemukan di keranjang'], 404);
        }
    }
}
