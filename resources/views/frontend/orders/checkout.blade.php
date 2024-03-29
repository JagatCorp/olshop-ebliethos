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
    @include('sweetalert::alert')
    <!-- checkout-area start -->
    <div class="checkout-area ptb-100">
        <div class="container">
            <form action="{{ route('orders.checkout') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="checkbox-form">
                            <h3>Billing Details</h3>
                            <div class="row">
                                <div class="col-6">
                                    <div class="checkout-form-list">
                                        <label>Nama Pertama <span class="required">*</span></label>
                                        <input type="text" name="first_name"
                                            value="{{ old('first_name', auth()->user()->first_name) }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="checkout-form-list">
                                        <label>Nama Akhir <span class="required">*</span></label>
                                        <input type="text" name="last_name"
                                            value="{{ old('last_name', auth()->user()->last_name) }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Alamat Lengkap <span class="required">*</span></label>
                                        <input type="text" name="address1"
                                            value="{{ old('address1', auth()->user()->address1) }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <input type="text" name="address2"
                                            value="{{ old('address2', auth()->user()->address2) }}">
                                    </div>
                                </div>


                                {{-- <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Provinsi<span class="required">*</span></label>
                                        <select name="province_id" id="shipping-province" required>
                                            <option value="">-- Pilih Provinsi --</option>
                                            @foreach ($provinces as $id => $province)
                                                <option {{ auth()->user()->province_id == $id ? 'selected' : null }}
                                                    value="{{ $id }}">{{ $province }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Kota/Kab<span class="required">*</span></label>
                                        <select name="shipping_city_id" id="shipping-city" required>
                                            <option value="">-- Pilih Kota --</option>
                                            @if ($cities)
                                                @foreach ($cities as $id => $city)
                                                    <option value="{{ $id }}">{{ $city }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div> --}}
                                {{-- pake ajax --}}


                                {{-- <div class="col-md-12 ">
                                    <div class="checkout-form-list">
                                        <label>Warehouse<span class="required">*</span></label><br>
                                        <input type="checkbox" name="jakarta" id="jakarta" value="jakarta">
                                        <label for="jakarta">Jakarta</label><br>
                                        <input type="checkbox" name="surabaya" id="surabaya" value="surabaya">
                                        <label for="surabaya">Surabaya</label><br>
                                        <input type="checkbox" name="cilacap" id="cilacap" value="cilacap">
                                        <label for="cilacap">Cilacap</label><br>
                                        <input type="checkbox" name="medan" id="medan" value="medan">
                                        <label for="medan">Medan</label><br>
                                    </div>
                                </div> --}}

                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Warehouse<span class="required">*</span></label>

                                        <select name="warehouse_id" required id="warehouse_id">
                                            <option value="">-- Pilih Gudang Dari --</option>
                                            @foreach ($warehouses as $warehouse)
                                                <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Provinsi<span class="required">*</span></label>
                                        <select id="province" name="province_id" required>
                                            <option value="">-- Pilih Provinsi --</option>
                                            @foreach ($provinces as $province)
                                                <option value="{{ $province->province_id }}">
                                                    {{ $province->province_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Kota/Kab<span class="required">*</span></label>
                                        <select id="city" name="city_id" required>
                                            <option value="">-- Pilih Kota/Kab --</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Kecamatan<span class="required">*</span></label>
                                        <select id="district" name="kecamatan_id" required>
                                            <option value="">-- Pilih Kecamatan --</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Courier<span class="required">*</span></label>
                                        <select name="courier_id" required>
                                            <option value="">-- Pilih Kurir --</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Provinsi<span class="required">*</span></label>
                                        <select name="province_id" id="shipping-province" required>
                                            <option value="">-- Pilih Provinsi --</option>
                                            @foreach ($provinces as $id => $province)
                                                <option {{ auth()->user()->province_id == $id ? 'selected' : null }}
                                                    value="{{ $id }}">{{ $province }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Kota/Kab<span class="required">*</span></label>
                                        <select name="shipping_city_id" id="shipping-city" required>
                                            <option value="">-- Pilih Kota --</option>
                                            @if ($cities)
                                                @foreach ($cities as $id => $city)
                                                    <option value="{{ $id }}">{{ $city }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Courier<span class="required">*</span></label>
                                        <select name="kurir" id="shipping-courier" required>

                                            <option value="">-- Pilih Kurir --</option>

                                            <option value="jne">jne</option>
                                            <option value="jnt">jnt</option>
                                            <option value="pos">pos</option>
                                            <option value="tiki">tiki</option>
                                            <option value="ninja">ninja</option>
                                        </select>
                                    </div>
                                </div> --}}

                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Kode Pos<span class="required">*</span></label>
                                        <input type="text" name="postcode"
                                            value="{{ old('postcode', auth()->user()->postcode) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>No. Handphone<span class="required">*</span></label>
                                        <input type="text" name="phone" placeholder="08xxxxxxx"
                                            value="{{ old('phone', auth()->user()->phone) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Email Address </label>
                                        <input type="text" name="email"
                                            value="{{ old('email', auth()->user()->email) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="different-address">
                                <div class="ship-different-title">
                                    {{-- <h3>
                                        <label>Ship to a different address?</label>
                                        <input id="ship-box" type="checkbox" name="ship_to" />
                                    </h3> --}}
                                </div>
                                <div id="ship-box-info">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Nama Pertama <span class="required">*</span></label>
                                                <input type="text" name="customer_first_name"
                                                    value="{{ old('customer_first_name') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Nama Akhir <span class="required">*</span></label>
                                                <input type="text" name="customer_last_name"
                                                    value="{{ old('customer_last_name') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Alamat Lengkap<span class="required">*</span></label>
                                                <input type="text" name="customer_address1"
                                                    value="{{ old('address1') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <input type="text" name="customer_address2"
                                                    value="{{ old('address2') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Province<span class="required">*</span></label>
                                                <select name="customer_province_id" id="">
                                                    <option value="ntm">Ntb</option>
                                                    <option value="jaksel">Jakarta Selatan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>City<span class="required">*</span></label>
                                                <select name="customer_shipping_city_id" id="customer_shipping_city">
                                                    <option value="mataram">Mataram</option>
                                                    <option value="kuta">Kuta</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Kode Pos <span class="required">*</span></label>
                                                <input type="text" name="customer_postcode"
                                                    value="{{ old('postcode') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Phone<span class="required">*</span></label>
                                                <input type="text" name="customer_phone"
                                                    value="{{ old('customer_phone') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Email </label>
                                                <input type="text" name="customer_email"
                                                    value="{{ old('customer_email') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="order-notes">
                                    <div class="checkout-form-list mrg-nn">
                                        <label>Catatan Pesanan</label>
                                        <input type="text" name="note" value="{{ old('note') }}">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="your-order">
                            <h3>Your order</h3>
                            <div class="your-order-table table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-name">Product</th>
                                            <th class="product-total">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($items as $item)
                                            @php
                                                $product = isset($item->model->parent)
                                                    ? $item->model->parent
                                                    : $item->model;
                                                $image = !empty($product->productImages->first())
                                                    ? asset('storage/' . $product->productImages->first()->path)
                                                    : asset('themes/ezone/assets/img/cart/3.jpg');
                                            @endphp
                                            <tr class="cart_item">
                                                <td class="product-name">
                                                    {{ $item->name }} <strong class="product-quantity"> ×
                                                        {{ $item->qty }}</strong>
                                                </td>
                                                <td class="product-total">
                                                    <span class="amount">Rp{{ $item->price * $item->qty }}</span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2">The cart is empty! </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr class="cart-subtotal">
                                            <th>Subtotal</th>
                                            <td><span class="amount">Rp{{ Cart::subtotal(0, ',', '.') }}</span></td>
                                        </tr>
                                        <!-- <tr class="cart-subtotal">

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      <th>Tax</th>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       <td><span class="amount">jnfjk</span></td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     </tr> -->
                                        {{-- <tr class="cart-subtotal">
                                            <th>Biaya Ongkir</th>
                                            <td><select id="shipping-cost-option" required name="shipping_service">

                                                </select></td>
                                        </tr> --}}

                                        <tr class="cart-subtotal">
                                            <th>Biaya Ongkir</th>
                                            <td>
                                                <select id="shipping-cost-options" required name="shipping_service"
                                                    required></select>
                                            </td>
                                        </tr>

                                        <tr class="cart-subtotal">
                                            <th>Type Pembayaran</th>
                                            <td>
                                                <select id="cod" required name="cod" required>
                                                </select>
                                            </td>
                                        </tr>

                                        <tr class="order-total">
                                            <th>Order Total</th>
                                            <td><strong>Rp<span
                                                        class="total-amount">{{ Cart::subtotal(0, ',', '.') }}</span></strong>
                                            </td>
                                            <input type="text" hidden readonly name="shipping_price" class="shipping_price">
                                        </tr>


                                    </tfoot>
                                </table>

                            </div>
                            <div class="payment-method">
                                <div class="payment-accordion">
                                    <div class="panel-group" id="faq">
                                        {{-- <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h5 class="panel-title"><a data-toggle="collapse" aria-expanded="true"
                                                        data-parent="#faq" href="#payment-1">Direct Bank Transfer.</a>
                                                </h5>
                                            </div>
                                            <div id="payment-1" class="panel-collapse collapse show">
                                                <div class="panel-body">
                                                    <p>Make your payment directly into our bank account. Please use your
                                                        Order ID as the payment reference. Your order won’t be shipped until
                                                        the funds have cleared in our account.</p>
                                                </div>
                                            </div>
                                        </div>
                                       --}}

                                    </div>
                                    <div class="order-button-payment">
                                        <input type="submit" value="Place Order" class="btn btn-primary rounded-5 " />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
    {{-- ajax search shipping cost --}}
    <script>
        $(document).ready(function() {
            function createObjectHandler() {
                let object = {}; // Variabel lokal untuk menyimpan objek

                // Function untuk mengatur (set) nilai properti objek
                function setProperty(key, value) {
                    object[key] = value;
                }

                // Function untuk mendapatkan (get) nilai properti objek
                function getProperty(key) {
                    return object[key];
                }

                // Mengembalikan object yang berisi function setProperty dan getProperty
                return {
                    setProperty: setProperty,
                    getProperty: getProperty
                };
            }
            let codValue = createObjectHandler();

            // Fungsi untuk melakukan validasi dan mengirimkan permintaan Ajax
            function validateAndSendRequest() {
                var warehouse_id = $('select[name="warehouse_id"]').val();
                var province_id = $('select[name="province_id"]').val();
                var city_id = $('select[name="city_id"]').val();
                var kecamatan_id = $('select[name="kecamatan_id"]').val();
                var courier_id = $('select[name="courier_id"]');
                var selectOngkir = $('#shipping-cost-options');
                var selectCod = $('select[name="cod"]');
                updateOrderTotal(0);

                // Periksa apakah semua bidang telah diisi dengan benar
                if (warehouse_id && province_id && city_id && kecamatan_id) {
                    // Jika ya, kirimkan permintaan Ajax
                    $.ajax({
                        url: '/search-shipping-cost',
                        type: 'POST',
                        data: {
                            warehouse_id: warehouse_id,
                            province_id: province_id,
                            city_id: city_id,
                            kecamatan_id: kecamatan_id,
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            // Tampilkan harga jika berhasil ditemukan
                            if (response.price.length != 0) {
                                // Update opsi biaya pengiriman
                                selectOngkir.empty();
                                selectCod.empty();
                                courier_id.html(
                                    '<option value="">-- Pilih Kurir --</option>'
                                );
                                console.log(response.price);

                                var arrayCod = [];
                                response.price.forEach(function(item) {
                                    // var valueOngkir = number_format(item.price, 2, ',', '.');
                                    // console.log(valueOngkir);
                                    courier_id.append('<option value="' +
                                        item.courier.id +
                                        '">' + item.courier.name + ' | ' + item.courier.type + ' | Rp. ' + parseInt(item.price) +
                                        '</option>');
                                    let dataCodHarga = [item.cod, item.price];
                                    // console.log('2', dataCodHarga)
                                    codValue.setProperty(item.courier.id, dataCodHarga);
                                });

                            } else {
                                // Tampilkan pesan jika harga tidak ditemukan
                                courier_id.html(
                                    '<option value="">Tidak ada ongkir yang tersedia</option>'
                                );

                                // Reset total pesanan
                                updateOrderTotal(0);
                            }
                        },
                        error: function(xhr, status, error) {
                            // Tangani kesalahan Ajax
                            console.error(xhr.responseText);
                        }
                    });
                } else {
                    // Jika ada bidang yang belum diisi, kosongkan opsi biaya pengiriman
                    $('#shipping-cost-options').html(
                        '<option value="">Pilih Gudang, Provinsi, Kota, dan Kurir terlebih dahulu</option>');

                    // Reset total pesanan
                    updateOrderTotal(0);
                }
            }


            // Fungsi untuk memperbarui total pesanan
            var biayaOngkirSebelumnya = 0;

            function updateOrderTotal(shippingCost) {
                // Ambil total pesanan sebelumnya
                var subtotal = parseInt($('.total-amount').text().replace(/\D/g, ''));

                if (biayaOngkirSebelumnya !== 0) {
                    subtotal -= biayaOngkirSebelumnya;
                }

                // Hitung total pesanan baru dengan menambahkan biaya pengiriman
                var newTotal = subtotal + parseInt(shippingCost);

                biayaOngkirSebelumnya = parseInt(shippingCost);
                $('.shipping_price').val(biayaOngkirSebelumnya);
                // Tampilkan total pesanan baru
                $('.total-amount').text(newTotal.toLocaleString());
            }

            // Ketika select province, city, courier, atau warehouse diubah, lakukan validasi dan kirimkan permintaan Ajax
            // $('select[name="province_id"], select[name="city_id"], select[name="courier_id"], select[name="warehouse_id"]')
            //     .change(function() {
            //         console.log('coba');
            //         $('select[name="province_id"]').empty();
            //         $('select[name="city_id"]').empty();
            //         $('select[name="courier_id"]').empty();
            //         $('select[name="warehouse_id"]').empty();
            //         validateAndSendRequest();
            //     });

            $('select[name="courier_id"]').on('change', function() {
                var selectOngkir = $('#shipping-cost-options');
                var selectCod = $('select[name="cod"]');
                selectOngkir.empty();
                selectCod.empty();
                var selectCourier = $(this).find('option:selected');
                var valueSelectCourier = codValue.getProperty(selectCourier.val());
                var cloneCourier = selectCourier.clone();
                updateOrderTotal(valueSelectCourier[1]);

                cloneCourier.appendTo(selectOngkir);

                if (valueSelectCourier[0] == 'yes') {
                    selectCod.append(
                        '<option value="yes">COD</option>'
                    );
                    selectCod.append(
                        '<option value="no">Transfer</option>'
                    );
                } else {
                    selectCod.append(
                        '<option value="no">Transfer</option>'
                    );
                }
            })

            // Menambahkan event listener untuk setiap elemen <select>
            $('select[name="province_id"], select[name="city_id"], select[name="warehouse_id"], select[name="kecamatan_id"]')
                .change(function() {
                    // Memeriksa apakah semua input memiliki nilai yang dipilih
                    if ($('select[name="province_id"]').val() !== '' &&
                        $('select[name="city_id"]').val() !== '' &&
                        $('select[name="kecamatan_id"]').val() !== '' &&
                        $('select[name="warehouse_id"]').val() !== '') {
                        // Lakukan sesuatu ketika ketiga input sudah terisi
                        validateAndSendRequest();
                        console.log('Keempat input sudah terisi.');
                        // Contoh: Panggil fungsi lain atau lakukan tindakan tertentu di sini
                    }
                });

        });
    </script>
    {{-- jquery fetch city based on province --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#province').change(function() {
                var provinceId = $(this).val();

                // Clear existing options and add default option
                $('#city').empty().append('<option value="">-- Pilih Kota/Kab --</option>');

                $.ajax({
                    url: '/admin/fetch-cities',
                    method: 'GET',
                    data: {
                        province_id: provinceId
                    },
                    success: function(response) {
                        $.each(response, function(index, city) {
                            $('#city').append('<option value="' + city.city_id + '">' +
                                city.type + ' ' + city.city_name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#city').change(function() {
                var cityId = $(this).val();

                // Clear existing options and add default option
                $('#district').empty().append('<option value="">-- Pilih Kecamatan --</option>');

                $.ajax({
                    url: '/admin/fetch-districts-by-city',
                    method: 'GET',
                    data: {
                        city_id: cityId
                    },
                    success: function(response) {
                        $.each(response, function(index, district) {
                            $('#district').append('<option value="' + district.id +
                                '">' +
                                district.name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
@endsection
