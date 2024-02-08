<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(){
        $tags = Tag::where('user_id',auth()->id())->latest()->get();
        return view('dashboard.tag.index', compact('tags'));
    }

    public function insert(Request $request){
        $request->validate([
            'title' => 'required',
        ]);
        Tag::insert([
            'title' => $request->title,
            'user_id' => auth()->id(),
            'created_at' => now(),
        ]);
        return back()->with('success', 'New tag added successfull!');
    }

    // change status
    public function status($id){

        $tag = Tag::where('id', $id)->first();

        if($tag->status == 'active'){
            Tag::find($id)->update([
                'status' => 'deactive',

                'updated_at' => now(),
            ]);
            return back()->with('success', 'Status changed successfull!');
        }else{
            Tag::find($id)->update([
                'status' => 'active',

                'updated_at' => now(),
            ]);
            return back()->with('success', 'Status changed successfull!');
        }

    }

    // tag delete
    public function delete($id){
        Tag::find($id)->delete();
        return back()->with('success', 'Tag Deleted Successfully!');

    }

}
