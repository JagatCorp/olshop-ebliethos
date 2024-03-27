<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function index()
    {
        $province = Province::all();
        return view('admin.province.index', compact('province'));
    }

    public function store(Request $request)
    {
        $request->validate([

            'province_name' => 'required',

        ]);

        Province::create([

            'province_name' => $request->province_name,

        ]);

        return redirect()->route('admin.province-index')->with('toast_success', 'Province Berhasil Di Tambahkan');

    }
    public function update(Request $request)
    {
        $request->validate([

            'province_name' => 'required',

        ]);

        Province::where('province_id', $request->province_id)->update([

            'province_name' => $request->province_name,

        ]);
        return redirect()->route('admin.province-index')->with('toast_success', 'Province Berhasil Di Ubah');
    }

    public function delete($id)
    {
        $province = Province::find($id);
        $province->delete();
        return redirect()->route('admin.province-index')->with('toast_success', 'Province Berhasil Di Hapus');
    }
}
