@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Stock All Products</h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.export.stok') }}" class="btn btn-success">

                            Export
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
                                    <th>Supplier</th>
                                    <th>Code</th>
                                    <th>Tanggal Beli</th>
                                    <th>Stok</th>
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
                                        <td>{{ $product['category']['name'] }}</td>
                                        <td>{{ $product['supplier']['name'] }}</td>
                                        <td>{{ $product->product_code }}</td>
                                        <td>{{ $product->tanggal_beli }}</td>
                                        <td> {{ $product->product_store }} </td>

                                        <td>
                                            <a href="{{ route('admin.detail.stok', $product->id) }}"
                                                class="btn-sm btn-primary">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#add-stok-{{ $product->id }}" aria-haspopup="true"
                                                aria-expanded="false" class="btn-sm text-green">
                                                <i class="ti ti-plus"></i>
                                            </a>

                                        </td>
                                    </tr>


                                    <div class="modal modal-blur fade" id="add-stok-{{ $product->id }}" tabindex="-1"
                                        role="dialog" aria-hidden="true">
                                        <div class="modal-dialog  modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <form method="POST" action="{{ route('admin.add.stok') }}"
                                                    autocomplete="off" novalidate>
                                                    @csrf

                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <div class=" mt-4 mb-2 text-center">

                                                        <h5 class="modal-title">Add Stock </h5>

                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="mb-3">
                                                            <label class="form-label">Stok</label>
                                                            <input type="number" name="stok_masuk"
                                                                value="{{ old('stok_masuk') }}" class="form-control"
                                                                placeholder="Stok Masuk"
                                                                autocomplete="off" required>
                                                            <x-input-error :messages="$errors->get('stok_masuk')" class="mt-2" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Tanggal</label>
                                                            <div class="input-icon">
                                                                <span
                                                                    class="input-icon-addon"><!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                                        width="24" height="24" viewBox="0 0 24 24"
                                                                        stroke-width="2" stroke="currentColor"
                                                                        fill="none" stroke-linecap="round"
                                                                        stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none" />
                                                                        <path
                                                                            d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                                                        <path d="M16 3v4" />
                                                                        <path d="M8 3v4" />
                                                                        <path d="M4 11h16" />
                                                                        <path d="M11 15h1" />
                                                                        <path d="M12 15v3" />
                                                                    </svg>
                                                                </span>
                                                                <input class="form-control" placeholder="Select a date"
                                                                    type="date" name="tanggal"
                                                                    value="{{ \Carbon\Carbon::now()->toDateString() }}" />

                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="modal-footer">
                                                        <a href="#" class="btn btn-link link-secondary"
                                                            data-bs-dismiss="modal">
                                                            Cancel
                                                        </a>
                                                        <button type="submit" class="btn btn-primary ms-auto"
                                                            data-bs-dismiss="modal">

                                                            Complete Order
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No Data Found!</td>
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
