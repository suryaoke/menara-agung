<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Order; // Pastikan model Order ada dan terhubung ke tabel order
use App\Models\OrderDetails;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class OrderCompleteExport implements FromView
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {
    //     //
    // }

    /**
     * Load data for export to Excel
     *
     * @return View
     */
    public function view(): View
    {


        $orders = Order::where('order_status', 'completed')->first();

        $orderItems = OrderDetails::with('product')
            ->whereHas('order', function ($query) {
                $query->where('order_status', 'completed');
            })
            ->orderBy('id', 'DESC')
            ->get();
        $total = OrderDetails::whereHas('order', function ($query) {
            $query->where('order_status', 'completed');
        })->sum('total');
        return view('admin.order.export_complete', [
            'orders' => $orders,
            'orderItems' => $orderItems,
            'total' => $total
        ]);
    }
}
