<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
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
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
