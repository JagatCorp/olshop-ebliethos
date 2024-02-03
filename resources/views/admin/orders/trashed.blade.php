@extends('admin.layout.dashboard')
@section('ActiveOrder', 'active')
@section('content')
    <div class="content pt-4">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>Order Yang Telah Di Hapus</h1>
                {{-- <p class="breadcrumbs"><span><a href="/admin/dashboard">Home</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>List Product
                </p> --}}
            </div>
            <div>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-primary shadow-sm"> <i class="fa fa-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    {{-- <div class="card-header card-header-border-bottom">
                        <h2>Trashed Orders</h2>
                        <div class="text-right">
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-primary shadow-sm float-right"> Kembali
                            </a>
                        </div>
                    </div> --}}
                    <div class="card-body">
                        <table id="responsive-data-table" class="table">
                            <thead>
                                <th>Order ID</th>
                                <th>Grand Total</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Payment</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr>
                                        <td>
                                            {{ $order->code }}<br>
                                            <span style="font-size: 12px; font-weight: normal">
                                                {{ $order->order_date }}</span>
                                        </td>
                                        <td>{{ $order->grand_total }}</td>
                                        <td>
                                            {{ $order->customer_full_name }}<br>
                                            <span style="font-size: 12px; font-weight: normal">
                                                {{ $order->customer_email }}</span>
                                        </td>
                                        <td>{{ $order->status }}</td>
                                        <td>{{ $order->payment_status }}</td>
                                        <td>
                                            <a href="{{ route('admin.orders.show', $order) }}"
                                                class="btn btn-info btn-sm">show</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No records found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @push('style-alt')
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
@endpush

@push('script-alt')
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script>
        $("#data-table").DataTable();
    </script>
@endpush --}}
