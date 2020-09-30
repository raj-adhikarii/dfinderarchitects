<?php

namespace App\Http\Controllers\Dashboard;

use Session;
use Validator;
use App\Footer;
use Intervention;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SettingController extends Controller
{
    public function getFooters()
    {
        $footer = Footer::first();
        return view('dashboard.footers.all', compact('footer'));
    }

    public function getEditFooter()
    {
        $footer = Footer::first();
        return view('dashboard.footers.edit',compact('footer'));
    }

    public function updateFooter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'email' => 'required',
            'img' => 'nullable | image',
            'location' => 'required',
            'social_facebook' => 'required',
            'social_instagram' => 'required',
            'social_twitter' => 'required',
            'social_linkedin' => 'required',
            'footer_description' => 'required',
        ]);
        if ($validator->fails()) {
            $error = $validator->messages();
            Session::flash('error',$error);
            return back()->withErrors($validator)->withInput();
        }

        $footer = Footer::first();
        if ($request->hasFile('img')) {
            // delete old img
            if(!is_null($footer)){
                $destinationPath = storage_path('app/public/logos/'.basename($footer->logo));
                if(file_exists($destinationPath)){
                    @unlink($destinationPath);
                }
            }

            // upload new img
            $image = $request->file('img');
            if (!file_exists(storage_path('app/public/logos/'))) {
                $oldmask = umask(0);
                mkdir(storage_path('app/public/logos/'), 0775, true);
                umask($oldmask);
            }
            $img_name = pathinfo(str_replace(" ","-",$image->getClientOriginalName()), PATHINFO_FILENAME);
            $name = $img_name . '-' . time() . '.' . $image->getClientOriginalExtension();
            $location = storage_path('app/public/logos/'. $name);

            Intervention::make($image)->save($location,75);
            $request['logo'] = asset('storage/app/public/logos/'. $name);
        }

        $footer = Footer::first();
        if( is_null($footer) ){
            if(Footer::create($request->all())){
                Session::flash('success','Successfully updated.');
                return redirect()->route('footers');
            }else{
                Session::flash('error','Error while saving data. Please try again later.');
                return redirect()->route('footers');
            }
        }else{
            if($footer->update($request->all())){
                Session::flash('success','Successfully updated.');
                return redirect()->route('footers');
            }else{
                Session::flash('error','Error while saving data. Please try again later.');
                return redirect()->route('footers');
            }
        }
    }
}
