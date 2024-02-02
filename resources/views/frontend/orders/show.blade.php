@extends('frontend.layout')

@section('content')
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

    <div class="shop-page-wrapper shop-page-padding ptb-100">
        <div class="container-fluid">
            <div class="row">
                <div class="ec-shop-leftside ec-vendor-sidebar col-lg-3 col-md-12">
                    <div class="ec-sidebar-wrap ec-border-box">
                        <!-- Sidebar Category Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-vendor-block">
                                <div class="ec-vendor-block-items">
                                    <ul>
                                        <li><a href="{{ url('profile') }}">Profile</a></li>
                                        <li><a href="{{ url('orders') }}">Orders</a></li>
                                        {{-- <li><a href="{{ url('wishlist') }}">Wishlist</a></li> --}}
                                        <li><a href="{{ url('carts') }}">Cart</a></li>
                                        <li><a href="{{ route('logout') }}" style="color: #c00d0d"><i
                                                    class="fi-rr-exit"></i> Logout</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="d-flex justify-content-between">
                        <h2 class="text-dark font-weight-medium">Order ID #{{ $order->code }}</h2>
                    </div>
                    <div class="row pt-5">
                        <div class="col-xl-4 col-lg-4">
                            <p class="text-dark mb-2"
                                style="font-weight: normal; font-size:16px; text-transform: uppercase;">Billing Address</p>
                            <address>
                                {{ $order->customer_first_name }} {{ $order->customer_last_name }}
                                <br> {{ $order->customer_address1 }}
                                <br> {{ $order->customer_address2 }}
                                <br> Email: {{ $order->customer_email }}
                                <br> Phone: {{ $order->customer_phone }}
                                <br> Postcode: {{ $order->customer_postcode }}
                            </address>
                        </div>
                        @if ($order->shipment)
                            <div class="col-xl-4 col-lg-4">
                                <p class="text-dark mb-2"
                                    style="font-weight: normal; font-size:16px; text-transform: uppercase;">Shipment Address
                                </p>
                                <address>
                                    {{ $order->shipment->first_name }} {{ $order->shipment->last_name }}
                                    <br> {{ $order->shipment->address1 }}
                                    <br> {{ $order->shipment->address2 }}
                                    <br> Email: {{ $order->shipment->email }}
                                    <br> Phone: {{ $order->shipment->phone }}
                                    <br> Postcode: {{ $order->shipment->postcode }}
                                </address>
                            </div>
                        @endif
                        <div class="col-xl-4 col-lg-4">
                            <p class="text-dark mb-2"
                                style="font-weight: normal; font-size:16px; text-transform: uppercase;">Details</p>
                            <address>
                                ID: <span class="text-dark">#{{ $order->code }}</span>
                                <br> {{ date('d M Y', strtotime($order->order_date)) }}
                                <br> Status: {{ $order->status }}
                                {{ $order->isCancelled() ? '(' . date('d M Y', strtotime($order->cancelled_at)) . ')' : null }}
                                @if ($order->isCancelled())
                                    <br> Cancellation Note : {{ $order->cancellation_note }}
                                @endif
                                <br> Payment Status: {{ $order->payment_status }}
                                <br> Shipped by: {{ $order->shipping_service_name }}
                            </address>
                        </div>
                    </div>
                    <div class="table-content table-responsive">
                        <table class="table table-bordered table-striped">
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
                                            $showAttributes .= '<ul class="item-attributes">';
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
                                        <td>{{ $item->sku }}</td>
                                        <td>{{ $item->name }}</td>
                                        {{-- <td>{!! showAttributes($item->attributes) !!}</td> --}}
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ number_format($item->base_price, 0, ',', '.') }}</td>
                                        <td>{{ number_format($item->sub_total, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">Order item not found!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
