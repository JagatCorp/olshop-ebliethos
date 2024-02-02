<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function reviews()
    {
        $review = Review::all();
        // $product = Review::with('product')->get();
        // $user = Review::with('user')->get();
        $product = Product::first();
        $user = User::all();
        // $orders = OrderItem::forUser(auth()->user())->with('product')
        //     ->orderBy('created_at', 'DESC')->where('status', 'completed')
        //     ->get();
        $orders = OrderItem::get();
        return view('frontend.review.index', compact('review', 'product', 'user', 'orders'));
    }
    public function index(Product $product)
    {
        $review = Review::all();
        // $product = Review::with('product')->get();
        // $user = Review::with('user')->get();
        $product = Product::all();
        $user = User::all();
        // $orders = OrderItem::forUser(auth()->user())->with('product')
        //     ->orderBy('created_at', 'DESC')->where('status', 'completed')
        //     ->get();
        $orders = OrderItem::get();
        return view('frontend.review.create', compact('review', 'product', 'user', 'orders'));
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
        // ]);

        // Temukan OrderItem yang sesuai dengan ID yang diberikan
        $orderItem = OrderItem::get()->find($request->order_item_id);

        // Pastikan OrderItem ditemukan
        if (!$orderItem) {
            return redirect()->back()->with('toast_error', 'OrderItem tidak ditemukan');
        }

        // Pastikan pengguna yang sedang masuk adalah pemilik Order yang terkait
        $user = Auth::user();
        if ($orderItem->order->user_id !== $user->id) {
            return redirect()->back()->with('toast_error', 'Anda tidak diizinkan untuk menambahkan review untuk OrderItem ini');
        }

        // Simpan foto jika diminta dalam validasi
        $imageName = time() . '_' . $request->file('foto')->getClientOriginalName();
        $request->foto->move(public_path('img/fotoreview/'), $imageName);

        // Buat dan simpan ulasan
        Review::create([
            'product_id' => $request->$orderItem->product_id,
            'user_id' => $request->$user->id,
            'rating' => $request->rating,
            'review' => $request->review,
            'foto' => $imageName,
        ]);

        // dd($request->all());
        return redirect()->route('reviews')->with('toast_success', 'Review Berhasil Di Tambahkan');
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
