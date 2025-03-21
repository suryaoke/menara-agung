<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{

    protected $fillable = [
        'name',
        'supplier_id',
        'category_id',
        'product_code',
        'image',
        'tanggal_beli',
        'harga_beli',
        'harga_jual',
        'product_store'
    ];


    function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
