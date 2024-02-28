@extends('admin.layout.dashboard')
@section('title', 'Coupon')
@section('ActiveProduct', 'active')
@section('content')

    <!-- CONTENT WRAPPER -->
    <div class="ec-content-wrapper">
        <d class="content">
            <div class="breadcrumb-wrapper breadcrumb-contacts">
                <div>
                    <h1>Coupon</h1>
                    <p class="breadcrumbs"><span><a href="index.html">Home</a></span>
                        <span><i class="mdi mdi-chevron-right"></i></span>Coupon
                    </p>
                </div>
                <div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalAdd"> <i
                            class="fa fa-plus"></i>
                        Coupon
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="ec-vendor-list card card-default">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="responsive-data-table" class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Kupon</th>
                                            <th>Diskon Persen %</th>
                                            <th>Batas Penggunaan</th>
                                            <th>Jumlah Sudah Digunakan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($coupon as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->coupon_code }}</td>
                                                <td>{{ $item->discount }}%</td>
                                                <td>{{ $item->usage_limit }}</td>
                                                <td>{{ $item->usage_count }}</td>
                                                <td>
                                                    <div class="btn-group mb-1">
                                                        <button type="button"
                                                            class="btn btn-outline-success">Action</button>
                                                        <button type="button"
                                                            class="btn btn-outline-success dropdown-toggle dropdown-toggle-split"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false" data-display="static">
                                                            <span class="sr-only">Info</span>
                                                        </button>

                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" style="cursor:pointer"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#ModalEdit{{ $item->id }}">Edit</a>
                                                            <a class="dropdown-item" style="cursor:pointer"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#ModalDelete{{ $item->id }}">Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Add Modal  -->
            <div class="modal fade modal-add-contact" id="ModalAdd" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <form action="{{ route('admin.create-coupon') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header px-4">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Coupon</h5>
                            </div>
                            <div class="modal-body px-4">
                                <div class="row mb-2 ">

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="firstName">Kode Kupon</label>
                                            <input type="text" class="form-control" name="coupon_code" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="firstName">Diskon Persen %</label>
                                            <input type="number" class="form-control" name="discount" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="firstName">Batas Penggunaan</label>
                                            <input type="number" class="form-control" name="usage_limit" required>
                                        </div>
                                    </div>

                                </div>

                                <div class="modal-footer px-4">
                                    <button type="button" class="btn btn-secondary btn-pill"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary btn-pill">Simpan</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    {{-- Edit Modal --}}
    @foreach ($coupon as $item)
        <div class="modal fade modal-add-contact" id="ModalEdit{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <form action="{{ route('admin.edit-coupon') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header px-4">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Edit Coupon</h5>
                        </div>
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <div class="modal-body px-4">

                            <div class="row mb-2 ">

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="firstName">Kode Kupon</label>
                                        <input type="text" class="form-control" name="coupon_code"
                                            value="{{ $item->coupon_code }}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="firstName">Diskon Persen %</label>
                                        <input type="number" class="form-control" name="discount"
                                            value="{{ $item->discount }}">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="firstName">Batas Penggunaan</label>
                                        <input type="number" class="form-control" name="usage_limit"
                                            value="{{ $item->usage_limit }}">
                                    </div>
                                </div>

                            </div>


                        </div>

                        <div class="modal-footer px-4">
                            <button type="button" class="btn btn-secondary btn-pill"
                                data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary btn-pill">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    {{-- Delete Modal --}}
    @foreach ($coupon as $item)
        <div class="modal fade" id="ModalDelete{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus data ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <a href="{{ route('admin.delete-coupon', $item->id) }}" class="btn btn-danger"
                            id="confirmDelete">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </div>
    </div>
    </div> <!-- End Content -->
    </div> <!-- End Content Wrapper -->
@endsection
