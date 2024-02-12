<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\WishList;
use Illuminate\Http\Request;

class WishListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wishlists = WishList::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')->get();
        // Ambil rata-rata nilai ulasan untuk setiap produk

        return view('frontend.wishlists.index', compact('wishlists'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return response()->json([
                'status' => 401,
            ]);
        }
        $request->validate(
            [
                'product_slug' => 'required',
            ]
        );

        $product = Product::where('slug', $request->get('product_slug'))->firstOrFail();

        $favorite = WishList::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($favorite) {
            return response('Produk sudah ada !', 422);
        }

        WishList::create(
            [
                'user_id' => auth()->id(),
                'product_id' => $product->id,
            ]
        );

        return response('Produk berhasil di masukkan !', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WishList $wishlist)
    {
        // $wishlist = WishList::where('id', $wishlist->id)->where('user_id', auth()->id())->firstOrFail();
        $wishlist->delete();

        return redirect('wishlists')->with([
            'message' => 'berhasil di hapus !',
            'alert-type' => 'danger',
        ]);
    }

    public function delete($id)
    {
        $wishlist = WishList::find($id);
        $wishlist->delete();
        return redirect('wishlists');
    }
}
