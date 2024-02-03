<div class="ec-left-sidebar ec-bg-sidebar">
    <div id="sidebar" class="sidebar ec-sidebar-footer">

        <div class="ec-brand">
            <img class="ec-brand-icon" src="/images/logoebli.png" alt=""
                style="width: 300px; height: 100px; margin-left: -60px" />
            {{-- <a href="index.html" title="Ekka">

                <span class="ec-brand-name text-truncate">Ekka</span>
            </a> --}}
        </div>

        <!-- begin sidebar scrollbar -->
        <div class="ec-navigation " data-simplebar>
            <!-- sidebar menu -->
            <ul class="nav sidebar-inner" id="sidebar-menu">
                <!-- Dashboard -->
                <li class="active">
                    <a class="sidenav-item-link" href="{{ url('app-admin/dashboard') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                    <hr>
                </li>

                <!-- Vendors -->
                <li class="has-sub">
                    <a class="sidenav-item-link" href="javascript:void(0)">
                        <i class="mdi mdi-atom"></i>
                        <span class="nav-text">Master Data</span> <b class="caret"></b>
                    </a>
                    <div class="collapse">
                        <ul class="sub-menu" id="vendors" data-parent="#sidebar-menu">
                            <li class="">
                                <a class="sidenav-item-link @yield('ActiveArtikel')" href="{{ url('admin/artikel') }}">
                                    <span class="nav-text">Artikel</span>
                                </a>
                            </li>
                            <li class="">
                                <a class="sidenav-item-link" href="{{ url('admin/about') }}">
                                    <span class="nav-text">About</span>
                                </a>
                            </li>

                            <li class="">
                                <a class="sidenav-item-link" href="{{ url('admin/konsultasi') }}">
                                    <span class="nav-text">Konsultasi</span>
                                </a>
                            </li>

                            {{-- <li class="">
                                <a class="sidenav-item-link" href="{{ url('admin/iklan') }}">
                                    <span class="nav-text">Iklan</span>
                                </a>
                            </li> --}}
                            <li class="">
                                <a class="sidenav-item-link" href="{{ url('admin/slider') }}">
                                    <span class="nav-text">Slider</span>
                                </a>
                            </li>
                            <li class="">
                                <a class="sidenav-item-link" href="{{ url('admin/banner') }}">
                                    <span class="nav-text">Banner</span>
                                </a>
                            </li>
                            <li class="">
                                <a class="sidenav-item-link" href="{{ url('admin/testimoni') }}">
                                    <span class="nav-text">Testimoni</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="has-sub">
                    <a class="sidenav-item-link" href="javascript:void(0)">
                        <i class="mdi mdi-account-group-outline"></i>
                        <span class="nav-text">Customer</span> <b class="caret"></b>
                    </a>
                    <div class="collapse">
                        <ul class="sub-menu" id="vendors" data-parent="#sidebar-menu">
                            <li class="">
                                <a class="sidenav-item-link" href="{{ url('admin/customer') }}">
                                    <span class="nav-text">Data Customer</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Users -->
                <li class="has-sub">
                    <a class="sidenav-item-link" href="javascript:void(0)">
                        <i class="mdi mdi-account-group"></i>
                        <span class="nav-text">Users</span> <b class="caret"></b>
                    </a>
                    <div class="collapse">
                        <ul class="sub-menu" id="users" data-parent="#sidebar-menu">


                            <li class="">
                                <a class="sidenav-item-link" href="{{ url('admin/users') }}">
                                    <span class="nav-text">User List</span>
                                </a>
                            </li>
                            {{-- <li class="">
                                <a class="sidenav-item-link" href="user-profile.html">
                                    <span class="nav-text">Users Profile</span>
                                </a>
                            </li> --}}
                        </ul>
                    </div>
                    <hr>
                </li>



                <!-- Products -->
                <li class="has-sub">
                    <a class="sidenav-item-link" href="javascript:void(0)">
                        <i class="mdi mdi-package-variant"></i>
                        <span class="nav-text">Products</span> <b class="caret"></b>
                    </a>
                    <div class="collapse">
                        <ul class="sub-menu" id="products" data-parent="#sidebar-menu">
                            <li class="">
                                <a class="sidenav-item-link" href="{{ url('admin/categories') }}">
                                    <span class="nav-text">Kategori Product</span>
                                </a>
                            </li>
                            <li class="">
                                <a class="sidenav-item-link" href="{{ url('admin/products') }}">
                                    <span class="nav-text">List Product</span>
                                </a>
                            </li>
                            {{-- <li class="">
                                <a class="sidenav-item-link" href="{{ url('admin/reports/inventory') }}">
                                    <span class="nav-text">Stok Product</span>
                                </a>
                            </li> --}}
                        </ul>
                    </div>
                </li>

                <!-- Orders -->
                <li class="has-sub">
                    <a class="sidenav-item-link" href="javascript:void(0)">
                        <i class="mdi mdi-cart"></i>
                        <span class="nav-text">Orders</span> <b class="caret"></b>
                    </a>
                    <div class="collapse">
                        <ul class="sub-menu" id="orders" data-parent="#sidebar-menu">
                            <li class="">
                                <a class="sidenav-item-link" href="{{ url('admin/orders') }}">
                                    <span class="nav-text">Order History</span>
                                </a>
                            </li>
                            <li class="">
                                <a class="sidenav-item-link" href="{{ url('admin/shipments') }}">
                                    <span class="nav-text">Pengiriman</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Reviews -->
                <li>
                    <a class="sidenav-item-link" href="{{ url('admin/review') }}">
                        <i class="mdi mdi-star-half"></i>
                        <span class="nav-text">Reviews</span>
                    </a>
                </li>
                <li class="has-sub">
                    <a class="sidenav-item-link" href="javascript:void(0)">
                        <i class="mdi mdi-file"></i>
                        <span class="nav-text">Laporan</span> <b class="caret"></b>
                    </a>
                    <div class="collapse">
                        <ul class="sub-menu mb-5" id="report" data-parent="#sidebar-menu">
                            <li class="">
                                <a class="sidenav-item-link" href="{{ url('admin/reports/revenue') }}">
                                    <span class="nav-text">Keuntungan</span>
                                </a>
                            </li>
                            <li class="">
                                <a class="sidenav-item-link" href="{{ url('admin/reports/product') }}">
                                    <span class="nav-text">Produk</span>
                                </a>
                            </li>
                            <li class="">
                                <a class="sidenav-item-link" href="{{ url('admin/reports/inventory') }}">
                                    <span class="nav-text">Stok Produk</span>
                                </a>
                            </li>
                            <li class="">
                                <a class="sidenav-item-link" href="{{ url('admin/reports/payment') }}">
                                    <span class="nav-text">Pembayaran</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Authentication -->
                {{-- <li class="has-sub">
                    <a class="sidenav-item-link" href="javascript:void(0)">
                        <i class="mdi mdi-login"></i>
                        <span class="nav-text">Authentication</span> <b class="caret"></b>
                    </a>
                    <div class="collapse">
                        <ul class="sub-menu" id="authentication" data-parent="#sidebar-menu">
                            <li class="">
                                <a href="{{ route('logout') }}">
                                    <span class="nav-text" style="color: rgb(195, 24, 24)">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}
            </ul>
        </div>
    </div>
</div>
