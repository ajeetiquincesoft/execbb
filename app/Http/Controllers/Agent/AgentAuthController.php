<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AgentAuthController extends Controller
{
    public function agentDashboard()
    {
        
        if(Auth::check()){
            return view('agent-dashboard.dashboard');
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
}
