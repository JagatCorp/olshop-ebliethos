<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::all();
        return view('admin.about.index', compact('about'));
    }

    public function store(Request $request)
    {
        $request->validate([

            'isi' => 'required',

        ]);

        About::create([

            'isi' => $request->isi,

        ]);

        return redirect()->route('admin.about-index')->with('toast_success', 'About Berhasil Di Tambahkan');

    }
    public function update(Request $request)
    {
        $request->validate([

            'isi' => 'required',

        ]);

        About::where('id', $request->id)->update([

            'isi' => $request->isi,

        ]);
        return redirect()->route('admin.about-index')->with('toast_success', 'About Berhasil Di Ubah');
    }

    public function delete($id)
    {
        $about = About::find($id);
        $about->delete();
        return redirect()->route('admin.about-index')->with('toast_success', 'About Berhasil Di Hapus');
    }
}
