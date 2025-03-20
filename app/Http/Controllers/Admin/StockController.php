<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(): View
    {
        $products = Product::paginate(10);
        return view('admin.stock.index', compact('products'));
    }
}
