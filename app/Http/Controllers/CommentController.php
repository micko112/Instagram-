<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required',
            'post_id' => 'required',
            'user_id' => 'required',
        ]);
        $comment = new Comment();
        $comment->post_id= $request->get('post_id');
        $comment->user_id= $request->get('user_id');
        $comment->text= $request->input('comment');
        $comment->save();
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
    }
}
