<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'unitcost',
        'total',

    ];

    public function product() {

        return $this->belongsTo(Product::class, 'product_id' , 'id');
    }
}
