@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Stores</h3>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($stores as  $store)
                                    <tr>
                                        <td>{{ ($stores->currentPage() - 1) * $stores->perPage() + $loop->iteration }}
                                        </td>
                                        <td><img src="{{ asset($store->image) }}" alt=""
                                                style="width: 50px; height:40px"></td>
                                        <td>{{ $store->name }}</td>
                                        <td>{{ $store->no_handphone }}</td>
                                        <td> {{ \Illuminate\Support\Str::words($store->address, 2, '...') }}</td>

                                        <td>

                                            <a href="{{ route('admin.store.edit', $store->id) }}"
                                                class="btn-sm btn-primary">
                                                <i class="ti ti-edit"></i>
                                            </a>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No Data Found!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $stores->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
