<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TokoUpdateRequest;
use App\Models\Store;
use App\Traits\FileUpload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $stores = Store::paginate(10);
        return view('admin.store.index', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(store $store)
    {

        return view('admin.store.edit', compact('store'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TokoUpdateRequest $request, store $store)
    {
        if ($request->hasFile('image')) {
            $imagePath = $this->uploadFile($request->file('image'));
            $this->deleteFile($store->image);
            $store->image = $imagePath;
        }

        $store->name = $request->name;
        $store->address = $request->address;
        $store->no_handphone = $request->no_handphone;

        $store->save();


        notyf()->success("Updated Store Successfully!");

        return to_route('admin.store.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
