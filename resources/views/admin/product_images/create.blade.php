@extends('admin.layout.dashboard')
@section('title', 'Data Gambar Produk')
@section('content')
    <!-- Main content -->
    <section class="ec-content-wrapper">
        <div class="content">
            <div class="breadcrumb-wrapper breadcrumb-contacts">
                <div>
                    <h1>Upload Gambar Produk</h1>

                </div>
                <div>
                    <a href="{{ route('admin.products.product_images.index', $product) }}"
                        class="btn btn-primary shadow-sm float-right"> <i class="fa fa-arrow-left"></i>
                        Kembali</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">

                    <div class="card">

                        <div class="card-body">
                            <form method="post" action="{{ route('admin.products.product_images.store', $product) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row border-bottom pb-4">
                                    <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="foto"
                                            value="{{ old('foto') }}" id="foto">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
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

@push('style-alt')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('script-alt')
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('.select-multiple').select2();
    </script>
@endpush
