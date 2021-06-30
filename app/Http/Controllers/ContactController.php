<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Mail\NotificationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::with(['user'])->get();
        return view('admin.contacts.index', compact('contacts'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $contact = new Contact();
       if ($request->ordernumber == ''){
            $contact->user_id = Auth::user()->id;
            $contact->email = Auth::user()->email;
            $contact->subject = $request->subject;
            $contact->description = $request->description;
            $data = $request->all();
        }else {
            $contact->user_id = Auth::user()->id;
            $contact->email = Auth::user()->email;
            $contact->ordernumber = $request->ordernumber;
            $contact->subject = $request->subject;
            $contact->description = $request->description;
            $data = $request->all();
        }

        $contact->save();
        Mail::to($contact->email)->send(new NotificationMail($data));
        Session::flash('form_send', 'Notification has been submitted, we contact u as soon as possible!');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //Komt uit hidden part in form de ID
        $contact = Contact::findOrFail($request->contact_id);
        $input = $request->all();
        $contact->update($input);
        Session::flash('updated_contact', 'The contact has been updated!');
        return redirect('admin/contacts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $contact = Contact::findOrFail($request->contact_id);
        //$category = Category::findOrFail($id);
        $contact->delete();
        Session::flash('deleted_contact', 'The contact has been deleted!');
        return redirect()->back();
    }
}


