@extends('frontend.layout')
@section('title')
    About
@endsection
@section('content')
    <section class="sticky-header-next-sec section ec-product-tab section-space-p" id="collection">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="ec-bg-title">Tentang Kami</h2>
                        <h2 class="ec-title">Tentang Kami</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9 mx-auto">
                    <div class="container">
                        <p class="text-center">{!! $about->isi  ?? 'No Data' !!}</p>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
