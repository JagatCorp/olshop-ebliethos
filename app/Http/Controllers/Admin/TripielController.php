<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Kecamatan;
use App\Models\Kurir;
use App\Models\Province;
use App\Models\Tripiel;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class TripielController extends Controller
{
    public function index()
    {
        $tripiel = Tripiel::all();
        $province = Province::all();
        $city = City::all();
        $courier = Kurir::all();
        $warehouse = Warehouse::all();
        $kecamatan = Kecamatan::all();
        return view('admin.tripiel.index', compact('tripiel', 'province', 'city', 'courier', 'warehouse', 'kecamatan'));
    }

    public function store(Request $request)
    {
        $request->validate([

            'courier_id' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'warehouse_id' => 'required',

        ]);

        Tripiel::create([

            'courier_id' => $request->courier_id,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'warehouse_id' => $request->warehouse_id,
            'kecamatan_id' => $request->kecamatan_id,
            'price' => $request->price,

        ]);

        return redirect()->route('admin.tripiel-index')->with('toast_success', 'Tripiel Berhasil Di Tambahkan');

    }
    public function update(Request $request)
    {
        $request->validate([
            'courier_id' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'warehouse_id' => 'required',

        ]);

        Tripiel::where('id', $request->id)->update([
            'courier_id' => $request->courier_id,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'warehouse_id' => $request->warehouse_id,
            'kecamatan_id' => $request->kecamatan_id,
            'price' => $request->price,

        ]);
        return redirect()->route('admin.tripiel-index')->with('toast_success', 'Tripiel Berhasil Di Ubah');
    }

    public function delete($id)
    {
        $tripiel = Tripiel::find($id);
        $tripiel->delete();
        return redirect()->route('admin.tripiel-index')->with('toast_success', 'Tripiel Berhasil Di Hapus');
    }
}
