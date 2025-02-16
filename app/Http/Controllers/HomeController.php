<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
        $totalProducts = Product::where('is_active', true)->count(); // Hanya hitung produk aktif
    return view('welcome', compact('totalProducts'));

        $totalProducts = Product::count(); // Hitung total produk
        return view('welcome', compact('totalProducts')); // Teruskan variabel ke view
    
    }

    public function dashboard()
{
    $totalProducts = Product::count();
    $totalOrders = Order::count();
    $totalRevenue = Order::sum('total');
    $latestProducts = Product::latest()->take(5)->get();
    $latestOrders = Order::with('user')->latest()->take(5)->get();

    return view('dashboard', compact(
        'totalProducts',
        'totalOrders',
        'totalRevenue',
        'latestProducts',
        'latestOrders'
    ));
}
}
