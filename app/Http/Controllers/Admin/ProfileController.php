<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        return view('frontend.profile.index');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            // Tambahkan validasi lainnya sesuai kebutuhan
        ]);

        // Set nama file foto default
        $defaultImageName = 'logo.png';

        $imageName = $user->foto ?: $defaultImageName; // Jika foto tidak ada, gunakan foto default

        if ($request->hasFile('foto')) {

            $public_path = public_path('img/fotouser/' . $imageName);
            if (file_exists($public_path) && is_file($public_path)) {
                // Menghapus file jika ada
                unlink($public_path);
            }

            $image = $request->file('foto');
            $imageName = time() . '_' . $request->file('foto')->getClientOriginalName();
            $image->move(public_path('img/fotouser/'), $imageName);
        }

        $user = User::where('id', $user->id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'postcode' => $request->postcode,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'phone' => $request->phone,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'foto' => $imageName,
        ]);

        return redirect()->route('profile');
    }
}
