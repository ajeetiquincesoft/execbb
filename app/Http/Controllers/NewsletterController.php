<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsLetterSubscriber;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterSubscriptionConfirmation;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    public function subscribeNewsletter(Request $request){
        // Validate form data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255|unique:news_letter_subscribers,Email',
        ]);
        // Check if validation fails
        if ($validator->fails()) {
            // Return a JSON response with the errors
            return response()->json([
                'errors' => $validator->errors()
            ], 422); // 422 is Unprocessable Entity status code for validation errors
        }
        $subscriber = new NewsLetterSubscriber();
        $subscriber->Email = $request->email;
        $subscriber->save();
        Mail::to($request->email)->send(new NewsletterSubscriptionConfirmation($subscriber));
         if($subscriber){
            return response()->json([
                'success' => true,
                'message' => 'Thank you for subscribing!'
            ]);
         }
         else{
            return response()->json([
                'success' => false,
                'message' => 'There was an error saving your email. Please try again.'
            ]);
         }
        

    }
}
