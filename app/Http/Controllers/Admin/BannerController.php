<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banner = Banner::all();
        return view('admin.banner.index', compact('banner'));
    }

    public function store(Request $request)
    {
        $request->validate([

            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
        ]);
        $imageName = time() . '_' . $request->file('foto')->getClientOriginalName();
        $request->foto->move(public_path('img/fotobanner/'), $imageName);

        Banner::create([

            'foto' => $imageName,

        ]);

        return redirect()->route('admin.banner-index')->with('toast_success', 'Banner Berhasil Di Tambahkan');

    }
    public function update(Request $request)
    {

        $imageName = $request->gambarLama;
        if ($request->hasFile('foto')) {

            $public_path = public_path('img/fotobanner/' . $imageName);
            if (file_exists($public_path) && is_file($public_path)) {
                // Menghapus file jika ada
                unlink($public_path);
            }

            $image = $request->file('foto');
            $imageName = time() . '_' . $request->file('foto')->getClientOriginalName();
            $image->move(public_path('img/fotobanner/'), $imageName);
        }

        Banner::where('id', $request->id)->update([

            'foto' => $imageName,

        ]);
        return redirect()->route('admin.banner-index')->with('toast_success', 'Banner Berhasil Di Ubah');
    }

    public function delete($id)
    {
        $banner = Banner::find($id);

        $public_path = public_path('img/fotobanner/' . $banner->foto);
        if (file_exists($public_path) && is_file($public_path)) {
            // Menghapus file jika ada
            unlink($public_path);
        }

        $banner->delete();
        return redirect()->route('admin.banner-index')->with('toast_success', 'Banner Berhasil Di Hapus');
    }
}
