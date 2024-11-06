<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OfferController extends Controller
{
     // Show the form for a specific step
     public function showForm(Request $request)
     {
       // session()->forget(['offerData', 'step']);
         // Retrieve the current step from the session, default to 1
         $step = session('step', 1);
         $offerData = session('offerData', []); // Retrieve saved form data from session
        //dd($step);
         return view('admin.offer.create', compact('step', 'offerData'));
     }
 
     // Process the form data and move to the next step
     public function processForm(Request $request)
     {
         $step = session('step', 1);
 
         // Logic to handle form submission based on current step
         if ($step == 1) {
             // Save step 1 data
         } elseif ($step == 2) {
             // Save step 2 data
         } elseif ($step == 3) {
             // Save step 3 data
         }elseif ($step == 4) {
            // Save step 4 data
        }elseif ($step == 5) {
            // Save step 5 data
        }elseif ($step == 6) {
            // Save step 6 data
        }
 
         // Update the session with the next step
         if ($request->has('next')) {
             $step = $step + 1;
         }
 
         if ($request->has('previous')) {
             $step = $step - 1;
         }
 
         // Store the new step in the session
         session(['step' => $step]);
         return redirect()->route('offer.form');
     }
 
     // Validate data for each step
     private function validateStep(Request $request, $step)
     {
         $rules = [];
 
         switch ($step) {
             case 1:
                 $rules = [
                     'name' => 'required|string|max:255',
                     'email' => 'required|email|unique:buyers,email',
                 ];
                 break;
             case 2:
                 $rules = [
                     'phone' => 'required|string|max:15',
                     'address' => 'required|string',
                 ];
                 break;
             case 3:
                 $rules = [
                     'city' => 'required|string',
                     'postal_code' => 'required|numeric',
                 ];
                 break;
         }
 
         $request->validate($rules);
     }
 
     // Save data to the database
     private function saveToDatabase($buyerData)
     {
         $finalData = array_merge(...array_values($buyerData)); // Flatten array to save all data at once
         //Buyer::create($finalData); // Save to the database
     }
}
