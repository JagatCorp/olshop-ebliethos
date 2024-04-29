<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductImageRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\File;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        $productImages = ProductImage::where('product_id', $product->id)->get();

        return view('admin.product_images.index', compact('product', 'productImages'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Product $product)
    {
        return view('admin.product_images.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductImageRequest $request, Product $product)
    {
        // Inisialisasi array untuk menyimpan nama file gambar
        // $foto = [];

        // if ($request->hasFile('foto')) {
        //     foreach ($request->file('foto') as $photoFile) {
        //         // Membuat nama unik untuk setiap file gambar
        //         $filename = time() . '_' . $photoFile->getClientOriginalName();
        //         // Memindahkan file gambar ke direktori penyimpanan
        //         $photoFile->move(public_path('img/fotoproducts/'), $filename);
        //         // Menyimpan nama file gambar ke dalam array
        //         $foto[] = $filename;

        //         // Memeriksa ekstensi file yang diunggah
        //         $extension = pathinfo($filename, PATHINFO_EXTENSION);
        //         if (in_array(strtolower($extension), ['jpg', 'jpeg'])) {
        //             // Menampilkan foto jika ekstensi adalah jpg atau jpeg
        //             echo '<img src="' . asset('img/fotoproducts/' . $filename) . '" alt="" width="60px" height="40px">';
        //         }
        //     }
        // }
        // $imageName = time() . '_' . $request->file('foto')->getClientOriginalName();
        // $request->foto->move(public_path('img/fotoproducts/'), $imageName);

        $imageName = null;
        $videoName = null;

// Upload foto
        if ($request->hasFile('foto')) {
            $imageName = time() . '_' . $request->file('foto')->getClientOriginalName();
            $request->foto->move(public_path('img/fotoproducts/'), $imageName);
            // Simpan nama file ke database atau variabel jika perlu
        }

// Upload video
        if ($request->hasFile('video')) {
            $videoName = time() . '_' . $request->file('video')->getClientOriginalName();
            $request->video->move(public_path('img/videoproducts/'), $videoName);
            // Simpan nama file ke database atau variabel jika perlu
        }

        // Membuat entri baru dalam tabel ProductImage dengan menyimpan array nama file gambar
        ProductImage::create([
            'foto' => $imageName,
            'product_id' => $product->id, // Menyimpan ID produk yang sesuai
            'video' => $videoName,
        ]);

        return redirect()->route('admin.products.product_images.index', $product)->with([
            'toast_success' => 'Berhasil diupload!',
            'alert-type' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, ProductImage $product_image)
    {
        // dd(file_exists(public_path('img/fotoproducts/' . $product_image->foto)));
        // dd($product_image->foto != null);

        $public_path_video = public_path('img/videoproducts/' . $product_image->video);
        $public_path_foto = public_path('img/fotoproducts/' . $product_image->foto);

        if (file_exists($public_path_foto) && $product_image->foto != null && is_file($public_path_foto)) {
            // Menghapus file jika ada
            unlink($public_path_foto);
        }

        if (file_exists($public_path_video) && $product_image->video != null && is_file($public_path_video)) {
            // Menghapus video jika ada
            unlink($public_path_video);
        }

        File::delete('storage/' . $product_image->path);
        $product_image->delete();

        return redirect()->back()->with([
            'toast_success' => 'Berhasil di hapus !',
            'alert-type' => 'danger',
        ]);
    }
}
