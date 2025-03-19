<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //

    protected $fillable = [
        'name',
        'supplier_id',
        'category_id',
        'product_code',
        'image',
        'tanggal_beli',
        'harga_beli',
        'harga_jual',
    ];
}
