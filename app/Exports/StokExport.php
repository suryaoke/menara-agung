<?php

namespace App\Exports;

use App\Models\Stok;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class StokExport implements FromView
{

    /**
     * Load data for export to Excel
     *
     * @return View
     */
    public function view(): View
    {

        $stoks = Stok::orderBy('product_id', 'desc')->get();
        return view('admin.stock.export', [
            'stoks' => $stoks,

        ]);
    }
}
