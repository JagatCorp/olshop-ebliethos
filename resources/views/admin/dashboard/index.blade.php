@extends('admin.layout.dashboard')
@section('title', 'dashboard')

@section('content')
    <!-- CONTENT WRAPPER -->
    <div class="ec-content-wrapper">
        <div class="content">
            <!-- Top Statistics -->
            <div class="row">
                <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
                    <div class="card card-mini dash-card card-1">
                        <div class="card-body">
                            <h2 class="mb-1">{{ $orderToday }}</h2>
                            <p>Order Harian</p>
                            <span class="mdi mdi-calendar-today"></span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
                    <div class="card card-mini dash-card card-2">
                        <div class="card-body">
                            <h2 class="mb-1">{{ $productTerjual }}</h2>
                            <p>Product Terjual</p>
                            <span class="mdi mdi-cash-multiple"></span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
                    <div class="card card-mini dash-card card-3">
                        <div class="card-body">
                            <h2 class="mb-1">Rp. {{ number_format($totalPenjualan, 0, ',', '.') }}</h2>
                            <p>Total Penjualan</p>
                            <span class="mdi mdi-cart"></span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
                    <div class="card card-mini dash-card card-4">
                        <div class="card-body">
                            <h2 class="mb-1">{{ $customers }} </h2>
                            <p>Pelanggan</p>
                            <span class="mdi mdi-account-group"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 p-b-15">
                    <!-- Recent Order Table -->
                    <div class="card card-table-border-none card-default recent-orders" id="recent-orders">
                        <div class="card-header justify-content-between">
                            <h2>Transaksi Terbaru</h2>
                            <div class="date-range-report">
                                <span></span>
                            </div>
                        </div>
                        <div class="card-body pt-0 pb-5">
                            <table class="table card-table table-responsive table-responsive-large" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Order ID</th>
                                        <th>Nama Pengguna</th>
                                        <th>Produk</th>
                                        <th class="d-none d-lg-table-cell">QTY</th>
                                        <th class="d-none d-lg-table-cell">Total Pembayaran</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach ($newestTransaction as $items)
                                        <td>{{ $items->order_date }}</td>
                                        <td>
                                            <a class="text-dark" href="">{{ $items->code }}</a>
                                        </td>
                                        <td>{{ $items->customer_first_name }}</td>
                                        <td class="d-none d-lg-table-cell">
                                            @foreach ($items->orderItems as $orderItem)
                                                {{ $orderItem->product->name }}<br>
                                            @endforeach
                                        </td>
                                        <td class="d-none d-lg-table-cell">
                                            @foreach ($items->orderItems as $orderItem)
                                                {{ $orderItem->qty }}<br>
                                            @endforeach
                                        </td>
                                        <td class="d-none d-lg-table-cell">                                        Rp. {{ number_format($items->grand_total, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            <span class="badge badge-success">{{ $items->status }}</span>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown show d-inline-block widget-dropdown">
                                                <a class="dropdown-toggle icon-burger-mini" href=""
                                                    role="button" id="dropdown-recent-order1" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false"
                                                    data-display="static"></a>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li class="dropdown-item">
                                                        <a href="#">View</a>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <a href="#">Remove</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-5">
                    <!-- New Customers -->
                    <div class="card ec-cust-card card-table-border-none card-default">
                        <div class="card-header justify-content-between ">
                            <h2>New Customers</h2>
                            <div>
                                <button class="text-black-50 mr-2 font-size-20">
                                    <i class="mdi mdi-cached"></i>
                                </button>
                                <div class="dropdown show d-inline-block widget-dropdown">
                                    <a class="dropdown-toggle icon-burger-mini" href="#" role="button"
                                        id="dropdown-customar" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" data-display="static">
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li class="dropdown-item"><a href="#">Action</a></li>
                                        <li class="dropdown-item"><a href="#">Another action</a></li>
                                        <li class="dropdown-item"><a href="#">Something else here</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0 pb-15px">
                            <table class="table ">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <div class="media-image mr-3 rounded-circle">
                                                    <a href="profile.html"><img class="profile-img rounded-circle w-45"
                                                            src="assets/img/user/u1.jpg" alt="customer image"></a>
                                                </div>
                                                <div class="media-body align-self-center">
                                                    <a href="profile.html">
                                                        <h6 class="mt-0 text-dark font-weight-medium">Selena
                                                            Wagner</h6>
                                                    </a>
                                                    <small>@selena.oi</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>2 Orders</td>
                                        <td class="text-dark d-none d-md-block">$150</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <div class="media-image mr-3 rounded-circle">
                                                    <a href="profile.html"><img class="profile-img rounded-circle w-45"
                                                            src="assets/img/user/u2.jpg" alt="customer image"></a>
                                                </div>
                                                <div class="media-body align-self-center">
                                                    <a href="profile.html">
                                                        <h6 class="mt-0 text-dark font-weight-medium">Walter
                                                            Reuter</h6>
                                                    </a>
                                                    <small>@walter.me</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>5 Orders</td>
                                        <td class="text-dark d-none d-md-block">$200</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <div class="media-image mr-3 rounded-circle">
                                                    <a href="profile.html"><img class="profile-img rounded-circle w-45"
                                                            src="assets/img/user/u3.jpg" alt="customer image"></a>
                                                </div>
                                                <div class="media-body align-self-center">
                                                    <a href="profile.html">
                                                        <h6 class="mt-0 text-dark font-weight-medium">Larissa
                                                            Gebhardt</h6>
                                                    </a>
                                                    <small>@larissa.gb</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>1 Order</td>
                                        <td class="text-dark d-none d-md-block">$50</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <div class="media-image mr-3 rounded-circle">
                                                    <a href="profile.html"><img class="profile-img rounded-circle w-45"
                                                            src="assets/img/user/u4.jpg" alt="customer image"></a>
                                                </div>
                                                <div class="media-body align-self-center">
                                                    <a href="profile.html">
                                                        <h6 class="mt-0 text-dark font-weight-medium">Albrecht
                                                            Straub</h6>
                                                    </a>
                                                    <small>@albrech.as</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>2 Orders</td>
                                        <td class="text-dark d-none d-md-block">$100</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <div class="media-image mr-3 rounded-circle">
                                                    <a href="profile.html"><img class="profile-img rounded-circle w-45"
                                                            src="assets/img/user/u5.jpg" alt="customer image"></a>
                                                </div>
                                                <div class="media-body align-self-center">
                                                    <a href="profile.html">
                                                        <h6 class="mt-0 text-dark font-weight-medium">Leopold
                                                            Ebert</h6>
                                                    </a>
                                                    <small>@leopold.et</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>1 Order</td>
                                        <td class="text-dark d-none d-md-block">$60</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <div class="media-image mr-3 rounded-circle">
                                                    <a href="profile.html"><img class="profile-img rounded-circle w-45"
                                                            src="assets/img/user/u3.jpg" alt="customer image"></a>
                                                </div>
                                                <div class="media-body align-self-center">
                                                    <a href="profile.html">
                                                        <h6 class="mt-0 text-dark font-weight-medium">Larissa
                                                            Gebhardt</h6>
                                                    </a>
                                                    <small>@larissa.gb</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>1 Order</td>
                                        <td class="text-dark d-none d-md-block">$50</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-xl-7">
                    <!-- Top Products -->
                    <div class="card card-default ec-card-top-prod">
                        <div class="card-header justify-content-between">
                            <h2>Top Products</h2>
                            <div>
                                <button class="text-black-50 mr-2 font-size-20"><i class="mdi mdi-cached"></i></button>
                                <div class="dropdown show d-inline-block widget-dropdown">
                                    <a class="dropdown-toggle icon-burger-mini" href="#" role="button"
                                        id="dropdown-product" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" data-display="static">
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li class="dropdown-item"><a href="#">Update Data</a></li>
                                        <li class="dropdown-item"><a href="#">Detailed Log</a></li>
                                        <li class="dropdown-item"><a href="#">Statistics</a></li>
                                        <li class="dropdown-item"><a href="#">Clear Data</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body mt-10px mb-10px py-0">
                            <div class="row media d-flex pt-15px pb-15px">
                                <div class="col-lg-3 col-md-3 col-2 media-image align-self-center rounded">
                                    <a href="#"><img src="assets/img/products/p1.jpg" alt="customer image"></a>
                                </div>
                                <div class="col-lg-9 col-md-9 col-10 media-body align-self-center ec-pos">
                                    <a href="#">
                                        <h6 class="mb-10px text-dark font-weight-medium">Baby cotton shoes</h6>
                                    </a>
                                    <p class="float-md-right sale"><span class="mr-2">58</span>Sales</p>
                                    <p class="d-none d-md-block">Statement belting with double-turnlock hardware
                                        adds “swagger” to a simple.</p>
                                    <p class="mb-0 ec-price">
                                        <span class="text-dark">$520</span>
                                        <del>$580</del>
                                    </p>
                                </div>
                            </div>
                            <div class="row media d-flex pt-15px pb-15px">
                                <div class="col-lg-3 col-md-3 col-2 media-image align-self-center rounded">
                                    <a href="#"><img src="assets/img/products/p2.jpg" alt="customer image"></a>
                                </div>
                                <div class="col-lg-9 col-md-9 col-10 media-body align-self-center ec-pos">
                                    <a href="#">
                                        <h6 class="mb-10px text-dark font-weight-medium">Hoodies for men</h6>
                                    </a>
                                    <p class="float-md-right sale"><span class="mr-2">20</span>Sales</p>
                                    <p class="d-none d-md-block">Statement belting with double-turnlock hardware
                                        adds “swagger” to a simple.</p>
                                    <p class="mb-0 ec-price">
                                        <span class="text-dark">$250</span>
                                        <del>$300</del>
                                    </p>
                                </div>
                            </div>
                            <div class="row media d-flex pt-15px pb-15px">
                                <div class="col-lg-3 col-md-3 col-2 media-image align-self-center rounded">
                                    <a href="#"><img src="assets/img/products/p3.jpg" alt="customer image"></a>
                                </div>
                                <div class="col-lg-9 col-md-9 col-10 media-body align-self-center ec-pos">
                                    <a href="#">
                                        <h6 class="mb-10px text-dark font-weight-medium">Long slive t-shirt</h6>
                                    </a>
                                    <p class="float-md-right sale"><span class="mr-2">10</span>Sales</p>
                                    <p class="d-none d-md-block">Statement belting with double-turnlock hardware
                                        adds “swagger” to a simple.</p>
                                    <p class="mb-0 ec-price">
                                        <span class="text-dark">$480</span>
                                        <del>$654</del>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Content -->
    </div> <!-- End Content Wrapper -->

@endsection
