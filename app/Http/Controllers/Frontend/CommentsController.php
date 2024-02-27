<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comments;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'artikel_id' => 'required|exists:artikels,id',
            'comment' => 'required|string',
        ]);

        $comment = new Comments();
        $comment->artikel_id = $request->artikel_id;
        $comment->user_id = auth()->id(); // Mengambil id pengguna yang sedang login
        $comment->comment = $request->comment;
        $comment->save();

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }

}
