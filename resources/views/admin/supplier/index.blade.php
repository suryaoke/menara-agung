@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Suppliers</h3>
                    <div class="card-actions">
                        <form role="form" action="{{ route('admin.supplier.index') }}" method="get">
                            <div class="row ">

                                <div class="col-md">
                                    <div class="form-group">
                                        <input type="text" name="searchname" valu="{{ request('searchname') }}"
                                            placeholder="Search Name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md">

                                    <a href="{{ route('admin.supplier.index') }}" class="btn btn-danger">Clear</a>
                                    <a href="{{ route('admin.supplier.create') }}" class="btn btn-primary">
                                        <i class="ti ti-plus"></i>
                                        Add new
                                    </a>
                                </div>

                            </div>

                        </form>

                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>Shopname</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($suppliers as  $supplier)
                                    <tr>
                                        <td>{{ ($suppliers->currentPage() - 1) * $suppliers->perPage() + $loop->iteration }}
                                        </td>
                                        <td><img src="{{ asset($supplier->image) }}" alt=""
                                                style="width: 50px; height:40px"></td>
                                        <td>{{ $supplier->shopname }}</td>
                                        <td>{{ $supplier->name }}</td>
                                        <td>{{ $supplier->email }}</td>
                                        <td>{{ $supplier->phone }}</td>
                                        <td> {{ \Illuminate\Support\Str::words($supplier->address, 2, '...') }}</td>

                                        <td>

                                            <a href="{{ route('admin.supplier.edit', $supplier->id) }}"
                                                class="btn-sm btn-primary">
                                                <i class="ti ti-edit"></i>
                                            </a>

                                            <a href="{{ route('admin.supplier.destroy', $supplier->id) }}"
                                                class="text-red delete-item">
                                                <i class="ti ti-trash-x"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No Data Found!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $suppliers->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
