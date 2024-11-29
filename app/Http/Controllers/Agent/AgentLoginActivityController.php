<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoginActivity;

class AgentLoginActivityController extends Controller
{
    public function index(Request $request)
    {
        // Fetch all login activities
       /*  $loginActivities = LoginActivity::with('user')->latest()->paginate(10); */
        $search_query = $request->input('query');
        $loginActivities = LoginActivity::query();
        if ($search_query) {
                
            $loginActivities = LoginActivity::with('user')  // Eager load the user relationship
                                    ->whereHas('user', function ($query) use ($search_query) {
                                        $query->where('name', 'like', '%' . $search_query . '%')
                                        ->orWhere('logged_in_at', 'like', '%' . $search_query . '%');
                                    });
    }
    
    $loginActivities = $loginActivities->orderBy('created_at', 'desc')->paginate(20);

        return view('agent-dashboard.login_activities.index', compact('loginActivities'));
    }
}
