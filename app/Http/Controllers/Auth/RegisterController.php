<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'required' => ':attribute harus diisi',
            'email.unique' => 'Email sudah terdaftar',
            'password.min' => 'Password minimal 6 karakter',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Membuat pengguna pada koneksi pertama
        $user1 = User::create([
            'first_name' => $data['first_name'],
            'name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],

            'password' => Hash::make($data['password']),

        ]);

        // Membuat pengguna pada koneksi kedua
        $user2 = new User;
        $user2->setConnection('mysql_second');
        $user2->name = $data['first_name'];
        $user2->email = $data['email'];
        $user2->password = Hash::make($data['password']);
        $user2->save();

        // Mengembalikan salah satu pengguna (atau keduanya) sesuai kebutuhan Anda
        return $user1; // atau bisa juga return $user2; atau kedua-duanya jika perlu
    }

    public function showRegistrationForm()
    {
        if (property_exists($this, 'registerView')) {
            return view($this->registerView);
        }
        return view('frontend.auth.register');
    }
}
