<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        if (view()->exists('auth.authenticate')) {
            return view('auth.authenticate');
        }

        return view('frontend.auth.login');
    }

    protected function authenticated(Request $request, $user)
    {
        // Set kolom is_logged_in menjadi true saat pengguna berhasil login
        $user->update(['is_logged_in' => true]);

        // Jika pengguna bukan admin dan belum terverifikasi, arahkan ke halaman verifikasi
        if (!$user->is_admin && !$user->is_verified) {
            return redirect('/verify')->with('toast_info', 'Anda harus verifikasi akun Anda.');
        }

        // Jika pengguna adalah admin, arahkan ke dashboard admin
        if ($user->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        // Jika pengguna adalah user biasa yang sudah terverifikasi, arahkan ke halaman profil
        return redirect('/profile');
    }


}
