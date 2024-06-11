<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with('city', 'province', 'kecamatan', 'orderItems', 'warehouse')->paginate(10);

        return OrderResource::collection($orders);
        // return response()->json(['orders' => $orders], 200);
    }

}
