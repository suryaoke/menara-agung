@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Update Supplier</h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.supplier.index') }}" class="btn btn-primary">
                            <i class="ti ti-arrow-left"></i>
                            Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.supplier.update', $supplier->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <x-image-preview src="{{ asset($supplier->image) }}" />

                            <div class="col-md-12">
                                <x-input-file-block name="image" />
                            </div>

                            <div class="col-md-12">
                                <x-input-block name="shopname" :value="$supplier->shopname" placeholder="Enter supplier shopName" />
                            </div>

                            <div class="col-md-12">
                                <x-input-block name="name" :value="$supplier->name" placeholder="Enter supplier name" />
                            </div>

                            <div class="col-md-12">
                                <x-input-email name="email" :value="$supplier->email" placeholder="Enter supplier email" />
                            </div>

                            <div class="col-md-12">
                                <x-input-number name="phone" :value="$supplier->phone" placeholder="Enter supplier phone" />
                            </div>

                            <div class="col-md-12">
                                <x-input-text name="address" :value="$supplier->address" placeholder="Enter supplier address" />
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
