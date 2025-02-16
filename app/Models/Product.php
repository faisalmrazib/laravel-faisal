<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Kolom yang diizinkan untuk diisi secara massal.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'decimal:4', // Cast kolom price ke DECIMAL dengan 2 digit di belakang koma
    ];

    protected $fillable = [
        'name', // Tambahkan ini
        'description', // Contoh kolom lain
        'price', // Contoh kolom lain
        'stock',
        'image',
    ];


   
        
}