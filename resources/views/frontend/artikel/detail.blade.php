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
                                <p>{{ $artikelSelengkapnya->isi }}</p>

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
