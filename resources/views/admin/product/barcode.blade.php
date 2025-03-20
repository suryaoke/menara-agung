@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Bar Code Products</h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.product.index') }}" class="btn btn-primary">
                            <i class="ti ti-arrow-left"></i>
                            Back
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="row ">
                        <div class="col-md">
                            <label class="form-label text-capitalize">Product Code</label>
                            <h3> {{ $product->product_code }} </h3>
                        </div>
                        @php
                            $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                        @endphp
                        <div class="col-md">
                            <label class="form-label text-capitalize">Product BarCode</label>
                            <h3> {!! $generator->getBarcode($product->product_code, $generator::TYPE_CODE_128) !!} </h3>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
