<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{
    public function index(){
        return view('Auth.resetpasswordform');

    }
    public function resetpasswordlink(Request $request){
    $token = Str::random(60);
    DB::table('password_resets')->where('email', $request->email)->delete();
   $create =  DB::table('password_resets')->insert([
        'email' => $request->email,
        'token' => $token,
        'created_at' => Carbon::now()
    ]);
      // Construct your custom reset URL
      $resetUrl = config('app.url') . "/reset-password?token={$token}&email=" . urlencode($request->email);
      // Send the reset link via email
      Mail::send('email.password-reset', ['url' => $resetUrl], function ($message) use ($request) {
          $message->to($request->email)
              ->subject('Reset Password Notification');
      });
    if($create){
        return redirect()->back()->with(['success_message' => 'Reset password link send to your email, please  check']);
    }
   // return $token;

    }
}
