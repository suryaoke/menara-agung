<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class ProductExport implements FromView

{

    /**
     * Load data for export to Excel
     *
     * @return View
     */
    public function view(): View
    {

        $products = Product::orderBy('name', 'asc')->get();
        return view('admin.product.export', [
            'products' => $products,

        ]);
    }
}
