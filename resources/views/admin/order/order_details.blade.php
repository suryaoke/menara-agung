@extends('admin.layouts.master')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Pending Invoice
                    </h2>
                </div>
                <!-- Page title actions -->

                <div class="col-auto ms-auto d-print-none">

                    <form action="{{ route('admin.order.status.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $orders->id }}">
                        <button type="submit" class="btn btn-success">

                            Complete Order
                        </button>

                        <a href="{{ route('admin.pending.order') }}" class="btn btn-primary">
                            <i class="ti ti-arrow-left"></i>
                            Back
                        </a>
                    </form>



                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="card card-lg">
                <div class="card-body">

                    <div class="row">

                        <div class="col-6">
                            {{--  <span class="avatar avatar-xl"
                                style="background-image: url({{ $store->image ? asset($store->image) : asset('admin/assets/static/avatars/userprofile.jpg') }})">
                            </span>  --}}
                            <p class="h3 mt-1"> {{ $store->name }} </p>
                            <address>
                                {{ $store->address }} <br>
                                {{ $store->no_handphone }}

                            </address>
                        </div>
                        <div class="col-6 text-end">
                            <p class="h3">Client : {{$orders->customer}} </p>
                            <address>
                                Order Date : {{ $orders->tanggal_order }} <br>
                                Payment Status : {{ $orders->payment_status }} <br>
                                Paid Amount :{{ $orders->pay }} <br>
                                Due Amount :{{ $orders->due }} <br>
                                Change :{{ $orders->change }}

                            </address>
                        </div>
                        <div class="col-12 mt-2">
                            <p class="h3">Invoice : {{ $orders->invoice_no }} </p>
                        </div>
                    </div>
                    <table class="table table-transparent table-responsive">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 1%">No</th>
                                <th class="text-center">Item</th>
                                <th class="text-center" style="width: 1%">Qty</th>
                                <th class="text-end" style="width: 1%">Unit</th>
                                <th class="text-end" style="width: 1%">Total</th>
                            </tr>
                        </thead>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($orderItems as $orderItem)
                            <tr class="text-center">
                                <td> {{ $no++ }}
                                </td>
                                <td> {{ $orderItem->product->name }} </td>
                                <td>
                                    {{ $orderItem->quantity }}
                                </td>

                                <td> {{ number_format($orderItem->unitcost, 0, ',', '.') }}</td>
                                <td> {{ number_format($orderItem->total, 0, ',', '.') }}</td>

                            </tr>
                        @endforeach




                        <tr>
                            <td colspan="4" class="strong text-end">Subtotal</td>
                            <td class="text-end">{{ $orders->sub_total }}</td>
                        </tr>

                        <tr>
                            <td colspan="4" class="strong text-end">PPN 10%</td>
                            <td class="text-end"> {{ $orders->vat }}</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="font-weight-bold text-uppercase text-end">Total</td>
                            <td class="font-weight-bold text-end">{{ $orders->total }}</td>
                        </tr>
                    </table>
                    <p class="text-secondary text-center mt-5">Thank you very much for doing business with us. We look
                        forward to working with
                        you again!</p>
                </div>
            </div>
        </div>
    </div>
@endsection
