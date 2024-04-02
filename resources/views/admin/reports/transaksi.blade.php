@extends('admin.layout.dashboard')
@section('title', 'Transaksi Report')
@section('ActiveReport', 'active')
@section('content')
    <div class="content pt-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Transaksi Report</h2>
                    </div>
                    <div class="card-body">
                        @include('admin.reports.filter')
                        <div class="table-responsive">
                            <table id="responsive-data-table" class="table">
                                <thead class="text-primary">
                                    <th>Order ID</th>
                                    <th>Produk</th>
                                    <th>Grand Total</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Status Pembayaran</th>
                                    <th>Diskon</th>
                                    <th>Status Pembayaran</th>
                                    <th>Biaya Pengiriman</th>
                                    <th>Jasa Pengiriman</th>
                                    <th>Catatan Pelanggan</th>
                                    <th>No. Telepon Pelanggan</th>
                                    <th>Kode Pos Pelanggan</th>
                                    <th>Alamat Pelanggan</th>

                                </thead>
                                <tbody>
                                    @forelse ($transaksi as $order)
                                        <tr>
                                            <td>{{ $order->code }}<br>
                                                <span style="font-size: 12px; font-weight: normal">
                                                    {{ $order->order_date }}</span>
                                            </td>
                                            <td>
                                                @foreach ($order->orderItems as $item)
                                                    @if ($item->product)
                                                        {{ $item->product->name }}<br>
                                                        pembelian ke: {{ $item->product->totalOrders() }} kali
                                                    @else
                                                        {{ $item->name }}<br>
                                                    @endif
                                                    <br />
                                                    <span style="font-size: 12px; font-weight: normal">
                                                        qty: {{ $item->qty }}</span>
                                                @endforeach

                                            </td>
                                            <td>Rp{{ number_format($order->grand_total, 0, ',', '.') }}</td>
                                            <td>
                                                {{ $order->customer_full_name }}<br>
                                                <span style="font-size: 12px; font-weight: normal">
                                                    {{ $order->customer_email }}</span>
                                            </td>
                                            <td>{{ $order->status }}</td>
                                            <td>Diskon: {{ $order->discount_percent }}%</td>
                                            <td>{{ $order->payment_status }}</td>
                                            <td>Rp{{ number_format($order->shipping_cost, 0, ',', '.') }}</td>
                                            <td>
                                                {{ $order->shipping_courier }}<br>
                                                <span style="font-size: 12px; font-weight: normal">
                                                    {{ $order->shipping_service_name }}</span>
                                            </td>
                                            <td>{{ $order->note }}</td>

                                            <td>{{ $order->customer_phone }}</td>
                                            <td>{{ $order->customer_postcode }}</td>
                                            <td>{{ $order->customer_address1 }}</td>




                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2">Tidak ada data pesanan</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style-alt')
    <!-- DataTables -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
        integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@push('script-alt')
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
        integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });
    </script>
@endpush
