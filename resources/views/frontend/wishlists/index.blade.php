@extends('frontend.layout')
@section('title', 'Wishlist')
@section('content')
    <!-- all css here -->

    <section class="ec-page-content ec-vendor-uploads ec-user-account wishlist-2 section-space-p">
        <div class="container">
            <div class="row">
                <!-- Sidebar Area Start -->
                @include('frontend.partials.user_menu')
                <div class="ec-shop-rightside col-lg-9 col-md-12">
                    <div class="ec-vendor-dashboard-card">
                        <div class="ec-vendor-card-header">
                            <h5>Wishlist</h5>

                        </div>

                        <section class="ec-page-content section-space-p">
                            <div class="container">
                                @if (session()->has('message'))
                                    <div class="content-header mb-3 pb-0">
                                        <div class="container-fluid">
                                            <div class="mb-0 alert alert-{{ session()->get('alert-type') }} alert-dismissible fade show"
                                                role="alert">
                                                <strong>{{ session()->get('message') }}</strong>
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        </div><!-- /.container-fluid -->
                                    </div>
                                @endif
                                <div class="row">
                                    <!-- Compare Content Start -->
                                    <div class="ec-wish-rightside col-lg-12 col-md-12">
                                        <!-- Compare content Start -->
                                        <div class="ec-compare-content">
                                            <div class="ec-compare-inner">
                                                <div class="row margin-minus-b-30">
                                                    @forelse ($wishlists as $wishlist)
                                                        @php
                                                            $product = $wishlist->product;
                                                            $product = isset($product->parent) ?: $product;

                                                        @endphp
                                                        <div
                                                            class="col-lg-3 col-md-4 col-sm-6 col-xs-6 mb-6 pro-gl-content">
                                                            <div class="ec-product-inner">
                                                                <div class="ec-pro-image-outer">
                                                                    <div class="ec-pro-image">
                                                                        <a href="{{ url('product/' . $product->slug) }}"
                                                                            class="image">
                                                                            @if ($product->productImages->isNotEmpty())
                                                                                <div>
                                                                                    <img class="main-image"
                                                                                        src="{{ asset('img/fotoproducts/' . $product->productImages->first()->foto) }}"
                                                                                        alt="Product Image">
                                                                                    <img class="hover-image"
                                                                                        src="{{ asset('img/fotoproducts/' . $product->productImages->first()->foto) }}"
                                                                                        alt="Product Image">
                                                                                </div>
                                                                            @endif
                                                                        </a>

                                                                        <span class="ec-com-remove ec-remove-wish">
                                                                            {{-- <form
                                                                                action="{{ route('delete-wishlist', $wishlist->id) }}"
                                                                                method="delete"
                                                                                class="delete d-inline-block">
                                                                                @csrf --}}

                                                                            <a href="{{ route('delete-wishlist', $wishlist->id) }}"
                                                                                type="submit" class="text-white">×</a>
                                                                            {{-- </form> --}}


                                                                        </span>


                                                                        <span class="percentage">Terlaris</span>

                                                                    </div>
                                                                </div>
                                                                <div class="ec-pro-content">
                                                                    <h5 class="ec-pro-title"><a
                                                                            href="{{ url('product/' . $product->slug) }}">{{ $product->name }}</a>
                                                                    </h5>
                                                                    <div class="ec-pro-rating">
                                                                        <i class="ecicon eci-star fill"></i>
                                                                        <i class="ecicon eci-star fill"></i>
                                                                        <i class="ecicon eci-star fill"></i>
                                                                        <i class="ecicon eci-star fill"></i>
                                                                        <i class="ecicon eci-star"></i>
                                                                    </div>

                                                                    <span class="ec-price">
                                                                        <span class="new-price">Rp
                                                                            {{ number_format($product->priceLabel(), 0, ',', '.') }}</span>
                                                                    </span>

                                                                </div>
                                                            </div>
                                                        </div>

                                                    @empty
                                                        <tr>
                                                            <td colspan="6" class="text-center">
                                                                <p class="text-center">You have no wishlist
                                                                    product</p>
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                        <!--compare content End -->
                                    </div>
                                    <!-- Compare Content end -->
                                </div>
                            </div>
                        </section>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
