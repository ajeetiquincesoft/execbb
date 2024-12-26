<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agent;

class BrokersController extends Controller
{
    public function index(Request $request){
        $query = $request->input('query');
        $agents = Agent::query();
        if ($query) {
            $agents = Agent::where('FName', 'LIKE', '%' . $query . '%')
                ->orWhere('LName', 'LIKE', '%' . $query . '%');
        }
        $agents = $agents->orderBy('created_at','desc')->paginate(9);
        return view('frontend.business-agent',compact('agents'));
    }
    public function brokerProfile($id){
        $agent = Agent::where('AgentUserRegisterId', $id)->orderBy('created_at','desc')->first();
        $agents = Agent::where('AgentUserRegisterId', '!=', $id)->orderBy('created_at','desc')->limit(3)->get();
        return view('frontend.business-agent-profile',compact('agent','agents'));

    }
}
