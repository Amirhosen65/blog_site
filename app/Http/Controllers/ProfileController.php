<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('dashboard.profile.index');
    }

    // name update
    public function name_update(Request $request, $id){

        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        User::find($id)->update([
            'name' => $request->name,
            'updated_at' => now(),
        ]);
        return back()->with('success', 'Name updated successfull!');
    }

    // email update
    public function email_update(Request $request, $id){

        $request->validate([
            'email' => 'required|email|max:255|unique:users,email',
        ]);
        User::find($id)->update([
            'email' => $request->email,
            'created_at' => now(),
        ]);
        return back()->with('success', 'Email updated successfull!');
    }

    // image update
    public function image_update(Request $request, $id){

        $request->validate([
            'image' => 'required|image',
        ]);

        if(auth()->user()->image == 'profile.png'){
            if($request->hasFile('image')){
                $new_name = auth()->id()."-". auth()->user()->name.".".$request->file('image')->getClientOriginalExtension();

            $img = Image::make($request->file('image'))->fit(400, 487, function ($constraint) {$constraint->upsize();});
            $img->save(base_path('public/uploads/default/'.$new_name), 85);

            User::find($id)->update([
                'image' => $new_name,
                'created_at' => now(),
            ]);
            return back()->with('success', 'Image updated successfull!');
        }

        }else{
            unlink(public_path('uploads/default/' . auth()->user()->image));

            if($request->hasFile('image')){
                $new_name = auth()->id()."-". auth()->user()->name.".".$request->file('image')->getClientOriginalExtension();

            $img = Image::make($request->file('image'))->resize(400, 487);
            $img->save(base_path('public/uploads/default/'.$new_name), 60);

            User::find($id)->update([
                'image' => $new_name,
                'created_at' => now(),
            ]);
                return back()->with('success', 'Image updated successfull!');
            }
        }

    }

    // password update
    public function password_update(Request $request, $id){
        $request->validate([
            'current_password' => "required",
            'password' => "required|confirmed",
        ]);
        if(Hash::check($request->current_password, auth()->user()->password)){
            User::findOrFail($id)->update([
                'password' => $request->password,
                'create_at' => now(),
            ]);
            return back()->with('success', 'Password updated successfull!');
        }else{
            return back()->with(['error_alert' => 'The provided current password is incorrect.'])->withInput();
        }
    }

}
