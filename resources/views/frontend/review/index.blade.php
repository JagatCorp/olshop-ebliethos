@extends('frontend.layout')
@section('title', 'Orders')
@section('content')

    <section class="ec-page-content ec-vendor-uploads ec-user-account section-space-p">
        <div class="container">
            <div class="row">
                <!-- Sidebar Area Start -->
                <div class="ec-shop-leftside ec-vendor-sidebar col-lg-3 col-md-12">
                    <div class="ec-sidebar-wrap ec-border-box">
                        <!-- Sidebar Category Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-vendor-block">
                                <div class="ec-vendor-block-items">
                                    <ul>
                                        <li><a href="{{ url('profile') }}">Profile</a></li>
                                        <li><a href="{{ url('orders') }}">Orders</a></li>
                                        <li><a href="{{ url('wishlists') }}">Wishlist</a></li>
                                        <li><a href="{{ url('carts') }}">Cart</a></li>
                                        <li><a href="{{ route('logout') }}" style="color: #c00d0d"><i
                                                    class="fi-rr-exit"></i> Logout</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ec-shop-rightside col-lg-9 col-md-12">
                    <div class="ec-vendor-dashboard-card">
                        <div class="ec-vendor-card-header">
                            <h5>Untuk Di Review</h5>
                            <div class="ec-header-btn">
                                <a class="btn btn-lg btn-primary" href="{{ url('products') }}">Shop Now</a>
                            </div>
                        </div>
                        <div class="ec-vendor-card-body">
                            <div class="ec-vendor-card-table">
                                <table class="table ec-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Order ID</th>
                                            <th scope="col">Grand Total</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Payment</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($orders as $order)
                                            <tr>
                                                <td>{{ $order->code }}<br>
                                                    <span style="font-size: 12px; font-weight: normal; margin-top: -15px">
                                                        {{ date('d M Y', strtotime($order->order_date)) }}</span>
                                                </td>
                                                <td><span>Rp {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                                                </td>
                                                <td>
                                                    <span>{{ $order->status }}</span>
                                                    @if ($order->status === 'cancelled')
                                                        <p class="text-danger">{{ $order->cancellation_note }}</p>
                                                    @endif
                                                </td>


                                                <td><span>{{ $order->payment_status }}</span></td>
                                                <td><span class="tbl-btn">
                                                        {{-- <a class="btn btn-lg btn-primary"
                                                            href="{{ url('orders/' . $order->id) }}">View</a> --}}
                                                        <a
                                                            href="{{ route('reviews-index', ['product_id' => $order->product_id]) }}">Beri
                                                            Review</a>
                                                    </span></td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">No records found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
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
    <a href="#" class="btn btn-primary open-review-modal" data-product-id="{{ $order->product_id }}">Beri
        Review</a>
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
