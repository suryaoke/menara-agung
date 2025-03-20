<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer',
        'tanggal_order',
        'order_status',
        'sub_total',
        'total_product',
        'vat',
        'invoice_no',
        'total',
        'payment_status',
        'pay',
        'due',

    ];


}
