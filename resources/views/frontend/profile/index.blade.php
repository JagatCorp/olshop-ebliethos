@extends('frontend.layout')
@section('title', 'Profile')
@section('content')


    <section class="ec-page-content ec-vendor-uploads ec-user-account section-space-p">
        <div class="container">
            <div class="row">
                <!-- Sidebar Area Start -->

                @include('frontend.partials.user_menu')

                <div class="ec-shop-rightside col-lg-9 col-md-12">
                    <div class="col-12">
                        <?php if (session('msg_status')) : ?>
                        <div class="alert mt-5 alert-<?= session('msg_status') ?> alert-dismissible fade show" role="alert">
                            <?= session('msg') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="ec-vendor-dashboard-card ec-vendor-setting-card">
                        <div class="ec-vendor-card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="ec-vendor-block-profile">
                                        <div class="ec-vendor-block-img space-bottom-30">
                                            {{-- <div class="ec-vendor-block-bg">
                                                <a href="#" class="btn btn-lg btn-primary"
                                                    data-link-action="editmodal" title="Edit Detail" data-bs-toggle="modal"
                                                    data-bs-target="#edit_modal">Edit Detail</a>
                                            </div> --}}
                                            <div class="ec-vendor-block-detail">
                                                <div class="d-flex align-items-center ">
                                                    @if (Auth()->user()->foto)
                                                        {{-- Tampilkan foto pengguna jika tersedia --}}
                                                        <img class="v-img mt-2"
                                                            src="{{ asset('/img/fotouser/' . Auth()->user()->foto) }}">
                                                    @else
                                                        {{-- Tampilkan gambar default jika foto pengguna kosong --}}
                                                        <img class="v-img mt-2" src="/img/avatar.jpg">
                                                    @endif
                                                </div>
                                            </div>


                                            <p>Hai <span><?= Auth()->user()->first_name ?></span></p>
                                            <p>Anda dapat dengan mudah melihat dan melacak pesanan pada akun Anda. Juga
                                                dapat mengelola dan mengubah informasi akun Anda seperti alamat, informasi
                                                kontak, dan riwayat pesanan.</p>
                                        </div>
                                        <h5>Informasi Akun</h5>

                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="ec-vendor-detail-block ec-vendor-block-email space-bottom-30">
                                                    <h6>Nama Pertama<a href="" data-link-action="editmodal"
                                                            title="Edit Detail" data-bs-toggle="modal"
                                                            data-bs-target="#edit_modal"><i class="fi-rr-edit"></i></a></h6>
                                                    <ul>
                                                        <li><strong>Nama: </strong><?= Auth()->user()->first_name ?></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="ec-vendor-detail-block ec-vendor-block-email space-bottom-30">
                                                    <h6>Nama Akhir <a href="" data-link-action="editmodal"
                                                            title="Edit Detail" data-bs-toggle="modal"
                                                            data-bs-target="#edit_modal"><i class="fi-rr-edit"></i></a></h6>
                                                    <ul>
                                                        <li><strong>Nama: </strong><?= Auth()->user()->last_name ?></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="ec-vendor-detail-block ec-vendor-block-email space-bottom-30">
                                                    <h6>Alamat E-mail <a href="" data-link-action="editmodal"
                                                            title="Edit Detail" data-bs-toggle="modal"
                                                            data-bs-target="#edit_modal"><i class="fi-rr-edit"></i></a></h6>
                                                    <ul>
                                                        <li><strong>Email: </strong><?= Auth()->user()->email ?></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="ec-vendor-detail-block ec-vendor-block-contact space-bottom-30">
                                                    <h6>Kontak<a href="" data-link-action="editmodal"
                                                            title="Edit Detail" data-bs-toggle="modal"
                                                            data-bs-target="#edit_modal"><i class="fi-rr-edit"></i></a></h6>
                                                    <ul>
                                                        <li><strong>Nomor: </strong><?= Auth()->user()->phone ?></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="ec-vendor-detail-block ec-vendor-block-contact space-bottom-30">
                                                    <h6>Kode Pos<a href="" data-link-action="editmodal"
                                                            title="Edit Detail" data-bs-toggle="modal"
                                                            data-bs-target="#edit_modal"><i class="fi-rr-edit"></i></a></h6>
                                                    <ul>
                                                        <li><strong>Kode Pos: </strong><?= Auth()->user()->postcode ?></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="ec-vendor-detail-block ec-vendor-block-address mar-b-30">
                                                    <h6>Alamat 1<a href="" data-link-action="editmodal"
                                                            title="Edit Detail" data-bs-toggle="modal"
                                                            data-bs-target="#edit_modal"><i class="fi-rr-edit"></i></a></h6>
                                                    <ul>
                                                        <li><strong>Alamat: </strong><?= Auth()->user()->address1 ?></li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <form class="row g-3" action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" class="form-control" id="id" name="id" value="{{ auth()->user()->id }}">
        <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="ec-vendor-block-img space-bottom-30">
                                {{-- <div class="ec-vendor-block-bg cover-upload">
                                <div class="thumb-upload">
                                    <div class="thumb-edit">
                                        <input type='file' id="thumbUpload01" class="ec-image-upload"
                                            accept=".png, .jpg, .jpeg" />
                                        <label><i class="fi-rr-edit"></i></label>
                                    </div>
                                    <div class="thumb-preview ec-preview">
                                        <div class="image-thumb-preview">
                                            <img class="image-thumb-preview ec-image-preview v-img"
                                                src="assets-user/images/banner/8.jpg" alt="edit" />
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                                <div class="ec-vendor-block-detail  ">
                                    <div class="thumb-upload ">
                                        <div class="thumb-edit">
                                            <input type='file' id="thumbUpload02" class="ec-image-upload"
                                                accept=".png, .jpg, .jpeg" />
                                            <label><i class="fi-rr-edit"></i></label>
                                        </div>
                                        <div class="thumb-preview ec-preview ">
                                            <div class="image-thumb-preview avatar ">

                                                @if (Auth()->user()->foto)
                                                    {{-- Tampilkan foto pengguna jika tersedia --}}
                                                    <img class="image-thumb-preview ec-image-preview v-img mt-3"
                                                        src="{{ asset('/img/fotouser/' . Auth()->user()->foto) }}" />
                                                @else
                                                    {{-- Tampilkan gambar default jika foto pengguna kosong --}}
                                                    <img class="image-thumb-preview ec-image-preview v-img mt-3"
                                                        src="/img/avatar.jpg">
                                                @endif
                                                <label for="fileInput" class="file-input-label">
                                                    <input type="file" name="foto" id="fileInput"
                                                        class="visually-hidden">
                                                    <i class="fi-rr-edit file-input-icon pencil"
                                                        style="font-size: 20px"></i>
                                                </label>

                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" id="submitButton"
                                                class="btn btn-primary rounded-5 btn-sm btn-xs ms-auto d-none">Simpan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="ec-vendor-upload-detail">

                                    <div class="row g-3">

                                        <div class="col-md-6 space-t-15">
                                            <label class="form-label">First name</label>
                                            <input type="text" class="form-control" name="first_name"
                                                value="{{ auth()->user()->first_name }}">
                                        </div>
                                        <div class="col-md-6 space-t-15">
                                            <label class="form-label">Last name</label>
                                            <input type="text" class="form-control" name="last_name"
                                                value="{{ auth()->user()->last_name }}">
                                        </div>
                                        <div class="col-md-6 space-t-15">
                                            <label class="form-label">Email</label>
                                            <input type="text" class="form-control" name="email"
                                                value="{{ auth()->user()->email }}">
                                        </div>
                                        <div class="col-md-6 space-t-15">
                                            <label class="form-label">Phone</label>
                                            <input type="text" class="form-control" name="phone" placeholder="08xxxxxxx"
                                                value="{{ auth()->user()->phone }}">
                                        </div>
                                        <div class="col-md-6 space-t-15">
                                            <label class="form-label">Kode Pos</label>
                                            <input type="number" class="form-control" name="postcode"
                                                value="{{ auth()->user()->postcode }}">
                                        </div>
                                        <div class="col-md-12 space-t-15">
                                            <label class="form-label">Address 1</label>
                                            <input type="text" class="form-control" name="address1"
                                                value="{{ auth()->user()->address1 }}">
                                        </div>
                                        <div class="col-md-12 space-t-15">
                                            <label class="form-label">Address 2</label>
                                            <input type="text" class="form-control" name="address2"
                                                value="{{ auth()->user()->address2 }}">
                                        </div>
                                        <div class="col-md-12 space-t-15">
                                            <button type="submit" class="btn btn-primary rounded-5 ">Update</button>
                                            <a href="#" class="btn btn-lg btn-secondary qty_close rounded-5 "
                                                data-bs-dismiss="modal" aria-label="Close">Close</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Modal end -->

    {{-- jquery update foto --}}
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            // Deteksi perubahan pada input file
            $('#fileInput').on('change', function() {
                var input = $(this)[0];

                // Pastikan ada file yang dipilih
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    // Setelah file dibaca, perbarui gambar profil
                    reader.onload = function(e) {
                        $('.avatar img').attr('src', e.target.result);

                        // Tampilkan tombol "Simpan"
                        $('#submitButton').removeClass('d-none');
                    };

                    // Baca file sebagai URL data
                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
    </script>
@endsection
