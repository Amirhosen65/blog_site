<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function index(){
        $categories = Category::all();
        return view('dashboard.category.index',compact('categories'));
    }

    // category insert
    public function insert(Request $request){
        $request->validate([
            "title" => 'required',
            "image" => 'required|image',
        ]);

        $new_name = auth()->id() . '-' . $request->title . '-' . now()->format('d M, Y H-i-s') . '.' . $request->file('image')->getClientOriginalExtension();
        $img = Image::make($request->file('image'))->fit(400, 400, function ($constraint) {$constraint->upsize();});
        $img->save(base_path('public/uploads/category/' . $new_name), 85);

        if ($request->hasFile('image')) {
            if ($request->slug) {
                Category::insert([
                    'title' => $request->title,
                    'slug' => Str::slug($request->slug),
                    'image' => $new_name,
                    'created_at' => now(),
                ]);
            } else {
                Category::insert([
                    'title' => $request->title,
                    'slug' => Str::slug($request->title),
                    'image' => $new_name,
                    'created_at' => now(),
                ]);
            }
        }
        return back()->with('success', 'New Category Insert Successfully!');
    }

    // category delete

    public function delete($id){
        Category::findOrFail($id)->delete();
        return back()->with('success', 'Category Deleted Successfully!');
    }

    // public function delete($id)
    // {
    //     $category = Category::findOrFail($id);
    //     $category->delete([
    //         'deleted_at' => now(),
    //     ]);

    //     return back()->with('success', 'Category Soft Deleted Successfully!');
    // }


    // category edit

    public function edit_index(Request $request, $id){
        $category = Category::where('id',$id)->first();
        return view('dashboard.category.edit',compact('category'));

    }



    public function edit(Request $request, $id){
        $category = Category::where('id',$id)->first();

        $request->validate([
            "title" => 'required',
            "slug" => 'required',

        ]);

        if ($request->hasFile('image')) {
            $new_name = $id . '-' . $request->title . '-' . now()->format('d M Y H-i-s') . '.' . $request->file('image')->getClientOriginalExtension();
            $img = Image::make($request->file('image'))->fit(400, 400, function ($constraint) {$constraint->upsize();});
            $img->save(base_path('public/uploads/category/' . $new_name), 85);
            if ($request->slug) {
                unlink(public_path('uploads/category/'. $category->image));
                Category::find($id)->update([
                    'title' => $request->title,
                    'slug' => Str::slug($request->slug),
                    'image' => $new_name,
                    'created_at' => now(),
                ]);
            } else {
                unlink(public_path('uploads/category/'. $category->image));
                Category::find($id)->update([
                    'title' => $request->title,
                    'slug' => Str::slug($request->title),
                    'image' => $new_name,
                    'created_at' => now(),
                ]);
            }
        }else{
            Category::find($id)->update([
                'title' => $request->title,
                'slug' => Str::slug($request->slug),
                'created_at' => now(),
            ]);
        }
        return redirect()->route('category')->with('success', 'Category Updated Successfully!');

    }

    // status change
    public function status($id){

        $category = Category::where('id', $id)->first();

        if($category->status == 'active'){
            Category::find($id)->update([
                'status' => 'deactive',

                'updated_at' => now(),
            ]);
            return back()->with('success', 'Status changed successfull!');
        }else{
            Category::find($id)->update([
                'status' => 'active',

                'updated_at' => now(),
            ]);
            return back()->with('success', 'Status changed successfull!');
        }

    }

}
