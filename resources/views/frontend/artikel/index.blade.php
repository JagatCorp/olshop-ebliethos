@extends('frontend.layout')

@section('title', 'Artikel')

@section('content')
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-blogs-rightside col-lg-12 col-md-12">

                    <!-- Blog content Start -->
                    <div class="ec-blogs-content">
                        <div class="ec-blogs-inner">
                            <div class="row">
                                @forelse ($artikel as $item)
                                    <div class="col-lg-4 col-md-6 col-sm-12 mb-6 ec-blog-block">
                                        <div class="ec-blog-inner">
                                            <div class="ec-blog-image">
                                                <a href="{{ url('/detail-artikel', $item->slug) }}">
                                                    <img class="blog-image"
                                                        src="{{ asset('img/fotoartikel/' . $item->foto) }}"
                                                        alt="Blog" />
                                                </a>
                                            </div>
                                            <div class="ec-blog-content">
                                                <h5 class="ec-blog-title"><a
                                                        href="{{ url('/detail-artikel', $item->slug) }}">{{ $item->judul }}</a>
                                                </h5>
                                                <div class="ec-blog-date">By <span>Eblithos</span> /
                                                    {{ strftime('%e %B %Y', strtotime($item->created_at)) }}
                                                </div>
                                                <div class="ec-blog-desc">
                                                    @php
                                                        $wordCount = str_word_count($item->isi);
                                                        $maxWords = 10;
                                                        $truncatedText = $wordCount > $maxWords ? implode(' ', array_slice(explode(' ', $item->isi), 0, $maxWords)) . ' ...' : $item->isi;
                                                        echo $truncatedText;
                                                    @endphp
                                                </div>

                                                <div class="ec-blog-btn"><a href="{{ url('/detail-artikel', $item->slug) }}"
                                                        class="btn btn-primary">Read
                                                        More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-center">No data</p>
                                @endforelse
                            </div>
                        </div>
                        <!-- Ec Pagination Start -->

                        <div class="text-center mt-3 mb-4">
                            <nav>
                                <ul class="pagination justify-content-center">
                                    {{ $artikel->links() }}
                                </ul>
                            </nav>
                        </div>

                        <!-- Ec Pagination End -->
                    </div>
                    <!--Blog content End -->
                </div>
            </div>
        </div>
    </section>
@endsection
