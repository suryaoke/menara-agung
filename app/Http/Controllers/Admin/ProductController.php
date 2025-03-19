<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Traits\FileUpload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $products = Product::paginate(10);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $supplierOptions = Supplier::pluck('name', 'id')->toArray();
        $categoryOptions = Category::pluck('name', 'id')->toArray();

        return view('admin.product.create', compact('supplierOptions', 'categoryOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(ProductStoreRequest $request): RedirectResponse
    {
        $imagePath = $this->uploadFile($request->file('image'));
        $product = new Product();
        $product->name = $request->name;
        $product->supplier_id = $request->supplier_id;
        $product->category_id = $request->category_id;
        $product->product_code = $request->product_code;
        $product->tanggal_beli = $request->tanggal_beli;
        $product->harga_beli = $request->harga_beli;
        $product->harga_jual = $request->harga_jual;
        $product->image = $imagePath;
        $product->save();

        notyf()->success("Created product Successfully!");

        return to_route('admin.product.index');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
