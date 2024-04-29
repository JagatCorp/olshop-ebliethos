@extends('frontend.layout')
@section('title', 'Orders')
@section('content')
    @include('sweetalert::alert')


    <section class="ec-page-content ec-vendor-uploads ec-user-account section-space-p">
        <div class="container">
            <div class="row">
                <!-- Sidebar Area Start -->
                @include('frontend.partials.user_menu')
                <div class="ec-shop-rightside col-lg-9 col-md-12">
                    <div class="ec-vendor-dashboard-card">
                        <div class="ec-vendor-card-header">
                            <h5>Pesanan Selesai</h5>
                            <div class="ec-header-btn">
                                <a class="btn btn-lg btn-primary" href="{{ url('products') }}">Shop Now</a>
                            </div>
                        </div>


                        <div class="ec-vendor-card-body">
                            <div class="ec-vendor-card-table">

                                <div class="ec-blog-comments">
                                    <div class="ec-blog-cmt-preview">
                                        <div class="ec-blog-comment-wrapper mt-55">
                                            @forelse($orders as $order)
                                                <div class="ec-single-comment-wrapper mt-35">
                                                    <div class=" ec-blog-user-img">
                                                        <img src="{{ asset('core/public/img/fotoproducts/' . $order->orderItems->first()->product->productImages->first()->foto) }}"
                                                            alt="image">
                                                    </div>
                                                    <div class="ec-blog-comment-content">
                                                        <h5>{{ $order->orderItems->first()->product->name }}</h5>
                                                        <td>
                                                            <span>IDR
                                                                {{ number_format($order->orderItems->first()->product->price, 0, ',', '.') }}</span>
                                                        </td>

                                                        <p>{{ $order->orderItems->first()->product->short_description }}</p>
                                                        <div class="ec-blog-details-btn gap-5">
                                                            <a href="{{ route('reviews.create', ['product_id' => $order->orderItems->first()->product_id]) }}"
                                                                class="badge bg-danger">Beri Review</a>
                                                            <a href="/product/{{ $order->orderItems->first()->product->slug }}"
                                                                class="badge bg-light text-black ">Beli
                                                                Lagi</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <tr>
                                                    <td colspan="5">Belum ada pesanan selesai</td>
                                                </tr>
                                            @endforelse
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

    <!-- Modal untuk Ulasan -->
    <div class="modal fade modal-add-contact" id="reviewModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('reviews-create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header px-4">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Review</h5>
                    </div>
                    <div class="modal-body px-4">
                        <input type="hidden" name="product_id" id="product_id">
                        <input type="hidden" name="user_id" id="user_id">
                        <div class="row mb-2">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="firstName">Rating</label>
                                    <select class="form-select" name="rating" id="">
                                        <option value="">pilih</option>
                                        <option value="1">⭐</option>
                                        <option value="2">⭐⭐</option>
                                        <option value="3">⭐⭐⭐</option>
                                        <option value="4">⭐⭐⭐⭐</option>
                                        <option value="5">⭐⭐⭐⭐⭐</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="firstName">Foto</label>
                                    <input type="file" class="form-control" name="foto">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label for="review">Review</label>
                                <textarea type="text" class="form-control" name="review" rows="5" cols="5" id="review" required>
                                            </textarea>
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

    <!-- Tombol "Beri Review" -->
    {{-- <a href="#" class="btn btn-primary open-review-modal" data-product-id="{{ $order->product_id }}">Beri
        Review</a> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            // Ketika tombol "Beri Review" diklik
            $('.open-review-modal').on('click', function(e) {
                e.preventDefault();
                var productId = $(this).data('product-id');
                $('#product_id').val(productId); // Set nilai product_id di dalam modal
                $('#reviewModal').modal('show'); // Tampilkan modal
            });

            // Saat formulir ulasan dikirim
            $('#reviewForm').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serialize(); // Ambil data formulir
                $.ajax({
                    type: "POST",
                    url: "{{ route('reviews-create') }}",
                    data: formData,
                    success: function(response) {
                        $('#reviewModal').modal(
                            'hide'); // Sembunyikan modal setelah berhasil disimpan
                        // Tampilkan pesan sukses atau lakukan aksi lain
                    },
                    error: function(xhr, status, error) {
                        // Tangani kesalahan jika ada
                    }
                });
            });
        });
    </script> --}}


@endsection
