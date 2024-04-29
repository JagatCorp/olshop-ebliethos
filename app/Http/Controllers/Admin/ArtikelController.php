<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikel = Artikel::all();
        return view('admin.artikel.index', compact('artikel'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
        ]);
        $imageName = time() . '_' . $request->file('foto')->getClientOriginalName();
        $request->foto->move(public_path('img/fotoartikel/'), $imageName);

        Artikel::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'foto' => $imageName,
            'slug' => Str::slug($request->judul, '-'),
        ]);

        return redirect()->route('admin.artikel-index')->with('toast_success', 'Artikel Berhasil Di Tambahkan');

    }
    public function update(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',

        ]);
        $imageName = $request->gambarLama;
        if ($request->hasFile('foto')) {

            $public_path = public_path('img/fotoartikel/' . $imageName);
            if (file_exists($public_path) && is_file($public_path)) {
                // Menghapus file jika ada
                unlink($public_path);
            }

            $image = $request->file('foto');
            $imageName = time() . '_' . $request->file('foto')->getClientOriginalName();
            $image->move(public_path('img/fotoartikel/'), $imageName);
        }

        Artikel::where('id', $request->id)->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'foto' => $imageName,

        ]);
        return redirect()->route('admin.artikel-index')->with('toast_success', 'Artikel Berhasil Di Ubah');
    }

    public function delete($id)
    {
        $artikel = Artikel::find($id);

        $public_path = public_path('img/fotoartikel/' . $artikel->foto);
            if (file_exists($public_path) && is_file($public_path)) {
                // Menghapus file jika ada
                unlink($public_path);
            }

        $artikel->delete();
        return redirect()->route('admin.artikel-index')->with('toast_success', 'Artikel Berhasil Di Hapus');
    }
}
