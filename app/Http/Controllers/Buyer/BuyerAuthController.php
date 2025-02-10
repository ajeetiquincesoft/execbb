<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuyerAuthController extends Controller
{
    public function buyerDashboard()
    {
        
        if(Auth::check()){
            /* return view('buyer-dashboard.dashboard'); */
            return view('frontend.buyer.buyer_dashboard');
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
}
