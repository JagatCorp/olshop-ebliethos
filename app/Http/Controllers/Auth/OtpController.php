<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class OtpController extends Controller
{
    public function verify()
    {

        return view('frontend.auth.otp.otp');
    }

    public function cekOTP()
    {

        return view('frontend.auth.otp.verifyOtp');
    }



    public function sendOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp_method' => 'required|in:email,phone',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Generate kode OTP secara acak
        $verificationCode = mt_rand(1000, 9999);

        // Simpan kode OTP bersama dengan informasi pengguna
        $user = auth()->user();
        $user->verification_code = $verificationCode;
        $user->save();

        $otpMethod = $request->input('otp_method');

        if ($otpMethod === 'email') {
            $this->sendEmailVerification($user->email, $verificationCode);
            return redirect()->route('cek.otp')->with('toast_success', 'Kode verifikasi telah dikirimkan ke email Anda.');
        } else {
            $this->sendVerificationCode($user->phone, $verificationCode);
            return redirect()->route('cek.otp')->with('toast_success', 'Kode verifikasi telah dikirimkan ke whatsapp Anda.');
        }
    }




protected function sendVerificationCode($phone, $verificationCode)
{
    $client = new Client();

    $response = $client->post('https://wa.kop-dayalisna.online/send-message', [
        'body' => json_encode([
            'number' => $phone, // Nomor telepon penerima
            'message' => 'Kode verifikasi Anda: ' . $verificationCode, // Pesan dengan kode verifikasi
        ]),
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
    ]);

    // Cek status kode respons
    if ($response->getStatusCode() == 200) {
        // Pesan berhasil terkirim
        return redirect()->route('cek.otp')->with('toast_success', 'Kode verifikasi telah dikirimkan ke whatsapp Anda.');
    } else {
        // Gagal mengirim pesan, lakukan penanganan error di sini jika diperlukan
        return redirect()->route('cek.otp')->with('toast_error', 'Kode verifikasi gagal dikirimkan ke whatsapp Anda.');
    }
}
protected function sendEmailVerification($email, $verificationCode)
{
    Mail::send('emails.verify', ['verificationCode' => $verificationCode], function($message) use ($email) {
        $message->to($email)
                ->subject('Verifikasi Email');
    });
}



public function verifyOTP(Request $request)
{
    $request->validate([
        'otpCode' => 'required', // Hapus aturan digits:4 sementara
    ]);

    try {
        // Bandingkan kode OTP yang dimasukkan dengan kode yang tersimpan untuk pengguna yang bersangkutan
        $enteredOTP = (string) $request->input('otpCode');
        $user = auth()->user();
        $userVerificationCodeString = (string) $user->verification_code;

        if ($enteredOTP === $userVerificationCodeString) {
            // Kode OTP cocok, tandai pengguna sebagai diverifikasi
            $user->is_verified = true;
            $user->save();

            // Redirect atau lakukan tindakan sesuai kebutuhan Anda
            return redirect('/profile')->with('toast_success', 'Verifikasi berhasil!');
        } else {
            // Kode OTP tidak cocok, tampilkan pesan kesalahan
            return redirect()->back()->with(['toast_error' => 'Kode OTP tidak valid. Silakan coba lagi.']);
        }

    } catch (\Exception $e) {
        // Tangani kesalahan saat menyimpan
        return redirect()->back()->with(['toast_error','Terjadi kesalahan. Silakan coba lagi nanti.']);
    }
}



}
