<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereNotIn('role', ['administrator'])->latest()->paginate(10);
        return view('dashboard.users.index', compact('users'));
    }

    public function requests(){
        $users = User::where('approve_status', false)->latest()->paginate(10);
        return view('dashboard.users.requests', compact('users'));
    }

    public function add_view(){

        return view('dashboard.users.add');
    }

    public function add(Request $request)
{
    // Validate the request data
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:8|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
    ]);

        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password),
            'created_at' => now(),
        ]);

        // Redirect with success message
        return back()->with('success', 'New user added successfully');
    }

    // User delete

    public function delete($id) {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('delete_success', 'User Deleted Successfully!');
    }

    // user information edit
    public function edit_view($id)
    {
        $user = User::where('id', $id)->first();
        return view("dashboard.users.edit", compact('user'));
    }


    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string',
            'email'=> 'required|email',
        ]);

        User::find($id)->update([
            'name' => $request->name,
            'role' => $request->role,
            'email' => $request->email,
            'updated_at' => now(),
        ]);
        return redirect()->route('users.index')->with('success', 'User information updated successfull!');

    }

    public function request_approve($id){
        $user = User::where('id', $id)->first();
        if($user->approve_status == false){
            User::find($id)->update([
                'approve_status' => true,
                'updated_at' => now(),
            ]);
            return back()->with('success','User request approved successfully!');
        }
    }

}
