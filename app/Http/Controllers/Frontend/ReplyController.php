<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comments_id' => 'required|exists:comments,id',
            'reply' => 'required|string',
        ]);

        Reply::create([
            'comments_id' => $request->comments_id,
            'user_id' => auth()->id(),
            'reply' => $request->reply,
        ]);

        return back()->with('success', 'Balasan berhasil ditambahkan.');
    }
}
