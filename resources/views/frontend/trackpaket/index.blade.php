@extends('frontend.layout')
@section('title', 'Input Pelacakan Paket')
@section('content')
    @include('sweetalert::alert')
    <section class="ec-page-content ec-vendor-uploads ec-user-account section-space-p">
        <div class="container">
            <div class="row">
                <!-- Sidebar Area Start -->
                @include('frontend.partials.user_menu')
                <div class="ec-shop-rightside col-lg-9 col-md-12">
                    <div class="ec-vendor-dashboard-card">
                        <div class="ec-vendor-card-header">
                            <h5>Input Pelacakan Paket</h5>

                        </div>
                        <div class="ec-vendor-card-body">
                            <div class="ec-vendor-card-table">
                                <form action="{{ route('track.paket') }}" method="GET">
                                    @csrf
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
                                    <div class="form-group">
                                        <label for="awb">Nomor Resi:</label>
                                        <input type="text" name="awb" id="awb" class="form-control"
                                            placeholder="Masukkan Nomor Resi" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-3">Lacak Paket</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
