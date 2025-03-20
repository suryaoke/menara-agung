<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Product::select(
            'name',
            'supplier_id',
            'category_id',
            'product_code',
            'image',
            'tanggal_beli',
            'harga_beli',
            'harga_jual',
            'product_store'
        )->get();
    }
}
