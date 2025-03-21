<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PrductTemplateExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Stok;
use App\Traits\FileUpload;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductImport;


class ProductController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $searchName = $request->input('searchname');
        $searchCode = $request->input('searchcode');

        $query = Product::query();
        if (!empty($searchName)) {
            $query->where('name', 'LIKE', '%' . $searchName . '%');
        }

        if (!empty($searchCode)) {
            $query->where('product_code', 'LIKE', '%' . $searchCode . '%');
        }


        $products = $query->orderBy('name', 'asc')->paginate(10);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $supplierOptions = Supplier::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        $categoryOptions = Category::orderBy('name', 'asc')->pluck('name', 'id')->toArray();

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
        $product->product_store = $request->product_store;
        $product->image = $imagePath;
        $product->save();

        $stok = new Stok();
        $stok->product_id = $product->id;
        $stok->awal = $product->product_store;
        $stok->save();

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
    public function edit(Product $product)
    {
        $supplierOptions = Supplier::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        $categoryOptions = Category::orderBy('name', 'asc')->pluck('name', 'id')->toArray();

        return view('admin.product.edit', compact('product', 'supplierOptions', 'categoryOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        if ($request->hasFile('image')) {
            $imagePath = $this->uploadFile($request->file('image'));
            $this->deleteFile($product->image);
            $product->image = $imagePath;
        }
        $product->name = $request->name;
        $product->supplier_id = $request->supplier_id;
        $product->category_id = $request->category_id;
        $product->product_code = $request->product_code;
        $product->tanggal_beli = $request->tanggal_beli;
        $product->harga_beli = $request->harga_beli;
        $product->harga_jual = $request->harga_jual;


        $product->save();


        notyf()->success("Updated Product Successfully!");

        return to_route('admin.product.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {


            if ($product->image && file_exists(public_path(str_replace('/storage', 'storage', $product->image)))) {

                $this->deleteFile($product->image);
            }
            $product->delete();

            notyf()->success('Deleted Product Successfully!');
            return response(['message' => 'Deleted Successfully!'], 200);
        } catch (Exception $e) {
            logger("product Language Error >> " . $e);
            return response(['message' => 'Something went wrong!'], 500);
        }
    }


    public function BarcodeProduct($id): View
    {
        $product = Product::findOrFail($id);

        return view('admin.product.barcode', compact('product'));
    }


    public function ImportProduct(): View
    {

        return view('admin.product.import');
    }



    public function ExportProduct()
    {
        return Excel::download(new ProductExport, 'products.xlsx');
    }



    public function ImportFileProduct(Request $request)
    {
        Excel::import(new ProductImport, $request->file('import_file'));

        notyf()->success("Product Import Successfully!");

        return to_route('admin.import.product');
    }

    public function ExportTemplateProduct()
    {
        return Excel::download(new PrductTemplateExport, 'template-products.xlsx');
    }
}
