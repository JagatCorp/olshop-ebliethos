<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kurir;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    public function index()
    {
        $courier = Kurir::all();
        return view('admin.courier.index', compact('courier'));
    }

    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required',

        ]);

        Kurir::create([

            'name' => $request->name,
            'type' => $request->type,

        ]);

        return redirect()->route('admin.courier-index')->with('toast_success', 'Courier Berhasil Di Tambahkan');

    }
    public function update(Request $request)
    {
        $request->validate([

            'name' => 'required',

        ]);

        Kurir::where('id', $request->id)->update([

            'name' => $request->name,
            'type' => $request->type,

        ]);
        return redirect()->route('admin.courier-index')->with('toast_success', 'Courier Berhasil Di Ubah');
    }

    public function delete($id)
    {
        $courier = Kurir::find($id);
        $courier->delete();
        return redirect()->route('admin.courier-index')->with('toast_success', 'Courier Berhasil Di Hapus');
    }
}
