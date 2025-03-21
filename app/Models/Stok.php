<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    protected $fillable = [
        'product_id',
        'tanggal',
        'stok_awal',
        'stok_masuk',
        'stok_keluar',
    ];

    function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
