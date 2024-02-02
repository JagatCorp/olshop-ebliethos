@extends('frontend.layout')

@section('content')
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>

    <dotlottie-player src="https://lottie.host/38c67dc5-4369-4eb2-a638-a806add296f9/68LnuwEDTA.json" background="transparent"
        speed="1" style="width: 300px; height: 300px; margin: 0 auto" loop autoplay></dotlottie-player>
    <h1 class="text-center">Terima Kasih!</h1>
    <p class="text-center">Pesanan anda sedang diproses</p>
    <div class="text-center">
        <a href="{{ url('products') }}" class="btn btn-custom-outline">Pesan lagi sekarang</a>
    </div>
@endsection
