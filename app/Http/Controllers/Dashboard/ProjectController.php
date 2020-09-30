<?php

namespace App\Http\Controllers\Dashboard;

use Session;
use Validator;
use App\Project;
use App\Gallery;
use App\Category;
use Intervention;
use App\Thumbnail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProjectController extends Controller
{
    public function getProjects()
    {
        $projects = Project::orderBy('id')->get();
        return view('dashboard.projects.all',compact('projects'));
    }

    public function getAddProject()
    {
        $categories = Category::whereNull('parent_id')->orderBy('name')->get();
        return view('dashboard.projects.add', compact('categories'));
    }

    public function postNewProject(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'cate_id' => 'required|integer',
            'desc' => 'required',
            'info' => 'required',
            'images' => 'required',
            'thumbnail' => 'required|image',
        ]);
        if ($validator->fails()) {
            $error = $validator->messages();
            Session::flash('error',$error);
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            if (!file_exists(storage_path('app/public/projects/thumbnails/'))) {
                $oldmask = umask(0);
                mkdir(storage_path('app/public/projects/thumbnails/'), 0775, true);
                umask($oldmask);
            }
            $img_name = pathinfo(str_replace(" ","-",$image->getClientOriginalName()), PATHINFO_FILENAME);
            $name = $img_name . '-' . time() . '.' . $image->getClientOriginalExtension();
            $location = storage_path('app/public/projects/thumbnails/'. $name);

            Intervention::make($image)->save($location,75);
            $data['thumbnail'] = asset('storage/app/public/projects/thumbnails/'. $name);
        }

        if( $project = Project::create($data) ){
            if( isset($request['images']) ) {
                $images = explode(',',$request['images']);
                foreach( $images as $image ) {
                    Gallery::create([
                        'project_id' => $project->id,
                        'source' => $image,
                    ]);
                }
            }
            Session::flash('success','Successfully saved.');
            return redirect()->route('projects');
        }else{
            Session::flash('error','Error while saving data. Please try again later.');
            return redirect()->route('projects');
        }
    }

    public function getEditProject($id)
    {
        $project = Project::findOrFail($id);
        if( !is_null($project) ){
            $categories = Category::whereNull('parent_id')->orderBy('name')->get();
            return view('dashboard.projects.edit',compact('categories','project'));
        }else{
            return abort(404);
        }
    }

    public function updateProject(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_id' => 'required|integer',
            'name' => 'required|string|min:3',
            'cate_id' => 'required|integer',
            'desc' => 'required',
            'info' => 'required',
            'images' => 'required',
            'thumbnail' => 'image'
        ]);
        if ($validator->fails()) {
            $error = $validator->messages();
            Session::flash('error',$error);
            return back()->withErrors($validator)->withInput();
        }

        $project = Project::findOrFail($request['project_id']);
        $data = $request->all();
        if ($request->hasFile('thumbnail')) {
            // delete old img
            $destinationPath = storage_path('app/public/projects/thumbnails/'.basename($project->thumbnail));
            if(file_exists($destinationPath)){
                @unlink($destinationPath);
            }

            $image = $request->file('thumbnail');
            if (!file_exists(storage_path('app/public/projects/thumbnails/'))) {
                $oldmask = umask(0);
                mkdir(storage_path('app/public/projects/thumbnails/'), 0775, true);
                umask($oldmask);
            }
            $img_name = pathinfo(str_replace(" ","-",$image->getClientOriginalName()), PATHINFO_FILENAME);
            $name = $img_name . '-' . time() . '.' . $image->getClientOriginalExtension();
            $location = storage_path('app/public/projects/thumbnails/'. $name);

            Intervention::make($image)->save($location,75);
            $data['thumbnail'] = asset('storage/app/public/projects/thumbnails/'. $name);
        }

        if( $project->update($data) ){
            if( isset($request['images']) ) {
                $images = explode(',',$request['images']);
                Gallery::where('project_id',$project->id)->delete();
                foreach( $images as $image ) {
                    Gallery::create([
                        'project_id' => $project->id,
                        'source' => $image,
                    ]);
                }
            }
            Session::flash('success','Successfully updated.');
            return redirect()->route('projects');
        }else{
            Session::flash('error','Error while saving data. Please try again later.');
            return redirect()->route('projects');
        }
    }

    public function deleteProject(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_id' => 'required',
        ]);
        if ($validator->fails()) {
            $error = $validator->messages();
            Session::flash('error',$error);
            return back()->withErrors($validator)->withInput();
        }
        $project = Project::findOrFail($request['project_id']);
        foreach($project->galleries as $image ){
            app('App\Http\Controllers\Dashboard\GalleryController')->deleteImageFromServer($image['source']);
            Gallery::where('source',$image['source'])->delete();
        }
        if( $project->delete() ){
            Session::flash('success','Successfully deleted.');
            return redirect()->route('projects');
        }else{
            Session::flash('error','Error while saving data. Please try again later.');
            return redirect()->route('projects');
        }
    }
}
