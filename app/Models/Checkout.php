<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'voucher_id',
        'quantity',
        'total_price',
        'discount',
        'final_price',
        'payment_method',
        'shipping_address',
        'status'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relasi ke Voucher
    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }
}