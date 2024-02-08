<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request){
        $search = $request->search_blog;
        $blogs = Blog::where("title","LIKE","%".$search."%")->orWhere("description","LIKE","%".$search."%")->latest()->paginate(10);
        return view('frontend.blogs.blogs', compact('blogs','search'));
    }
}
