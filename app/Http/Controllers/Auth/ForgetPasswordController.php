<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class ForgetPasswordController extends Controller
{
    public function index(){
        return view('Auth.forget-password');
    }
    public function updatePasswordLink(Request $request){
        $request->validate([
            'email' => 'required|email'
        ]);
       // Retrieve the user by email
        $user = User::where('email', $request->email)->first();
        if (!$user) {
        return  redirect()->back()->withInput()->with('success_message','User not found in our records.');
        }
        $token = Str::random(60);
        // Store the token in the password_resets table
        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            [
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]
        );
        $user = User::where('email',$request->email)->first();
        // Construct your custom reset URL
        $resetUrl = config('app.url') . "/update/password?token={$token}&email=" . urlencode($request->email);
        // Send the reset link via email
        Mail::send('email.password-reset', ['url' => $resetUrl, 'user' => $user], function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Reset Password Notification');
        });
        return redirect()->back()->with('success_message','Link has been send to your email. please check');
    }
    public function updatePassword(Request $request){
        $email = $request->email;
        $token = $request->token;
        return view('Auth.update-password',compact('email','token'));
    }
    public function resetForgetPassword(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
            'token' => 'required'
        ]);
        // Retrieve the reset token data from the password_resets table
        $passwordReset = DB::table('password_resets')
        ->where('email', $request->email)
        ->where('token', $request->token)
        ->first();
        // Check if token exists and is still valid (for example, within 60 minutes)
        if (!$passwordReset || Carbon::parse($passwordReset->created_at)->addMinutes(60)->isPast()) {
           
            return  redirect()->back()->with('success_message','Invalid or expired token.');
        }
        // Retrieve the user by email
        $user = User::where('email', $request->email)->first();
        if (!$user) {
        return  redirect()->back()->with('success_message','User not found.');
        }
        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();
        // Delete the token from the password_resets table
        DB::table('password_resets')->where('email', $request->email)->delete();
        // Return success response
        return  redirect()->back()->with('success_message','Password has been successfully reset.');
        
    }
}
