<?php

namespace App\Http\Controllers\Dashboard;

use App\Gallery;
use Intervention;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    public function uploadProjectGallery(Request $request)
    {
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            
            $dir = date('Y-m') .'/'.date('d') .'/';
            $date =   date('Y-m') .'/'.date('d') .'/';
            if (!file_exists(storage_path('app/public/projects') .'/'.$dir )) {
                $oldmask = umask(0);
                mkdir(storage_path('app/public/projects') .'/'.$dir , 0775, true);
                umask($oldmask);
            }
            
            $img_name =$date . pathinfo(str_replace(" ","-",$image->getClientOriginalName()), PATHINFO_FILENAME);
            $name = $img_name . '-' . time() . '.' . $image->getClientOriginalExtension();
            $location = storage_path('app/public/projects/'. $name);

            Intervention::make($image)->save($location,75);
            
            return response()->json([
                'success' => true,
                'message' => 'Images Uploaded Successfully',
                'image' => asset('storage/app/public/projects/'.$name)
            ],200);
        }else{
            return response()->json(['message' => 'Error uploading images. Please try again later'],500);
        }
    }

    public function ajaxDeleteProjectGallery(Request $request)
    {
        if(Gallery::where('source',$request['url'])->delete() ){
            $this->deleteImageFromServer($request['url']);
            return 'success';
        }elseif($this->deleteImageFromServer($request['url'])){
            return 'success';
        }else{
            return 'failure';
        }
    }

    public function deleteImageFromServer($file_path)
    {
        $url_array = explode(pathinfo($file_path)['filename'],$file_path);
        $dir = substr($url_array[0],-11);
        $destinationPath = storage_path('app/public/projects/'.$dir.basename($file_path));
        if(file_exists($destinationPath)){
            @unlink($destinationPath);
        }else{
            return false;
        }
    }
}
