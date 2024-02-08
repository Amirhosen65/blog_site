<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request){
        $request->validate([
            'email'=> 'required|email',
            'name'=> 'required',
            'message'=> 'required',
        ]);
        Comment::insert([
            "user_id"=> auth()->id(),
            'blog_id'=> $request->blog_id,
            'parent_id'=> $request->parent_id,
            'name'=> $request->name,
            'email'=> $request->email,
            'message'=> $request->message,
            'created_at'=> now(),
        ]);
        return back()->with('success','Your comment has been submited successfully.');
    }
}
