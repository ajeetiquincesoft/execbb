<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agent;
use App\Models\SavedSearch;
use Illuminate\Support\Facades\Auth;

class BrokersController extends Controller
{
    public function index(Request $request){
        $query = $request->input('query');
        if ($request->has('brk_search') && Auth::check()) {
            $saveSearch = new SavedSearch();
            $saveSearch->user_id = Auth::id();
            $saveSearch->search_val = $query;
            $saveSearch->search_for = 'agent';
            $saveSearch->save();
            }
        $agents = Agent::query();
        if ($query) {
            // Split the query by space to separate first name and last name
            $nameParts = explode(' ', $query);
            
            // Check if there are at least two parts (first name and last name)
            if (count($nameParts) > 1) {
                // Search both FName and LName for the full name
                $agents = $agents->where(function ($query) use ($nameParts) {
                    $query->where('FName', 'LIKE', '%' . $nameParts[0] . '%')
                          ->where('LName', 'LIKE', '%' . $nameParts[1] . '%');
                });
            } else {
                // If there's only one part (e.g., just 'rahul'), search both fields
                $agents = $agents->where(function ($query) use ($nameParts) {
                    $query->where('FName', 'LIKE', '%' . $nameParts[0] . '%')
                          ->orWhere('LName', 'LIKE', '%' . $nameParts[0] . '%');
                });
            }
        }
        $agents = $agents->orderBy('created_at','desc')->paginate(9);
        return view('frontend.business-agent',compact('agents'));
    }
    public function brokerProfile($id){
        $agent = Agent::where('AgentUserRegisterId', $id)->first();
        $agents = Agent::where('AgentUserRegisterId', '!=', $id)->orderBy('created_at','desc')->limit(3)->get();
        return view('frontend.business-agent-profile',compact('agent','agents'));

    }
}
