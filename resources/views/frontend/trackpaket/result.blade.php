@extends('frontend.layout')
@section('title', 'Hasil Pelacakan Paket')
@section('content')

    <section class="ec-page-content ec-vendor-uploads ec-user-account section-space-p">
        <div class="container">
            <div class="row">
                <!-- Sidebar Area Start -->
                @include('frontend.partials.user_menu')
                <div class="ec-shop-rightside col-lg-9 col-md-12">
                    <div class="ec-vendor-dashboard-card">
                        <div class="ec-vendor-card-header">
                            <h5>Hasil Pelacakan Paket</h5>
                            <div class="ec-header-btn">
                                <a class="btn btn-lg btn-primary" href="{{ url('/track-paket') }}">Back</a>
                            </div>
                        </div>
                        <div class="ec-vendor-card-body">
                            <div class="ec-vendor-card-table">
                                <div class="mt-4">
                                    {{-- Tampilkan ringkasan pelacakan --}}
                                    <h5>Ringkasan Pelacakan Paket:</h5>
                                    <p>Nomor AWB: {{ $result['data']['summary']['awb'] }}</p>
                                    <p>Kurir: {{ $result['data']['summary']['courier'] }}</p>
                                    <p>Layanan: {{ $result['data']['summary']['service'] }}</p>
                                    <p>Status: {{ $result['data']['summary']['status'] }}</p>
                                    <p>Tanggal: {{ $result['data']['summary']['date'] }}</p>
                                </div>
                                <div class="mt-4">
                                    {{-- Tampilkan detail pelacakan --}}
                                    <h5>Detail Pelacakan Paket:</h5>
                                    <p>Asal: {{ $result['data']['detail']['origin'] }}</p>
                                    <p>Tujuan: {{ $result['data']['detail']['destination'] }}</p>
                                    <p>Pengirim: {{ $result['data']['detail']['shipper'] }}</p>
                                </div>
                                <div class="mt-4">
                                    {{-- Tampilkan riwayat pelacakan --}}
                                    <h5>Riwayat Pelacakan Paket:</h5>
                                    <ul>
                                        @foreach ($result['data']['history'] as $history)
                                            <li>
                                                <strong>Tanggal:</strong> {{ $history['date'] }} -
                                                <strong>Deskripsi:</strong> {{ $history['desc'] }} -
                                                <strong>Lokasi:</strong>{{ $history['location'] }}
                                            </li>
                                            <li>

                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
