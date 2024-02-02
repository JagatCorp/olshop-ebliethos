<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Artikel;
use App\Models\Banner;
use App\Models\Konsultasi;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Slide;
use App\Models\Slider;

class HomepageController extends Controller
{
    public function index()
    {
        $products = Product::get();
        $slides = Slide::active()->orderBy('position', 'ASC')->get();
        // Ambil semua data product images dari database
        $productImages = ProductImage::get();
        $slider = Slider::get();
        $banner = Banner::get();
        return view('frontend.homepage', compact('products', 'slides', 'productImages', 'slider', 'banner'));
    }
    // about
    public function about()
    {
        $about = About::first();
        return view('frontend.lainnya.about', compact('about'));
    }
    // artikel
    public function artikel()
    {
        $artikel = Artikel::paginate(3);
        return view('frontend.artikel.index', compact('artikel'));
    }
    // detail artikel
    public function Detailartikel($slug)
    {
        $artikelSelengkapnya = Artikel::where('slug', $slug)->first();
        $artikelSelengkapnya->update(['dilihat' => $artikelSelengkapnya->dilihat + 1]);

        $artikelLainnya = Artikel::limit(5)->get();
        return view('frontend.artikel.detail', compact('artikelSelengkapnya', 'artikelLainnya'));
    }
    // konsultasi
    public function konsultasi()
    {
        $konsultasi = Konsultasi::get();
        return view('frontend.konsultasi.index', compact('konsultasi'));
    }
// keluar
    public function keluar()
    {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    }

}