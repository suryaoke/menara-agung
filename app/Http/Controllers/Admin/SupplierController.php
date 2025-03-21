<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierStoreRequest;
use App\Http\Requests\SupplierUpdateRequest;
use App\Models\Supplier;
use App\Traits\FileUpload;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $suppliers = Supplier::orderBy('name', 'asc')->paginate(10);
        return view('admin.supplier.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        return view('admin.supplier.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplierStoreRequest $request): RedirectResponse
    {
        $imagePath = $this->uploadFile($request->file('image'));
        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->shopname = $request->shopname;
        $supplier->image = $imagePath;
        $supplier->save();

        notyf()->success("Created Supplier Successfully!");

        return to_route('admin.supplier.index');
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
    public function edit(Supplier $supplier)
    {

        return view('admin.supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SupplierUpdateRequest $request, Supplier $supplier)
    {
        if ($request->hasFile('image')) {
            $imagePath = $this->uploadFile($request->file('image'));
            $this->deleteFile($supplier->image);
            $supplier->image = $imagePath;
        }

        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->shopname = $request->shopname;

        $supplier->save();


        notyf()->success("Updated Supplier Successfully!");

        return to_route('admin.supplier.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        try {


            if ($supplier->image && file_exists(public_path(str_replace('/storage', 'storage', $supplier->image)))) {

                $this->deleteFile($supplier->image);
            }
            $supplier->delete();

            notyf()->success('Deleted Supplier Successfully!');
            return response(['message' => 'Deleted Successfully!'], 200);
        } catch (Exception $e) {
            logger("supplier Language Error >> " . $e);
            return response(['message' => 'Something went wrong!'], 500);
        }
    }
}
