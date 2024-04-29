@extends('frontend.layout')

@section('content')
    <!-- all css here -->
    <link rel="stylesheet" href="{{ asset('themes/ezone/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/ezone/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/ezone/assets/css/pe-icon-7-stroke.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/ezone/assets/css/icofont.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/ezone/assets/css/meanmenu.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/ezone/assets/css/easyzoom.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/ezone/assets/css/bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/ezone/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/ezone/assets/css/responsive.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <style>
        .cart-plus-minus {
            display: flex;
            align-items: center;
        }

        .cart-plus-minus-box {
            width: 40px;
            text-align: center;
        }

        .cart-plus-minus i {
            cursor: pointer;
            margin: 0 5px;
        }

        .quickview-btn-cart,
        .quickview-btn-wishlist {
            margin-left: 10px;
        }


        .quickview-btn-cart button {
            background-color: #B42225;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
            border-radius: 5px;
            width: 100%;
        }


        .quickview-btn-wishlist a {
            color: #555;
            font-size: 20px;
            transition: all 0.3s ease;
        }

        .quickview-btn-wishlist a:hover {
            color: #fff;
            background-color: #B42225;
        }
    </style>
    @if (session()->has('message'))
        <div class="content-header mb-0 pb-0 mt-3">
            <div class="container-fluid">
                <div class="mb-0 alert alert-{{ session()->get('alert-type') }} alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('message') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div><!-- /.container-fluid -->
        </div>
    @endif
    <div class="product-details ptb-100 pb-90">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-7 col-12">
                    <div class="product-details-img-content">
                        <div class="product-details-tab mr-70">
                            <div class="product-details-large tab-content">
                                @php
                                    $i = 1;
                                @endphp
                                @forelse ($product->productImages as $image)
                                    <div class="tab-pane fade {{ $i == 1 ? 'active show' : '' }}"
                                        id="pro-details{{ $i }}" role="tabpanel">
                                        <div class="easyzoom easyzoom--overlay">
                                            @if ($image->foto)
                                                <a href="{{ asset('/img/fotoproducts/' . $image->foto) }}">
                                                    <img src="{{ asset('/img/fotoproducts/' . $image->foto) }}"
                                                        alt="{{ $product->name }}">
                                                </a>
                                            @else
                                                <video width="100%" height="100%" controls>
                                                    <source src="{{ asset('/img/videoproducts/' . $image->video) }}"
                                                        type="video/mp4">
                                                </video>
                                            @endif
                                        </div>
                                    </div>
                                    @php
                                        $i++;
                                    @endphp
                                @empty
                                    No image found!
                                @endforelse
                            </div>
                            <div class="product-details-small nav mt-12" role="tablist">

                                @php
                                    $i = 1;
                                    $maxImages = 4;
                                @endphp
                                @forelse ($product->productImages as $image)
                                    {{-- responsive foto --}}
                                    <style>
                                        @media only screen and (max-width: 768px) {
                                            .foto-details {
                                                width: 70px !important;
                                            }
                                        }
                                    </style>

                                    @if ($i <= $maxImages)
                                        <a style="width: 100px;" class="{{ $i == 1 ? 'active' : '' }} mr-12 foto-details"
                                            href="#pro-details{{ $i }}" data-toggle="tab" role="tab"
                                            aria-selected="true">
                                            <div class="easyzoom easyzoom--overlay">
                                                @if ($image->foto)
                                                    <img src="{{ asset('/img/fotoproducts/' . $image->foto) }}"
                                                        class="" alt="{{ $product->name }}">
                                                @endif
                                                @if ($image->video)
                                                    <video width="100%" height="100%" controls>
                                                        <source src="{{ asset('/img/videoproducts/' . $image->video) }}"
                                                            type="video/mp4">
                                                    </video>
                                                @endif
                                            </div>
                                        </a>
                                        @php $i++; @endphp
                                    @else
                                    @break
                                @endif
                            @empty
                                No image found!
                            @endforelse


                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-5 col-12">
                <div class="product-details-content">
                    <h3>{{ $product->name }}</h3>
                    <div class="details-price">

                        <span>IDR {{ number_format($product->priceLabel()) }}</span>
                    </div>
                    <p>{!! $product->description !!}</p>
                    <form action="{{ route('carts.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="qty" value="1">
                        {{-- @if ($product->type == 'configurable')
                                <div class="quick-view-select">
                                    <div class="select-option-part">
                                        <label>Size*</label>
                                        <select name="size" class="select" id="">
                                            @foreach ($sizes as $size)
                                                <option value="{{ $size }}">{{ $size }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="select-option-part">
                                        <label>Color*</label>
                                        <select name="color" class="select" id="">
                                            @foreach ($colors as $color)
                                                <option value="{{ $color }}">{{ $color }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif --}}


                        <div class="quickview-plus-minus align-items-center">
                            {{-- <div class="cart-plus-minus">
                                    <i class="fas fa-minus" onclick="decrementValue()"></i>
                                    <input type="number" name="qty" value="1" class="cart-plus-minus-box"
                                        min="1">
                                    <i class="fas fa-plus" onclick="incrementValue()"></i>
                                </div> --}}
                            <div class="quickview-btn-cart">
                                <button type="submit" class="submit contact-btn btn-hover">add to cart</button>
                            </div>
                            <div class="quickview-btn-wishlist">

                                <a href="{{ auth()->check() ? route('wishlists.store') : route('login') }}"
                                    class="btn-hover add-to-fav" product-slug="{{ $product->slug }}" title="Wishlist"
                                    onclick="event.preventDefault(); window.location.href = this.href;">
                                    <i class="fi-rr-heart"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                    <div class="product-details-cati-tag mt-35">
                        <ul>
                            <li class="categories-title">Categories :</li>
                            @foreach ($product->categories as $category)
                                <li><a
                                        href="{{ url('products/category/' . $category->slug) }}">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    {{-- <div class="product-details-cati-tag mtb-10">
                        <ul>
                            <li class="categories-title">Tags :</li>
                            <li><a href="#">fashion</a></li>
                            <li><a href="#">electronics</a></li>
                            <li><a href="#">toys</a></li>
                            <li><a href="#">food</a></li>
                            <li><a href="#">jewellery</a></li>
                        </ul>
                    </div> --}}

                </div>
            </div>
        </div>
    </div>
</div>
<div class="ec-single-pro-tab" style="margin-top: -50px">
    <div class="container">
        <div class="ec-single-pro-tab-wrapper">
            <div class="ec-single-pro-tab-nav">
                <ul class="nav nav-tabs">
                    <li class="nav-item ">
                        <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-review"
                            role="tablist">Reviews</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content  ec-single-pro-tab-content">



                <div id="ec-spt-nav-review" class="tab-pane fade active ">
                    <div class="row">
                        <div class="ec-t-review-wrapper">

                            @foreach ($reviews as $review)
                                <div class="ec-t-review-item">
                                    <div class="ec-t-review-avtar">
                                        <!-- Gambar Profil Pengguna (opsional) -->
                                        @if ($review->user->foto)
                                            <img src="{{ asset('/img/fotouser/' . $review->user->foto) }}">
                                        @else
                                            <img src="/img/avatar.jpg">
                                        @endif
                                    </div>
                                    <div class="ec-t-review-content">
                                        <div class="ec-t-review-top">
                                            <!-- Nama Pengguna -->
                                            <div class="ec-t-review-name">{{ $review->user->first_name }}
                                                {{ $review->user->last_name }}</div>
                                            <!-- Rating/Ulasan Pengguna -->
                                            <div class="ec-t-review-rating">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $review->rating)
                                                        <i class="ecicon eci-star fill"></i>
                                                    @else
                                                        <i class="ecicon eci-star-o"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                        <!-- Konten Ulasan Pengguna -->
                                        <div class="ec-t-review-bottom">
                                            <p>{{ $review->review }}</p>
                                        </div>

                                        <!-- Gambar Produk -->
                                        <img src="{{ asset('/img/fotoreview/' . $review->foto) }}" width="150px"
                                            height="130px">
                                    </div>
                                </div>
                            @endforeach
                            <div class="text-center mt-3 mb-4">
                                <nav>
                                    <ul class="pagination justify-content-center">
                                        {{ $reviews->links() }}
                                    </ul>
                                </nav>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function incrementValue() {
        var value = parseInt(document.querySelector('.cart-plus-minus-box').value, 10);
        value = isNaN(value) ? 0 : value;
        value++;
        document.querySelector('.cart-plus-minus-box').value = value;
    }

    function decrementValue() {
        var value = parseInt(document.querySelector('.cart-plus-minus-box').value, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            document.querySelector('.cart-plus-minus-box').value = value;
        }
    }
</script>
<script src="{{ asset('themes/ezone/assets/js/vendor/jquery-1.12.0.min.js') }}"></script>
<script src="{{ asset('themes/ezone/assets/js/popper.js') }}"></script>
<script src="{{ asset('themes/ezone/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('themes/ezone/assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('themes/ezone/assets/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('themes/ezone/assets/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('themes/ezone/assets/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('themes/ezone/assets/js/waypoints.min.js') }}"></script>
<script src="{{ asset('themes/ezone/assets/js/ajax-mail.js') }}"></script>
<script src="{{ asset('themes/ezone/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('themes/ezone/assets/js/plugins.js') }}"></script>
<script src="{{ asset('themes/ezone/assets/js/main.js') }}"></script>
<script src="{{ asset('themes/ezone/assets/js/app.js') }}"></script>
@endsection
