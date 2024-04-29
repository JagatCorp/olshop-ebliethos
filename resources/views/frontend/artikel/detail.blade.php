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
                                <img class="blog-image" src="{{ asset('/img/fotoartikel/' . $artikelSelengkapnya->foto) }}"
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
                                <h4 class="ec-blog-dec-title">Komentar : {{ $comments }}</h4>
                                @forelse ($artikelSelengkapnya->comments as $comment)
                                    <div class="ec-blog-cmt-preview">
                                        <div class="ec-blog-comment-wrapper mt-55">


                                            <div class="ec-single-comment-wrapper mt-35">
                                                <div class="ec-blog-user-img">
                                                    <img src="{{ asset('/img/fotouser/' . $comment->user->foto) }}">
                                                </div>
                                                <div class="ec-blog-comment-content">
                                                    <h5>{{ $comment->user->name }}</h5>
                                                    <span>
                                                        {{ strftime('%e %B %Y | %H:%M', strtotime($comment->created_at)) }}</span>
                                                    <p>{{ $comment->comment }}</p>
                                                    {{-- garis melengkung harusnya --}}
                                                    {{-- <span class="comment-reply-line"></span> --}}

                                                    <div class="ec-blog-details-btn">
                                                        <a class="reply-btn" data-id="{{ $comment->id }}">Balas</a>
                                                    </div>



                                                    <div class="reply-form" id="reply-form-{{ $comment->id }}"
                                                        style="display: none;">
                                                        <form action="{{ route('reply.store') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="comments_id"
                                                                value="{{ $comment->id }}">
                                                            <textarea name="reply" rows="2" cols="40" placeholder="Tulis Balasan"></textarea>
                                                            <button type="submit" class="btn btn-primary">Balas</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            @foreach ($comment->replies as $reply)
                                                <div class=" ec-single-comment-wrapper mt-50 ml-150 ">
                                                    <div class="ec-blog-user-img">
                                                        <img src="{{ asset('/img/fotouser/' . $reply->user->foto) }}">
                                                    </div>
                                                    <div class="ec-blog-comment-content">
                                                        <h5>{{ $reply->user->name }}</h5>
                                                        <span>
                                                            {{ strftime('%e %B %Y | %H:%M', strtotime($reply->created_at)) }}
                                                        </span>
                                                        <p>{{ $reply->reply }}</p>
                                                        {{-- <div class="ec-blog-details-btn">
                                                        <a href="javascript:void(0)" class="reply-btn"
                                                            data-id="{{ $comment->id }}">Reply</a>
                                                    </div> --}}

                                                    </div>
                                                </div>
                                            @endforeach
                                            <style>
                                                .comment-reply-line {
                                                    position: absolute;

                                                    left: 230px;
                                                    /* Sesuaikan dengan posisi komentar */
                                                    width: 1px;
                                                    height: 60px;
                                                    margin-top: -10px;
                                                    background-color: red;
                                                    z-index: 6;
                                                }
                                            </style>

                                        </div>
                                    </div>
                                @empty
                                    <p>belum ada komentar</p>
                                @endforelse
                                {{-- js input form reply --}}
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const replyButtons = document.querySelectorAll('.reply-btn');

                                        replyButtons.forEach(button => {
                                            button.addEventListener('click', function() {
                                                const commentId = this.getAttribute('data-id');
                                                const replyForm = document.getElementById('reply-form-' + commentId);

                                                // Toggle display: none
                                                if (replyForm.style.display === 'none') {
                                                    replyForm.style.display = 'block';
                                                } else {
                                                    replyForm.style.display = 'none';
                                                }
                                            });
                                        });
                                    });
                                </script>
                                <form action="{{ route('comments.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="artikel_id" value="{{ $artikelSelengkapnya->id }}">
                                    <div class="ec-blog-cmt-form">
                                        <div class="ec-blog-reply-wrapper mt-50">
                                            <h4 class="ec-blog-dec-title">Beri Komentar</h4>
                                            <form class="ec-blog-form" action="#">
                                                <div class="row">

                                                    {{-- <div class="col-md-6">
                                                        <div class="ec-leave-form">
                                                            <textarea type="text" placeholder="Message "></textarea>
                                                        </div>
                                                    </div> --}}
                                                    <div class="col-md-12">
                                                        <div class="ec-text-leave">
                                                            <textarea placeholder="Komentar" name="comment"></textarea>
                                                            <button type="submit" class="btn btn-lg btn-primary">Beri
                                                                Komentar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <!--Blog content End -->
                </div>
                <!-- Sidebar Area Start -->
                <div class="ec-blogs-leftside col-lg-4 col-md-12">
                    {{-- <div class="ec-blog-search">
                        <form class="ec-blog-search-form" action="#">
                            <input class="form-control" placeholder="Search Our Blog" type="text">
                            <button class="submit" type="submit"><i class="ecicon eci-search"></i></button>
                        </form>
                    </div> --}}
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
