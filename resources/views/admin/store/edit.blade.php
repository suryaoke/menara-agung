@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Update Store</h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.store.index') }}" class="btn btn-primary">
                            <i class="ti ti-arrow-left"></i>
                            Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.store.update', $store->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <x-image-preview src="{{ asset($store->image) }}" />

                            <div class="row ">
                                <div class="col-md">
                                    <x-input-file-block name="image" />
                                </div>
                                <div class="col-md">
                                    <x-input-block name="name" :value="$store->name" placeholder="Enter store name" />
                                </div>

                            </div>



                            <div class="row ">
                                <div class="col-md">
                                    <x-input-number name="no_handphone" :value="$store->no_handphone" placeholder="Enter store phone" />
                                </div>
                                <div class="col-md">
                                    <x-input-text name="address" :value="$store->address" placeholder="Enter store address" />
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
