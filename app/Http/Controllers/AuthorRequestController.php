<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthorRequestController extends Controller
{
    public function authors_approved($id){
        $author = User::where('id', $id)->first();
        if($author->author_status == 'requests'){
            User::find($id)->update([
                'author_status' => 'approved',
                'role' => 'author',
                'updated_at' => now(),
            ]);
            return back()->with('success','Author request approved!');
        }
    }

    public function authors_rejected($id){
        $author = User::where('id', $id)->first();
        if($author->author_status == 'requests'){
            User::find($id)->update([
                'author_status' => 'rejected',
                'updated_at' => now(),
            ]);
            return back()->with('success','Author request rejected!');
        }
    }

    public function authors_list(){
        $users = User::where('approve_status', true)->where('block_status', false)->where('author_status', 'approved')->latest()->paginate(10);
        return view('dashboard.authors.author_list', compact('users'));
    }

    // Auhtor ban
    public function authors_block($id){
        $author = User::where('id', $id)->first();
        if($author->block_status == false){
            User::find($id)->update([
                'block_status'=> true,
            ]);
            return back()->with('success','Author blocked successfull!');
        }
    }

    public function authors_requests($id){
        $author = User::where('id', $id)->first();
        if($author->author_status == 'none'){
            User::find($id)->update([
                'author_status' => 'requests',
                'updated_at' => now(),
            ]);
            return back()->with('success','Author request send successfully!');
        }
    }

}
