<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
        $warehouse = Warehouse::all();
        return view('admin.warehouse.index', compact('warehouse'));
    }

    public function indexApi()
    {
        $warehouse = Warehouse::all();
        return response()->json($warehouse);
    }

    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required',

        ]);

        Warehouse::create([

            'name' => $request->name,

        ]);

        return redirect()->route('admin.warehouse-index')->with('toast_success', 'Warehouse Berhasil Di Tambahkan');

    }
    public function update(Request $request)
    {
        $request->validate([

            'name' => 'required',

        ]);

        Warehouse::where('id', $request->id)->update([

            'name' => $request->name,

        ]);
        return redirect()->route('admin.warehouse-index')->with('toast_success', 'Warehouse Berhasil Di Ubah');
    }

    public function delete($id)
    {
        $warehouse = Warehouse::find($id);
        $warehouse->delete();
        return redirect()->route('admin.warehouse-index')->with('toast_success', 'Warehouse Berhasil Di Hapus');
    }
}
