<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    public function index()
    {
        $kecamatan = Kecamatan::all();
        $city = City::all();
        return view('admin.kecamatan.index', compact('kecamatan', 'city'));
    }

    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required',
            'city_id' => 'required',

        ]);

        Kecamatan::create([

            'name' => $request->name,
            'city_id' => $request->city_id,

        ]);

        return redirect()->route('admin.kecamatan-index')->with('toast_success', 'Kecamatan Berhasil Di Tambahkan');

    }
    public function update(Request $request)
    {
        $request->validate([

            'name' => 'required',

        ]);

        Kecamatan::where('id', $request->id)->update([

            'name' => $request->name,
            'city_id' => $request->city_id,

        ]);
        return redirect()->route('admin.kecamatan-index')->with('toast_success', 'Kecamatan Berhasil Di Ubah');
    }

    public function delete($id)
    {
        $kecamatan = Kecamatan::find($id);
        $kecamatan->delete();
        return redirect()->route('admin.kecamatan-index')->with('toast_success', 'Kecamatan Berhasil Di Hapus');
    }
}
