<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Voucher;

class AdminController extends Controller
{
    public function dashboard()
{
    $data = [
        'revenueChart' => [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            'data' => [12000000, 19000000, 3000000, 5000000, 2000000, 3000000]
        ]
    ];

    dd($data);

    return view('admin.dashboard', $data);
}
}