<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\Product;
use App\Models\Voucher;
use App\Services\RajaOngkirService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    // Menampilkan halaman checkout
    public function index()
    {
        $user = Auth::user();
        $cartItems = $user->cartItems ?? collect(); // Pastikan tidak null
        return view('checkout_index', compact('cartItems'));
    }

    // Proses checkout dengan AJAX
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'voucher_code' => 'nullable|exists:vouchers,code',
            'shipping_address' => 'required|string|max:255',
            'origin' => 'required|string',
            'destination' => 'required|string',
            'weight' => 'required|numeric|min:1',
            'courier' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        // Hitung ongkos kirim
        $rajaOngkirService = new RajaOngkirService();
        $cost = $rajaOngkirService->getCost($request->origin, $request->destination, $request->weight, $request->courier);

        // Ambil data produk
        $product = Product::findOrFail($request->product_id);

        // Hitung total harga sebelum diskon
        $totalPrice = $product->price * $request->quantity;

        // Cek dan terapkan voucher jika ada
        $discount = 0;
        $voucher = null;

        if ($request->voucher_code) {
            $voucher = Voucher::where('code', $request->voucher_code)->first();

            if ($voucher && $voucher->isValid()) {
                $discount = $voucher->calculateDiscount($totalPrice);
                $totalPrice -= $discount;
                $voucher->increment('used_count'); // Update penggunaan voucher
            }
        }

        // Buat checkout
        $checkout = Checkout::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'voucher_id' => $voucher ? $voucher->id : null,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'discount' => $discount,
            'shipping_address' => $request->shipping_address,
            'shipping_cost' => $cost, // Simpan ongkos kirim
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Checkout berhasil!',
            'data' => $checkout,
        ]);
    }
}
