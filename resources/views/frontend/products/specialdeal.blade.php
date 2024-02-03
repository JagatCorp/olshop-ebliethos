@extends('frontend.layout')

@section('content')
    <!-- Ec Shop page -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-shop-rightside col-lg-9 order-lg-last col-md-12 order-md-first margin-b-30">
                    <!-- Shop Top Start -->
                    <div class="ec-pro-list-top d-flex">
                        <div class="col-md-6 ec-grid-list">
                            <div class="ec-gl-btn">
                                <button class="btn btn-grid active"><i class="fi-rr-apps"></i></button>
                                <button class="btn btn-list"><i class="fi-rr-list"></i></button>
                            </div>
                        </div>
                        <div class="col-md-6 ec-sort-select">
                            <span class="sort-by">Sort by</span>
                            <div class="ec-select-inner">
                                <select
                                    onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value)"
                                    name="sort" id="">
                                    @foreach ($sorts as $url => $sort)
                                        <option {{ $selectedSort == $url ? 'selected' : null }} value="{{ $url }}">
                                            {{ $sort }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Shop Top End -->

                    <p class="sub-title mb-3 text-center">PROMO SPESIAL TERBATAS</p>
                    <!-- Shop content Start -->
                    <div class="shop-pro-content">
                        <div class="shop-pro-inner">
                            <div class="row">
                                @forelse ($products as $product)
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 mb-6 pro-gl-content">
                                        <div class="ec-product-inner">
                                            <div class="ec-pro-image-outer">
                                                <div class="ec-pro-image">
                                                    <a href="{{ url('product/' . $product->slug) }}" class="image">
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
                                                    <span class="percentage">Terlaris</span>
                                                    <span class="flags">
                                                        <span class="sale">Diskon</span>
                                                    </span>
                                                    <a href="#" class="quickview" data-link-action="quickview"
                                                        title="Quick view" data-bs-toggle="modal"
                                                        data-bs-target="#modal_detail{{ $product->id }}"><i
                                                            class="fi-rr-eye"></i></a>
                                                    <div class="ec-pro-actions">
                                                        <a href="{{ auth()->check() ? route('wishlists.store') : route('login') }}"
                                                            class="ec-btn-group wishlist add-to-fav"
                                                            product-slug="{{ $product->slug }}" title="Wishlist"
                                                            onclick="event.preventDefault(); window.location.href = this.href;">
                                                            <i class="fi-rr-heart"></i>
                                                        </a>
                                                        {{-- <a href="#" class="quickview" data-link-action="quickview"
                                                            title="Quick view" data-bs-toggle="modal"
                                                            data-bs-target="#modal_detail{{ $product->id }}"><i
                                                                class="fi-rr-eye"></i></a> --}}
                                                        <a class="add-to-cart" title="Add To Cart" href=""
                                                            product-id="{{ $product->id }}"
                                                            product-type="{{ $product->type }}"
                                                            product-slug="{{ $product->slug }}">
                                                            <i class="fi-rr-shopping-basket"></i>
                                                        </a>

                                                    </div>
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
                                                <div class="ec-pro-list-desc">Lorem Ipsum is simply dummy text of the
                                                    printing
                                                    and typesetting industry. Lorem Ipsum is simply dutmmy text ever since
                                                    the
                                                    1500s, when an unknown printer took a galley.</div>
                                                <span class="ec-price">
                                                    <span class="old-price">IDR
                                                        {{ number_format($product->priceOld()) }}</span>
                                                    <span class="new-price">IDR
                                                        {{ number_format($product->priceLabel()) }}</span>
                                                </span>

                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    No product found!
                                @endforelse
                            </div>
                        </div>
                        <!-- Ec Pagination Start -->

                        <!-- Ec Pagination End -->
                    </div>
                    <!--Shop content End -->
                </div>
                <!-- Sidebar Area Start -->
                <div class="ec-shop-leftside col-lg-3 order-lg-first col-md-12 order-md-last">
                    <div id="shop_sidebar">
                        <div class="ec-sidebar-heading">
                            <h1>Filter Products By</h1>
                        </div>
                        <div class="ec-sidebar-wrap">
                            <!-- Sidebar Category Block -->
                            @if ($categories)
                                <div class="ec-sidebar-block">
                                    <div class="ec-sb-title">
                                        <h3 class="ec-sidebar-title">Category</h3>
                                    </div>
                                    <div class="ec-sb-block-content">
                                        <ul>
                                            @foreach ($categories as $category)
                                                <li>
                                                    <div class="ec-sidebar-block-item">
                                                        <input type="checkbox" value="{{ $category->id }}" name="category"
                                                            id="category{{ $category->id }}" /> <a
                                                            href="{{ url('products?category=' . $category->slug) }}">{{ $category->name }}</a>
                                                </li>
                                            @endforeach
                                            {{--
                                        <li>
                                            <div class="ec-sidebar-block-item ec-more-toggle">
                                                <span class="checked"></span><span id="ec-more-toggle">More
                                                    Categories</span>
                                            </div>
                                        </li> --}}

                                        </ul>
                                    </div>
                                </div>
                            @endif

                            <!-- Sidebar Price Block -->
                            <div class="ec-sidebar-block">
                                <div class="ec-sb-title">
                                    <h3 class="ec-sidebar-title">Price</h3>
                                </div>
                                <div class="ec-sb-block-content es-price-slider">
                                    <div class="ec-price-filter">
                                        <div id="ec-sliderPrice" class="filter__slider-price" data-min="0" data-max="250"
                                            data-step="10"></div>
                                        <div class="ec-price-input">
                                            <label class="filter__label"><input type="text"
                                                    class="filter__input"></label>
                                            <span class="ec-price-divider"></span>
                                            <label class="filter__label"><input type="text"
                                                    class="filter__input"></label>
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
    <!-- End Shop page -->
    <!-- Modal Detail Product -->
    @foreach ($products as $product)
        <div class="modal fade" id="modal_detail{{ $product->id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="btn-close qty_close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-5 col-sm-12 col-xs-12">
                                <!-- Swiper -->
                                <div class="qty-product-cover">
                                    @if ($product->productImages->isNotEmpty())
                                        <div class="qty-slide">
                                            <img class="img-responsive cover-image"
                                                src="{{ asset('img/fotoproducts/' . $product->productImages->first()->foto) }}"
                                                alt="Product" />
                                        </div>
                                    @endif
                                </div>
                                <div class="qty-nav-thumb">
                                    @php $count = 0; @endphp
                                    @foreach ($product->productImages as $image)
                                        @if ($count < 4)
                                            <div class="qty-slide">
                                                <img class="img-responsive thumbnail-image"
                                                    src="{{ asset('img/fotoproducts/' . $image->foto) }}"
                                                    alt="Product" />
                                            </div>
                                            @php $count++; @endphp
                                        @endif
                                    @endforeach
                                </div>

                            </div>
                            <div class="col-md-7 col-sm-12 col-xs-12">
                                <div class="quickview-pro-content">
                                    <h5 class="ec-quick-title"><a
                                            href="{{ url('product/' . $product->slug) }}">{{ $product->name }}</a>
                                    </h5>
                                    <div class="ec-quickview-rating">
                                        <i class="ecicon eci-star fill"></i>
                                        <i class="ecicon eci-star fill"></i>
                                        <i class="ecicon eci-star fill"></i>
                                        <i class="ecicon eci-star fill"></i>
                                        <i class="ecicon eci-star fill"></i>
                                    </div>

                                    <div class="ec-quickview-desc">{{ $product->short_description }}</div>
                                    <div class="ec-quickview-price">
                                        <span class="old-price">IDR 9999</span>
                                        <span class="new-price">IDR
                                            {{ number_format($product->priceLabel(), 0, ',', '.') }}</span>
                                    </div>

                                    <div class="ec-quickview-qty align-items-center ">
                                        <div class="ec-quickview-cart ">
                                            <a href="" class="add-to-cart btn btn-primary"
                                                product-id="{{ $product->id }}" product-type="{{ $product->type }}"
                                                product-slug="{{ $product->slug }}" style="background-color: #B42225"><i
                                                    class="fi-rr-shopping-basket"></i>
                                                Add To Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- Modal end -->
    <script>
        // Ambil semua thumbnail-image di dalam modal
        var thumbnailImages = document.querySelectorAll('.modal.fade .thumbnail-image');

        // Loop melalui setiap thumbnail-image
        thumbnailImages.forEach(function(thumbnailImage) {
            // Tambahkan event listener untuk setiap thumbnail-image
            thumbnailImage.addEventListener('click', function() {
                // Ambil sumber gambar dari thumbnail-image yang diklik
                var clickedImageSrc = this.getAttribute('src');
                // Ambil elemen cover-image di dalam modal yang sedang aktif
                var activeModalCoverImage = document.querySelector('.modal.fade.show .cover-image');
                // Ganti atribut src dari cover-image dalam modal yang sedang aktif
                // dengan sumber gambar dari thumbnail-image yang diklik
                if (activeModalCoverImage) {
                    activeModalCoverImage.setAttribute('src', clickedImageSrc);
                }
            });
        });
    </script>
@endsection
