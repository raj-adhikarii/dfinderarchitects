<?php

namespace App\Http\Controllers\Dashboard;

use Session;
use Validator;
use App\About;
use Intervention;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AboutController extends Controller
{
   public function getAbouts()
    {
        $about = About::first();
        return view('dashboard.about.all', compact('about'));
    }

    public function getEditAbout()
    {
        $about = About::first();
        return view('dashboard.about.edit',compact('about'));
    }

    public function updateAbout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'phylosophy' => 'required',
            'vision' => 'required',
            'img' => 'nullable|image'
        ]);
        if ($validator->fails()) {
            $error = $validator->messages();
            Session::flash('error',$error);
            return back()->withErrors($validator)->withInput();
        }

        $about = About::first();
        if ($request->hasFile('img')) {
            // delete old img
            if(!is_null($about)){
                $destinationPath = storage_path('app/public/abouts/'.basename($about->image));
                if(file_exists($destinationPath)){
                    @unlink($destinationPath);
                }
            }

            // upload new img
            $image = $request->file('img');
            if (!file_exists(storage_path('app/public/abouts/'))) {
                $oldmask = umask(0);
                mkdir(storage_path('app/public/abouts/'), 0775, true);
                umask($oldmask);
            }
            $img_name = pathinfo(str_replace(" ","-",$image->getClientOriginalName()), PATHINFO_FILENAME);
            $name = $img_name . '-' . time() . '.' . $image->getClientOriginalExtension();
            $location = storage_path('app/public/abouts/'. $name);

            Intervention::make($image)->save($location,75);
            $request['image'] = asset('storage/app/public/abouts/'. $name);
        }

        if( is_null($about) ){
            if(About::create($request->all())){
                Session::flash('success','Successfully updated.');
                return redirect()->route('abouts');
            }else{
                Session::flash('error','Error while saving data. Please try again later.');
                return redirect()->route('abouts');
            }
        }else{
            if($about->update($request->all())){
                Session::flash('success','Successfully updated.');
                return redirect()->route('abouts');
            }else{
                Session::flash('error','Error while saving data. Please try again later.');
                return redirect()->route('abouts');
            }
        }
    }
}
