<?php

namespace App\Http\Controllers\Dashboard;

use Hash;
use Auth;
use Session;
use Validator;
use Intervention;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function getDashboard()
    {
        return view('dashboard.index');
    }

    public function getDashboardLogin()
    {
        return view('dashboard.login');
    }

    public function getForgotPassword()
    {
        return view('dashboard.forgot-password');
    }

    public function getResetPassword()
    {
        return view('dashboard.reset-password');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('dashboard.login');
    }

    public function getUserProfile(){
        $user = Auth::user();
        return view('dashboard.profile.view', compact('user'));
    }

    public function getEditUserProfile(){
        $user = Auth::user();
        return view('dashboard.profile.edit', compact('user'));
    }

    public function updateUserProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'img' => 'nullable'
        ]);
        if ($validator->fails()) {
            $error = $validator->messages();
            Session::flash('error',$error);
            return back()->withErrors($validator)->withInput();
        }
        $data = $request->except('password','email');
        if( $user = Auth::user() ){
            $user->update($data);
            if ($request->hasFile('img')) {
                $image = $request->file('img');
                if (!file_exists(storage_path('app/public/avatars/'))) {
                    $oldmask = umask(0);
                    mkdir(storage_path('app/public/avatars/'), 0775, true);
                    umask($oldmask);
                }
                $img_name = pathinfo(str_replace(" ","-",$image->getClientOriginalName()), PATHINFO_FILENAME);
                $name = $img_name . '-' . time() . '.' . $image->getClientOriginalExtension();
                $location = storage_path('app/public/avatars/'. $name);
                
                Intervention::make($image)->save($location,75);
                $user->profile = asset('storage/app/public/avatars/'. $name);
            }
            $user->update();
            Session::flash('success','Successfully saved.');
            return redirect()->route('user-profile');
        }else{
            Session::flash('error','Error while saving data. Please try again later.');
            return redirect()->route('user-profile');
        }
    }

    public function updateUserPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|string',
            'password' => 'required|string|min:6|confirmed'
        ]);
        if ($validator->fails()) {
            $error = $validator->messages();
            Session::flash('error',$error);
            return back()->withErrors($validator)->withInput();
        }
        $user = Auth::user();
        if (Hash::check($request['old_password'], $user->password)) {
            $user->password = Hash::make($request->password);
            $user->update();
            Session::flash('success','Successfully saved.');
            return redirect()->route('user-profile');
        }else{
            Session::flash('error','Error while saving data. Please try again later.');
            return redirect()->route('user-profile');
        }
    }
}
