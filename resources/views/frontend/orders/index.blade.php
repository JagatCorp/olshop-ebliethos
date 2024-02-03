@extends('frontend.layout')
@section('title', 'Orders')
@section('content')

    <section class="ec-page-content ec-vendor-uploads ec-user-account section-space-p">
        <div class="container">
            <div class="row">
                <!-- Sidebar Area Start -->
                <div class="ec-shop-leftside ec-vendor-sidebar col-lg-3 col-md-12">
                    <div class="ec-sidebar-wrap ec-border-box">
                        <!-- Sidebar Category Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-vendor-block">
                                <div class="ec-vendor-block-items">
                                    <ul>
                                        <li><a href="{{ url('profile') }}">Profile</a></li>
                                        <li><a href="{{ url('orders') }}">Orders</a></li>
                                        <li><a href="{{ url('wishlists') }}">Wishlist</a></li>
                                        <li><a href="{{ url('carts') }}">Cart</a></li>
                                        <li><a href="{{ url('reviews') }}">Review</a></li>
                                        <li><a href="{{ route('logout') }}" style="color: #c00d0d"><i
                                                    class="fi-rr-exit"></i> Logout</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ec-shop-rightside col-lg-9 col-md-12">
                    <div class="ec-vendor-dashboard-card">
                        <div class="ec-vendor-card-header">
                            <h5>Order History</h5>
                            <div class="ec-header-btn">
                                <a class="btn btn-lg btn-primary" href="{{ url('products') }}">Shop Now</a>
                            </div>
                        </div>
                        <div class="ec-vendor-card-body">
                            <div class="ec-vendor-card-table">
                                <table class="table ec-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Order ID</th>
                                            <th scope="col">Grand Total</th>
                                            {{-- <th scope="col">Nomor Resi</th> --}}
                                            <th scope="col">Status</th>

                                            <th scope="col">Payment</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($orders as $order)
                                            <tr>
                                                <td>{{ $order->code }}<br>
                                                    <span style="font-size: 12px; font-weight: normal; margin-top: -15px">
                                                        {{ date('d M Y', strtotime($order->order_date)) }}</span>
                                                </td>
                                                <td><span>Rp {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                                                </td>
                                                {{-- <td><span>{{ $order->shipment->track_number }}</span></td> --}}
                                                <td>
                                                    <span>{{ $order->status }}</span>
                                                    @if ($order->status === 'cancelled')
                                                        <p class="text-danger">{{ $order->cancellation_note }}</p>
                                                    @endif
                                                </td>


                                                <td><span>{{ $order->payment_status }}</span></td>
                                                <td><span class="tbl-btn"><a class="btn btn-lg btn-primary"
                                                            href="{{ url('orders/' . $order->id) }}">View</a></span></td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">No records found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
