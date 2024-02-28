<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * Show the form for creating a new resource.
     */
    public function create(Product $product)
    {
        return view('admin.product_video.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */

}
