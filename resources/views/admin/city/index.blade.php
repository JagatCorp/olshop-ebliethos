@extends('admin.layout.dashboard')
@section('title', 'City')
@section('ActiveCity', 'active')
@section('Active3PL', 'active')
@section('content')

    <!-- CONTENT WRAPPER -->
    <div class="ec-content-wrapper">
        <div class="content">
            <div class="breadcrumb-wrapper breadcrumb-contacts">
                <div>
                    <h1>City</h1>
                    <p class="breadcrumbs"><span><a href="admin/dashboard">Home</a></span>
                        <span><i class="mdi mdi-chevron-right"></i></span>City
                    </p>
                </div>
                <div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalAdd"> <i
                            class="fa fa-plus"></i>
                        City
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
                                            <th>Province Name</th>
                                            <th>city name</th>
                                            <th>Type</th>
                                            <th>Postal Code</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <!--@foreach ($city as $item)-->
                                        <!--    <tr>-->
                                        <!--        <td>{{ $loop->iteration }}</td>-->
                                        <!--        <td>{{ $item->province->province_name }}</td>-->
                                        <!--        <td>{{ $item->city_name }}</td>-->
                                        <!--        <td>{{ $item->type }}</td>-->
                                        <!--        <td>{{ $item->postal_code }}</td>-->


                                        <!--        <td>-->
                                        <!--            <div class="btn-group mb-1">-->
                                        <!--                <button type="button"-->
                                        <!--                    class="btn btn-outline-success">Action</button>-->
                                        <!--                <button type="button"-->
                                        <!--                    class="btn btn-outline-success dropdown-toggle dropdown-toggle-split"-->
                                        <!--                    data-bs-toggle="dropdown" aria-haspopup="true"-->
                                        <!--                    aria-expanded="false" data-display="static">-->
                                        <!--                    <span class="sr-only">Info</span>-->
                                        <!--                </button>-->

                                        <!--                <div class="dropdown-menu">-->
                                        <!--                    <a class="dropdown-item" style="cursor:pointer"-->
                                        <!--                        data-bs-toggle="modal"-->
                                        <!--                        data-bs-target="#ModalEdit{{ $item->city_id }}">Edit</a>-->
                                        <!--                    <a class="dropdown-item" style="cursor:pointer"-->
                                        <!--                        data-bs-toggle="modal"-->
                                        <!--                        data-bs-target="#ModalDelete{{ $item->city_id }}">Delete</a>-->
                                        <!--                </div>-->
                                        <!--            </div>-->
                                        <!--        </td>-->
                                        <!--    </tr>-->
                                        <!--@endforeach-->
                                           <script type="text/javascript">
                                    $(function() {
                                        var table = $('.data-table').DataTable({
                                            processing: true,
                                            serverSide: true,
                                            ajax: "{{ route('admin.city-index') }}",
                                            columns: [{
                                                    data: 'DT_RowIndex', // Menampilkan nomor urut
                                                    name: 'DT_RowIndex',
                                                    orderable: false, // Kolom ini tidak bisa diurutkan
                                                    searchable: false // Kolom ini tidak bisa dicari
                                                },
                                                {
                                                    data: 'province.province_name',
                                                    name: 'province.province_name'
                                                },
                                                {
                                                    data: 'city_name',
                                                    name: 'city_name'
                                                },
                                                {
                                                    data: 'type',
                                                    name: 'type'
                                                },
                                                {
                                                    data: 'postal_code',
                                                    name: 'postal_code'
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
                        <form action="{{ route('admin.create-city') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header px-4">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah City</h5>
                            </div>

                            <div class="modal-body px-4">
                                <div class="row mb-2">
                                    <div class="row mb-2">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="firstName">Province Name</label>
                                                <select name="province_id" class="form-control" required>
                                                    <option value="">-- Select Province --
                                                    </option>
                                                    @foreach ($province as $item)
                                                        <option value="{{ $item->province_id }}">
                                                            {{ $item->province_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-4">
                                                <label for="userName">Name City</label>
                                                <input type="text" class="form-control" name="city_name" required />
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group mb-4">
                                                <label for="userName">Type</label>
                                                {{-- <input type="text" class="form-control" name="type" required /> --}}
                                                <select name="type" id="type" class="form-control" required>
                                                    <option value="">-- pilih type --</option>
                                                    <option value="Kabupaten">Kabupaten</option>
                                                    <option value="Kota">Kota</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group mb-4">
                                                <label for="userName">Postal Code</label>
                                                <input type="number" class="form-control" name="postal_code" required />
                                            </div>
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
            @foreach ($city as $item)
                <div class="modal fade modal-add-contact" id="ModalEdit{{ $item->city_id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <form action="{{ route('admin.edit-city') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header px-4">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit City</h5>
                                </div>
                                <input type="hidden" name="city_id" value="{{ $item->city_id }}">
                                <div class="modal-body px-4">
                                    <div class="row mb-2">
                                        <div class="col-lg-6">
                                            <div class="form-group mb-4">
                                                <label for="userName">Province</label>
                                                <select name="province_id" class="form-control" required>

                                                    @foreach ($province as $province_item)
                                                        <option value="{{ $province_item->province_id }}"
                                                            {{ $province_item->province_id == $item->province_id ? 'selected' : '' }}>
                                                            {{ $province_item->province_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-lg-6">
                                            <div class="form-group mb-4">
                                                <label for="userName">Name City</label>
                                                <input type="text" class="form-control" name="city_name"
                                                    value="{{ $item->city_name }}" />
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group mb-4">
                                                <label for="userName">Type</label>
                                                {{-- <input type="text" class="form-control" name="type"
                                                    value="{{ $item->type }}" /> --}}
                                                <select name="type" id="type" class="form-control" required>
                                                    <option value="Kabupaten" {{ $item->type == "Kabupaten" ? 'selected' : '' }}>Kabupaten</option>
                                                    <option value="Kota" {{ $item->type == "Kota" ? 'selected' : '' }}>Kota</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group mb-4">
                                                <label for="userName">Postal Code</label>
                                                <input type="number" class="form-control" name="postal_code"
                                                    value="{{ $item->postal_code }}" />
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
            @foreach ($city as $item)
                <div class="modal fade" id="ModalDelete{{ $item->city_id }}" tabindex="-1" role="dialog"
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
                                <a href="{{ route('admin.delete-city', $item->city_id) }}" class="btn btn-danger"
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
