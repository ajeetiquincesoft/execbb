<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Agent;
use Illuminate\Support\Facades\DB;
use App\Models\Activity;

class AgentLeadController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $loginAgentID = auth()->user()->id;
        $AgentData = Agent::where('AgentUserRegisterId', $loginAgentID)->first();
        $leads = DB::table('leads')->where('AgentID', $AgentData->AgentID);
        $categories = DB::table('categories')->pluck('BusinessCategory', 'CategoryID');
        $lead_status = DB::table('lead_status')->pluck('Status', 'LeadStatusID');
        $agents = User::with('agent_info')->where('role_name', 'agent')->get();
        if ($query) {
            $leads = DB::table('leads')
                ->leftJoin('categories', 'leads.Category', '=', 'categories.CategoryID')
                ->leftJoin('lead_status', 'leads.Status', '=', 'lead_status.LeadStatusID')
                ->select('leads.*', 'categories.BusinessCategory as category_name', 'lead_status.Status as status')
                ->where('leads.AgentID', $AgentData->AgentID) // Ensure only leads assigned to the agent are fetched
                ->where(function ($q) use ($query) {
                    $q->where('leads.SellerFName', 'LIKE', '%' . $query . '%')
                        ->orWhere('leads.SellerLName', 'LIKE', '%' . $query . '%')
                        ->orWhere('leads.BusName', 'LIKE', '%' . $query . '%')
                        ->orWhere('leads.Address', 'LIKE', '%' . $query . '%')
                        ->orWhere('leads.Phone', 'LIKE', '%' . $query . '%')
                        ->orWhere('leads.AppointmentDate', 'LIKE', '%' . $query . '%')
                        ->orWhere('categories.BusinessCategory', 'LIKE', '%' . $query . '%')
                        ->orWhere('lead_status.Status', 'LIKE', '%' . $query . '%');
                });
        }
        $leads = $leads->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('agent-dashboard.lead.index', compact('leads', 'categories', 'lead_status','agents'));
    }
    public function show($id)
    {
        $lead =  DB::table('leads')->where('LeadID', $id)->first();
        $loginAgentID = auth()->user()->id;
        $AgentData = Agent::where('AgentUserRegisterId', $loginAgentID)->first();
        $activities = Activity::latest()->paginate(10);
        //dd($lead->toSql(), $lead->getBindings());
        // Get the previous lead ID
        $previous = DB::table('leads')->where('LeadID', '<', $id)->where('AgentID', $AgentData->AgentID)->orderBy('LeadID', 'desc')->first();
        // Get the next lead ID
        $next = DB::table('leads')->where('LeadID', '>', $id)->where('AgentID', $AgentData->AgentID)->orderBy('LeadID', 'asc')->first();
        return view('agent-dashboard.lead.show', compact('lead', 'previous', 'next','activities'));
    }
}
