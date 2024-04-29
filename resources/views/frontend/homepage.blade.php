@extends('frontend.layout')
@section('title')
    Home
@endsection
@section('ActiveBeranda', 'active')
@section('content')
    <style>
        .btn-custom-outline {
            color: #B42225;
            background-color: transparent;
            background-image: none;
            border: 1px solid #B42225;
            padding-left: 50px;
            padding-right: 50px;
        }

        .btn-custom-outline:hover {
            color: #fff;
            background-color: #B42225;
        }

        .kategori {
            font-size: x-large;
            font-weight: bold;
            color: #B42225;
            text-align: center;
            padding-bottom: 20px;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .search-bar {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
        }
    </style>




    <!-- ekka Cart End -->

    <!-- Main Slider Start -->
    <div class="sticky-header-next-sec ec-main-slider section section-space-pb" style="  top: -50%;">
        <div class="ec-slider swiper-container main-slider-nav main-slider-dot">
            <!-- Main slider -->
            <div class="swiper-wrapper">
                @foreach ($slider as $item)
                    <div style="background: url('{{ asset('core/public/img/fotoslider/' . $item->foto) }}') no-repeat; background-size: cover; margin-bottom:0px; background-position: center center;"
                        class="ec-slide-item swiper-slide d-flex ec-slide-1 ">
                        <div class="container align-self-center">
                            <div class="row">
                                <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center">
                                    <div class="ec-slide-content slider-animation">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="swiper-pagination swiper-pagination-white"></div>
            <div class="swiper-buttons">
                <div class="swiper-button-next" style="background-color: #B42225"></div>
                <div class="swiper-button-prev" style="background-color: #B42225"></div>
            </div>
        </div>
    </div>
    <!-- Main Slider End -->
    <!--  services Section Start -->
    <div class="section ec-services-section section-space-p">
        <h2 class="d-none">Services</h2>
        <div class="container">
            <div class="row py-5 " style="margin-top: -100px;">
                <div class="ec_ser_content ec_ser_content_1 col-sm-12 col-md-6 col-lg-3 mb-lg-0" data-animation="fadeIn">
                    <div class="ec_ser_inner">
                        <div class="ec-service-image">
                            <i class="fi fi-rr-location-alt"></i>
                        </div>
                        <div class="ec-service-desc">
                            <h2>Produk Asli</h2>
                            <p>Jaminan produk langsung dari pabriknya</p>
                        </div>
                        {{-- <a href="#" class="btn btn-primary mt-2 rounded-5 ">Join Now</a> --}}
                    </div>

                </div>
                <div class="ec_ser_content ec_ser_content_2 col-sm-12 col-md-6 col-lg-3" data-animation="fadeIn">
                    <div class="ec_ser_inner">
                        <div class="ec-service-image">
                            <i class="fi fi-rr-headset"></i>
                        </div>
                        <div class="ec-service-desc">
                            <h2>24X7 Support</h2>
                            <p>Customer Service kami 24 jam aktif melayani anda</p>
                        </div>
                        {{-- <a href="#" class="btn btn-primary mt-2 rounded-5 ">Join Now</a> --}}
                    </div>
                </div>
                <div class="ec_ser_content ec_ser_content_3 col-sm-12 col-md-6 col-lg-3" data-animation="fadeIn">
                    <div class="ec_ser_inner">
                        <div class="ec-service-image">
                            <i class="fi fi-rr-badge-percent"></i>
                        </div>
                        <div class="ec-service-desc">
                            <h2>Potongan Ongkir</h2>
                            <p>Dapatkan Potongan Ongkir seluruh Indonesia</p>
                        </div>
                        {{-- <a href="#" class="btn btn-primary mt-2 rounded-5 ">Join Now</a> --}}
                    </div>
                </div>
                <div class="ec_ser_content ec_ser_content_4 col-sm-12 col-md-6 col-lg-3" data-animation="fadeIn">
                    <div class="ec_ser_inner">
                        <div class="ec-service-image">
                            <i class="fi fi-rr-hand-holding-seeding"></i>
                        </div>
                        <div class="ec-service-desc">
                            <h2>Bebas Konsultasi</h2>
                            <p>Konsultasikan keluhan anda bersama ahli kami GRATIS!!</p>
                        </div>
                        {{-- <a href="#" class="btn btn-primary mt-2 rounded-5 ">Join Now</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--services Section End -->
    <!-- Ec Instagram Start -->
    <section class="section ec-instagram-section module section-space-p" id="insta">
        <div class="ec-insta-wrapper">
            <div class="ec-insta-outer">
                <div class="container" data-animation="fadeIn">
                    <div class="insta-auto">
                        <!-- instagram item -->
                        @foreach ($banner as $item)
                            <div class="ec-insta-item" style="width: 600px !important;height: 160px !important">
                                <div class="">
                                    <a href="/special-deal"><img src="{{ asset('core/public/img/fotobanner/' . $item->foto) }}"
                                            alt="insta"></a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Ec Instagram End -->
    <!-- Product tab Area Start -->
    <section class="section ec-product-tab section-space-p" id="collection">
        <div class="container">
            {{-- <div class="row mb-5">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    @foreach ($banner as $item)
                        <img src="{{ asset('img/fotobanner/' . $item->foto) }}">
                    @endforeach
                </div>
                <div class="col-md-1"></div>
            </div> --}}
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="ec-bg-title">Paling Sering Dibeli</h2>
                        <h2 class="ec-title">Paling Sering Dibeli</h2>
                        <p class="sub-title" style="opacity: 0">Browse The Collection of Paling Sering Dibeli</p>
                        <a href="special-deal" class="btn btn-custom-outline">Lihat Semua</a>
                    </div>
                </div>
            </div>
            @if ($products)
                <div class="row">
                    <div class="col">
                        <div class="tab-content">
                            <!-- 1st Product tab start -->
                            <div class="tab-pane fade show active" id="tab-pro-for-all">
                                <div class="row">
                                    <!-- Product Content -->

                                    @foreach ($products as $product)
                                        @php
                                            $product = $product->parent ?: $product;
                                            // Ambil gambar produk yang sesuai dengan produk yang sedang ditampilkan
                                            $productImage = $productImages->where('product_id', $product->id)->first();
                                            $photos = $productImage ? json_decode($productImage->foto) : [];
                                        @endphp
                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6  ec-product-content"
                                            data-animation="fadeIn">
                                            <div class="ec-product-inner">
                                                <!-- Formulir untuk setiap produk -->

                                                <div class="ec-pro-image">
                                                    <a href="{{ url('product/' . $product->slug) }}" class="image">
                                                        <a href="{{ url('product/' . $product->slug) }}" class="image">
                                                            @if ($product->productImages->isNotEmpty())
                                                                <div>
                                                                    <img class="main-image"
                                                                        src="{{ asset('core/public/img/fotoproducts/' . $product->productImages->first()->foto) }}"
                                                                        alt="Product Image">
                                                                    <img class="hover-image"
                                                                        src="{{ asset('core/public/img/fotoproducts/' . $product->productImages->first()->foto) }}"
                                                                        alt="Product Image">
                                                                </div>
                                                            @endif
                                                        </a>
                                                        <span class="percentage">{{ $product->label }}</span>

                                                        <a href="#" class="quickview" data-link-action="quickview"
                                                            title="Quick view" data-bs-toggle="modal"
                                                            data-bs-target="#modal_detail{{ $product->id }}"><i
                                                                class="fi-rr-eye"></i></a>
                                                        <div class="ec-pro-actions">

                                                            <a class="add-to-cart" title="Add To Cart" href=""
                                                                product-id="{{ $product->id }}"
                                                                product-type="{{ $product->type }}"
                                                                product-slug="{{ $product->slug }}">
                                                               <i class="fi-rr-shopping-cart"></i>
                                                            </a>

                                                            <a href="{{ auth()->check() ? route('wishlists.store') : route('login') }}"
                                                                class="ec-btn-group wishlist add-to-fav"
                                                                product-slug="{{ $product->slug }}" title="Wishlist"
                                                                onclick="event.preventDefault(); window.location.href = this.href;">
                                                                <i class="fi-rr-heart"></i>
                                                            </a>
                                                        </div>
                                                </div>
                                                <div class="ec-pro-content">
                                                    <h5 class="ec-pro-title"> <a
                                                            href="{{ url('product/' . $product->slug) }}">{{ $product->name }}</a>
                                                    </h5>
                                                    <div class="ec-pro-rating">
                                                        @php
                                                            $averageRating = $product->average_rating ?? 0;
                                                            $filledStars = floor($averageRating);
                                                            $emptyStars = 5 - $filledStars;
                                                        @endphp
                                                        @for ($i = 0; $i < $filledStars; $i++)
                                                            <i class="ecicon eci-star fill"></i>
                                                        @endfor
                                                        @for ($i = 0; $i < $emptyStars; $i++)
                                                            <i class="ecicon eci-star"></i>
                                                        @endfor
                                                    </div>
                                                    <span class="ec-price">
                                                        <span class="old-price">IDR
                                                            {{ number_format($product->priceOld(), 0, ',', '.') }}</span>
                                                        <span class="new-price">IDR
                                                            {{ number_format($product->priceLabel(), 0, ',', '.') }}</span>
                                                    </span>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- ec 1st Product tab end -->
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- ec Product tab Area End -->

    <!--  Category Section Start -->
    <section class="section ec-category-section section-space-p" id="categories">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="ec-bg-title">Kategori</h2>
                        <h2 class="ec-title">Kategori</h2>
                        <p class="sub-title" style="opacity: 0">Browse The Collection of Popular Products</p>
                        <button class="btn btn-custom-outline" style="opacity: 0">View All</button>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="tab-content">
                        <!-- 1st Product tab start -->
                        <div class="tab-pane fade show active" id="tab-pro-for-all">

                            <div class="row">
                                <!-- Product Content -->
                                <div class="col-lg-2"></div>
                                <div class="kategori">Vitamin</div>
                                @foreach ($products as $product)
                                    @php
                                        $product = $product->parent ?: $product;
                                        // Ambil gambar produk yang sesuai dengan produk yang sedang ditampilkan
                                        $productImage = $productImages->where('product_id', $product->id)->first();
                                        $photos = $productImage ? json_decode($productImage->foto) : [];
                                    @endphp
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6  ec-product-content"
                                        data-animation="fadeIn">
                                        <div class="ec-product-inner">
                                            <div class="ec-pro-image">
                                                <a href="{{ url('product/' . $product->slug) }}" class="image">


                                                    @if ($product->productImages->isNotEmpty())
                                                        <div>
                                                            <img class="main-image"
                                                                src="{{ asset('core/public/img/fotoproducts/' . $product->productImages->first()->foto) }}"
                                                                alt="Product Image">
                                                            <img class="hover-image"
                                                                src="{{ asset('core/public/img/fotoproducts/' . $product->productImages->first()->foto) }}"
                                                                alt="Product Image">
                                                        </div>
                                                    @endif

                                                </a>
                                                <span class="percentage">{{ $product->label }}</span>

                                                <a href="#" class="quickview" data-link-action="quickview"
                                                    title="Quick view" data-bs-toggle="modal"
                                                    data-bs-target="#modal_detail{{ $product->id }}"><i
                                                        class="fi-rr-eye"></i></a>
                                                <div class="ec-pro-actions">

                                                    <a class="add-to-cart" title="Add To Cart" href=""
                                                        product-id="{{ $product->id }}"
                                                        product-type="{{ $product->type }}"
                                                        product-slug="{{ $product->slug }}">
                                                        <i class="fi-rr-shopping-cart"></i>
                                                    </a>

                                                    <a href="{{ auth()->check() ? route('wishlists.store') : route('login') }}"
                                                        class="ec-btn-group wishlist add-to-fav"
                                                        product-slug="{{ $product->slug }}" title="Wishlist"
                                                        onclick="event.preventDefault(); window.location.href = this.href;">
                                                        <i class="fi-rr-heart"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="ec-pro-content">
                                                <h5 class="ec-pro-title"> <a
                                                        href="{{ url('product/' . $product->slug) }}">{{ $product->name }}</a>
                                                </h5>
                                                <div class="ec-pro-rating">
                                                    @php
                                                        $averageRating = $product->average_rating ?? 0;
                                                        $filledStars = floor($averageRating);
                                                        $emptyStars = 5 - $filledStars;
                                                    @endphp
                                                    @for ($i = 0; $i < $filledStars; $i++)
                                                        <i class="ecicon eci-star fill"></i>
                                                    @endfor
                                                    @for ($i = 0; $i < $emptyStars; $i++)
                                                        <i class="ecicon eci-star"></i>
                                                    @endfor
                                                </div>
                                                <span class="ec-price">
                                                    <span class="old-price">IDR
                                                        {{ number_format($product->priceOld(), 0, ',', '.') }}</span>
                                                    <span class="new-price">IDR
                                                        {{ number_format($product->priceLabel(), 0, ',', '.') }}</span>
                                                </span>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach

                            </div>

                        </div>
                        <div class="col-lg-2"></div>
                        <!-- ec 1st Product tab end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Category Section End -->


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
                                                src="{{ asset('core/public/img/fotoproducts/' . $product->productImages->first()->foto) }}"
                                                alt="Product" />
                                        </div>
                                    @endif
                                </div>
                                <div class="qty-nav-thumb">
                                    @php $count = 0; @endphp
                                    @foreach ($product->productImages as $image)
                                        @if ($count < 4)
                                            <div class="qty-slide">
                                                <div class="easyzoom easyzoom--overlay">
                                                    @if ($image->foto)
                                                        <img class="img-responsive thumbnail-image"
                                                            src="{{ asset('core/public/img/fotoproducts/' . $image->foto) }}"
                                                            alt="Product" />
                                                    @elseif ($image->video)
                                                        <video width="100%" height="100%" controls>
                                                            <source
                                                                src="{{ asset('core/public/img/videoproducts/' . $image->video) }}"
                                                                type="video/mp4">
                                                        </video>
                                                    @endif
                                                </div>
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
                                        @php
                                            $averageRating = $product->average_rating ?? 0;
                                            $filledStars = floor($averageRating);
                                            $emptyStars = 5 - $filledStars;
                                        @endphp
                                        @for ($i = 0; $i < $filledStars; $i++)
                                            <i class="ecicon eci-star fill"></i>
                                        @endfor
                                        @for ($i = 0; $i < $emptyStars; $i++)
                                            <i class="ecicon eci-star"></i>
                                        @endfor
                                    </div>

                                    <div class="ec-quickview-desc">{{ $product->short_description }}</div>
                                    <div class="ec-quickview-price">
                                        <span class="old-price">IDR {{ number_format($product->priceOld(), 0, ',', '.') }}</span>
                                        <span class="new-price">IDR
                                            {{ number_format($product->priceLabel(), 0, ',', '.') }}</span>
                                    </div>

                                    <div class="ec-quickview-qty align-items-center ">
                                        <div class="ec-quickview-cart ">
                                            <a href="" class="add-to-cart btn btn-primary"
                                                product-id="{{ $product->id }}" product-type="{{ $product->type }}"
                                                product-slug="{{ $product->slug }}" style="background-color: #B42225">
                                                 <i class="fi-rr-shopping-cart"></i>
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




    <!-- ec testimonial Start -->
     <section class="section ec-test-section section-space-mt section-space-mb section-space-p"
        style="background-image: url('assets/images/testimonial/testi_bg.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center ec-test-top">
                    <div class="ec-test-top-svg">
                        <h2 class=" text-danger  text-center">Testimoni</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="ec-test-outer">
                    <ul id="ec-testimonial-slider">
                        @foreach ($testimoni as $item)
                            <li class="ec-test-item">
                                <div class="ec-test-inner">
                                   <img  <img src="{{ asset('core/public/img/fototestimoni/' . $item->image) }}"
                                        style="border-radius: 50%; width:150px; height:150px" class="mx-auto" />/>
                                    <div class="ec-test-content">
                                        <div class="ec-test-desc"><i class="fi-rr-quote-right top"></i>
                                            {!! $item->testimoni !!} <i class="fi-rr-quote-right bottom"></i>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach


                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- ec testimonial end -->


    <!-- Main Js -->
    <script src="assets-user/js/vendor/index.js"></script>
    <script src="assets-user/js/main.js"></script>

    <script>
        // JavaScript to show and hide the search bar modal
        const showSearchButton = document.getElementById('showSearch');
        const searchModal = document.getElementById('searchModal');

        showSearchButton.addEventListener('click', function() {
            searchModal.style.display = 'flex';
        });

        function closeSearchModal() {
            searchModal.style.display = 'none';
        }

        // Close modal when clicking outside of it
        window.addEventListener('click', function(event) {
            if (event.target === searchModal) {
                closeSearchModal();
            }
        });
    </script>
    <script>
        // JavaScript to show and hide the search bar modal
        const showSearchButton = document.getElementById('showSearch2');
        const searchModal = document.getElementById('searchModal2');

        showSearchButton.addEventListener('click', function() {
            searchModal.style.display = 'flex';
        });

        function closeSearchModal() {
            searchModal.style.display = 'none';
        }

        // Close modal when clicking outside of it
        window.addEventListener('click', function(event) {
            if (event.target === searchModal) {
                closeSearchModal();
            }
        });
    </script>
@endsection
