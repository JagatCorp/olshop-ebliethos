<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Transaksi Report</title>
    <style type="text/css">
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table tr td,
        table tr th {
            font-size: 10pt;
            text-align: left;
            padding: 8px;
            border: 1px solid #dddddd;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table th {
            background-color: #dddddd;
        }
    </style>
</head>

<body>
    <h2>Transaksi Report</h2>
    <hr>
    <p>Period : {{ date('d M Y', strtotime($startDate)) }} - {{ date('d M Y', strtotime($endDate)) }}</p>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Produk</th>
                <th>Qty</th>
                <th>Pembelian Ke</th>
                <th>Grand Total</th>
                <th>Nama Pelanggan</th>
                <th>Status Pembayaran</th>
                <th>Diskon</th>
                <th>Payment</th>
                <th>Biaya Pengiriman</th>
                <th>Jasa Pengiriman</th>
                <th>Catatan Pelanggan</th>
                <th>No. Telepon Pelanggan</th>
                <th>Email Pelanggan</th>
                <th>Kode Pos Pelanggan</th>
                <th>Alamat Pelanggan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $order)
                @foreach ($order->orderItems as $item)
                    <tr>
                        <td>{{ $order->code }}</td>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ $item->product->totalOrders() }}</td>
                        <td>Rp{{ number_format($order->grand_total, 0, ',', '.') }}</td>
                        <td>{{ $order->customer_full_name }}<br>{{ $order->customer_email }}</td>
                        <td>{{ $order->status }}</td>
                        <td>Diskon: {{ $order->discount_percent }}%</td>
                        <td>{{ $order->payment_status }}</td>
                        <td>Rp{{ number_format($order->shipping_cost, 0, ',', '.') }}</td>
                        <td>{{ $order->shipping_courier }}<br>{{ $order->shipping_service_name }}</td>
                        <td>{{ $order->note }}</td>
                        <td>{{ $order->customer_phone }}</td>
                        <td>{{ $order->customer_email }}</td>
                        <td>{{ $order->customer_postcode }}</td>
                        <td>{{ $order->customer_address1 }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>

</html>
