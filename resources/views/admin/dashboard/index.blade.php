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
                            <h2 class="mb-1" style="font-size: 15px">Rp. {{ number_format($totalPenjualan, 0, ',', '.') }}
                            </h2>
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

            {{-- <div class="row">
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
                            <div class="table-responsive">
                                <table class="table card-table table-responsive" style="width:100%">
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
                                                            role="button" id="dropdown-recent-order1"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false" data-display="static"></a>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li class="dropdown-item">
                                                                <a href="/admin/orders/{{ $items->id }}">View</a>
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
            </div> --}}

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
                    <div class="card card-default">
                        <div class="card-header justify-content-center">
                            <h2>Product Overview</h2>
                        </div>
                        <div class="card-body">
                            <div id="PembelianOverview"></div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-12 p-b-15">
                    <!-- Doughnut Chart -->
                    <div class="card card-default">
                        <div class="card-header justify-content-center">
                            <h2>Customers Login</h2>
                        </div>
                        <div class="card-body">
                            <div id="CustomerLogin"></div>
                        </div>
                    </div>
                </div>

                <div class="row mb-5">
                    <div id="user-acquisition" class="card card-default">
                        <div class="card-header">
                            <h2>Report Pengunjung</h2>
                        </div>
                        <div class="card-body">
                            <div class="tab-content pt-4" id="salesReport">
                                <div class="tab-pane fade show active" id="source-medium" role="tabpanel">
                                    <div class="mb-6" style="max-height:247px">
                                        <div id="ReportVisitor" class="chartjs2"></div>
                                        <div id="acqLegend" class="customLegend mb-2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6 p-b-15">
                    <!-- Recent Order Table -->
                    <div class="card card-table-border-none card-default recent-orders" id="recent-orders">
                        <div class="card-header justify-content-between">
                            <h2>Transaksi Produk pada bulan {{ date('M') }}</h2>
                            <div class="date-range-report">
                                <span></span>
                            </div>
                        </div>
                        <div class="card-body pt-0 pb-5">
                            <div class="table-responsive">
                                <table class="table card-table table-responsive" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nama Produk</th>
                                            <th>Gambar</th>
                                            <th>Terjual</th>
                                            <th>Harga</th>
                                            <th>Subtotal</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listProd as $prod)
                                            <tr>
                                                <td>{{ $prod->name }}</td>
                                                <td><img src="{{ asset('img/fotoproducts/' . $prod->productImages->first()->foto) }}"
                                                        alt="Product" width="100px" /></td>
                                                <td>{{ $prodTerjual->where('product_id', $prod->id)->sum('qty') }}</td>
                                                <td>{{ number_format($prod->price, 0, ',', '.') }}</td>
                                                <td>{{ number_format($prodTerjual->where('product_id', $prod->id)->sum('base_total'), 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 p-b-15">
                    <!-- Recent Order Table -->
                    <div class="card card-table-border-none card-default recent-orders" id="recent-orders">
                        <div class="card-header justify-content-between">
                            <h2>Transaksi Pelanggan pada bulan {{ date('M') }}</h2>
                            <div class="date-range-report">
                                <span></span>
                            </div>
                        </div>
                        <div class="card-body pt-0 pb-5">
                            <div class="table-responsive">
                                <table class="table card-table table-responsive" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Foto</th>
                                            <th>No HP</th>
                                            <th>Pembelian Produk</th>
                                            <th>Total Dihabiskan</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataCust as $data)
                                            <tr>
                                                <td>{{ $data->name }}</td>
                                                <td><img src="{{ asset('img/fotouser/' . $data->foto) }}" alt="User"
                                                        width="100px" /></td>
                                                <td>{{ $data->name }}</td>
                                                <td>
                                                    {{ $transCust->where('user_id', $data->id)->sum(function ($order) {
                                                        return $order->orderItems->sum('qty');
                                                    }) }}
                                                </td>
                                                <td>{{ number_format(
                                                    $transCust->where('user_id', $data->id)->sum(function ($order) {
                                                        return $order->grand_total;
                                                    }),
                                                    0,
                                                    ',',
                                                    '.',
                                                ) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6 p-b-15">
                    <!-- Recent Order Table -->
                    <div class="card card-table-border-none card-default recent-orders" id="recent-orders">
                        <div class="card-header justify-content-between">
                            <h2>Status Transaksi pada bulan {{ date('M') }}</h2>
                            <div class="date-range-report">
                                <span></span>
                            </div>
                        </div>
                        <div class="card-body pt-0 pb-5">
                            <div class="table-responsive">
                                <table class="table card-table table-responsive" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Created</th>
                                            <th>Confirmed</th>
                                            <th>Delivered</th>
                                            <th>Completed</th>
                                            <th>Cancelled</th>
                                            <th>Paid</th>
                                            <th>Unpaid</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">{{ $created }}</td>
                                            <td class="text-center">{{ $confirmed }}</td>
                                            <td class="text-center">{{ $delivered }}</td>
                                            <td class="text-center">{{ $completed }}</td>
                                            <td class="text-center">{{ $cancelled }}</td>
                                            <td class="text-center">{{ $paid }}</td>
                                            <td class="text-center">{{ $unpaid }}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 p-b-15">
                    <!-- Recent Order Table -->
                    <div class="card card-table-border-none card-default recent-orders" id="recent-orders">
                        <div class="card-header justify-content-between">
                            <h2>Pemakaian Diskon</h2>
                            <div class="date-range-report">
                                <span></span>
                            </div>
                        </div>
                        <div class="card-body pt-0 pb-5">
                            <div class="table-responsive">
                                <table class="table card-table table-responsive" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Persentase</th>
                                            <th>Digunakan</th>
                                            <th>Batas Penggunaan</th>
                                            <th>Sisa Penggunaan</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($diskon as $dis)
                                            @php
                                                $sisa = $dis->usage_limit - $dis->usage_count;
                                            @endphp
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $dis->coupon_code }}</td>
                                                <td class="text-center">{{ $dis->discount }}</td>
                                                <td class="text-center">{{ $dis->usage_count }}</td>
                                                <td class="text-center">{{ $dis->usage_limit }}</td>
                                                <td class="text-center">{{ $sisa }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
                name: 'Total Penjualan',
                data: {!! json_encode(array_values($salesData->toArray())) !!}
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
                categories: {!! json_encode(array_keys($salesData->toArray())) !!}
            },
            yaxis: {
                title: {
                    text: 'Total Penjualan'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "Rp. " + val
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
            series: {!! json_encode(array_values($statuses)) !!},
            labels: {!! json_encode(array_keys($statuses)) !!},
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


    {{-- chart report visitor --}}
    <script>
        var optionsVisitor = {
            series: [{
                name: 'Total Pengunjung',
                data: {!! json_encode(array_values($visitorData->toArray())) !!}
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '10%',
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
                categories: {!! json_encode(array_keys($visitorData->toArray())) !!}
            },
            yaxis: {
                title: {
                    text: 'Total Pengunjung'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#ReportVisitor"), optionsVisitor);
        chart.render();
    </script>
    {{-- end chart Visitor --}}


    {{-- chart customer login --}}
    <script>
        var activeUsers = {!! json_encode($activeUsers) !!};

        var options = {
            series: [activeUsers],
            labels: ['Customer Login'],
            chart: {
                type: 'donut',
                height: 250
            },
            plotOptions: {
                pie: {
                    donut: {
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: 'Customer Login',
                                formatter: function(w) {
                                    return activeUsers;
                                }
                            }
                        }
                    }
                }
            },
            legend: {
                show: false
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 250
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#CustomerLogin"), options);
        chart.render();
    </script>
    {{-- end chart --}}

    {{-- chart pembelian product --}}
    <script>
        var options = {
            series: {!! json_encode(array_values($pembelians)) !!},
            labels: {!! json_encode(array_keys($pembelians)) !!},
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

        var chart = new ApexCharts(document.querySelector("#PembelianOverview"), options);
        chart.render();
    </script>
    {{-- end pembelian product --}}

@endsection
