<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $now = $request->date;

        $orderToday = Order::whereDate('created_at', '=', $now)
        ->where([
            ['status', 'created'],

        ])->count();

        return view('admin.dashboard.index');
    }
}
