@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pending Orders</h3>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Order Date</th>
                                    <th>Payment</th>
                                    <th>Invoice</th>
                                    <th>Pay</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as  $order)
                                    <tr>
                                        <td>{{ ($orders->currentPage() - 1) * $orders->perPage() + $loop->iteration }}
                                        </td>

                                        <td>{{ $order->customer }}</td>
                                        <td>{{ $order->tanggal_order }}</td>
                                        <td>{{ $order->payment_status }}</td>
                                        <td>{{ $order->invoice_no }}</td>
                                        <td>{{ $order->pay }}</td>
                                        <td>
                                            <a href="#" class="btn btn-outline-danger active w-10">
                                                {{ $order->order_status }}
                                            </a>

                                        </td>

                                        <td>
                                            <a href="{{ route('admin.order.details', $order->id) }}"
                                                class="btn btn-outline-primary active w-10">
                                              Detail
                                            </a>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No Data Found!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $orders->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
