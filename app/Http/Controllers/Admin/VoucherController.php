<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use App\Models\Product;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::with('products')->get();
        return view('admin.vouchers.index', compact('vouchers'));
    }

    public function create()
    {
        $products = Product::all();
        return view('admin.vouchers.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:vouchers',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_amount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'max_uses' => 'nullable|integer|min:1',
            'products' => 'required|array'
        ]);

        $voucher = Voucher::create($request->only([
            'code',
            'discount_type',
            'discount_amount',
            'start_date',
            'end_date',
            'max_uses'
        ]));

        $voucher->products()->sync($request->products);

        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher berhasil dibuat');
    }

    public function edit(Voucher $voucher)
    {
        $products = Product::all();
        return view('admin.vouchers.edit', compact('voucher', 'products'));
    }

    public function update(Request $request, Voucher $voucher)
    {
        $request->validate([
            'code' => 'required|unique:vouchers,code,'.$voucher->id,
            'discount_type' => 'required|in:percentage,fixed',
            'discount_amount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'max_uses' => 'nullable|integer|min:1',
            'products' => 'required|array'
        ]);

        $voucher->update($request->only([
            'code',
            'discount_type',
            'discount_amount',
            'start_date',
            'end_date',
            'max_uses'
        ]));

        $voucher->products()->sync($request->products);

        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher berhasil diperbarui');
    }

    public function destroy(Voucher $voucher)
    {
        $voucher->delete();
        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher berhasil dihapus');
    }
}