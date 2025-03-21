<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Orders</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            text-align: center;
            padding: 8px;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        .total {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h4 style="text-align: center;">Laporan Orders</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Invoice No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>QTY</th>
                <th>Harga</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderItems as $key => $orderItem)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $orderItem->order->tanggal_order }}</td>
                    <td>{{ $orderItem->order->invoice_no }}</td>
                    <td>{{ $orderItem->product->product_code }}</td>
                    <td>{{ $orderItem->product->name }}</td>
                    <td>{{ $orderItem->quantity }}</td>
                    <td>{{ $orderItem->unitcost }}</td>
                    <td>{{ $orderItem->total }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="7" class="total">Total</td>
                <td class="total">{{ $total }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
