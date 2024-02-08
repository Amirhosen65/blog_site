<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;

class CategoryBlogController extends Controller
{
    public function index($id){
        $blogs = Blog::where("category_id",$id)->latest()->paginate(10);
        $category_name = Category::where("id",$id)->first();
        return view('frontend.categoryBlog.index', compact('blogs','category_name'));
    }

    public function single_blog($id){
        $blog = Blog::where("id",$id)->first();
        $comments = Comment::with('relationWithReply')->where("blog_id",$id)->whereNull('parent_id')->latest()->get();
        if($blog){
            Blog::find($id)->update(["visitor_count"=> $blog->visitor_count + 1]);
        }
        return view('frontend.singleBlog.index', compact('blog','comments'));
    }
}
