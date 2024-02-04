<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function reviews()
    {

        $orders = Order::where('status', 'delivered')->latest()->limit(2)->get();
        return view('frontend.review.index', compact('orders'));
    }
    public function index($product_id)
    {

        $value = Product::find($product_id);
        return view('frontend.review.create', compact('value'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required',
        ]);
        // Check if a file was uploaded
        if ($request->hasFile('foto')) {
            // Validate and store the uploaded file
            $imageName = time() . '_' . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->move(public_path('img/fotoreview/'), $imageName);
        } else {
            // If no file was uploaded, set the image name to null or any default value you prefer
            $imageName = null;
        }

        Review::create([
            'product_id' => $request->product_id,
            'user_id' => Auth::user()->id,
            'review' => $request->review,
            'rating' => $request->rating,
            'foto' => $imageName,
        ]);

        return redirect()->route('reviews')->with('toast_success', 'Ulasan Anda telah berhasil dikirimkan,');

    }
    // public function store(Request $request)
    // {
    //     $review = new Review();
    //     $review->booking_id = $request->booking_id;
    //     $review->comments = $request->comment;
    //     $review->star_rating = $request->rating;
    //     $review->user_id = Auth::user()->id;
    //     $review->service_id = $request->service_id;
    //     $review->save();
    //     return redirect()->back()->with('flash_msg_success', 'Your review has been submitted Successfully,');
    // }

}
