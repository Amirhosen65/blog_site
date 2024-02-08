<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class FrontTagController extends Controller
{
    public function index($id){
        $tag_name = Tag::where("id",$id)->first();
        $tag = Tag::with('ManyRelationBlogs')->where("id",$id)->get();
        $blogs = $tag[0]->ManyRelationBlogs()->latest()->paginate(10);
        return view('frontend.tagBlog.index',compact('tag_name','blogs'));
    }
}
