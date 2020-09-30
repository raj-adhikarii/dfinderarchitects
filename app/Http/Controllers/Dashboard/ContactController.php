<?php

namespace App\Http\Controllers\Dashboard;

use Session;
use Validator;
use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function getContactQueries()
    {
        $contacts = Contact::orderBy('id')->get();
        return view('dashboard.contacts.all', compact('contacts'));
    }

    public function toggleContactStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contact_id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            $error = $validator->messages()->first();
            Session::flash('error',$error);
            return back()->withErrors($validator)->withInput();
        }
        if( $contact = Contact::find($request['contact_id']) ){
            $contact->followed = !$contact->followed;
            $contact->update();
            Session::flash('success','Successfully saved.');
            return redirect()->route('contacts');
        }else{
            Session::flash('failure','Error while saving data. Please try again later.');
            return redirect()->route('contacts');
        }
    }

    public function deleteContactQuery(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contact_id' => 'required',
        ]);
        if ($validator->fails()) {
            $error = $validator->messages()->first();
            Session::flash('error',$error);
            return back()->withErrors($validator)->withInput();
        }
        $contact = Contact::findOrFail($request['contact_id']);
        if( $contact && $contact->followed  ){
            $contact->delete();
            Session::flash('success','Successfully deleted.');
            return redirect()->route('contacts');
        }else{
            Session::flash('error','Error while deleting data. Maybe its not followed yet. Please try again later.');
            return redirect()->route('contacts');
        }
    }
}
