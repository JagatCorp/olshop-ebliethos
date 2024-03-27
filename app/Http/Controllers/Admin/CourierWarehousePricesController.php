<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Courierwarehouseprices;
use App\Models\Kurir;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class CourierwarehousepricesController extends Controller
{
    public function index()
    {
        $courierwarehouseprices = Courierwarehouseprices::all();
        $courier = Kurir::all();
        $warehouse = Warehouse::all();
        return view('admin.courierwarehouseprices.index', compact('courierwarehouseprices', 'courier', 'warehouse'));
    }

    public function store(Request $request)
    {
        $request->validate([

            'courier_id' => 'required',
            'warehouse_id' => 'required',
            'price' => 'required',

        ]);
        // dd($request->all());
        Courierwarehouseprices::create([

            'courier_id' => $request->courier_id,
            'warehouse_id' => $request->warehouse_id,
            'price' => $request->price,

        ]);

        return redirect()->route('admin.courierwarehouseprices-index')->with('toast_success', 'Courierwarehouseprices Berhasil Di Tambahkan');

    }
    public function update(Request $request)
    {
        $request->validate([
            'courier_id' => 'required',
            'warehouse_id' => 'required',
            'price' => 'required',
        ]);

        Courierwarehouseprices::where('id', $request->id)->update([

            'courier_id' => $request->courier_id,
            'warehouse_id' => $request->warehouse_id,
            'price' => $request->price,

        ]);
        return redirect()->route('admin.courierwarehouseprices-index')->with('toast_success', 'Courierwarehouseprices Berhasil Di Ubah');
    }

    public function delete($id)
    {
        $courierwarehouseprices = Courierwarehouseprices::find($id);
        $courierwarehouseprices->delete();
        return redirect()->route('admin.courierwarehouseprices-index')->with('toast_success', 'Courierwarehouseprices Berhasil Di Hapus');
    }
}
