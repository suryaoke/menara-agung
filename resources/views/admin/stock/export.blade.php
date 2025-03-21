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
    <table>

        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Product Code</th>
                <th>Tanggal Beli</th>
                <th>Tanggal</th>
                <th>Stok Awal</th>
                <th>Stok Masuk</th>
                <th>Stok Keluar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stoks as $key => $stok)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $stok->product->name }}</td>
                    <td>{{ $stok->product->product_code }}</td>
                    <td>{{ $stok->product->tanggal_beli }}</td>
                    <td>{{ $stok->tanggal }}</td>
                    <td>{{ $stok->stok_awal }}</td>
                    <td>{{ $stok->stok_masuk }}</td>
                    <td>{{ $stok->stok_keluar }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
</body>

</html>
