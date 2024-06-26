@extends('frontend.layout')

@section('content')
    <!-- all css here -->
    <link rel="stylesheet" href="{{ asset('themes/ezone/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/ezone/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/ezone/assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/ezone/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/ezone/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/ezone/assets/css/pe-icon-7-stroke.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/ezone/assets/css/icofont.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/ezone/assets/css/meanmenu.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/ezone/assets/css/easyzoom.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/ezone/assets/css/bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/ezone/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/ezone/assets/css/responsive.css') }}">
    <script src="{{ asset('themes/ezone/assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>

    <!-- checkout-area start -->
        @include('sweetalert::alert')
    <div class="cart-main-area  ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @if (session()->has('message'))
                        <div class="content-header mb-0 pb-0">
                            <div class="container-fluid">
                                <div class="mb-0 alert alert-{{ session()->get('alert-type') }} alert-dismissible fade show"
                                    role="alert">
                                    <strong>{{ session()->get('message') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div><!-- /.container-fluid -->
                        </div>
                    @endif
                    <h1 class="cart-heading">Your Order:</h4>
                        <div class="row">
                            <div class="col-xl-3 col-lg-4">
                                <p class="text-dark mb-2"
                                    style="font-weight: normal; font-size:16px; text-transform: uppercase;">Alamat Tagihan
                                </p>
                                <address>
                                    {{ $order->customer_first_name }} {{ $order->customer_last_name }}
                                    <br> {{ $order->customer_address1 }}
                                    <br> {{ $order->customer_address2 }}
                                    <br> Email: {{ $order->customer_email }}
                                    <br> Phone: {{ $order->customer_phone }}
                                    <br> Kode Pos: {{ $order->customer_postcode }}
                                </address>
                            </div>
                            <div class="col-xl-3 col-lg-4">
                                <p class="text-dark mb-2"
                                    style="font-weight: normal; font-size:16px; text-transform: uppercase;">Alamat
                                    Pengiriman
                                </p>
                                <address>
                                    {{ $order->shipment->first_name }} {{ $order->shipment->last_name }}
                                    <br> {{ $order->shipment->address1 }}
                                    <br> {{ $order->shipment->address2 }}
                                    <br> Email: {{ $order->shipment->email }}
                                    <br> Phone: {{ $order->shipment->phone }}
                                    <br> Kode Pos: {{ $order->shipment->postcode }}
                                </address>
                            </div>
                            <div class="col-xl-3 col-lg-4">
                                <p class="text-dark mb-2"
                                    style="font-weight: normal; font-size:16px; text-transform: uppercase;">Details</p>
                                <address>
                                    Invoice ID:
                                    <span class="text-dark">#{{ $order->code }}</span>
                                    <br> {{ $order->order_date }}
                                    <br> Status: {{ $order->status }}
                                    <br> Payment Status: {{ $order->payment_status }}
                                    <br> Pengiriman by: {{ $order->shipping_service_name }}
                                    <br> Type Pembayaran: {{ $order->cod == 'yes' ? 'COD' : 'Transfer' }}
                                </address>
                            </div>
                        </div>
                        <div class="table-content table-responsive">
                            <table class="table mt-3 table-striped table-responsive table-responsive-large"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Item</th>
                                        {{-- <th>Description</th> --}}
                                        <th>Quantity</th>
                                        <th>Unit Cost</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        function showAttributes($jsonAttributes)
                                        {
                                            $jsonAttr = (string) $jsonAttributes;
                                            $attributes = json_decode($jsonAttr, true);
                                            $showAttributes = '';
                                            if ($attributes) {
                                                $showAttributes .= '<ul class="item-attributes list-unstyled">';
                                                foreach ($attributes as $key => $attribute) {
                                                    if (count($attribute) != 0) {
                                                        foreach ($attribute as $value => $attr) {
                                                            $showAttributes .= '<li>' . $value . ': <span>' . $attr . '</span><li>';
                                                        }
                                                    } else {
                                                        $showAttributes .= '<li><span> - </span></li>';
                                                    }
                                                }
                                                $showAttributes .= '</ul>';
                                            }
                                            return $showAttributes;
                                        }
                                    @endphp
                                    @forelse ($order->orderItems as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            {{-- <td>{!! showAttributes($item->attributes) !!}</td> --}}
                                            <td>{{ $item->qty }}</td>
                                            <td>Rp{{ number_format($item->base_price, 0, ',', '.') }}</td>
                                            <td>Rp{{ number_format($item->sub_total, 0, ',', '.') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">Order item not found!</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-5 ml-auto">
                                <div class="cart-page-total">
                                    @php
                                        $jumlahTotal = $order->shipping_cost + $order->base_total_price;
                                        $jumlahDiskon = ($order->discount_percent / 100) * $jumlahTotal;
                                        $diskon = intval($order->discount_percent);
                                    @endphp
                                     @if ($diskon === 0 && $order->status == 'created')
                                        <div class="ec-checkout-coupan-content hidden ">
                                            <form class="ec-checkout-coupan-form" name="ec-checkout-coupan-form"
                                                method="POST"
                                                action="{{ route('apply.coupon', ['orderId' => $orderId]) }}">
                                                @csrf
                                                <input type="hidden" name="orderId" value="{{ $orderId }}">
                                                <input class="ec-coupan" type="text" placeholder="Masukkan Code Kupon"
                                                    name="coupon_code">
                                                <button class="ec-coupan-btn button btn-danger mt-1"
                                                    type="submit">Cek</button>
                                            </form>
                                        </div>
                                    @endif
                                    <ul class="mt-3">
                                        <li> Subtotal
                                            <span>Rp{{ number_format($order->base_total_price, 0, ',', '.') }}</span>
                                        </li>
                                        {{-- <li>Tax (10%)
                                            <span>Rp{{ number_format($order->tax_amount, 0, ',', '.') }}</span>
                                        </li> --}}
                                        <li>Biaya Ongkir
                                            <span>Rp{{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                                        </li>
                                        @if ($diskon !== 0)
                                            <li>Total Sebelumnya
                                                <span>Rp{{ number_format($jumlahTotal, 0, ',', '.') }}</span>
                                            </li>
                                            <li>Diskon {{ $diskon }}%
                                                <span>- Rp{{ number_format($jumlahDiskon, 0, ',', '.') }}</span>
                                            </li>
                                        @endif
                                        <li>Total
                                            <span>Rp{{ number_format($order->grand_total, 0, ',', '.') }}</span>
                                        </li>
                                    </ul>
                                    {{-- @if (!$order->isPaid())
                                        <a href="{{ $order->payment_url }}">Proceed to payment</a>
                                    @endif --}}

                                    @if($order->status == 'created')
                                        @if ($order->cod === 'yes')
                                            <form action={{ route('order-success', $order->id) }} method="get">
                                                <button type="submit"
                                                    class="btn-dark rounded-pill py-2 px-3 mt-4">Pesan</button>
                                            </form>
                                        @else
                                            <a class="rounded-5 text-white" id="pay-button">Bayar</a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
    </script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            // SnapToken acquired from previous step
            snap.pay('{{ $order->payment_token }}', {
                // Optional
                onSuccess: function(result) {
                    window.location.href = "{{ route('order-success', $order->id) }}";
                },
                // Optional
                onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                }
            });
        };
    </script>
@endsection
