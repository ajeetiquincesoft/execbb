<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AgentreferralsController extends Controller
{
    public function index(){
         
        $agentId = auth()->user()->id;
        $key = rand(100000000, 999999999);
         $url = url('/register/ebb/buyer/') . '?agent_id=' . $agentId . '&key=' . $key;
        return view('agent-dashboard.buyer-referrals.index',['url' => $url]);
    }
}
