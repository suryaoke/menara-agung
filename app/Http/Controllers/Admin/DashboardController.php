<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $product = Product::count();
        $productStock = Product::where('product_store', '=', '0')->count();
        $successOrder = Order::where('order_status', 'completed')->count();
        $pendingOrder = Order::where('order_status', 'pending')->count();
        return view('admin.dashboard', compact('product', 'productStock', 'successOrder', 'pendingOrder'));
    }
}
