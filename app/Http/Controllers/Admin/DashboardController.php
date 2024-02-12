<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $now = now()->format('Y-m-d');
        $orderToday = Order::whereDate('created_at', $now)
            ->where('status', 'created')->orWhere('status', 'completed')->orWhere('status', 'created')
            ->count();

        $productTerjual = OrderItem::whereHas('order', function ($query) {
            $query->where('status', 'created')->orWhere('status', 'completed');
        })->where('qty', '>', 0)->count();

        $totalPenjualan = Order::sum('grand_total');

        $customers = User::where('is_admin', 0)->count();

        $newestTransaction = Order::with('orderItems')->orderBy('order_date', 'desc')->get();
        $product = OrderItem::whereHas('order', function ($query) {
            $query->where('code', 'order_id');
        })->get();

        $statusCounts = Order::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        $statuses = $statusCounts->pluck('total', 'status')->toArray();
        // $paidOrders = Order::where('payment_status', 'PAID')->get();
        $paidOrders = Order::where('status', 'created')->orWhere('status', 'completed')->get();
        $salesData = $paidOrders->groupBy(function ($order) {
            return $order->created_at->format('D M Y');
        })->map(function ($groupedOrders) {
            return $groupedOrders->sum('grand_total');
        });

        return view('admin.dashboard.index', compact('orderToday', 'productTerjual', 'totalPenjualan', 'customers', 'newestTransaction', 'product', 'totalPenjualan', 'statuses', 'salesData'));

    }
}
