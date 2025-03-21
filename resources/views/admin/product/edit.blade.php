@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Update Products</h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.product.index') }}" class="btn btn-primary">
                            <i class="ti ti-arrow-left"></i>
                            Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.product.update', $product->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <x-image-preview src="{{ asset($product->image) }}" />


                            <div class="row ">
                                <div class="col-md">
                                    <x-input-file-block name="image" />
                                </div>
                                <div class="col-md">
                                    <x-input-block name="name" :value="$product->name" placeholder="Enter product name" />
                                </div>

                            </div>

                            <div class="row ">
                                <div class="col-md">
                                    <label class="form-label text-capitalize">Supplier</label>

                                    <x-select-block name="supplier_id" placeholder="Select Supplier" :value="$product->supplier_id"
                                        :options="$supplierOptions" />

                                    <x-input-error :messages="$errors->get('supplier_id')" class="mt-2" />
                                </div>
                                <div class="col-md">
                                    <label class="form-label text-capitalize">Category</label>

                                    <x-select-block name="category_id" placeholder="Select category" :value="$product->category_id"
                                        :options="$categoryOptions" />

                                    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                                </div>

                            </div>

                            <div class="row mt-2 ">
                                <div class="col-md">
                                    <x-input-block name="product_code" :value="$product->product_code" placeholder="Enter product code" />
                                </div>
                                <div class="col-md">
                                    <label class="form-label text-capitalize">Tanggal Beli</label>
                                    <div class="input-icon">
                                        <span
                                            class="input-icon-addon"><!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                                <path d="M16 3v4" />
                                                <path d="M8 3v4" />
                                                <path d="M4 11h16" />
                                                <path d="M11 15h1" />
                                                <path d="M12 15v3" />
                                            </svg>
                                        </span>
                                        <input class="form-control" placeholder="Select a date" type="date"
                                            name="tanggal_beli" value="{{ $product->tanggal_beli }}" />

                                    </div>
                                </div>

                            </div>


                            <div class="row ">
                                <div class="col-md">
                                    <x-input-number name="harga_beli" :value="$product->harga_beli"
                                        placeholder="Enter product harga beli" />
                                </div>
                                <div class="col-md">
                                    <x-input-number name="harga_jual" :value="$product->harga_jual"
                                        placeholder="Enter product harga jual" />
                                </div>

                            </div>

                          



                        </div>

                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">
                                <i class="ti ti-device-floppy"></i>
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
