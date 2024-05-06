<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\ProductInventory;
use App\Models\Shipment;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use App\Models\City;
use App\Models\Warehouse;
use App\Models\Province;
use App\Models\Tripiel;
use App\Models\Kurir;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::forUser(auth()->user())
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('frontend.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::forUser(auth()->user())->findOrFail($id);

        return view('frontend.orders.show', compact('order'));
    }

    private function _getTotalWeight()
    {
        if (Cart::count() <= 0) {
            return 0;
        }

        $totalWeight = 0;

        $items = Cart::content();

        foreach ($items as $item) {
            $totalWeight += ($item->qty * $item->model->weight);
        }

        return $totalWeight;
    }

    public function cities(Request $request)
    {
        $cities = $this->getCities($request->query('province_id'));
        return response()->json(['cities' => $cities]);
    }

    public function shippingCost(Request $request)
    {
        $destination = $request->input('city_id');

        return $this->_getShippingCost($destination, $this->_getTotalWeight());
    }

    private function _getShippingCost($destination, $weight)
    {
        $params = [
            'origin' => $this->rajaOngkirOrigin,
            'destination' => $destination,
            'weight' => $weight,
        ];

        $results = [];
        foreach ($this->couriers as $code => $courier) {
            $params['courier'] = $code;

            $response = $this->rajaOngkirRequest('cost', $params, 'POST');

            if (!empty($response['rajaongkir']['results'])) {
                foreach ($response['rajaongkir']['results'] as $cost) {
                    if (!empty($cost['costs'])) {
                        foreach ($cost['costs'] as $costDetail) {
                            $serviceName = strtoupper($cost['code']) . ' - ' . $costDetail['service'];
                            $costAmount = $costDetail['cost'][0]['value'];
                            $etd = $costDetail['cost'][0]['etd'];

                            $result = [
                                'service' => $serviceName,
                                'cost' => $costAmount,
                                'etd' => $etd,
                                'courier' => $code,
                            ];

                            $results[] = $result;
                        }
                    }
                }
            }
        }

        $response = [
            'origin' => $params['origin'],
            'destination' => $destination,
            'weight' => $weight,
            'results' => $results,
        ];

        return $response;
    }

    public function setShipping(Request $request)
    {
        $shippingService = $request->get('shipping_service');
        $destination = $request->get('city_id');

        $shippingOptions = $this->_getShippingCost($destination, $this->_getTotalWeight());

        $selectedShipping = null;
        if ($shippingOptions['results']) {
            foreach ($shippingOptions['results'] as $shippingOption) {
                if (str_replace(' ', '', $shippingOption['service']) == $shippingService) {
                    $selectedShipping = $shippingOption;
                    break;
                }
            }
        }

        $status = null;
        $message = null;
        $data = [];
        if ($selectedShipping) {
            $status = 200;
            $message = 'Success set shipping cost';
            $data['total'] = (int) Cart::subtotal(0, '', '') + $selectedShipping['cost'];
        } else {
            $status = 400;
            $message = 'Failed to set shipping cost';
        }

        $response = [
            'status' => $status,
            'message' => $message,
        ];

        if ($data) {
            $response['data'] = $data;
        }

        return $response;
    }

    public function checkout()
    {
        if (Cart::count() == 0) {
            return redirect('carts');
        }

        $items = Cart::content();

        $warehouses = Warehouse::get();
        $provinces = Province::get();
        $citys = City::get();

        // $totalWeight = $this->_getTotalWeight() / 1000;
        // $provinces = $this->getProvinces();
        // $cities = isset(auth()->user()->province_id) ? $this->getCities(auth()->user()->province_id) : [];
        // return view('frontend.orders.checkout', compact('items', 'totalWeight', 'provinces', 'cities'));

        return view('frontend.orders.checkout', compact('items', 'warehouses', 'provinces', 'citys'));
    }

    public function searchShippingCost(Request $request)
    {

        $request->validate([
            'warehouse_id' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'kecamatan_id' => 'required',
        ]);

        $warehouse_id = $request->input('warehouse_id');
        $kecamatan_id = $request->input('kecamatan_id');
        $province_id = $request->input('province_id');
        $city_id = $request->input('city_id');

        // Mencari harga gudang hanya jika semua input valid
        $price = null;

        $price = Tripiel::where('province_id', $province_id)
            ->where('city_id', $city_id)
            ->where('warehouse_id', $warehouse_id)
            ->where('kecamatan_id', $kecamatan_id)
            ->with('courier')
            ->orderBy('price', 'asc')
            ->get();

        // Jika harga ditemukan, kirimkan harga sebagai respons
        if ($price !== null) {
            return response()->json(['price' => $price]);
        } else {
            // Jika harga tidak ditemukan atau input tidak valid, kirimkan null sebagai respons
            return response()->json(['price' => null]);
        }
    }

    public function doCheckout(Request $request)
    {
        // $request->validate([

        //     'customer_address1' => 'required',
        //     'customer_phone' => 'required',
        //     'customer_email' => 'required',
        //     'customer_postcode' => 'required',
        //     'customer_city_id' => 'required',
        //     'customer_province_id' => 'required',

        // ]);

        $dataCourier = Kurir::where('id', $request->courier_id)->first();
        $params = $request->except('_token');
        $params['service'] = $dataCourier->name . ($dataCourier->type == null ? '' : ' | ' . $dataCourier->type);
        $params['shipping_courier'] = $dataCourier->name;
        // return response()->json($params);

        $order = DB::transaction(
            function () use ($params) {
                $order = $this->_saveOrder($params);
                $this->_saveOrderItems($order);
                $this->_generatePaymentToken($order);
                $this->_saveShipment($order, $params);

                return $order;
            }
        );

        if ($order) {
            Cart::destroy();
            // $this->_sendEmailOrderReceived($order);

            // Session::flash('success', 'Thank you. Your order has been received!');
            return redirect('orders/received/' . $order->id);
        }

        return redirect()->back();
    }

    private function _getSelectedShipping($destination, $totalWeight, $shippingService)
    {
        $shippingOptions = $this->_getShippingCost($destination, $totalWeight);

        $selectedShipping = null;
        if ($shippingOptions['results']) {
            foreach ($shippingOptions['results'] as $shippingOption) {
                if (str_replace(' ', '', $shippingOption['service']) == $shippingService) {
                    $selectedShipping = $shippingOption;
                    break;
                }
            }
        }

        return $selectedShipping;
    }

    private function _saveOrder($params)
    {
        $destination = !isset($params['ship_to']) ? $params['city_id'] : $params['customer_shipping_city_id'];
        $selectedShipping = $this->_getSelectedShipping($destination, $this->_getTotalWeight(), $params['shipping_service']);

        $baseTotalPrice = (int) Cart::subtotal(0, '', '');
        $taxAmount = 0;
        $taxPercent = 0;
        // $shippingCost = $selectedShipping['cost'];
        $shippingCost = $params['shipping_price'];
        $discountAmount = 0;
        $discountPercent = 0;
        $grandTotal = ($baseTotalPrice + $taxAmount + $shippingCost) - $discountAmount;
        $cod = $params['cod'];
        $kecamatan_id = $params['kecamatan_id'];
        $warehouse_id = $params['warehouse_id'];

        $orderDate = date('Y-m-d H:i:s');
        $paymentDue = (new \DateTime($orderDate))->modify('+7 day')->format('Y-m-d H:i:s');

        $user_profile = [
            'first_name' => $params['first_name'],
            'last_name' => $params['last_name'],
            'address1' => $params['address1'],
            'address2' => $params['address2'],
            'province_id' => $params['province_id'],
            // 'city_id' => $params['shipping_city_id'],
            'city_id' => $params['city_id'],
            'kecamatan_id' => $params['kecamatan_id'],
            'postcode' => $params['postcode'],
            'phone' => $params['phone'],
            'email' => $params['email'],
        ];

        auth()->user()->update($user_profile);

        $orderParams = [
            'user_id' => auth()->id(),
            'code' => Order::generateCode(),
            'status' => Order::CREATED,
            'order_date' => $orderDate,
            'payment_due' => $paymentDue,
            'payment_status' => Order::UNPAID,
            'base_total_price' => $baseTotalPrice,
            'tax_amount' => $taxAmount,
            'tax_percent' => $taxPercent,
            'discount_amount' => $discountAmount,
            'discount_percent' => $discountPercent,
            'shipping_cost' => $shippingCost,
            'grand_total' => $grandTotal,
            'cod' => $cod,
            'warehouse_id' => $warehouse_id,
            'note' => $params['note'],
            'customer_first_name' => $params['first_name'],
            'customer_last_name' => $params['last_name'],
            'customer_address1' => $params['address1'],
            'customer_address2' => $params['address2'],
            'customer_phone' => $params['phone'],
            'customer_email' => $params['email'],
            // 'customer_city_id' => $params['shipping_city_id'],
            'customer_city_id' => $params['city_id'],
            'customer_province_id' => $params['province_id'],
            'customer_kecamatan_id' => $kecamatan_id,
            'customer_postcode' => $params['postcode'],
            // 'shipping_courier' => $selectedShipping['courier'],
            'shipping_courier' => $params['shipping_courier'],
            // 'shipping_service_name' => $selectedShipping['service'],
            'shipping_service_name' => $params['service'],
        ];

        return Order::create($orderParams);
    }

    private function _saveOrderItems($order)
    {
        $cartItems = Cart::content();

        if ($order && $cartItems) {
            foreach ($cartItems as $item) {
                $itemTaxAmount = 0;
                $itemTaxPercent = 0;
                $itemDiscountAmount = 0;
                $itemDiscountPercent = 0;
                $itemBaseTotal = $item->qty * $item->price;
                $itemSubTotal = $itemBaseTotal + $itemTaxAmount - $itemDiscountAmount;

                $product = isset($item->model->parent) ? $item->model->parent : $item->model;

                $orderItemParams = [
                    'order_id' => $order->id,
                    'product_id' => $item->model->id,
                    'qty' => $item->qty,
                    'base_price' => $item->price,
                    'base_total' => $itemBaseTotal,
                    'tax_amount' => $itemTaxAmount,
                    'tax_percent' => $itemTaxPercent,
                    'discount_amount' => $itemDiscountAmount,
                    'discount_percent' => $itemDiscountPercent,
                    'sub_total' => $itemSubTotal,
                    'sku' => $item->model->sku,
                    'type' => $product->type,
                    'name' => $item->name,
                    'weight' => $item->model->weight,
                    'attributes' => json_encode($item->options),
                ];

                $orderItem = OrderItem::create($orderItemParams);

                if ($orderItem) {
                    ProductInventory::reduceStock($orderItem->product_id, $orderItem->qty);
                }
            }
        }
    }

    private function _generatePaymentToken($order)
    {
        $this->initPaymentGateway();

        // Ambil grand_total setelah diskon kupon diterapkan
        $grandTotalAfterDiscount = $order->grand_total;

        $customerDetails = [
            'first_name' => $order->customer_first_name,
            'last_name' => $order->customer_last_name,
            'email' => $order->customer_email,
            'phone' => $order->customer_phone,
        ];

        $params = [
            'enable_payments' => Payment::PAYMENT_CHANNELS,
            'transaction_details' => [
                'order_id' => $order->code,
                'gross_amount' => $grandTotalAfterDiscount,
            ],
            'customer_details' => $customerDetails,
            'expiry' => [
                'start_time' => date('Y-m-d H:i:s T'),
                'unit' => Payment::EXPIRY_UNIT,
                'duration' => Payment::EXPIRY_DURATION,
            ],
        ];

        $headers = [
            'Authorization' => 'Basic ' . base64_encode(config('midtrans.serverKey')),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];

        $url = "https://app.midtrans.com/snap/v1/transactions";

        $response = Http::withHeaders($headers)->post($url, $params);

        if ($response->successful()) {
            $snap = $response->json();
            if (isset($snap['token'])) {
                $order->update(['payment_token' => $snap['token']]);
            }
        }

        return redirect()->route('orders.received', $order->id);
    }

    //coupon diskon
    public function applyCoupon(Request $request, $orderId)
    {
        $couponCode = $request->input('coupon_code');
        $coupon = Coupon::where('coupon_code', $couponCode)->first();

        if (!$coupon) {
            return redirect()->back()->with('error', 'Kupon tidak valid.');
        }

        // Periksa apakah kupon sudah mencapai batas penggunaan
        if ($coupon->usage_limit !== null && $coupon->usage_count >= $coupon->usage_limit) {
            return redirect()->back()->with('error', 'Kupon sudah tidak berlaku.');
        }

        // Temukan pesanan berdasarkan ID
        $order = Order::find($orderId);

        if (!$order) {
            return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
        }

        // Hitung diskon
        $discount = $order->grand_total * ($coupon->discount / 100);

        // Terapkan diskon pada grand_total
        $order->grand_total -= $discount;

          // Hitung persentase diskon dan masukkan ke order discount_percent
        $order->discount_percent = $coupon->discount;

        // Tandai kupon sebagai digunakan
        $coupon->usage_count++;
        $coupon->save();

        // Simpan perubahan pada pesanan
        $order->save();

        // Generate payment token with updated grand_total
        $this->_generatePaymentToken($order);

        // Redirect kembali ke halaman checkout
        return redirect()->back()->with('success', 'Kupon berhasil diterapkan.');
    }

    // public function successOrder(Order $orderId)
    // {
    //     $orderId->payment_status = 'PAID';
    //     $orderId->save();
    //     return view('frontend.orders.ordersucces', compact('orderId'));
    // }

  public function successOrder(Order $orderId)
    {
        // Ubah status pembayaran menjadi 'PAID'
        if($orderId->cod == 'no'){
            $orderId->payment_status = 'PAID';
            $orderId->save();
        }

        // URL untuk melihat detail pesanan
        $orderUrl = url('orders/' . $orderId->id);
        $messageCod = $orderId->cod == 'yes' ? 'terkirim' : 'terbayar';

        // Kirim pesan WhatsApp jika pembayaran berhasil
        $response = Http::post('https://wa.eblieshop.online/send-message', [
            'number' => $orderId->customer_phone,
            'message' => 'Halo ' . $orderId->customer_first_name . '! Invoice Anda dengan nomor ' . $orderId->code . ' telah berhasil ' . $messageCod . '. Detail pesanan dapat dilihat di sini: ' . $orderUrl,
        ]);

        // Lakukan penanganan respons API WhatsApp di sini, misalnya log atau lainnya
        if ($response->successful()) {
            Log::info('Pesan WhatsApp berhasil dikirim.');
        } else {
            Log::error('Gagal mengirim pesan WhatsApp: ' . $response->body());
        }

        // Tampilkan halaman sukses pembayaran kepada pengguna
        return view('frontend.orders.ordersucces', compact('orderId'));
    }


    private function _saveShipment($order, $params)
    {
        $shippingFirstName = isset($params['ship_to']) ? $params['shipping_first_name'] : $params['first_name'];
        $shippingLastName = isset($params['ship_to']) ? $params['shipping_last_name'] : $params['last_name'];
        $shippingAddress1 = isset($params['ship_to']) ? $params['shipping_address1'] : $params['address1'];
        $shippingAddress2 = isset($params['ship_to']) ? $params['shipping_address2'] : $params['address2'];
        $shippingPhone = isset($params['ship_to']) ? $params['shipping_phone'] : $params['phone'];
        $shippingEmail = isset($params['ship_to']) ? $params['shipping_email'] : $params['email'];
        // $shippingCityId = isset($params['ship_to']) ? $params['shipping_city_id'] : $params['shipping_city_id'];
        $shippingCityId = $params['city_id'];
        $shippingProvinceId = isset($params['ship_to']) ? $params['shipping_province_id'] : $params['province_id'];
        $shippingPostcode = isset($params['ship_to']) ? $params['shipping_postcode'] : $params['postcode'];
        $totalQty = 0;
        foreach ($order->orderItems as $orderItem) {
            $totalQty += $orderItem->qty;
        }

        $shipmentParams = [
            'user_id' => auth()->id(),
            'order_id' => $order->id,
            'status' => Shipment::PENDING,
            'total_qty' => $totalQty,
            'total_weight' => $this->_getTotalWeight(),
            'first_name' => $shippingFirstName,
            'last_name' => $shippingLastName,
            'address1' => $shippingAddress1,
            'address2' => $shippingAddress2,
            'phone' => $shippingPhone,
            'email' => $shippingEmail,
            'city_id' => $shippingCityId,
            'province_id' => $shippingProvinceId,
            'postcode' => $shippingPostcode,
        ];

        Shipment::create($shipmentParams);
    }

    public function received($orderId)
    {
        $order = Order::where('id', $orderId)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('frontend.orders.received', compact('order', 'orderId'));
    }

}
