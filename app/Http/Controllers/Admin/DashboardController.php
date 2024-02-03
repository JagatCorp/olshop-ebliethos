<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $now = date('d-m-Y');
        $orderToday = Order::whereDate('created_at', '=', $now)
        ->where([
            ['status', 'created'],

        ])->count();

        $productTerjual = OrderItem::whereHas('order', function ($query) {
            $query->where('status', 'created');
        })->where('qty', '>', 0)->count();

        $totalPenjualan = Order::sum('grand_total');

        $customers = User::where('is_admin', 0)->count();

        $newestTransaction = Order::with('orderItems')->orderBy('order_date', 'desc')->get();
        $product = OrderItem::whereHas('order', function ($query) {
            $query->where('code', 'order_id');
        })->get();

        return view('admin.dashboard.index', compact('orderToday','productTerjual', 'totalPenjualan','customers','newestTransaction','product','totalPenjualan'));

    }
}
