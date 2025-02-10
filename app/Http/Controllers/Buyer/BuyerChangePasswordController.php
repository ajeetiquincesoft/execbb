<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class BuyerChangePasswordController extends Controller
{
    public function index(){
        return view('frontend.buyer.buyer_change_password');
    }
    public function buyerChangePassword(Request $request){
        
        $request->validate([
           'old_password' => 'required',
           'password' => 'required|confirmed|min:6',
           'password_confirmation' => 'required'
       ]);

     
       $user = auth()->user();

     
       if (!Hash::check($request->old_password, $user->password)) {
           return  redirect()->back()->with('error_message','The provided old password does not match our records.');
       }

       $update_password = User::find($user->id);
       $update_password->password = Hash::make($request->password);
       $update_password->save();
       return redirect()->back()->with('success_message','Password updated successfully!');

   }
}
