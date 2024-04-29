@extends('admin.layout.dashboard')
@section('title', 'Data Gambar Produk')
@section('ActiveProduct', 'active')
@section('content')
    <!-- Main content -->
    <section class="ec-content-wrapper">
        <div class="content">
            <div class="breadcrumb-wrapper breadcrumb-contacts">
                <div>
                    <h1>Data Gambar Produk</h1>
                    <p class="breadcrumbs"><span><a href="/admin/dashboard">Home</a></span>
                        <span><i class="mdi mdi-chevron-right"></i></span>Gambar Product
                    </p>
                </div>
                <div>
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary shadow-sm float-right"> <i
                            class="fa fa-arrow-left"></i> Kembali
                    </a>
                    <a href="{{ route('admin.products.product_images.create', $product) }}"
                        class="btn btn-primary shadow-sm float-right mr-2"> <i class="fa fa-upload"></i> Upload Foto
                    </a>
                    <a href="{{ route('admin.products.product_video.create', $product) }}"
                        class="btn btn-primary shadow-sm float-right mr-2"> <i class="fa fa-upload"></i> Upload Video
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="responsive-data-table" class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Gambar</th>
                                            <th>Video</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($product->productImages as $productImage)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    {{-- @foreach ($productImages as $productImage)
                                                        @foreach (json_decode($productImage->foto) as $photo) --}}
                                                    @if ($productImage->foto)
                                                        <img src="{{ asset('/img/fotoproducts/' . $productImage->foto) }}"
                                                            alt="Product" width="100px" />
                                                    @endif

                                                    {{-- @endforeach
                                                    @endforeach --}}

                                                </td>
                                                <td>
                                                    @if ($productImage->video)
                                                        <video width="100" height="100" controls>
                                                            <source
                                                                src="{{ asset('/img/videoproducts/' . $productImage->video) }}"
                                                                type="video/mp4">
                                                        </video>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <form onclick="return confirm('apakah anda yakin  !')"
                                                            action="{{ route('admin.products.product_images.destroy', [$product, $productImage]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-outline-danger" type="submit"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">Data Kosong !</td>
                                            </tr>
                                        @endforelse
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
@endsection
{{--
@push('style-alt')
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
