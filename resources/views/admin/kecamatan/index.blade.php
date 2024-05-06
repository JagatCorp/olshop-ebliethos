@extends('admin.layout.dashboard')
@section('title', 'Kecamatan')
@section('ActiveKecamatan', 'active')
@section('Active3PL', 'active')
@section('content')

    <!-- CONTENT WRAPPER -->
    <div class="ec-content-wrapper">
        <div class="content">
            <div class="breadcrumb-wrapper breadcrumb-contacts">
                <div>
                    <h1>Kecamatan</h1>
                    <p class="breadcrumbs"><span><a href="admin/dashboard">Home</a></span>
                        <span><i class="mdi mdi-chevron-right"></i></span>Kecamatan
                    </p>
                </div>
                <div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalAdd"> <i
                            class="fa fa-plus"></i>
                        Kecamatan
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="ec-vendor-list card card-default">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table data-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>

                                            <th>Name</th>
                                            <th>City</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>


                                        <script type="text/javascript">
                                            $(function() {
                                                var table = $('.data-table').DataTable({
                                                    processing: true,
                                                    serverSide: true,
                                                    ajax: "{{ route('admin.kecamatan-index') }}",
                                                    columns: [{
                                                            data: 'DT_RowIndex', // Menampilkan nomor urut
                                                            name: 'DT_RowIndex',
                                                            orderable: false, // Kolom ini tidak bisa diurutkan
                                                            searchable: false // Kolom ini tidak bisa dicari
                                                        },
                                                        {
                                                            data: 'name',
                                                            name: 'name'
                                                        },
                                                        {
                                                            data: 'city.city_name',
                                                            name: 'city.city_name'
                                                        },

                                                        {
                                                            data: 'action',
                                                            name: 'action',
                                                            orderable: false,
                                                            searchable: false
                                                        },
                                                    ]
                                                });
                                            });
                                        </script>
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
                        <form action="{{ route('admin.create-kecamatan') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header px-4">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Kecamatan</h5>
                            </div>

                            <div class="modal-body px-4">
                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-4">
                                            <label for="userName">Name Kecamatan</label>
                                            <input type="text" class="form-control" id="editor" name="name"
                                                rows="5" cols="5" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="firstName">City Name</label>
                                            <select name="city_id" class="form-control" required>
                                                <option value="">-- Select City --
                                                </option>
                                                @foreach ($city as $item)
                                                    <option value="{{ $item->city_id }}">
                                                        {{ $item->city_name }}
                                                    </option>
                                                @endforeach
                                            </select>
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

            <input id="url" type="hidden" value="{{ \Request::url() }}">

            <div class="modal fade modal-add-contact" id="ModalEdit" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <form action="{{ route('admin.edit-kecamatan') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header px-4">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Edit Kecamatan</h5>
                            </div>
                            <input type="hidden" name="id" id="kecamatan_id">
                            <div class="modal-body px-4">
                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-4">
                                            <label for="userName">Name Kecamatan</label>
                                            <input type="text" class="form-control" name="name" id="namaKecamatan" />
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group mb-4">
                                            <label for="userName">City</label>
                                            <select name="city_id" class="form-control city" required>

                                                {{-- dari ajax - public/js/modalkecamatan.js --}}

                                            </select>
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
            {{-- Delete Modal --}}
            <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog"
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
                            <form action="{{ route('admin.delete-kecamatan') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" id="delete_id">
                                <button type="submit" class="btn btn-danger" id="confirmDelete">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div> <!-- End Content -->
    </div> <!-- End Content Wrapper -->

    <script src="{{ asset('js/modalkecamatan.js') }}"></script>

@endsection
