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
        $imageName = time() . '_' . $request->file('foto')->getClientOriginalName();
        $request->foto->move(public_path('img/fotoproducts/'), $imageName);

        // Membuat entri baru dalam tabel ProductImage dengan menyimpan array nama file gambar
        ProductImage::create([
            'foto' => $imageName,
            'product_id' => $product->id, // Menyimpan ID produk yang sesuai
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
        File::delete('storage/' . $product_image->path);
        $product_image->delete();

        return redirect()->back()->with([
            'toast_success' => 'Berhasil di hapus !',
            'alert-type' => 'danger',
        ]);
    }
}
