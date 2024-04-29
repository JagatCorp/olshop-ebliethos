<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Settings::all();

        return view('admin.settings.index', compact('settings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'waktu_buka' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'link_shopee' => 'required',
            'link_tokped' => 'required',
            'link_tiktokshop' => 'required',
        ]);
        $imageName = time() . '_' . $request->file('logo')->getClientOriginalName();
        $request->logo->move(public_path('img/logotoko/'), $imageName);

        Settings::create([
            'link_shopee' => $request->link_shopee,
            'link_tokped' => $request->link_tokped,
            'link_tiktokshop' => $request->link_tiktokshop,
            'email' => $request->email,
            'waktu_buka' => $request->waktu_buka,
            'logo' => $imageName,
        ]);

        return redirect()->route('admin.settings-index')->with('toast_success', 'Settings Berhasil Di Tambahkan');

    }
    public function update(Request $request)
    {

        $imageName = $request->gambarLama;
        if ($request->hasFile('logo')) {

            $public_path = public_path('img/logotoko/' . $imageName);
            if (file_exists($public_path) && is_file($public_path)) {
                // Menghapus file jika ada
                unlink($public_path);
            }

            $image = $request->file('logo');
            $imageName = time() . '_' . $request->file('logo')->getClientOriginalName();
            $image->move(public_path('img/logotoko/'), $imageName);
        }

        Settings::where('id', $request->id)->update([
            'link_shopee' => $request->link_shopee,
            'link_tokped' => $request->link_tokped,
            'link_tiktokshop' => $request->link_tiktokshop,
            'email' => $request->email,
            'waktu_buka' => $request->waktu_buka,
            'logo' => $imageName,
        ]);
        return redirect()->route('admin.settings-index')->with('toast_success', 'Settings Berhasil Di Ubah');
    }

    public function delete($id)
    {
        $settings = Settings::find($id);

        $public_path = public_path('img/logotoko/' . $settings->logo);
        if (file_exists($public_path) && is_file($public_path)) {
            // Menghapus file jika ada
            unlink($public_path);
        }

        $settings->delete();
        return redirect()->route('admin.settings-index')->with('toast_success', 'Settings Berhasil Di Hapus');
    }
}
