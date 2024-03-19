<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Models\VisitorUser;
use Carbon\Carbon;
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

        // penjualan per product
        $listProd = Product::get();

        $monthStart = Carbon::now()->startOfMonth();
        $monthEnd = Carbon::now()->endOfMonth();

        $prodTerjual = OrderItem::select('product_id', 'qty', 'base_price', 'base_total')
            ->whereHas('order', function ($query) use ($monthStart, $monthEnd) {
                $query->where('payment_status', 'PAID')
                    ->whereBetween('order_date', [$monthStart, $monthEnd]);
            })->get();

        // data pembelian setiap customer
        $dataCust = User::where('is_admin', '!=', 1)->get();
        $transCust = Order::where('payment_status', 'PAID')
            ->whereBetween('order_date', [$monthStart, $monthEnd])
            ->get();

        // data status overviews
        $created = Order::where('status', 'created')
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->count();

        $confirmed = Order::where('status', 'confirmed')
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->count();

        $delivered = Order::where('status', 'delivered')
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->count();

        $completed = Order::where('status', 'completed')
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->count();

        $cancelled = Order::where('status', 'cancelled')
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->count();

        $paid = Order::where('payment_status', 'PAID')
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->count();

        $unpaid = Order::where('payment_status', 'UNPAID')
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->count();

        $diskon = Coupon::get();

        // Visitor / Pengunjung website
        $visitors = VisitorUser::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total_visitors'))
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->groupBy('date')
            ->get();

        $visitorData = $visitors->pluck('total_visitors', 'date');

        $activeUsers = User::whereHas('orders')->count();
        return view('admin.dashboard.index', compact('orderToday', 'productTerjual', 'totalPenjualan', 'customers', 'newestTransaction', 'product', 'totalPenjualan', 'statuses', 'salesData', 'prodTerjual', 'listProd', 'dataCust', 'transCust', 'created', 'confirmed', 'delivered', 'completed', 'cancelled', 'paid', 'unpaid', 'diskon', 'activeUsers', 'visitorData'));

    }
}
