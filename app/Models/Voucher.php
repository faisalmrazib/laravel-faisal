<?php

// app/Models/Voucher.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
        'code',
        'type',
        'discount_value',
        'max_uses',
        'used',
        'valid_from',
        'valid_until',
        'user_limit'
    ];

    public function isValid()
    {
        if ($this->max_uses && $this->used >= $this->max_uses) {
            return false;
        }

        if (now() < $this->valid_from || now() > $this->valid_until) {
            return false;
        }

        return true;
    }
}