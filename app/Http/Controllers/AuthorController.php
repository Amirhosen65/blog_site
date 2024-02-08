<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthorController extends Controller
{
    public function register_view(){
        return view('frontend.authorRegister.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'g-recaptcha-response' => 'required|captcha',
        ], [
            'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
            'g-recaptcha-response.captcha' => 'Captcha error! Try again later or contact the site admin.',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'user',
            'password' => bcrypt($request->password),
        ]);

        $mail = User::where('email', $request->email)->first();

        $mail->sendEmailVerificationNotification();

        // Redirect with success message

        return redirect()->route('author.login.view')->with('email', $request->email)->with('password', $request->password)->with('success', 'New user registered successfully. Please check your email for verification.');
    }

    public function login_view(){
        return view('frontend.authorRegister.login');
    }

    public function login(Request $request){
        $request->validate([
            'email'=> 'required|email',
            'password'=> 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password'=> $request->password, 'approve_status' => true], $request->remember)) {
            $user = User::where('email', $request->email)->orWhere('password', $request->password)->first();
            $user->sendEmailVerificationNotification();
            return redirect()->route('home')->with('success','Log in successfull!');
        }else{
            return back()->with('error','Your request is pending approval from the administrator.');
        }
    }

    public function authors(){
        $users = User::where('author_status', 'requests')->latest()->paginate(10);
        return view('dashboard.authors.index', compact('users'));
    }


// author profile
    public function author_profile($id){
        $author = User::where('id',$id)->first();
        $blogs = Blog::where("user_id",$id)->latest()->paginate(10);
        $categories = Category::where('status','active')->latest()->get();
        $tags = Tag::where('status', 'active')->get();
        $popular_blogs = Blog::where('status','published')->orderBy('visitor_count','desc')->take(5)->get();
        return view('frontend.authorProfile.index', compact('author','blogs','categories','tags','popular_blogs'));
    }

// author list
public function authors_all(){
    $authors = User::where('approve_status', true)->where('block_status', false)->where('author_status', 'approved')->latest()->paginate(10);
    $categories = Category::where('status','active')->latest()->get();
    $tags = Tag::where('status', 'active')->get();
    $popular_blogs = Blog::where('status','published')->orderBy('visitor_count','desc')->take(5)->get();

    return view('frontend.authorProfile.authors', compact('authors','categories','tags','popular_blogs'));
}


}
