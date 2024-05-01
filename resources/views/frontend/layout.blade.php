<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>

        @yield('title')

    </title>
    <meta name="keywords"
        content="herbal,susu,madu,jahe,apparel, catalog, clean, ecommerce, electronics, fashion, html eCommerce, html store, minimal, multipurpose, multipurpose ecommerce, online store, responsive ecommerce template, shops" />
    <meta name="description" content="eblie shop">
    <meta name="author" content="angga gumilang">

    <!-- site Favicon -->
    <link rel="icon" href="{{ asset('/images/ebli2.png') }}" sizes="32x32" />
    <link rel="apple-touch-icon" href="{{ asset('/images/ebli2.png') }}" />
    <meta name="msapplication-TileImage" content="{{ asset('/images/ebli2.png') }}" />

    <!-- css Icon Font -->
    <link rel="stylesheet" href="{{ asset('assets-user/css/vendor/ecicons.min.css') }}" />

    <!-- css All Plugins Files -->
    <link rel="stylesheet" href="{{ asset('assets-user/css/plugins/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets-user/css/plugins/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets-user/css/plugins/jquery-ui.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets-user/css/plugins/countdownTimer.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets-user/css/plugins/slick.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets-user/css/plugins/bootstrap.css') }}" />

    <!-- Main Style -->
    <link rel="stylesheet" href="{{ asset('assets-user/css/demo1.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets-user/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets-user/css/responsive.css') }}" />
    <!-- Background css -->
    <link rel="stylesheet" id="bg-switcher-css" href="{{ asset('assets-user/css/backgrounds/bg-4.css') }}">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="/assets-tambahan/css/font-awesome.min.css">
    <!-- icofont CSS -->
    <link rel="stylesheet" href="/assets-tambahan/css/icofont.css">

    <!-- Animate CSS -->
    <link rel="stylesheet" href="/assets-tambahan/css/animate.min.css">

    <!-- CSRF Token Penting  BuatAdd Cart -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
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

<body>

    <div id="ec-overlay">
        <div class="ec-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- Header start  -->
    <header id="ec-main-menu-desk" class="sticky-nav ec-header">
        <!--Ec Header Top Start -->
        <div>
            <div class="container">
                <div class="row align-items-center pt-2">
                    <!-- Header Top responsive Action -->
                    <div class="col d-lg-none ">
                        <div class="ec-header-bottons">
                            <!-- Header Search Start -->
                            {{-- <a href="#" class="ec-header-btn ec-header-wishlist" id="showSearch2">
                                <div class="header-icon"><i class="fi-rr-search"></i></div>
                            </a> --}}
                            <!-- Header Search End -->
                            <!-- Ec Header Search Start -->
                            <div class="modal" id="searchModal2">
                                <div class="search-bar">
                                    <div class="align-self-center" id="searchModal2">
                                        <div class="header-search">
                                            <form class="ec-btn-group-form" action="#">
                                                <input class="form-control ec-search-bar" placeholder="Search..."
                                                    type="text">
                                                <button class="submit" type="submit"><i
                                                        class="fi-rr-search"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Ec Header Search End -->
                            <!-- Header User Start -->
                            <!--<a href="/account" class="ec-header-btn ec-side-toggle">-->
                            <!--    <div class="header-icon"><i class="fi-rr-user"></i></div>-->
                            <!--</a>-->
                            <!-- Header User End -->
                            <!-- Header Cart Start -->
                            <a href="#ec-side-cart" class="ec-header-btn ec-side-toggle">
                                <div class="header-icon"><i class="fi-rr-shopping-cart"></i></div>
                                <span class="ec-header-count cart-count-lable">{{ Cart::count() }}</span>
                            </a>
                            <!-- Header Cart End -->

                            <!-- Header menu Start -->
                            <a href="#ec-mobile-menu" class="ec-header-btn ec-side-toggle d-lg-none">
                                <i class="fi fi-rr-menu-burger"></i>
                            </a>
                            <!-- Header menu End -->
                        </div>
                    </div>
                    <!-- Header Top responsive Action -->
                </div>
            </div>
        </div>
        <!-- Ec Header Top  End -->
        <!-- Ec Header Bottom  Start -->
        <div class="ec-header-bottom d-none d-lg-block bg-transparent">
            <div class="container position-relative">
                <div class="row">
                    <div class="ec-flex">
                        <div class="col-6 " style="margin-left:-5%; ">
                            <div class="ec-main-menu">
                                <ul>
                                    <li><a href="/" class="@yield('ActiveBeranda')">Beranda</a></li>
                                    <li class="dropdown"><a>Produk</a>
                                        <ul class="sub-menu ">
                                            <li><a href="/special-deal" class="@yield('ActivePopuler')">Special Deal</a>
                                            </li>
                                            <li><a href="/products" class="@yield('ActiveProduk')">Produk</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown"><a>Lainnya</a>
                                        <ul class="sub-menu">
                                            <li><a href="/about" class="@yield('ActiveAbout')">Tentang Kami</a></li>
                                            <li><a href="/konsultasi" class="@yield('ActiveKonsultasi')">Konsultasi</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="/artikel" class="@yield('ActiveArtikel')">Artikel</a></li>

                                </ul>
                            </div>
                        </div>
                        @php
                            $settings = App\Models\Settings::first();
                        @endphp
                        <!-- Ec Header Logo Start -->
                        <div class="align-self-center col-3 " style="margin-left: -100px">
                            <div class="header-logo">
                                <a href="/"><img src="{{ asset('/img/logotoko/' . $settings->logo) }}"
                                        class="main-logo" /></a>
                            </div>
                            <style>
                                .main-logo {
                                    width: 200px !important;
                                    height: 50px;

                                }
                            </style>
                        </div>
                        <!-- Ec Header Logo End -->

                        <!-- Ec Header Button Start -->
                        <div class="align-self-center">
                            <div class="ec-header-bottons">

                                {{-- <!-- Header Search Start -->
                                <a href="#" class="ec-header-btn ec-header-wishlist" id="showSearch">
                                    <div class="header-icon"><i class="fi-rr-search"></i></div>
                                </a>
                                <!-- Header Search End -->
                                <!-- Ec Header Search Start -->
                                <div class="modal" id="searchModal">
                                    <div class="search-bar">
                                        <div class="align-self-center" id="searchModal2">
                                            <div class="header-search">
                                                <form class="ec-btn-group-form" action="#">
                                                    <input class="form-control ec-search-bar" placeholder="Search..."
                                                        type="text">
                                                    <button class="submit" type="submit"><i
                                                            class="fi-rr-search"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="align-self-center">
                                    <div class="header-search" style="width: 200px; float: right;">
                                        <form class="ec-btn-group-form" action="{{ url('products') }}"
                                            method="GET">
                                            <input class="form-control ec-search-bar" style="width: 200px;"
                                                placeholder="Search products..." type="text" name="q"
                                                value="{{ isset($q) ? $q : null }}">
                                            <button class="submit" type="submit"><i
                                                    class="fi-rr-search"></i></button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Ec Header Search End -->
                                <!-- Header User Start -->
                                <a href="{{ url('/profile') }}" class="ec-header-btn ec-header-wishlist">
                                    <div class="header-icon"><i class="fi-rr-user"></i></div>
                                </a>
                                <!-- Header User End -->
                                <!-- Header Cart Start -->
                                <a href="#ec-side-cart" class="ec-header-btn ec-side-toggle">
                                    <div class="header-icon"><i class="fi-rr-shopping-cart"></i></div>
                                    <span class="ec-header-count cart-count-lable"
                                        style="position: relative; top: -3px; left: -5px">
                                        {{ Cart::count() }}
                                    </span>

                                </a>
                                <!-- Header Cart End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ec Header Button End -->
        <!-- Header responsive Bottom  Start -->
        <div class="ec-header-bottom d-lg-none">
            <div class="container position-relative">
                <div class="row ">

                    <!-- Ec Header Logo Start -->
                    <div class="align-self-center">
                        <div class="header-logo">
                            <a href="/"><img src="{{ asset('/img/logotoko/' . $settings->logo) }}"
                                    class="main-logo" alt="Site Logo" /></a>
                        </div>
                    </div>
                    <!-- Ec Header Logo End -->
                    {{-- search form start --}}
                    <div class="align-self-center ">
                        <div class="header-search" style="width: 200px;">
                            <form class="ec-btn-group-form" action="{{ url('products') }}" method="GET">
                                <input class="form-control ec-search-bar" style="width: 200px;"
                                    placeholder="Search products..." type="text" name="q"
                                    value="{{ isset($q) ? $q : null }}">
                                <button class="submit" type="submit"><i class="fi-rr-search"></i></button>
                            </form>
                        </div>
                    </div>
                    {{-- search form end --}}
                </div>
            </div>
        </div>
        <!-- Header responsive Bottom  End -->

        <!-- ekka Mobile Menu Start -->
        <div id="ec-mobile-menu" class="ec-side-cart ec-mobile-menu">
            <div class="ec-menu-title">
                <span class="menu_title">Menu</span>
                <button class="ec-close">×</button>
            </div>
            <div class="ec-menu-inner">
                <div class="ec-menu-content">
                    <ul>
                        <li><a href="/">Beranda</a></li>
                        <li class="dropdown"><a href="">Produk</a>
                            <ul class="sub-menu">
                                <li><a href="/special-deal">Special Deal</a></li>
                                <li><a href="/products">Produk</a></li>
                            </ul>
                        </li>
                        <li class="dropdown"><a href="">Lainnya</a>
                            <ul class="sub-menu">
                                <li><a href="/about">Tentang Kami</a></li>
                                <li><a href="/konsultasi">Konsultasi</a></li>
                            </ul>
                        </li>
                        <li><a href="/artikel">Artikel</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- ekka mobile Menu End -->
    </header>
    <!-- Header End  -->

    {{-- sidebar cart --}}

    <!-- ekka Cart Start -->
    {{-- @foreach ($cart as $keranjang) --}}
    @php

        // $count = \App\Models\Sewa::count();
        use Gloudemans\Shoppingcart\Facades\Cart;
        $items = \Cart::content();
        // $total = \Cart::getTotal();
        // $totalItem = \Cart::getTotalQuantity();
        // $totalWeight = \Cart::getTotalWeight();
        $productImages = \App\Models\ProductImage::get();

    @endphp
    <div class="ec-side-cart-overlay"></div>
    <div id="ec-side-cart" class="ec-side-cart">
        <div class="ec-cart-inner">
            <div class="ec-cart-top">
                <div class="ec-cart-title">
                    <span class="cart_title">Cart</span>
                    <button class="ec-close">×</button>
                </div>
                <ul class="eccart-pro-items">
                    @forelse ($items as $item)
                        @php
                            $product = isset($item->model->parent) ? $item->model->parent : $item->model;

                        @endphp
                        <li>
                            <a href="#" class="sidekka_pro_img">

                                @if ($product->productImages->isNotEmpty())
                                    <div>
                                        <img src="{{ asset('/img/fotoproducts/' . $product->productImages->first()->foto) }}"
                                            alt="Product Image">

                                    </div>
                                @endif
                            </a>
                            <div class="ec-pro-content">
                                <a href="#" class="cart_pro_title">{{ $product->name }}</a>
                                <span class="cart-price"><span>IDR
                                        {{ number_format($item->price, 0, ',', '.') }}</span> x
                                    {{ $item->qty }}</span>
                                <div class="d-flex align-items-center">
                                    <p class="mt-3">Pilih Jumlah</p>
                                    <select class="form-select" id="change-qty" data-productId="{{ $item->rowId }}"
                                        value="{{ $item->qty }}">
                                        @foreach (range(1, $item->model->productInventory->qty) as $qty)
                                            <option {{ $qty == $item->qty ? 'selected' : null }}
                                                value="{{ $qty }}">{{ $qty }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <a href="{{ url('carts/remove/' . $item->rowId) }}" class="remove"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini dari keranjang?')">×</a>
                            </div>
                        </li>
                    @empty
                        <tr>
                            <td colspan="6">The cart is empty!</td>
                        </tr>
                    @endforelse
                </ul>
            </div>
            <div class="ec-cart-bottom">
                <div class="cart-sub-total">
                    <table class="table cart-table">
                        <tbody>
                            <tr>
                                <td class="text-left">Total :</td>
                                <td class="text-right primary-color">Rp.{{ Cart::subtotal(0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="cart_btn">
                    <a href="carts" class="btn btn-primary">View Cart</a>
                    <a href="{{ url('orders/checkout') }}" class="btn btn-secondary">Checkout</a>
                </div>
            </div>
        </div>
    </div>
    {{-- @endforeach --}}
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

    {{-- end sidebar cart --}}


    {{-- section content --}}
    @yield('content')
    {{-- end section konten --}}

    {{-- loading --}}
    <div id="loader" style="display: none;">
        <div id="loading"
            style="z-index:99999;position: fixed;top:0;left:0;right:0;bottom:0;background-color:rgba(0,0,0,.3);display: flex;justify-content:center;align-items: center;"
            class="mx-auto">
            <p><img src="{{ asset('themes/ezone/assets/img/loading.gif') }}" /> Tunggu Sebentar</p>
        </div>
    </div>
    {{-- endloading --}}
    <footer class="ec-footer section-space-mt">
        <div class="footer-container">
            <div class="footer-top section-space-footer-p">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-lg-5 ec-footer-info m-auto">
                            <div class="ec-footer-widget">
                                <h4 class="ec-footer-heading">TENTANG KAMI</h4>
                                <div class="ec-footer-links">
                                    <ul class="align-items-center">
                                        <li class="ec-footer-link">{!! $about->isi ?? 'No Data' !!}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-2 ec-footer-account">
                            <div class="ec-footer-widget">
                                <h4 class="ec-footer-heading">TOKO KAMI</h4>
                                <div class="ec-footer-links">
                                    <ul class="align-items-center">
                                        <li class="ec-footer-link"><a
                                                href="https://shopee.co.id/{{ $settings->link_shopee }}">Shopee</a>
                                        </li>
                                        <li class="ec-footer-link"><a
                                                href="https://www.tokopedia.com/{{ $settings->link_tokped }}">Tokopedia</a>
                                        </li>
                                        <li class="ec-footer-link"><a
                                                href="https://www.tiktok.com/{{ '@' . $settings->link_tiktokshop }}">TikTok
                                                Shop</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-2 ec-footer-service">
                            <div class="ec-footer-widget">
                                <h4 class="ec-footer-heading">KONTAK KAMI</h4>
                                <div class="ec-footer-links">
                                    <ul class="align-items-center">
                                        <li class="ec-footer-link">{{ $settings->email }}</li>
                                        <li class="ec-footer-link">{{ $settings->waktu_buka }}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="row align-items-center">
                        <!-- Footer Copyright Start -->
                        <div class="col text-center footer-copy">
                            <div class="footer-bottom-copy ">
                                <p>&copy;
                                    <script>
                                        document.write(new Date().getFullYear());
                                    </script> Ebliethos Official
                                </p>
                            </div>
                        </div>
                        <!-- Footer Copyright End -->
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Area End -->

    <!-- Footer navigation panel for responsive display -->
    <div class="ec-nav-toolbar">
        <div class="container">
            <div class="ec-nav-panel">
                <div class="ec-nav-panel-icons">
                    <a href="#ec-mobile-menu" class="navbar-toggler-btn ec-header-btn ec-side-toggle"><i
                            class="fi-rr-menu-burger"></i></a>
                </div>
                <div class="ec-nav-panel-icons">
                    <a href="#ec-side-cart" class="toggle-cart ec-header-btn ec-side-toggle"><i
                            class="fi-rr-shopping-cart"></i><span
                            class="ec-cart-noti ec-header-count cart-count-lable">{{ Cart::count() }}</span></a>
                </div>
                <div class="ec-nav-panel-icons">
                    <a href="/" class="ec-header-btn"><i class="fi-rr-home"></i></a>
                </div>
                {{-- <div class="ec-nav-panel-icons">
                    <a href="wishlist.html" class="ec-header-btn"><i class="fi-rr-search"></i></a>
                </div> --}}
                <div class="ec-nav-panel-icons">
                    <a href="{{ url('/profile') }}" class="ec-header-btn"><i class="fi-rr-user"></i></a>
                </div>

            </div>
        </div>
    </div>
    <!-- Footer navigation panel for responsive display end -->

    <!-- Cart Floating Button -->
    <div class="ec-cart-float">
        <a href="#ec-side-cart" class="ec-header-btn ec-side-toggle">
            <div class="header-icon"><i class="fi-rr-shopping-basket"></i>fgsd
            </div>
            <span class="ec-cart-count cart-count-lable">{{ Cart::count() }}</span>
        </a>
    </div>
    <!-- Cart Floating Button end -->

    {{-- icon live chat --}}
    <div class="ec-style ec-right-bottom d-flex  gap-2">
        <a href="https://chat.mendjamu.com">
            <img src="{{ asset('images/logochat.png') }}" alt="" width="40"
                style="margin-right: 110px">
        </a>
    </div>


    <!-- Whatsapp -->
    <div class="ec-style ec-right-bottom">
        <!-- Start Floating Panel Container -->
        <div class="ec-panel mb-4 me-4">
            <!-- Panel Header -->
            <div class="ec-header" style="background-color: #B42225;">
                <strong>Perlu Bantuan?</strong>
                <p>Hubungi Kami Melalui WhatsApp</p>
            </div>
            <!-- Panel Content -->
            <div class="ec-body">
                <ul>
                    <!-- Start Single Contact List -->
                    <li>

                        <a class="ec-list" data-number="918866774266"
                            data-message="Please help me! I have got wrong product - ORDER ID is : #654321485">

                            <div class="d-flex bd-highlight">

                                <!-- Profile Picture -->
                                <div class="ec-img-cont">
                                    <img src="{{ asset('/assets-user/images/whatsapp/profile_01.jpg') }}"
                                        class="ec-user-img" alt="Profile image">
                                    <span class="ec-status-icon"></span>
                                </div>

                                <!-- Display Name & Last Seen -->
                                <div class="ec-user-info">
                                    <span>Admin</span>
                                    <p>Admin aktif 7 menit yang lalu</p>
                                </div>

                                <!-- Chat iCon -->
                                <div class="ec-chat-icon">
                                    <i class="fa fa-whatsapp"></i>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!--/ End Single Contact List -->
                    <!-- Start Single Contact List -->
                    <li>
                        <a class="ec-list" data-number="918866774266"
                            data-message="Please help me! I have got wrong product - ORDER ID is : #654321485">
                            <div class="d-flex bd-highlight">
                                <!-- Profile Picture -->
                                <div class="ec-img-cont">
                                    <img src="{{ asset('/assets-user/images/whatsapp/profile_02.jpg') }}"
                                        class="ec-user-img" alt="Profile image">
                                    <span class="ec-status-icon ec-online"></span>
                                </div>
                                <!-- Display Name & Last Seen -->
                                <div class="ec-user-info">
                                    <span>Customer Service</span>
                                    <p>Customer Service sedang online</p>
                                </div>
                                <!-- Chat iCon -->
                                <div class="ec-chat-icon">
                                    <i class="fa fa-whatsapp"></i>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!--/ End Single Contact List -->
                </ul>
            </div>
        </div>
        <!--/ End Floating Panel Container -->
        <!-- Start Right Floating Button-->
        <div class="ec-right-bottom me-4">
            <div class="">
                <div class="ec-button rotateBackward">
                    <img class="" src="{{ asset('/assets-user/images/chat.png') }}" alt="whatsapp icon"
                        style="max-width: 200%; margin-right: 50px;">
                </div>
            </div>
        </div>
        <!--/ End Right Floating Button-->
    </div>
    <!-- Whatsapp end -->

    <!-- Vendor JS -->
    <script src="{{ asset('assets-user/js/vendor/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets-user/js/vendor/popper.min.js') }}"></script>
    <script src="{{ asset('assets-user/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets-user/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('assets-user/js/vendor/modernizr-3.11.2.min.js') }}"></script>

    <!--Plugins JS-->
    <script src="{{ asset('assets-user/js/plugins/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets-user/js/plugins/countdownTimer.min.js') }}"></script>
    <script src="{{ asset('assets-user/js/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('assets-user/js/plugins/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('assets-user/js/plugins/slick.min.js') }}"></script>
    <script src="{{ asset('assets-user/js/plugins/infiniteslidev2.js') }}"></script>
    <script src="{{ asset('assets-user/js/vendor/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets-user/js/plugins/jquery.sticky-sidebar.js') }}"></script>

    <!-- Main Js -->
    <script src="{{ asset('assets-user/js/vendor/index.js') }}"></script>
    <script src="{{ asset('assets-user/js/main.js') }}"></script>

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(".delete").on("click", function() {
            return confirm("Do you want to remove this?");
        });
    </script>

    @yield('scripts')
    {{-- js penting banget --}}
    <script src="{{ asset('themes/ezone/assets/js/app.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    @stack('script-alt')
</body>

</html>
