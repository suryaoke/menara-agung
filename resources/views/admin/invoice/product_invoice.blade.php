@extends('admin.layouts.master')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Customer Invoice
                    </h2>
                </div>
                <!-- Page title actions -->

                <div class="col-auto ms-auto d-print-none">

                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-report" aria-haspopup="true"
                        aria-expanded="false" class="btn btn-success">
                        Submit
                    </a>

                    <a href="{{ route('admin.pos') }}" class="btn btn-primary">
                        <i class="ti ti-arrow-left"></i>
                        Back
                    </a>
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
                            <p class="h3">Client</p>
                            <address>
                                {{ $customer }}
                            </address>
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
                        @foreach ($contents as $content)
                            <tr class="text-center">
                                <td> {{ $no++ }}
                                </td>
                                <td> {{ $content->name }} </td>
                                <td>
                                    {{ $content->qty }}
                                </td>

                                <td> {{ number_format($content->price, 0, ',', '.') }}</td>
                                <td> {{ number_format($content->subtotal, 0, ',', '.') }}</td>



                            </tr>
                        @endforeach




                        <tr>
                            <td colspan="4" class="strong text-end">Subtotal</td>
                            <td class="text-end"> {{ Cart::subtotal() }}</td>
                        </tr>

                        <tr>
                            <td colspan="4" class="strong text-end">PPN 10%</td>
                            <td class="text-end"> {{ Cart::tax() }}</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="font-weight-bold text-uppercase text-end">Total</td>
                            <td class="font-weight-bold text-end">{{ Cart::total() }}</td>
                        </tr>
                    </table>
                    <p class="text-secondary text-center mt-5">Thank you very much for doing business with us. We look
                        forward to working with
                        you again!</p>
                </div>
            </div>
        </div>
    </div>



    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.final.invoice') }}" autocomplete="off" novalidate>
                    @csrf
                    <div class=" mt-4 mb-2 text-center">

                        <h5 class="modal-title">Invoice {{ $customer }} </h5>
                        <h5 class="modal-title">Total Amount {{ Cart::total() }} </h5>


                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label text-capitalize">Payment</label>

                            <x-select-block name="payment_status" :value="old('payment_status', 'cash')" :options="['cash' => 'Cash', 'transfer' => 'Transfer']" />


                            <x-input-error :messages="$errors->get('payment_status')" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pay Now</label>
                            <input type="number" id="payNow" name="pay" value="{{ old('pay') }}"
                                class="form-control" placeholder="Pay Now" autocomplete="off" required>
                            <x-input-error :messages="$errors->get('pay')" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Due Amount</label>
                            <input type="number"  name="due" value="{{ old('due') }}"
                                class="form-control" placeholder="Due Amount" autocomplete="off" required readonly>
                            <x-input-error :messages="$errors->get('due')" class="mt-2" />
                        </div>


                        <input type="hidden" name="customer" value="{{ $customer }}">
                        <input type="hidden" name="tanggal_order" value="{{ now()->format('Y-m-d') }}">
                        <input type="hidden" name="order_status" value="pending">
                        <input type="hidden" name="total_product" value="{{ Cart::count() }}">
                        <input type="hidden" name="sub_total" value="{{ Cart::subtotal() }}">
                        <input type="hidden" name="vat" value="{{ Cart::tax() }}">
                        <input type="hidden" name="total" value="{{ Cart::total() }}">



                    </div>

                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">

                            Complete Order
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{--  <script>
        const payNowInput = document.getElementById('payNow');
        const dueAmountInput = document.getElementById('dueAmount');


        const cartTotalString = '{{ Cart::total() }}'.replace(/\./g, '').replace(',', '.');
        const cartTotal = parseFloat(cartTotalString); // Convert the string to a float

        // Function to update Due Amount
        function updateDueAmount() {
            let payNow = parseFloat(payNowInput.value) || 0; // Set Pay Now to 0 if empty
            let dueAmount = Math.floor(cartTotal - payNow); // Calculate Due Amount and round down
            dueAmountInput.value = dueAmount >= 0 ? dueAmount : 0; // Set Due Amount (no negative values)
        }

        // Initialize Due Amount when page loads
        window.addEventListener('DOMContentLoaded', updateDueAmount);

        // Also initialize Due Amount when modal is shown
        document.getElementById('modal-report').addEventListener('shown.bs.modal', updateDueAmount);

        // Listen for changes in the Pay Now input field
        payNowInput.addEventListener('input', updateDueAmount);
    </script>  --}}
@endsection
