@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Categories</h3>
                    <div class="card-actions">

                        <form role="form" action="{{ route('admin.category.index') }}" method="get">
                            <div class="row ">

                                <div class="col-md">
                                    <div class="form-group">
                                        <input type="text" name="searchname" valu="{{ request('searchname') }}"
                                            placeholder="Search Name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md">

                                    <a href="{{ route('admin.category.index') }}" class="btn btn-danger">Clear</a>
                                    <a href="{{ route('admin.category.create') }}" class="btn btn-primary">
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
                                    <th>Name</th>
                                    <th>Descripton</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as  $categorie)
                                    <tr>
                                        <td>{{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}
                                        </td>
                                        <td>{{ $categorie->name }}</td>
                                        <td> {{ \Illuminate\Support\Str::words($categorie->description, 3, '...') }}</td>
                                        <td>

                                            <a href="{{ route('admin.category.edit', $categorie->id) }}"
                                                class="btn-sm btn-primary">
                                                <i class="ti ti-edit"></i>
                                            </a>

                                            <a href="{{ route('admin.category.destroy', $categorie->id) }}"
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
                        {{ $categories->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
