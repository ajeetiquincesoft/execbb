<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\ContactFormSubmission;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function index(){
        $states = DB::table('states')->get();
        return view('frontend.contact-us',compact('states'));
    }
    public function sendEmail(Request $request){
        
        // Validate form data
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'zip' => 'required|string|max:10',
            'day_time_phone' => 'required|string|max:15',
            'evening_phone' => 'nullable|string|max:15',
            'cellular_phone' => 'nullable|string|max:15',
            'email' => 'required|email|max:255',
            'time_to_connect' => 'required|string|max:255',
            'message' => 'nullable|string',
            'role' => 'nullable|string',
        ]);
        //dd($request->all());
        // Send the email
        $content = html_entity_decode($request->message);
        $request->merge([
            'message_content' => $content,
        ]);
        Mail::to('santosh@yopmail.com')->send(new ContactFormSubmission($request->all()));

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Your message has been sent successfully!');

    }
}
