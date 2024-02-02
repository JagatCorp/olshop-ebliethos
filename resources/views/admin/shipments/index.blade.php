@extends('admin.layout.dashboard')

@section('content')
    <!-- Main content -->
    <section class="ec-content-wrapper">
        <div class="content">
            <div class="breadcrumb-wrapper breadcrumb-contacts">
                <div>
                    <h1>Data Pengiriman</h1>
                    <p class="breadcrumbs"><span><a href="/admin/dashboard">Home</a></span>
                        <span><i class="mdi mdi-chevron-right"></i></span>Data Pengiriman
                    </p>
                </div>

            </div>
            <div class="row">
                <div class="col-12">

                    <div class="card">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="responsive-data-table" class="table">
                                    <thead>
                                        <th>Order ID</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Total Qty</th>
                                        <th>Total Weight (gram)</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @forelse ($shipments as $shipment)
                                            <tr>
                                                <td>
                                                    {{ $shipment->order->code }}<br>
                                                    <span style="font-size: 12px; font-weight: normal">
                                                        {{ $shipment->order->order_date }}</span>
                                                </td>
                                                <td>{{ $shipment->order->customer_full_name }}</td>
                                                <td>
                                                    {{ $shipment->status }}
                                                    <br>
                                                    <span style="font-size: 12px; font-weight: normal">
                                                        {{ $shipment->shipped_at }}</span>
                                                </td>
                                                <td>{{ $shipment->total_qty }}</td>
                                                <td>{{ $shipment->total_weight }}</td>
                                                <td>
                                                    <a href="{{ url('admin/orders/' . $shipment->order->id) }}"
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
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
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
