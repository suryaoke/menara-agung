@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $product->name }}
                        <br> Tanggal Beli : {{ $product->tanggal_beli }}
                        <br> Product Code : {{ $product->product_code }}
                    </h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.stock') }}" class="btn btn-primary">
                            <i class="ti ti-arrow-left"></i>
                            Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>Tanggal</th>
                                    <th>Stok Awal</th>
                                    <th>Stok Masuk</th>
                                    <th>Stok Keluar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($stoks as  $stok)
                                    <tr>
                                        <td>{{ ($stoks->currentPage() - 1) * $stoks->perPage() + $loop->iteration }}
                                        </td>
                                        <td><img src="{{ asset($stok->product->image) }}" alt=""
                                                style="width: 50px; height:40px"></td>
                                        <td>{{ $stok->tanggal }}</td>
                                        <td> {{ $stok->stok_awal }} </td>
                                        <td>{{ $stok->stok_masuk }}</td>
                                        <td> {{ $stok->stok_keluar }} </td>


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
                        {{ $stoks->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
