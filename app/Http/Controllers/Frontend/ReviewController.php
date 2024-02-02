<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function reviews()
    {
        $review = Review::all();
        // $product = Review::with('product')->get();
        // $user = Review::with('user')->get();
        $product = Product::all();
        $user = User::all();
        $orders = Order::forUser(auth()->user())->with('orderItems.product')
            ->orderBy('created_at', 'DESC')->where('status', 'completed')
            ->get();
        return view('frontend.review.index', compact('review', 'product', 'user', 'orders'));
    }

    public function store(Request $request)
    {
        $request->validate([

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
        $review->delete();
        return redirect()->route('admin.review-index')->with('toast_success', 'Review Berhasil Di Hapus');
    }
}
