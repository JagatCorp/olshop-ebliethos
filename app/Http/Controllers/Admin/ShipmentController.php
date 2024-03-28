<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shipments = Shipment::join('orders', 'shipments.order_id', '=', 'orders.id')
            ->whereRaw('orders.deleted_at IS NULL')
            ->orderBy('shipments.created_at', 'DESC')->get();

        return view('admin.shipments.index', compact('shipments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shipment $shipment)
    {
        return view('admin.shipments.edit', compact('shipment'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Shipment $shipment)
    // {
    //     $request->validate(
    //         [
    //             'nomor_resi' => 'required|max:255',
    //         ]
    //     );

    //     $order = DB::transaction(
    //         function () use ($shipment, $request) {
    //             $shipment->nomor_resi = $request->input('nomor_resi');
    //             $shipment->status = Shipment::SHIPPED;
    //             // $shipment->shipped_at = now();
    //             // $shipment->shipped_by = auth()->id();

    //             if ($shipment->save()) {
    //                 $shipment->order->status = Order::DELIVERED;
    //                 $shipment->order->save();
    //             }

    //             return $shipment->order;
    //         }
    //     );

    //     Session::flash('success', 'The shipment has been updated');
    //     return redirect('admin/orders/' . $order->id);
    // }
    public function update(Request $request)
    {
        Order::where('id', $request->id)->update([
            'nomor_resi' => $request->nomor_resi,
        ]);

        return redirect('admin/shipments')->with('toast_success', 'nomor_resi Order Berhasil');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
