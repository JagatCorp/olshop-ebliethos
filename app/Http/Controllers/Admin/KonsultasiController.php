<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Konsultasi;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class KonsultasiController extends Controller
{
    public function index()
    {
        $konsultasi = Konsultasi::all();
        return view('admin.konsultasi.index', compact('konsultasi'));
    }
    public function customer()
    {
        $customer = Order::select('user_id')
            ->distinct()
            ->pluck('user_id');

        $users = User::whereIn('id', $customer)->get();
        return view('admin.customer.index', compact('customer', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'no_wa' => 'required',

        ]);

        Konsultasi::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'no_wa' => $request->no_wa,

        ]);

        return redirect()->route('admin.konsultasi-index')->with('toast_success', 'Konsultasi Berhasil Di Tambahkan');

    }
    public function update(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'no_wa' => 'required',

        ]);

        Konsultasi::where('id', $request->id)->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'no_wa' => $request->no_wa,

        ]);
        return redirect()->route('admin.konsultasi-index')->with('toast_success', 'Konsultasi Berhasil Di Ubah');
    }

    public function delete($id)
    {
        $konsultasi = Konsultasi::find($id);
        $konsultasi->delete();
        return redirect()->route('admin.konsultasi-index')->with('toast_success', 'Konsultasi Berhasil Di Hapus');
    }
}
