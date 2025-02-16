<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Pastikan model Product di-import

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard dengan daftar produk
     */
    public function index()
    {

        $product = Product::paginate(6); // 6 produk per halaman
    return view('dashboard', compact('product'));
        // Ambil data produk dengan pagination (10 item per halaman)
        $product = Product::latest()->paginate(10);
        
        // Jika ingin menampilkan semua produk tanpa pagination:
        // $products = Product::all();
        
        return view('dashboard', compact('product'));
    }
}