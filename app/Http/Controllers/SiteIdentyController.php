<?php

namespace App\Http\Controllers;

use App\Models\SiteIdenty;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SiteIdentyController extends Controller
{
    public function site_identity(){
        $identy = SiteIdenty::get()->first();
        return view('dashboard.siteIdenty.index', compact('identy'));
    }


    public function favicon_update(Request $request, $id){
        $request->validate([
            'favicon' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',


        ]);
        if($request->hasFile('favicon')){
            $new_name = 'favicon' .'-'. microtime().".".$request->file('favicon')->getClientOriginalExtension();

            $img = Image::make($request->file('favicon'))->fit(60, 60, function ($constraint) {
                $constraint->upsize();
            });
            $img->save(base_path('public/uploads/logo/' . $new_name), 100);

            SiteIdenty::find($id)->update([
                'favicon' => $new_name,
                'updated_at' => now(),
            ]);
            return back()->with('success', 'Favicon updated successfull!');
        }
    }

    public function logo_update(Request $request, $id){
        $request->validate([
            'logo_dark' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'logo_white' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',

        ]);

        if($request->hasFile('logo_white')){
            $new_name = 'logo_white' .'-'. microtime().".".$request->file('logo_white')->getClientOriginalExtension();

            $img = Image::make($request->file('logo_white'))->fit(200, 60, function ($constraint) {
                $constraint->upsize();
            });
            $img->save(base_path('public/uploads/logo/' . $new_name), 100);

            SiteIdenty::find($id)->update([
                'logo_white' => $new_name,
                'updated_at' => now(),
            ]);
        }

        if($request->hasFile('logo_dark')){
            $new_name = 'logo_dark' .'-'. microtime().".".$request->file('logo_dark')->getClientOriginalExtension();

            $img = Image::make($request->file('logo_dark'))->fit(200, 60, function ($constraint) {
                $constraint->upsize();
            });
            $img->save(base_path('public/uploads/logo/' . $new_name), 100);

            SiteIdenty::find($id)->update([
                'logo_dark' => $new_name,
                'updated_at' => now(),
            ]);
        }
        return back()->with('success', 'Logo updated successfull!');
    }

    public function title_update(Request $request, $id){
        $request->validate([
            'site_title' => 'required',
        ]);
        SiteIdenty::find($id)->update([
            'site_title' => $request->site_title,
            'updated_at' => now(),
        ]);
        return back()->with('success', 'Site title updated successfull!');
    }

    public function footer_update(Request $request, $id){
        $request->validate([
            'footer' => 'required',
        ]);
        SiteIdenty::find($id)->update([
            'footer' => $request->footer,
            'updated_at' => now(),
        ]);
        return back()->with('success', 'Footer updated successfull!');
    }


    // About section
    public function about_update(Request $request, $id){
        $request->validate([
            'about_text' => 'required|string',
            'about_image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',

        ]);
        if($request->hasFile('about_image')){
            $new_name = 'about_image' .'-'. microtime().".".$request->file('about_image')->getClientOriginalExtension();

            $img = Image::make($request->file('about_image'))->fit(1200, 700, function ($constraint) {
                $constraint->upsize();
            });
            $img->save(base_path('public/uploads/others/' . $new_name), 100);
            SiteIdenty::find($id)->update([
                'about_text' => $request->about_text,
                'about_image' => $new_name,
                'updated_at' => now(),
            ]);

        }else{
            SiteIdenty::find($id)->update([
                'about_text' => $request->about_text,
                'updated_at' => now(),
            ]);
        }
        return back()->with('success', 'About page updated successfull!');
    }

    // Contact section
    public function contact_update(Request $request, $id){
        $request->validate([
            'contact_text' => 'required|string',
            'contact_image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',

        ]);
        if($request->hasFile('contact_image')){
            $new_name = 'contact_image' .'-'. microtime().".".$request->file('contact_image')->getClientOriginalExtension();

            $img = Image::make($request->file('contact_image'))->fit(900, 980, function ($constraint) {
                $constraint->upsize();
            });
            $img->save(base_path('public/uploads/others/' . $new_name), 100);
            SiteIdenty::find($id)->update([
                'contact_text' => $request->contact_text,
                'contact_image' => $new_name,
                'updated_at' => now(),
            ]);

        }else{
            SiteIdenty::find($id)->update([
                'contact_text' => $request->contact_text,
                'updated_at' => now(),
            ]);
        }
        return back()->with('success', 'Contact page updated successfull!');
    }
}
