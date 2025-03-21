@extends('admin.layouts.master')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row  align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        POS
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-lg-6">
                    <div class="card ">
                        <div class="card-body">
                            <style>
                                .table-bordered-blue {
                                    border: 2px solid blue;

                                }

                                .table-bordered-blue th,
                                .table-bordered-blue td {
                                    border: 1px solid blue;

                                }
                            </style>
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table table-bordered-blue">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>QTY</th>
                                            <th>Price</th>
                                            <th>Subtotal</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $allcarts = Cart::content();

                                    @endphp
                                    <tbody>
                                        @foreach ($allcarts as $allcart)
                                            @php
                                                $productDetail = App\Models\Product::where('id', $allcart->id)->first();
                                            @endphp
                                            <tr class="text-center">
                                                <td> {{ $allcart->name }} </td>
                                                <td style="width: 100px;">
                                                    <form action="{{ route('admin.update.pos.cart', $allcart->rowId) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="number" name="qty" value="{{ $allcart->qty }}"
                                                            style="width: 40px" min="1"
                                                            max="{{ $productDetail->product_store }}" id="">
                                                        <button type="submit" class="btn btn-sm btn-success"
                                                            style="margin-top: -2px">
                                                            <i class="ti ti-check"></i>
                                                        </button>
                                                    </form>
                                                </td>

                                                <td> {{ number_format($allcart->price, 0, ',', '.') }}</td>
                                                <td> {{ number_format($allcart->subtotal, 0, ',', '.') }}</td>

                                                <td> <a href="{{ route('admin.delete.pos.cart', $allcart->rowId) }}"
                                                        class="text-red delete-item">
                                                        <i class="ti ti-trash-x"></i>
                                                    </a></td>

                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>
                                <div class="bg-primary text-center ">
                                    <br>
                                    <p style="font-size: 18px; color:#fff">Quantity : {{ Cart::count() }} </p>
                                    <p style="font-size: 18px; color:#fff">SubTotal : {{ Cart::subtotal() }}</p>
                                    <p style="font-size: 18px; color:#fff">Ppn 10% : {{ Cart::tax() }}</p>
                                    <p style="font-size: 18px; color:#fff">
                                    <h2 class="text-white">Total</h2>
                                    <h1 class="text-white ">{{ Cart::total() }}</h1>
                                    </p>
                                    <br>
                                </div>
                                <div class="text-center mt-2">

                                    <form action="{{ route('admin.add.invoice') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <x-input-block name="customer" value="noname" placeholder="Enter custmoer name" />

                                        <div class="mb-3 mt-3">
                                            <button class="btn btn-primary" type="submit">
                                                Create Invoice
                                            </button>
                                        </div>
                                    </form>
                                </div>


                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <form role="form" action="{{ route('admin.pos') }}" method="get" class="sm:flex">
                                <div class="row ">

                                    <div class="col-md">
                                        <div class="form-group">
                                            <input type="text" name="searchname" valu="{{ request('searchname') }}"
                                                placeholder="Search Name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        {{--  <button type="submit" class="btn btn-primary">Search</button>  --}}
                                        <a href="{{ route('admin.pos') }}" class="btn btn-danger">Clear</a>

                                    </div>

                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-vcenter card-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Image</th>
                                            <th>Name</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($products as  $product)
                                            <tr>
                                                <form action="{{ route('admin.add.pos.cart') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                                    <input type="hidden" name="name" value="{{ $product->name }}">
                                                    <input type="hidden" name="qty" value="1">
                                                    <input type="hidden" name="price"
                                                        value="{{ $product->harga_jual }}">


                                                    <td>{{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}
                                                    </td>
                                                    <td><img src="{{ asset($product->image) }}" alt=""
                                                            style="width: 50px; height:40px"></td>
                                                    <td>{{ $product->name }}</td>

                                                    <td>
                                                        <button type="submit" class="btn btn-primary ">
                                                            <i class="ti ti-square-rounded-plus"></i>
                                                        </button>
                                                    </td>

                                                </form>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10" class="text-center">No Data Found!</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4">
                                {{ $products->links() }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
