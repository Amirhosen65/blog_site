<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    public function index(){
        $feature_blogs = Blog::where('feature', 'active')->get();
        $categories = Category::where('status','active')->latest()->get();
        $tags = Tag::where('status', 'active')->get();
        $blogs = Blog::where('status','published')->latest()->paginate(10);
        $popular_blogs = Blog::where('status','published')->orderBy('visitor_count','desc')->take(5)->get();
        return view('frontend.root.index',[
            'feature_blogs'=> $feature_blogs,
            'categories'=> $categories,
            'blogs'=> $blogs,
            'tags'=> $tags,
            'popular_blogs'=> $popular_blogs,
        ]);
    }

    public function blogs(){
        $blogs = Blog::where('status','published')->latest()->paginate(10);
        return view('frontend.blogs.blogs',[
            'blogs'=> $blogs,

        ]);
    }

    public function contacts(){
        return view('frontend.contacts.contacts');
    }


    // contacts form mail
    public function contacts_form(Request $request){
        $request->validate([
            'name'=> 'required|string',
            'email'=> 'required|email',
            'subject'=> 'required|string',
            'message'=> 'required|string',
            'g-recaptcha-response' => 'required|captcha'

        ], [
            'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
            'g-recaptcha-response.captcha' => 'Captcha error! Try again later or contact the site admin.',
        ]);

        Contact::insert([
            'auth_id'=> auth()->id(),
            'name'=> $request->name,
            'email'=> $request->email,
            'subject'=> $request->subject,
            'message'=> $request->message,
            'created_at'=> now(),

        ]);
        Mail::to($request->email)->send(new ContactMail($request->except('_token')));
        return back()->with('success', 'Your message was sent successfully.');
    }

    // contact mailbox
    public function mailbox(){
        $mailbox = Contact::latest()->get();
        return view('dashboard.contactMailbox.index', compact('mailbox'));
    }

    public function mail_delete($id){
        $mailbox = Contact::find($id);
        $mailbox->delete();
        return back()->with('success','Mail deleted successfully!');
    }

}
