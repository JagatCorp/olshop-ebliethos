<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        // $provinces = $this->getProvinces();
        // $cities = isset($users->province_id) ? $this->getCities($users->province_id) : [];

        return view('admin.users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users,email',
        ], [
            'email.unique' => 'Email sudah terdaftar',
        ]);
        $imageName = time() . '_' . $request->file('foto')->getClientOriginalName();
        $request->foto->move(public_path('img/fotouser/'), $imageName);
        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'postcode' => $request->postcode,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'phone' => $request->phone,
            // 'province_id' => $request->province_id,
            // 'city_id' => $request->city_id,
            'foto' => $imageName,
            'is_admin' => $request->is_admin,

        ]);
        return redirect('/admin/users')->with('toast_success', 'User berhasil di tambahkan');
    }
    public function update(Request $request)
    {

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            // Tambahkan validasi lainnya sesuai kebutuhan
        ],
            [
                'email.unique' => 'Email sudah terdaftar',
            ]);

        $imageName = $request->gambarLama;
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $imageName = time() . '_' . $request->file('foto')->getClientOriginalName();
            $image->move(public_path('img/fotouser/'), $imageName);
        }

        $data = User::find($request->id);

        if ($data->password == $request->password) {
            User::where('id', $request->id)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'postcode' => $request->postcode,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'phone' => $request->phone,
                'foto' => $imageName,
                'is_admin' => $request->is_admin,
            ]);
        } else {
            // Update password
            User::where('id', $request->id)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'postcode' => $request->postcode,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'phone' => $request->phone,
                'foto' => $imageName,
                'is_admin' => $request->is_admin,
            ]);
        }

        return redirect('/admin/users')->with('toast_success', 'User updated successfully');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/admin/users')->with('toast_success', 'User Berhasil Di Hapus');
    }
}
