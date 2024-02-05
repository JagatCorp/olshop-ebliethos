@extends('admin.layout.dashboard')
@section('title', 'dashboard')
@section('ActiveDashboard', 'active')
@section('content')
    {{-- cdn apex chart --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
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
                                    @foreach ($newestTransaction->take(5) as $items)
                                        <tr>
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
                                            <td class="d-none d-lg-table-cell"> Rp.
                                                {{ number_format($items->grand_total, 0, ',', '.') }}
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
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-8 col-md-12 p-b-15">
                    <!-- Sales Graph -->
                    <div id="user-acquisition" class="card card-default">
                        <div class="card-header">
                            <h2>Report Penjualan</h2>
                        </div>
                        <div class="card-body">
                            <div class="tab-content pt-4" id="salesReport">
                                <div class="tab-pane fade show active" id="source-medium" role="tabpanel">
                                    <div class="mb-6" style="max-height:247px">
                                        <div id="ReportPenjualan" class="chartjs2"></div>
                                        <div id="acqLegend" class="customLegend mb-2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-12 p-b-15">
                    <!-- Doughnut Chart -->
                    <div class="card card-default">
                        <div class="card-header justify-content-center">
                            <h2>Orders Overview</h2>
                        </div>
                        <div class="card-body">
                            <div id="OrdersOverview"></div>
                        </div>


                    </div>
                </div>
            </div>
        </div> <!-- End Content -->
    </div> <!-- End Content Wrapper -->
    {{-- chart report penjualan --}}
    <script>
        var options = {
            series: [{
                name: 'Net Profit',
                data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
            }, {
                name: 'Revenue',
                data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
            }, {
                name: 'Free Cash Flow',
                data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            },
            yaxis: {
                title: {
                    text: '$ (thousands)'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "$ " + val + " thousands"
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#ReportPenjualan"), options);
        chart.render();
    </script>
    {{-- end chart Penjualan --}}

    {{-- chart order overview --}}
    <script>
        var options = {
            series: [44, 55, 41, 17, 15],
            chart: {
                type: 'donut',
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#OrdersOverview"), options);
        chart.render();
    </script>
    {{-- end chart --}}
@endsection
