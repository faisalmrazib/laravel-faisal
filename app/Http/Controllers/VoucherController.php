<?php
// app/Http/Controllers/Admin/VoucherController.php

// app/Http/Controllers/VoucherController.php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoucherController extends Controller
{
    // app/Http/Controllers/VoucherController.php

public function apply(Request $request)
{
    $request->validate([
        'voucher_code' => 'required|exists:vouchers,code',
    ]);

    $voucher = Voucher::where('code', $request->voucher_code)->first();

    if ($voucher->expires_at < now()) {
        return redirect()->back()->with('error', 'Voucher sudah kedaluwarsa.');
    }

    $cart = Cart::where('user_id', Auth::id())->first();

    if ($cart->voucher_id) {
        return redirect()->back()->with('error', 'Anda sudah menggunakan voucher.');
    }

    $cart->voucher_id = $voucher->id;
    $cart->save();

    return redirect()->back()->with('success', 'Voucher berhasil diterapkan.');
}


// app/Http/Controllers/VoucherController.php

public function remove()
{
    $cart = Cart::where('user_id', Auth::id())->first();
    $cart->voucher_id = null;
    $cart->save();

    return redirect()->back()->with('success', 'Voucher berhasil dihapus.');
}

}