<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .invoice-container {
            background-color: white;
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            /* Align items vertically */
            margin-bottom: 20px;
        }

        .company-info {
            display: flex;
            align-items: center;
        }

        .company-info img {
            width: 80px;
            height: 80px;
            margin-right: 20px;
        }

        .company-info h1 {
            margin: 0;
            font-size: 14px;
            color: #333;
        }

        .company-info p {
            margin: 5px 0;
            color: #666;
        }

        .client-info {
            text-align: right;
        }

        .client-info p {
            margin: 5px 0;
            color: #666;
        }

        .invoice-details h2 {
            font-size: 13px;
            color: #333;
            margin-bottom: 20px;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .items-table th,
        .items-table td {
            border: 1px solid #ddd;
            padding: 7px;
            text-align: left;
        }

        .items-table th {
            background-color: #f4f4f4;
        }

        .summary {
            text-align: right;
            margin-bottom: 20px;
        }

        .summary p {
            margin: 5px 0;
            color: #333;
        }

        .summary h3 {
            margin-top: 10px;
            font-size: 15px;
            color: #333;
        }

        .footer {
            text-align: center;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <div class="header">
            <div class="company-info">
                {{--  <img
                    src="{{ $store->image ? asset($store->image) : asset('admin/assets/static/avatars/userprofile.jpg') }}">  --}}
                <div>
                    <h1>Jaya {{ $store->name }} </h1>
                    <p>{{ $store->address }}</p>
                    <p> {{ $store->no_handphone }}</p>
                </div>
            </div>
            <div class="client-info">
                <p>Client : {{ $orders->customer }} </p>
                <p>
                    Order Date : {{ $orders->tanggal_order }} <br>
                    Payment Status : {{ $orders->payment_status }} <br>
                    Paid Amount :{{ $orders->pay }} <br>
                    Due Amount :{{ $orders->due }}

                </p>
            </div>
        </div>

        <div class="invoice-details">
            <h2>Invoice : {{ $orders->invoice_no }} </h2>
        </div>

        <table class="items-table">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>ITEM</th>
                    <th>QTY</th>
                    <th>UNIT</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
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
            </tbody>
        </table>

        <div class="summary">
            <p>Subtotal: {{ $orders->sub_total }}</p>
            <p>PPN 10%: {{ $orders->vat }}</p>
            <h3>Total: {{ $orders->total }}</h3>
        </div>

        <div class="footer">
            <p>Thank you very much for doing business with us. We look forward to working with you again!</p>
        </div>
    </div>
</body>

</html>
