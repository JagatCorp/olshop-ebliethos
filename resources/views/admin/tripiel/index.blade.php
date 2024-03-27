@extends('admin.layout.dashboard')
@section('title', 'Tripiel')
@section('ActiveTripiel', 'active')
@section('Active3PL', 'active')
@section('content')

    <!-- CONTENT WRAPPER -->
    <div class="ec-content-wrapper">
        <div class="content">
            <div class="breadcrumb-wrapper breadcrumb-contacts">
                <div>
                    <h1>Tripiel</h1>
                    <p class="breadcrumbs"><span><a href="admin/dashboard">Home</a></span>
                        <span><i class="mdi mdi-chevron-right"></i></span>Tripiel
                    </p>
                </div>
                <div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalAdd"> <i
                            class="fa fa-plus"></i>
                        Tripiel
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
                                            <th>Destination Province</th>
                                            <th>Destination City</th>
                                            <th>Courier</th>
                                            <th>Warehouse</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($tripiel as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>

                                                <td>{{ $item->province->province_name }}</td>

                                                <td>{{ $item->city->city_name }}</td>

                                                <td>{{ $item->courier->name }}</td>

                                                <td>{{ $item->warehouse->name }}</td>

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
                        <form action="{{ route('admin.create-tripiel') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header px-4">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Tripiel</h5>
                            </div>

                            <div class="modal-body px-4">
                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-4">
                                            <label for="userName">Name Tripiel</label>
                                            <input type="text" class="form-control" id="editor" name="name"
                                                rows="5" cols="5" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-4">
                                            <label for="userName">Type</label>
                                            <input type="text" class="form-control" name="type" required />
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
            @foreach ($tripiel as $item)
                <div class="modal fade modal-add-contact" id="ModalEdit{{ $item->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <form action="{{ route('admin.edit-tripiel') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header px-4">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Tripiel</h5>
                                </div>
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <div class="modal-body px-4">
                                    <div class="row mb-2">
                                        <div class="col-lg-6">
                                            <div class="form-group mb-4">
                                                <label for="userName">Name Tripiel</label>
                                                <input type="text" class="form-control" name="name"
                                                    id="editor{{ $item->id }}" rows="5" cols="5"
                                                    value="{{ $item->name }}" />
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group mb-4">
                                                <label for="userName">Type</label>
                                                <input type="text" class="form-control" name="type"
                                                    value="{{ $item->type }}" />
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
            @foreach ($tripiel as $item)
                <div class="modal fade" id="ModalDelete{{ $item->id }}" tabindex="-1" role="dialog"
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
                                <a href="{{ route('admin.delete-tripiel', $item->id) }}" class="btn btn-danger"
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
