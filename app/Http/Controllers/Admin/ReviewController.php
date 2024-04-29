<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $review = Review::all();
        // $product = Review::with('product')->get();
        // $user = Review::with('user')->get();
        $product = Product::all();
        $user = User::all();
        return view('admin.review.index', compact('review', 'product', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required',
            'review' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
        ]);
        $imageName = time() . '_' . $request->file('foto')->getClientOriginalName();
        $request->foto->move(public_path('img/fotoreview/'), $imageName);

        Review::create([
            'product_id' => $request->product_id,
            'user_id' => $request->user_id,
            'review' => $request->review,
            'rating' => $request->rating,
            'foto' => $imageName,
        ]);

        return redirect()->route('admin.review-index')->with('toast_success', 'Review Berhasil Di Tambahkan');

    }
    public function update(Request $request)
    {

        $imageName = $request->gambarLama;
        if ($request->hasFile('foto')) {

            $public_path = public_path('img/fotoreview/' . $imageName);
            if (file_exists($public_path) && is_file($public_path)) {
                // Menghapus file jika ada
                unlink($public_path);
            }

            $image = $request->file('foto');
            $imageName = time() . '_' . $request->file('foto')->getClientOriginalName();
            $image->move(public_path('img/fotoreview/'), $imageName);
        }

        Review::where('id', $request->id)->update([
            'product_id' => $request->product_id,
            'user_id' => $request->user_id,
            'review' => $request->review,
            'rating' => $request->rating,
            'foto' => $imageName,

        ]);
        return redirect()->route('admin.review-index')->with('toast_success', 'Review Berhasil Di Ubah');
    }

    public function delete($id)
    {
        $review = Review::find($id);

        $public_path = public_path('img/fotoreview/' . $review->foto);
        if (file_exists($public_path) && is_file($public_path)) {
            // Menghapus file jika ada
            unlink($public_path);
        }

        $review->delete();
        return redirect()->route('admin.review-index')->with('toast_success', 'Review Berhasil Di Hapus');
    }
}
