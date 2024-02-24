@extends('frontend.layout')

@section('title', 'Artikel Detail')

@section('content')
    <!-- Ec Blog page -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-blogs-rightside col-lg-8 col-md-12">

                    <!-- Blog content Start -->
                    <div class="ec-blogs-content">
                        <div class="ec-blogs-inner">
                            <div class="ec-blog-main-img">
                                <img class="blog-image" src="{{ asset('img/fotoartikel/' . $artikelSelengkapnya->foto) }}"
                                    alt="Blog" />
                            </div>
                            <div class="ec-blog-date">
                                <p class="date">{{ strftime('%e %B %Y', strtotime($artikelSelengkapnya->created_at)) }} -
                                </p><a>{{ $artikelSelengkapnya->dilihat }} Membaca</a>
                            </div>
                            <div class="ec-blog-detail">
                                <h3 class="ec-blog-title">{{ $artikelSelengkapnya->judul }}</h3>
                                <p>{!! $artikelSelengkapnya->isi !!}</p>

                            </div>

                            <div class="ec-blog-comments">
                                <div class="ec-blog-cmt-preview">
                                    <div class="ec-blog-comment-wrapper mt-55">
                                        <h4 class="ec-blog-dec-title">Comments : 05</h4>
                                        <div class="ec-single-comment-wrapper mt-35">
                                            <div class="ec-blog-user-img">
                                                <img src="assets/images/blog-image/9.jpg" alt="blog image">
                                            </div>
                                            <div class="ec-blog-comment-content">
                                                <h5>John Deo</h5>
                                                <span>October 14, 2018 </span>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                                    eiusmod tempor incididunt ut labore et dolor magna aliqua. Ut enim
                                                    ad minim veniam, </p>
                                                <div class="ec-blog-details-btn">
                                                    <a href="javascript:void(0)">Reply</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ec-single-comment-wrapper mt-50 ml-150">
                                            <div class="ec-blog-user-img">
                                                <img src="assets/images/blog-image/10.jpg" alt="blog image">
                                            </div>
                                            <div class="ec-blog-comment-content">
                                                <h5>Jenifer lowes</h5>
                                                <span>October 14, 2018 </span>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                                    eiusmod tempor incididunt ut labore et dolor magna aliqua. Ut enim
                                                    ad minim veniam, </p>
                                                <div class="ec-blog-details-btn">
                                                    <a href="javascript:void(0)">Reply</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ec-blog-cmt-form">
                                    <div class="ec-blog-reply-wrapper mt-50">
                                        <h4 class="ec-blog-dec-title">Leave A Reply</h4>
                                        <form class="ec-blog-form" action="#">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="ec-leave-form">
                                                        <input type="text" placeholder="Full Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="ec-leave-form">
                                                        <input type="email" placeholder="Email Address ">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="ec-text-leave">
                                                        <textarea placeholder="Message"></textarea>
                                                        <a href="#" class="btn btn-lg btn-secondary">Order Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--Blog content End -->
                </div>
                <!-- Sidebar Area Start -->
                <div class="ec-blogs-leftside col-lg-4 col-md-12">
                    <div class="ec-blog-search">
                        <form class="ec-blog-search-form" action="#">
                            <input class="form-control" placeholder="Search Our Blog" type="text">
                            <button class="submit" type="submit"><i class="ecicon eci-search"></i></button>
                        </form>
                    </div>
                    <div class="ec-sidebar-wrap">
                        <!-- Sidebar Recent Blog Block -->
                        <div class="ec-sidebar-block ec-sidebar-recent-blog">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Recent Articles</h3>
                            </div>
                            <div class="ec-sb-block-content">
                                @forelse ($artikelLainnya as $item)
                                    <div class="ec-sidebar-block-item">
                                        <h5 class="ec-blog-title"><a
                                                href="{{ url('/detail-artikel', $item->slug) }}">{{ $item->judul }}</a>
                                        </h5>
                                        <div class="ec-blog-date">{{ strftime('%e %B %Y', strtotime($item->created_at)) }}
                                        </div>
                                    </div>
                                @empty
                                    <p>No data</p>
                                @endforelse
                            </div>
                        </div>
                        <!-- Sidebar Recent Blog Block -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
