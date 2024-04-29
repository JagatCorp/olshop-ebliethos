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

          $customers = Order::where('status', 'created')->count();

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
            return $order->created_at->format('M');
        })->map(function ($groupedOrders) {
            return $groupedOrders->sum('grand_total');
        });

        // penjualan per product
        $listProd = Product::paginate(5);

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

        $activeUsers = User::whereHas('orders')
            ->where('is_logged_in', 1)
            ->count();

        // pembelian product
        $pembelianData = OrderItem::select('product_id', DB::raw('COUNT(*) as total_order'))
          ->join('products as p', 'product_id', '=', 'p.id')
          ->groupBy('product_id')
          ->get();
        
        foreach($pembelianData as $item) {
          $name = Product::where('id', $item->product_id)->first()->name;
          
          $pembelians[$name] = $item->total_order;
        }
         
            // transaksi perbulan
            $transaksiBulanan = Order::whereYear('order_date', Carbon::now()->year)
        ->whereMonth('order_date', Carbon::now()->month)
        ->get();
        
        
        // start Product Penjualan Berdasarkan Customer
    // Ambil semua pesanan dengan relasi OrderItem dan Product
    $orders = Order::with('orderItems.product')->get();

    // Inisialisasi array untuk menyimpan data penjualan
    $salesProduct = [];

    // Iterasi melalui setiap pesanan
    foreach ($orders as $order) {
        // Ambil nama pelanggan dari pesanan
        $customerName = $order->customer_first_name;

        // Iterasi melalui setiap item dalam pesanan
        foreach ($order->orderItems as $orderItem) {
            // Ambil nama produk dan id produk
            $productName = $orderItem->product->name;
            $productId = $orderItem->product_id;

            // Gunakan nama pelanggan dan nama produk sebagai kunci dalam array data penjualan
            $key = $customerName . '_' . $productName;

            // Jika kunci sudah ada, tambahkan jumlah pembelian
            if (isset($salesProduct[$key])) {
                $salesProduct[$key]['count']++;
            } else {
                // Jika tidak, inisialisasikan jumlah pembelian menjadi 1
                $salesProduct[$key] = [
                    'customer' => $customerName,
                    'product' => $productName,
                    'product_id' => $productId,
                    'count' => 1,
                    // Tambahkan properti untuk menyimpan jumlah total pembelian
                    'total_orders' => $orderItem->product->getTotalOrders()
                ];
            }
        }
    }

    // Siapkan data untuk chart
    $chartData = [];
    foreach ($salesProduct as $sale) {
        $chartData[] = [
            'customer' => $sale['customer'],
            'product' => $sale['product'],
            // Hapus properti 'percentage' dari data yang diteruskan ke chart
            'percentage' => $sale['total_orders'] * 100,
            // Tetap menyertakan properti 'total_orders' sebagai informasi tambahan
            'total_orders_customer' => $sale['total_orders']
        ];
    }
// end Product Penjualan Berdasarkan Customer


        return view('admin.dashboard.index', compact('pembelians', 'orderToday', 'productTerjual', 'totalPenjualan', 'customers', 'newestTransaction', 'product', 'totalPenjualan', 'statuses', 'salesData', 'prodTerjual', 'listProd', 'dataCust', 'transCust', 'created', 'confirmed', 'delivered', 'completed', 'cancelled', 'paid', 'unpaid', 'diskon', 'activeUsers', 'visitorData','transaksiBulanan','chartData'));

    }
}
