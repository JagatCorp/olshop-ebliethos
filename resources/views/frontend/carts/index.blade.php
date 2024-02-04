@extends('frontend.layout')
@section('title', 'Carts')
@section('content')
    <section class="ec-page-content ec-vendor-uploads ec-user-account wishlist-2 section-space-p">
        <div class="container">
            <div class="row">
                <!-- Sidebar Area Start -->
                @include('frontend.partials.user_menu')
                <div class="ec-shop-rightside col-lg-9 col-md-12">
                    <div class="ec-vendor-dashboard-card">
                        <div class="ec-vendor-card-header">
                            <h5>Keranjang</h5>

                        </div>
                        <div class="ec-vendor-card-body">
                            <div class="ec-vendor-card-table">
                                <table class="table ec-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Foto</th>
                                            <th scope="col">Produk</th>
                                            {{-- <th scope="col">Tanggal Ditambahkan</th> --}}
                                            <th scope="col">Harga</th>
                                            {{-- <th scope="col">Status</th> --}}
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody class="wish-empt">
                                        @forelse ($items as $item)
                                            @php
                                                $product = isset($item->model->parent) ? $item->model->parent : $item->model;

                                            @endphp

                                            <tr class="pro-gl-content">
                                                <td>
                                                    @if ($product->productImages->isNotEmpty())
                                                        <div>
                                                            <img class="prod-img"
                                                                src="{{ asset('img/fotoproducts/' . $product->productImages->first()->foto) }}"
                                                                alt="Product Image">

                                                        </div>
                                                    @endif
                                                </td>
                                                <td><span>{{ $product->name }}</span></td>
                                                {{-- <td><span>{{ $item->created_at }}</span></td> --}}
                                                <td><span>Rp.{{ number_format($item->price, 0, ',', '.') }}</span></td>
                                                {{-- @if ($item->product->status_stock > 0)
                                                    <td><span class="avl">Tersedia</span></td>
                                                @else
                                                    <td><span class="out">Stok Habis</span></td>
                                                @endif --}}
                                                <td class="product-quantity">
                                                    <select class="form-select" id="change-qty"
                                                        data-productId="{{ $item->rowId }}" value="{{ $item->qty }}">
                                                        @foreach (range(1, $item->model->productInventory->qty) as $qty)
                                                            <option {{ $qty == $item->qty ? 'selected' : null }}
                                                                value="{{ $qty }}">
                                                                <span>{{ $qty }}</span>
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><span class="tbl-btn">
                                                        <a class="btn btn-lg btn-primary ec-com-remove "
                                                            href="{{ url('carts/remove/' . $item->rowId) }}"
                                                            title="Remove From List">×</a></span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6">The cart is empty!</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="ec-vendor-card-header fw-bold col-lg-9 col-md-12 d-none d-md-block">
                                    <div class="d-flex">
                                        <h5 class="col-4">Total</h5>
                                        <div class="ms-4 col-4"><span
                                                id="selectedProductsCount">{{ $items->count() }}</span> Produk</div>
                                        <div class="ms-4 col-4"><span
                                                id="selectedProductsTotal">Rp.{{ Cart::subtotal(0, ',', '.') }}</span>
                                        </div>
                                        <div class="ec-header-btn col-4">
                                            <a href="{{ url('orders/checkout') }}"
                                                class="btn btn-lg btn-primary">Checkout</a>
                                        </div>
                                    </div>
                                </div>

                                {{-- mobile --}}
                                <div class="ec-vendor-card-header fw-bold col-lg-9 col-md-12 d-block d-md-none">
                                    <div class="d-flex">
                                        <h5 class="col-4">Total</h5>
                                        <div class="ms-4 col-4"><span id="selectedProductsCount">0</span> Produk</div>
                                        <div class="ms-4 col-4"><span
                                                id="selectedProductsTotal">Rp.{{ Cart::subtotal(0, ',', '.') }}</span>
                                        </div>
                                        <div class="ec-header-btn col-4">
                                            <a href="{{ url('orders/checkout') }}"
                                                class="btn btn-lg btn-primary">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                                {{-- end mobile --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script-alt')
    <script>
        $(document).on("change", function(e) {
            var qty = e.target.value;
            var productId = e.target.attributes['data-productid'].value;

            $.ajax({
                type: "POST",
                url: "/carts/update",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                    productId,
                    qty
                },
                success: function(response) {
                    location.reload(true);
                    Swal.fire({
                        title: "Jumlah Produk",
                        text: "Berhasil di ganti !",
                        icon: "success",
                        confirmButtonText: "Close",
                    });
                },
            });
        });
    </script>
@endpush
