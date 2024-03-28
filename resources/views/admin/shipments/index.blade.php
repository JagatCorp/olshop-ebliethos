@extends('admin.layout.dashboard')
@section('ActiveOrder', 'active')
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
                                        <th>Nomor Resi</th>
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
                                                <td>{{ $shipment->nomor_resi }}</td>

                                                <td>
                                                    <a class="btn btn-sm btn-warning mr-1 rounded-circle "
                                                        style="cursor:pointer" data-bs-toggle="modal"
                                                        data-bs-target="#ModalEdit{{ $shipment->id }}"><i
                                                            class="fa fa-edit"></i></a>
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

    @foreach ($shipments as $shipment)
        <div class="modal fade modal-add-contact" id="ModalEdit{{ $shipment->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <form action="{{ route('admin.shipments.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header px-4">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Ubah Nomor Resi Order</h5>
                        </div>
                        <input type="hidden" name="id" value="{{ $shipment->id }}">
                        <div class="modal-body px-4">
                            <div class="row mb-2">
                                <div class="col-lg-12">
                                    <div class="form-group textmb-4">
                                        <label for="userName">Ubah Nomor Resi Order</label>
                                        <input type="text" name="nomor_resi" class="form-control"
                                            value="{{ $shipment->nomor_resi }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer px-4">
                            <button type="button" class="btn btn-secondary btn-pill" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary btn-pill">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
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
