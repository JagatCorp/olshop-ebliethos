@extends('admin.layout.dashboard')
@section('title', 'Hasil Pelacakan Paket')
@section('ActiveOrder', 'active')
@section('content')
    <div class="ec-content-wrapper">
        <div class="content">
            <div class="breadcrumb-wrapper breadcrumb-contacts">
                <div>
                    <h1>Hasil Pelacakan</h1>
                    <p class="breadcrumbs"><span><a href="admin/dashboard">Home</a></span>
                        <span><i class="mdi mdi-chevron-right"></i></span>Hasil Pelacakan
                    </p>
                </div>
                <div>
                    <a href="{{ url('admin/track-paket-admin') }}" class="btn btn-primary"> <i class="fa fa-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="ec-vendor-list card card-default">
                        <div class="card-body">
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
    </div>
@endsection
