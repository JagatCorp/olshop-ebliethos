<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    function index()
    {
        $testimoni = Testimoni::get();
        return view('admin.testimoni.index',compact('testimoni'));
    }

    public function store(Request $request)
    {
        $request->validate([

            'image' => 'required|image|mimes:jpeg,png,jpg,webp',
        ]);
        $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
        $request->image->move(public_path('img/fototestimoni/'), $imageName);

        Testimoni::create([

            'image' => $imageName,
            'testimoni' => $request->testimoni,

        ]);

        return redirect()->route('admin.testimoni-index')->with('toast_success', 'Testimoni Berhasil Di Tambahkan');

    }
    public function update(Request $request)
    {

        $imageName = $request->gambarLama;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $image->move(public_path('img/fototestimoni/'), $imageName);
        }

        Testimoni::where('id', $request->id)->update([

            'image' => $imageName,
            'testimoni' => $request->testimoni,

        ]);
        return redirect()->route('admin.testimoni-index')->with('toast_success', 'Testimoni Berhasil Di Ubah');
    }

    public function delete($id)
    {
        $slider = Testimoni::find($id);
        $slider->delete();
        return redirect()->route('admin.testimoni-index')->with('toast_success', 'Testimoni Berhasil Di Hapus');
    }
}
