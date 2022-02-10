<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Events\CommentWritten;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function index()
    {
        $comments = Comment::all();

        return view('discussion.index', compact('comments'));
    }

    public function comment(Request $request)
    {
        $comment = new Comment;
        $comment->body = $request->comment;
        $comment->user_id = Auth::user()->id;
        $comment->save();

        event(new CommentWritten($comment));

        return redirect()->back();
    }

}
