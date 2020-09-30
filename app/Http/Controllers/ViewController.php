<?php

namespace App\Http\Controllers;

use Session;
use Validator;
use App\Event;
use App\About;
use App\Footer;
use App\Project;
use App\Contact;
use App\Category;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function getIndex()
    {
        $projects = Project::with('category')->inRandomOrder()->take(5)->get();
        return view('index', compact('projects') )->with('removeFooter', true);
    }

    public function getProjects()
    {
        $projects = Project::with('category')->orderBy('id')->get();
        $categories_ids = Project::whereNotNull('cate_id')->distinct('cate_id')->pluck('cate_id');
        $categories = Category::whereIn('id', $categories_ids)->take(6)->get();
        return view('projects', compact('projects','categories'));
    }

    public function getProjectDetail($id)
    {
        $project = Project::findOrFail($id);
        return view('projectDetail', compact('project'));
    }

    public function getEvents()
    {
        $events = Event::orderBy('id')->get();
        return view('events', compact('events'));
    }

    public function getEventDetail($id)
    {
        $event = Event::findOrFail($id);
        return view('eventDetail', compact('event'));
    }

    public function getAbout()
    {
        $about = About::first();
        return view('about', compact('about'));
    }

    public function getContact()
    {
        $footer = Footer::first();
        return view('contact', compact('footer'));
    }

    public function postContact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'phone' => 'required',
            'subject' => 'required|string',
            'message' => 'required',
        ]);
        if ($validator->fails()) {
            $error = $validator->messages()->first();
            Session::flash('error',$error);
            return back()->withErrors($validator)->withInput();
        }
        if(Contact::create($request->all())){
            Session::flash('success','Message delivered successfully.');
            return redirect()->route('home-contacts');
        }else{
            Session::flash('error','Error while sending data. Please try again later.');
            return abort(500);
        }
    }
}
