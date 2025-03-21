<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Stok; // Jangan lupa untuk mengimpor model Stok
use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        $product = new Product([
            'name' => $row[0],
            'supplier_id' => $row[1],
            'category_id' => $row[2],
            'product_code' => $row[3],
            'image' => $row[4],
            'tanggal_beli' => $row[5],
            'harga_beli' => $row[6],
            'harga_jual' => $row[7],
            'product_store' => $row[8],
        ]);


        $product->save();


        $stok = new Stok();
        $stok->product_id = $product->id;
        $stok->stok_awal = $product->product_store;
        $stok->save();

        // Kembalikan produk yang dibuat
        return $product;
    }
}
