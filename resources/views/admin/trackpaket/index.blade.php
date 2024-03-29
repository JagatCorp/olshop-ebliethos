@extends('admin.layout.dashboard')
@section('title', 'Input Pelacakan Paket')
@section('ActiveOrder', 'active')
@section('content')
    <div class="ec-content-wrapper">
        <div class="content">
            <div class="breadcrumb-wrapper breadcrumb-contacts">
                <div>
                    <h1>Track Paket</h1>
                    <p class="breadcrumbs"><span><a href="/admin/dashboard">Home</a></span>
                        <span><i class="mdi mdi-chevron-right"></i></span>Track Paket
                    </p>
                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <div class="ec-vendor-list card card-default">
                        <div class="card-body">
                            <form action="{{ route('admin.track.paket') }}" method="GET">
                                @csrf
                                <div class="row mb-2 align-items-center">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="courier">Kurir:</label>
                                            <select name="courier" id="courier" class="form-control">
                                                <option value="">-- Pilih Kurir --</option>
                                                <option value="jne">JNE</option>
                                                <option value="pos">POS</option>
                                                <option value="jnt">JNT</option>
                                                <option value="jnt_cargo">JNT CARGO</option>
                                                <option value="sicepat">SICEPAT</option>
                                                <option value="tiki">TIKI</option>
                                                <option value="anteraja">ANTERAJA</option>
                                                <option value="wahana">WAHANA</option>
                                                <option value="ninja">NINJA</option>
                                                <option value="lion">LION</option>
                                                <option value="pcp">PCP</option>
                                                <option value="jet">JET</option>
                                                <option value="rex">REX EXPRESS</option>
                                                <option value="first">FIRST LOGICTICS</option>
                                                <option value="ide">ID EXPRESS</option>
                                                <option value="spx">SHOPEE EXPRESS</option>
                                                <option value="kgx">KGX EXPRESS</option>
                                                <option value="sap">SAP EXPRESS</option>
                                                <option value="jxe">JX EXPRESS</option>
                                                <option value="rpx">RPX</option>
                                                <option value="lex">LAZADA EXPRESS</option>
                                                <option value="indah_cargo">INDAH CARGO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="awb">Nomor Resi:</label>
                                            <input type="text" name="awb" id="awb" class="form-control"
                                                placeholder="Masukkan Nomor Resi" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <button type="submit" class="btn btn-primary mt-3">Lacak Paket</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
