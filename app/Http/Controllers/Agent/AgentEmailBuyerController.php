<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BuyerEmail;
use App\Models\Buyer;

class AgentEmailBuyerController extends Controller
{
    public function index(){
        $buyers = Buyer::orderBy('created_at', 'desc')->get();
        return view('agent-dashboard.email_buyer.send_email_to_buyer',compact('buyers'));
    }
    public function sendEmail(Request $request){
         // Validate the incoming data
         $request->validate([
            'recipientEmail' => 'required|array', // Ensures at least one email is selected
            'recipientEmail.*' => 'email', 
            'subject' => 'required|string|max:255',
            'email_content' => 'required|string',
        ]);

        // Send the email
        //Mail::to($request->recipientEmail)->send(new BuyerEmail($request->all()));
        foreach ($request->recipientEmail as $email) {
            Mail::to( $email)->send(new BuyerEmail($request->all()));
        }

        // Return a response (optional)
        return redirect()->back()->with('success', 'Email sent successfully!');

    }
}
