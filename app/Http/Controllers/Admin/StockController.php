<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Stok;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(): View
    {
        $products = Product::paginate(10);
        return view('admin.stock.index', compact('products'));
    }

    public function AddStok(Request $request): RedirectResponse
    {


        $stok = new Stok();
        $stok->product_id = $request->product_id;
        $stok->stok_masuk = $request->stok_masuk;
        $stok->tanggal = $request->tanggal;
        $stok->save();

        $product = Product::where('id', $request->product_id)->first();
        $product->product_store = $product->product_store + $stok->stok_masuk;
        $product->save();

        notyf()->success("Add Stok Successfully!");

        return to_route('admin.stock');
    }

    public function detail($id): View
    {
        $product = Product::find($id);

        $stoks = Stok::where('product_id', $id)->paginate(10);
        return view('admin.stock.detail', compact('stoks', 'product'));
    }
}
