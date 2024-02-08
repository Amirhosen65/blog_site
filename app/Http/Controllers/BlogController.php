<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Blog;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    public function index(){
        $blogs = Blog::where('user_id',auth()->id())->latest()->paginate(10);
        $all_blogs = Blog::latest()->paginate(10);
        return view('dashboard.blog.index', compact('blogs','all_blogs'));
    }

    public function insert_view(){
        $categories = Category::where('status','active')->get();
        $tags = Tag::where('status','active')->get();
        return view('dashboard.blog.insert',compact('categories','tags'));
    }


    // blog post insert
    public function insert(Request $request)
    {
        // Validate the form data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'date' => 'nullable|date',

            'tag_ids.*' => 'exists:tags,id',
        ]);

        if ($request->hasFile('image')) {
            $new_name = time() . '_' . Str::random(10) . '_' . now()->format('d-M-Y H-i-s') . '.' . $request->file('image')->getClientOriginalExtension();
            $img = Image::make($request->file('image'))->fit(900, 506, function ($constraint) {
                $constraint->upsize();
            });
            $img->save(base_path('public/uploads/blog/' . $new_name), 90);
        }

        $date = $request->date ? $request->date : now()->format('Y-m-d');

        $blog_insert = Blog::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'image' => $new_name,
            'user_id' => auth()->id(),
            'date' => $date,
            'created_at' => now(),
        ]);

        $blog_insert->ManyRelationTags()->attach($request->tag_ids);
        $blog_insert->save();

        return redirect()->route('blog.index')->with('success', 'New Post Insert Successfully!');
    }




    // status change
    public function status($id){

        $blog = Blog::where('id', $id)->first();

        if($blog->status == 'published'){
            Blog::find($id)->update([
                'status' => 'draft',

                'updated_at' => now(),
            ]);
            return back()->with('success', 'Status changed successfull!');
        }else{
            Blog::find($id)->update([
                'status' => 'published',

                'updated_at' => now(),
            ]);
            return back()->with('success', 'Status changed successfull!');
        }

    }


    // blog edit
    public function blog_edit(Request $request, $id){
        $blog = Blog::where('id',$id)->first();
        $categories = Category::where('status','active')->get();
        $tags = Tag::where('status','active')->get();
        return view('dashboard.blog.edit',compact('blog','categories','tags'));

    }

    public function update(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'tag_ids.*' => 'exists:tags,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'date' => 'nullable|date'
        ]);

        if($request->file('image')){
            $blog_img = Blog::where('id',$id)->first();
            unlink(public_path('uploads/blog/' . $blog_img->image));

            $new_name = $id . $request->title . '-' . now()->format('d M, Y H-i-s') . '.' . $request->file('image')->getClientOriginalExtension();
            $img = Image::make($request->file('image'))->fit(1200, 630, function ($constraint) {
                $constraint->upsize();
            });
            $img->save(base_path('public/uploads/blog/' . $new_name), 85);

            $blog = Blog::find($id);
            $blog->title = $request->title;
            $blog->description = $request->description;
            $blog->category_id = $request->category_id;
            $blog->image = $new_name;
            $blog->date = $request->date;
            $blog->updated_at = now();

            $blog->ManyRelationTags()->sync($request->tag_ids);
            $blog->save();

            return redirect()->route('blog.index')->with('success', 'Blog has been updated Successfully!');
        }else{
            $blog = Blog::find($id);
            $blog->title = $request->title;
            $blog->description = $request->description;
            $blog->category_id = $request->category_id;
            $blog->date = $request->date;
            $blog->updated_at = now();

            $blog->ManyRelationTags()->sync($request->tag_ids);
            $blog->save();

            return redirect()->route('blog.index')->with('success', 'Blog has been updated Successfully!');

        }

    }


      // blog delete

      public function delete($id) {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        $blog->update([
            'status' => 'draft',
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Blog Deleted Successfully!');
    }


    // trashed
    public function trash(){
        // $trashed = Blog::where('user_id',auth()->id())->latest()->paginate(3);
        $blog_trash = Blog::onlyTrashed()->where('user_id',auth()->id())->latest()->paginate(3);
        return view('dashboard.blog.trash',compact('blog_trash'));
    }

    // blog restore from trash
    public function restore($id){
        Blog::withTrashed()->where('id',$id)->restore();
        return back()->with('success', 'Blog Restored Successfully!');

    }

    // forcedelete from trashed
    public function forcedelete($id){
        Blog::withTrashed()->where('id',$id)->forceDelete();
        return back()->with('success', 'Blog Permanently Delete Successfully!');

    }

    // delete all trashed
    public function delete_all() {
        // Permanently delete all trashed blog posts
        Blog::onlyTrashed()->forceDelete();

        return back()->with('success', 'All trashed blogs have been permanently deleted.');
    }


        // feature status
        public function feature($id){

            $blog = Blog::where('id', $id)->first();

            if($blog->feature == 'active'){
                Blog::find($id)->update([
                    'feature' => 'deactive',

                    'updated_at' => now(),
                ]);
                return back()->with('success', 'Feature status deactivated successfull!');
            }else{
                Blog::find($id)->update([
                    'feature' => 'active',

                    'updated_at' => now(),
                ]);
                return back()->with('success', 'Feature status activated successfull!');
            }

        }


}
