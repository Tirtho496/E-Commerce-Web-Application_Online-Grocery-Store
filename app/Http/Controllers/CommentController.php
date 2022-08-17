<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function makeComment(Request $request)
    {
        $comment = new Comment();
        $comment->name = $request->input('name');
        $comment->email = $request->input('email');
        $comment->comment = $request->input('text');
        $comment->save();

        return redirect()->back();
    }
}
