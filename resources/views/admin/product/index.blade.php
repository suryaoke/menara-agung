@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Products</h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.product.create') }}" class="btn btn-primary">
                            <i class="ti ti-plus"></i>
                            Add new
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
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Product</th>
                                    <th>Code</th>
                                    <th>Tanggal</th>
                                    <th>Jual</th>
                                    <th>Beli</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as  $product)
                                    <tr>
                                        <td>{{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}
                                        </td>
                                        <td><img src="{{ asset($product->image) }}" alt=""
                                                style="width: 50px; height:40px"></td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category_id }}</td>
                                        <td>{{ $product->supplier_id }}</td>
                                        <td>{{ $product->product_code }}</td>
                                        <td>{{ $product->tanggal_beli }}</td>

                                        <td> {{ number_format($product['harga_beli'], 0, ',', '.') }}</td>

                                        <td> {{ number_format($product['harga_jual'], 0, ',', '.') }}</td>


                                        <td>

                                            <a href="{{ route('admin.product.edit', $product->id) }}"
                                                class="btn-sm btn-primary">
                                                <i class="ti ti-edit"></i>
                                            </a>

                                            <a href="{{ route('admin.product.destroy', $product->id) }}"
                                                class="text-red delete-item">
                                                <i class="ti ti-trash-x"></i>
                                            </a>
                                        </td>
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
@endsection
