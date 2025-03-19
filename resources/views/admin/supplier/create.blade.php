@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Supplier</h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.supplier.index') }}" class="btn btn-primary">
                            <i class="ti ti-arrow-left"></i>
                            Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.supplier.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="row ">
                                <div class="col-md">
                                    <x-input-file-block name="image" />
                                </div>
                                <div class="col-md">
                                    <x-input-block name="shopname" placeholder="Enter shopname" />
                                </div>

                            </div>

                            <div class="row ">
                                <div class="col-md">
                                    <x-input-block name="name" placeholder="Enter supplier name" />
                                </div>
                                <div class="col-md">
                                    <x-input-email name="email" placeholder="Enter supplier email" />
                                </div>

                            </div>

                            <div class="row ">
                                <div class="col-md">
                                    <x-input-number name="phone" placeholder="Enter supplier phone" />
                                </div>
                                <div class="col-md">
                                    <x-input-text name="address" placeholder="Enter supplier address" />
                                </div>

                            </div>



                        </div>

                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">
                                <i class="ti ti-device-floppy"></i>
                                Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
