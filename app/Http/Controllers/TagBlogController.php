<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagBlogController extends Controller
{
    public function index($id){
        $blogs = Blog::where("tag_id",$id)->latest()->paginate(10);
        $tag_name = Tag::where("id",$id)->first();
        return view('frontend.tagBlog.index', compact('blogs','tag_name'));
    }
}
