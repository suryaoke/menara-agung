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
                <th>kategory</th>
                <th>Product Code</th>
                <th>Image</th>
                <th>Tanggal Beli</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Product Store</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $key => $product)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product['category']['name'] }}</td>
                    <td>{{ $product['supplier']['name'] }}</td>
                    <td>{{ $product->image }}</td>
                    <td>{{ $product->tanggal_beli }}</td>
                    <td>{{ $product->harga_beli }}</td>
                    <td>{{ $product->harga_jual }}</td>
                    <td>{{ $product->product_store }}</td>

                </tr>
            @endforeach

        </tbody>
    </table>
</body>

</html>
