<?php

namespace App\Http\Controllers\Dashboard;

use Session;
use Validator;
use App\Event;
use Intervention;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EventController extends Controller
{
    public function getEvents()
    {
        $events = Event::orderBy('id')->get();
        return view('dashboard.events.all', compact('events'));
    }

    public function getAddEvent()
    {
        return view('dashboard.events.add');
    }

    public function postEvent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'desc' => 'required',
            'date' => 'required|date',
            'img' => 'required|file|image'
        ]);
        if ($validator->fails()) {
            $error = $validator->messages();
            Session::flash('error',$error);
            return back()->withErrors($validator)->withInput();
        }
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            if (!file_exists(storage_path('app/public/events/'))) {
                $oldmask = umask(0);
                mkdir(storage_path('app/public/events/'), 0775, true);
                umask($oldmask);
            }
            $img_name = pathinfo(str_replace(" ","-",$image->getClientOriginalName()), PATHINFO_FILENAME);
            $name = $img_name . '-' . time() . '.' . $image->getClientOriginalExtension();
            $location = storage_path('app/public/events/'. $name);
            
            Intervention::make($image)->save($location,75);
            $request['thumbnail'] = asset('storage/app/public/events/'. $name);
        }
        if( Event::create($request->all()) ){
            Session::flash('success','Successfully saved.');
            return redirect()->route('events');
        }else{
            Session::flash('error','Error while saving data. Please try again later.');
            return redirect()->route('events');
        }
    }
    
    public function getEditEvent($id)
    {
        $event = Event::findOrFail($id);
        return view('dashboard.events.edit', compact('event'));
    }

    public function updateEvent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'desc' => 'required',
            'date' => 'required|date',
            'img' => 'nullable|file|image',
            'event_id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            $error = $validator->messages();
            Session::flash('error',$error);
            return back()->withErrors($validator)->withInput();
        }
        $event = Event::findOrFail($request['event_id']);
        if ($request->hasFile('img')) {
            // delete old img
            $destinationPath = storage_path('app/public/events/'.basename($event->thumbnail));
            if(file_exists($destinationPath)){
                @unlink($destinationPath);
            }
            // upload new img
            $image = $request->file('img');
            if (!file_exists(storage_path('app/public/events/'))) {
                $oldmask = umask(0);
                mkdir(storage_path('app/public/events/'), 0775, true);
                umask($oldmask);
            }
            $img_name = pathinfo(str_replace(" ","-",$image->getClientOriginalName()), PATHINFO_FILENAME);
            $name = $img_name . '-' . time() . '.' . $image->getClientOriginalExtension();
            $location = storage_path('app/public/events/'. $name);
            
            Intervention::make($image)->save($location,75);
            $request['thumbnail'] = asset('storage/app/public/events/'. $name);
        }
        if( $event->update($request->all()) ){
            Session::flash('success','Successfully updated.');
            return redirect()->route('events');
        }else{
            Session::flash('error','Error while saving data. Please try again later.');
            return redirect()->route('events');
        }
    }

    public function deleteEvent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_id' => 'required',
        ]);
        if ($validator->fails()) {
            $error = $validator->messages();
            Session::flash('error',$error);
            return back()->withErrors($validator)->withInput();
        }
        if( Event::find($request['event_id'])->delete() ){
            Session::flash('success','Successfully deleted.');
            return redirect()->route('events');
        }else{
            Session::flash('error','Error while saving data. Please try again later.');
            return redirect()->route('events');
        }
    }
}
