@extends('frontend.layout')
@section('title', 'Hasil Pelacakan Paket')
@section('content')

    <section class="ec-page-content ec-vendor-uploads ec-user-account section-space-p">
        <div class="container">
            <div class="row">
                <!-- Sidebar Area Start -->
                @include('frontend.partials.user_menu')
                {{-- <div class="ec-shop-rightside col-lg-9 col-md-12">
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

                                    <h5>Ringkasan Pelacakan Paket:</h5>
                                    <p>Nomor AWB: {{ $result['data']['summary']['awb'] }}</p>
                                    <p>Kurir: {{ $result['data']['summary']['courier'] }}</p>
                                    <p>Layanan: {{ $result['data']['summary']['service'] }}</p>
                                    <p>Status: {{ $result['data']['summary']['status'] }}</p>
                                    <p>Tanggal: {{ $result['data']['summary']['date'] }}</p>
                                </div>
                                <div class="mt-4">

                                    <h5>Detail Pelacakan Paket:</h5>
                                    <p>Asal: {{ $result['data']['detail']['origin'] }}</p>
                                    <p>Tujuan: {{ $result['data']['detail']['destination'] }}</p>
                                    <p>Pengirim: {{ $result['data']['detail']['shipper'] }}</p>
                                </div>
                                <div class="mt-4">

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
                </div> --}}

                <div class="ec-shop-rightside col-lg-9 col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Hasil Track Paket</h6>
                                    <div id="content">
                                        <ul class="timeline">
                                            <li class="event" data-date="">
                                                <h3>Ringkasan Pelacakan Paket:</h3>
                                                <p>Nomor Resi: {{ $result['data']['summary']['awb'] }}</p>
                                                <p>Kurir: {{ $result['data']['summary']['courier'] }}</p>
                                                <p>Layanan: {{ $result['data']['summary']['service'] }}</p>
                                                <p>Status: {{ $result['data']['summary']['status'] }}</p>
                                                <p>Tanggal: {{ $result['data']['summary']['date'] }}</p>
                                            </li>
                                            <li class="event" data-date="">
                                                <h3>Detail Pelacakan Paket:</h3>
                                                <p>Asal: {{ $result['data']['detail']['origin'] }}</p>
                                                <p>Tujuan: {{ $result['data']['detail']['destination'] }}</p>
                                                <p>Pengirim: {{ $result['data']['detail']['shipper'] }}</p>
                                            </li>
                                            @foreach ($result['data']['history'] as $history)
                                                <li class="event" data-date="">
                                                    {{-- <h3>Riwayat Pelacakan Paket:</h3> --}}
                                                    <p>Tanggal: {{ $history['date'] }}</p>
                                                    <p>Deskripsi: {{ $history['desc'] }}</p>
                                                    <p>Lokasi: {{ $history['location'] }}</p>
                                                </li>
                                            @endforeach
                                            {{-- <li class="event" data-date="5:00 - 8:00pm">
                                                <h3>Riwayat Pelacakan Paket:</h3>
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
                                            </li> --}}

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <style>
                    .timeline {
                        border-left: 3px solid #B42225;
                        border-bottom-right-radius: 4px;
                        border-top-right-radius: 4px;
                        background: rgba(114, 124, 245, 0.09);
                        margin: 0 auto;
                        letter-spacing: 0.2px;
                        position: relative;
                        line-height: 1.4em;
                        font-size: 1.03em;
                        padding: 50px;
                        list-style: none;
                        text-align: left;
                        max-width: 90%;
                    }

                    @media (max-width: 767px) {
                        .timeline {
                            max-width: 98%;
                            padding: 25px;
                        }
                    }

                    .timeline h1 {
                        font-weight: 300;
                        font-size: 1.4em;
                    }

                    .timeline h2,
                    .timeline h3 {
                        font-weight: 600;
                        font-size: 1rem;
                        margin-bottom: 10px;
                    }

                    .timeline .event {
                        border-bottom: 1px dashed #e8ebf1;
                        padding-bottom: 25px;
                        margin-bottom: 25px;
                        position: relative;
                    }

                    @media (max-width: 767px) {
                        .timeline .event {
                            padding-top: 30px;
                        }
                    }

                    .timeline .event:last-of-type {
                        padding-bottom: 0;
                        margin-bottom: 0;
                        border: none;
                    }

                    .timeline .event:before,
                    .timeline .event:after {
                        position: absolute;
                        display: block;
                        top: 0;
                    }

                    .timeline .event:before {
                        left: -207px;
                        content: attr(data-date);
                        text-align: right;
                        font-weight: 100;
                        font-size: 0.9em;
                        min-width: 120px;
                    }

                    @media (max-width: 767px) {
                        .timeline .event:before {
                            left: 0px;
                            text-align: left;
                        }
                    }

                    .timeline .event:after {
                        -webkit-box-shadow: 0 0 0 3px #B42225;
                        box-shadow: 0 0 0 3px #B42225;
                        left: -55.8px;
                        background: #fff;
                        border-radius: 50%;
                        height: 9px;
                        width: 9px;
                        content: "";
                        top: 5px;
                    }

                    @media (max-width: 767px) {
                        .timeline .event:after {
                            left: -31.8px;
                        }
                    }

                    .rtl .timeline {
                        border-left: 0;
                        text-align: right;
                        border-bottom-right-radius: 0;
                        border-top-right-radius: 0;
                        border-bottom-left-radius: 4px;
                        border-top-left-radius: 4px;
                        border-right: 3px solid #B42225;
                    }

                    .rtl .timeline .event::before {
                        left: 0;
                        right: -170px;
                    }

                    .rtl .timeline .event::after {
                        left: 0;
                        right: -55.8px;
                    }
                </style>
            </div>
        </div>
    </section>

@endsection
