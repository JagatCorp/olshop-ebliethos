@extends('admin.layout.dashboard')
@section('title', 'Data Order')
@section('ActiveOrder', 'active')
@section('content')
    <!-- Main content -->
    <section class="ec-content-wrapper">
        <div class="content">
            <div class="breadcrumb-wrapper breadcrumb-contacts">
                <div>
                    <h1>List Order</h1>
                    <p class="breadcrumbs"><span><a href="/admin/dashboard">Home</a></span>
                        <span><i class="mdi mdi-chevron-right"></i></span>List Order
                    </p>
                </div>
                <div>
                    <a href="{{ route('admin.orders.trashed') }}" class="btn btn-danger shadow-sm float-right"> <i
                            class="fa fa-trash"></i> Lihat Order Yang Telah Di Hapus </a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        {{-- <div class="card-header">
                            <h3 class="card-title">Data Order</h3>
                            <div class="text-right">
                                <a href="{{ route('admin.orders.trashed') }}" class="btn btn-danger shadow-sm float-right"> <i
                                        class="fa fa-trash"></i> Trash </a>
                            </div>
                        </div> --}}

                        <div class="card-body">
                            <form action="" class="input-daterange form-inline mb-4 d-flex flex-wrap">
                                <div class="form-group mx-sm-3 mb-2 col-lg-3 col-md-3 col-sm-12">
                                    <input type="text" class="form-control input-block" name="q"
                                        value="{{ !empty(request()->input('q')) ? request()->input('q') : '' }}"
                                        placeholder="Type code or name" autocomplete="off">
                                </div>
                                <div class="form-group mx-sm-3 mb-2 col-lg-2 col-md-2 col-sm-6 col-6">
                                    <input type="date" class="form-control "
                                        value="{{ !empty(request()->input('start')) ? request()->input('start') : '' }}"
                                        name="start" placeholder="from">
                                </div>
                                <div class="form-group mx-sm-3 mb-2 col-lg-2 col-md-2 col-sm-6 col-6">
                                    <input type="date" class="form-control"
                                        value="{{ !empty(request()->input('end')) ? request()->input('end') : '' }}"
                                        name="end" placeholder="to">
                                </div>
                                <div class="form-group mx-sm-3 mb-2 col-lg-2 col-md-2 col-sm-6 col-6">
                                    <select class="form-control input-block" name="status" id="status">
                                        @foreach ($statuses as $value => $status)
                                            <option value="{{ $value }}">{{ $status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mx-sm-3 mb-2 col-lg-1 col-md-1 col-sm-12 col-12">
                                    <button type="submit" class="btn btn-primary shadow-sm float-right">Cari</button>
                                </div>
                            </form>



                            <div class="table-responsive">
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
                                                <td>Rp{{ number_format($order->grand_total, 0, ',', '.') }}</td>
                                                <td>
                                                    {{ $order->customer_full_name }}<br>
                                                    <span style="font-size: 12px; font-weight: normal">
                                                        {{ $order->customer_email }}</span>
                                                </td>
                                                <td>{{ $order->status }}</td>
                                                <td>{{ $order->payment_status }}</td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="{{ route('admin.orders.show', $order->id) }}"
                                                            class="btn btn-primary rounded-circle  mr-1  btn-sm"><i
                                                                class="fa fa-eye"></i>
                                                        </a>
                                                        {{-- <form onclick="return confirm('are you sure !')"
                                                            action="{{ route('admin.orders.destroy', $order) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger" type="submit"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </form> --}}
                                                        <a class="btn btn-sm btn-warning mr-1 rounded-circle "
                                                            style="cursor:pointer" data-bs-toggle="modal"
                                                            data-bs-target="#ModalEdit{{ $order->id }}"><i
                                                                class="fa fa-edit"></i></a>
                                                        <a class="btn btn-sm btn-danger rounded-circle "
                                                            style="cursor:pointer" data-bs-toggle="modal"
                                                            data-bs-target="#ModalDelete{{ $order->id }}"><i
                                                                class="fa fa-trash"></i></a>
                                                    </div>
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

    @foreach ($orders as $order)
        <div class="modal fade modal-add-contact" id="ModalEdit{{ $order->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <form action="{{ route('admin.orders.status.edit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header px-4">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Ubah Status Order</h5>
                        </div>
                        <input type="hidden" name="id" value="{{ $order->id }}">
                        <div class="modal-body px-4">
                            <div class="row mb-2">
                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label for="userName">Ubah Status Order</label>
                                        <select name="status" id="" class="form-select">
                                            <option value="">pilih</option>
                                            <option value="created">
                                                Created
                                            </option>
                                            <option value="confirmed">
                                                Confirmed
                                            </option>
                                            <option value="delivered">
                                                Delivered
                                            </option>
                                            <option value="completed">
                                                Completed
                                            </option>
                                            <option value="cancelled">
                                                Cancelled
                                            </option>

                                        </select>
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

    {{-- Delete Modal --}}
    @foreach ($orders as $order)
        <div class="modal fade" id="ModalDelete{{ $order->id }}" tabindex="-1" role="dialog"
            aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('admin.orders.destroy', $order) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Apakah anda yakin ingin menghapus data ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger" id="confirmDelete">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection

{{-- @push('style-alt')
    <!-- DataTables -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
        integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
@endpush --}}

@push('script-alt')
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    {{-- <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script>
        $("#data-table").DataTable();
    </script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
        integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });
        $(".delete").on("submit", function() {
            return confirm("Do you want to remove this?");
        });
        $("a.delete").on("click", function() {
            event.preventDefault();
            var orderId = $(this).attr('order-id');
            if (confirm("Do you want to remove this?")) {
                document.getElementById('delete-form-' + orderId).submit();
            }
        });
        $(".restore").on("click", function() {
            return confirm("Do you want to restore this?");
        });
    </script>
@endpush
