<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $slider = Slider::all();
        return view('admin.slider.index', compact('slider'));
    }

    public function store(Request $request)
    {
        $request->validate([

            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
        ]);
        $imageName = time() . '_' . $request->file('foto')->getClientOriginalName();
        $request->foto->move(public_path('img/fotoslider/'), $imageName);

        Slider::create([

            'foto' => $imageName,

        ]);

        return redirect()->route('admin.slider-index')->with('toast_success', 'Slider Berhasil Di Tambahkan');

    }
    public function update(Request $request)
    {

        $imageName = $request->gambarLama;
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $imageName = time() . '_' . $request->file('foto')->getClientOriginalName();
            $image->move(public_path('img/fotoslider/'), $imageName);
        }

        Slider::where('id', $request->id)->update([

            'foto' => $imageName,

        ]);
        return redirect()->route('admin.slider-index')->with('toast_success', 'Slider Berhasil Di Ubah');
    }

    public function delete($id)
    {
        $slider = Slider::find($id);
        $slider->delete();
        return redirect()->route('admin.slider-index')->with('toast_success', 'Slider Berhasil Di Hapus');
    }
}
