<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class TrackpaketController extends Controller
{


    public function showTrackForm()
    {
        return view('frontend.trackpaket.index');
    }

    public function trackPaket(Request $request)
    {
        // Daftar kurir yang valid
        $validCouriers = ['jne', 'pos', 'jnt', 'jnt_cargo', 'sicepat', 'tiki', 'anteraja', 'wahana', 'ninja', 'lion', 'pcp', 'jet', 'rex', 'first', 'ide', 'spx', 'kgx', 'sap', 'jxe', 'rpx', 'lex', 'indah_cargo'];

        // Periksa jika input awb dan kurir telah diberikan
        if ($request->has('awb') && $request->has('courier')) {
            $apiKey = 'f77fb0cc16b19409d1d3c3ebbde7d3a81c5b652e4850bae0a4237873610db65f';
            $courier = $request->input('courier');
            $awb = $request->input('awb');

            // Periksa apakah kurir yang dipilih valid
            if (in_array($courier, $validCouriers)) {
                $response = Http::get("https://api.binderbyte.com/v1/track?api_key=$apiKey&courier=$courier&awb=$awb");

                // Periksa status kode respons
                if ($response->successful()) {
                    $result = $response->json();
                    // Tampilkan hasil pelacakan paket
                    return view('frontend.trackpaket.result', ['result' => $result]);
                } else {
                    // Jika respons tidak berhasil (misalnya, nomor Resi salah), kembalikan ke formulir input
                    return redirect()->route('track.form')->with('error', 'Nomor Resi salah atau kurir tidak valid. Silakan coba lagi.');
                }
            } else {
                // Jika kurir yang dipilih tidak valid, kembalikan ke formulir input
                return redirect()->route('track.form')->with('error', 'Kurir yang dipilih tidak valid. Silakan pilih kurir yang sesuai.');
            }
        }

        // Jika tidak ada nomor Resi atau kurir yang diberikan, kembalikan ke formulir input
        return redirect()->route('track.form')->with('error', 'Mohon masukkan nomor Resi dan pilih kurir.');
    }



}
