@extends('admin.layout.dashboard')
@section('title', 'Province')
@section('ActiveProvince', 'active')
@section('Active3PL', 'active')
@section('content')

    <!-- CONTENT WRAPPER -->
    <div class="ec-content-wrapper">
        <div class="content">
            <div class="breadcrumb-wrapper breadcrumb-contacts">
                <div>
                    <h1>Province</h1>
                    <p class="breadcrumbs"><span><a href="admin/dashboard">Home</a></span>
                        <span><i class="mdi mdi-chevron-right"></i></span>Province
                    </p>
                </div>
                <div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalAdd"> <i
                            class="fa fa-plus"></i>
                        Province
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

                                            <th>province name</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($province as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>

                                                <td>{{ $item->province_name }}</td>

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
                                                                data-bs-target="#ModalEdit{{ $item->province_id }}">Edit</a>
                                                            <a class="dropdown-item" style="cursor:pointer"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#ModalDelete{{ $item->province_id }}">Delete</a>
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
                        <form action="{{ route('admin.create-province') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header px-4">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Province</h5>
                            </div>

                            <div class="modal-body px-4">
                                <div class="row mb-2">
                                    <div class="col-lg-12">
                                        <div class="form-group mb-4">
                                            <label for="userName">Name Province</label>
                                            <input type="text" class="form-control" name="province_name" required />
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
            {{-- Edit Modal --}}
            @foreach ($province as $item)
                <div class="modal fade modal-add-contact" id="ModalEdit{{ $item->province_id }}" tabindex="-1"
                    role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <form action="{{ route('admin.edit-province') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header px-4">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Province</h5>
                                </div>
                                <input type="hidden" name="province_id" value="{{ $item->province_id }}">
                                <div class="modal-body px-4">
                                    <div class="row mb-2">
                                        <div class="col-lg-12">
                                            <div class="form-group mb-4">
                                                <label for="userName">Name Province</label>
                                                <input type="text" class="form-control" name="province_name"
                                                    value="{{ $item->province_name }}" />
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
            @foreach ($province as $item)
                <div class="modal fade" id="ModalDelete{{ $item->province_id }}" tabindex="-1" role="dialog"
                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
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
                                <a href="{{ route('admin.delete-province', $item->province_id) }}" class="btn btn-danger"
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
