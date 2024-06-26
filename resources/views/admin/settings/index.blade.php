@extends('admin.layout.dashboard')
@section('title', 'Settings')
@section('ActiveSettings', 'active')
@section('MasterData', 'active')
@section('content')

    <!-- CONTENT WRAPPER -->
    <div class="ec-content-wrapper">
        <d class="content">
            <div class="breadcrumb-wrapper breadcrumb-contacts">
                <div>
                    <h1>Settings</h1>
                    <p class="breadcrumbs"><span><a href="index.html">Home</a></span>
                        <span><i class="mdi mdi-chevron-right"></i></span>Settings
                    </p>
                </div>
                <div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalAdd"> <i
                            class="fa fa-plus"></i>
                        Settings
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
                                            <th>Logo</th>
                                            <th>Email</th>
                                            <th>Waktu Buka</th>
                                            <th>Link Shopee</th>
                                            <th>Link Tokopedia</th>
                                            <th>Link Tiktokshop</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($settings as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <img src="{{ asset('/img/logotoko/' . $item->logo) }}" width="200px"
                                                        alt="logo toko" />
                                                </td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->waktu_buka }}</td>
                                                <td>{{ $item->link_shopee }}</td>
                                                <td>{{ $item->link_tokped }}</td>
                                                <td>{{ $item->link_tiktokshop }}</td>


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
                        <form action="{{ route('admin.create-settings') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header px-4">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Settings</h5>
                            </div>

                            <div class="modal-body px-4">
                                <div class="row mb-2">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="firstName">Logo</label>
                                            <input type="file" class="form-control" name="logo" required>

                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="firstName">Email</label>
                                            <input type="email" class="form-control" name="email" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="firstName">Waktu Buka</label>
                                            <input type="text" class="form-control" name="waktu_buka" required>
                                        </div>
                                    </div>

                                </div>

                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="firstName">Link Shopee</label>
                                            <input type="text" class="form-control" name="link_shopee" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="firstName">Link Tokopedia</label>
                                            <input type="text" class="form-control" name="link_tokped" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="firstName">Link Tiktok Shop</label>
                                            <input type="text" class="form-control" name="link_tiktokshop" required>
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
    @foreach ($settings as $item)
        <div class="modal fade modal-add-contact" id="ModalEdit{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <form action="{{ route('admin.edit-settings') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header px-4">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Edit Settings</h5>
                        </div>
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <div class="modal-body px-4">
                            <div class="row mb-2">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="firstName">Logo</label>
                                        <input type="file" class="form-control" name="logo">
                                        <input type="hidden" class="form-control" name="gambarLama"
                                            value="{{ $item->logo }}">
                                    </div>
                                </div>

                            </div>

                            <div class="row mb-2">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="firstName">Email</label>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ $item->email }}">

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="firstName">Waktu Buka</label>
                                        <input type="text" class="form-control" name="waktu_buka"
                                            value="{{ $item->waktu_buka }}">
                                    </div>
                                </div>

                            </div>

                            <div class="row mb-2">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="firstName">Link Shopee</label>
                                        <input type="text" class="form-control" name="link_shopee"
                                            value="{{ $item->link_shopee }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="firstName">Link Tokopedia</label>
                                        <input type="text" class="form-control" name="link_tokped"
                                            value="{{ $item->link_tokped }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="firstName">Link Tiktok Shop</label>
                                        <input type="text" class="form-control" name="link_tiktokshop"
                                            value="{{ $item->link_tiktokshop }}">
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
    @foreach ($settings as $item)
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
                        <a href="{{ route('admin.delete-settings', $item->id) }}" class="btn btn-danger"
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
