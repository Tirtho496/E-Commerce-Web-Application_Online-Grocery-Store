<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewCommentController extends Controller
{
    public function index()
    {
        $comment = Comment::all();
        return view('admin.comment.index',compact('comment'));
    }

    public function delete($id)
    {
        $comment = Comment::find($id);
        
        $comment->delete();
        return redirect('view-comments')->with('status','Comment Deleted Successfully');
    }
}
