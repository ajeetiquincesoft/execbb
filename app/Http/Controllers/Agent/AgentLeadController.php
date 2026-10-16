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
        $query = trim($request->input('query', ''));

        $leads = DB::table('leads')
            ->leftJoin(
                'categories',
                'leads.Category',
                '=',
                'categories.CategoryID'
            )
            ->leftJoin(
                'lead_status',
                'leads.Status',
                '=',
                'lead_status.LeadStatusID'
            )
            ->leftJoin(
                'agents',
                'leads.AgentID',
                '=',
                'agents.AgentID'
            )
            ->select(
                'leads.*',
                'leads.AgentID as lead_agent_id',
                'categories.BusinessCategory as category_name',
                'lead_status.Status as status',
                'agents.FName as agent_fname',
                'agents.LName as agent_lname'
            );

        if ($query !== '') {
            $search = '%' . $query . '%';

            $leads->where(function ($q) use ($search) {
                $q->where('leads.SellerFName', 'LIKE', $search)
                    ->orWhere('leads.SellerLName', 'LIKE', $search)
                    ->orWhere('leads.BusName', 'LIKE', $search)
                    ->orWhere('leads.Address', 'LIKE', $search)
                    ->orWhere('leads.Phone', 'LIKE', $search)
                    ->orWhere('leads.AppointmentDate', 'LIKE', $search)
                    ->orWhere('categories.BusinessCategory', 'LIKE', $search)
                    ->orWhere('lead_status.Status', 'LIKE', $search)
                    ->orWhere('agents.FName', 'LIKE', $search)
                    ->orWhere('agents.LName', 'LIKE', $search)
                    ->orWhereRaw(
                        "CONCAT(
                    COALESCE(agents.FName, ''),
                    ' ',
                    COALESCE(agents.LName, '')
                ) LIKE ?",
                        [$search]
                    );
            });
        }

        $leads = $leads
            ->orderBy('leads.created_at', 'desc')
            ->paginate(10)
            ->appends($request->except('page'));

        $categories = DB::table('categories')
            ->pluck('BusinessCategory', 'CategoryID');

        $lead_status = DB::table('lead_status')
            ->pluck('Status', 'LeadStatusID');

        $agents = User::with('agent_info')
            ->where('role_name', 'agent')
            ->get();

        return view(
            'agent-dashboard.lead.index',
            compact('leads', 'categories', 'lead_status', 'agents')
        );
    }
    public function show($id)
    {
        $loginAgentID = auth()->user()->id;

        $AgentData = Agent::where(
            'AgentUserRegisterId',
            $loginAgentID
        )->first();

        if (!$AgentData) {
            return redirect()->back()
                ->with('err_message', 'Agent details not found.');
        }

        // Get lead with category and agent names
        $lead = DB::table('leads')
            ->leftJoin(
                'categories',
                'leads.Category',
                '=',
                'categories.CategoryID'
            )
            ->leftJoin(
                'agents',
                'leads.AgentID',
                '=',
                'agents.AgentID'
            )
            ->where('leads.LeadID', $id)
            ->select(
                'leads.*',
                'categories.BusinessCategory as category_name',
                'agents.FName as agent_fname',
                'agents.LName as agent_lname'
            )
            ->first();

        if (!$lead) {
            return redirect()->back()
                ->with('err_message', 'Lead not found or not assigned to you.');
        }

        $activities = Activity::latest()->paginate(10);

        // Previous lead assigned to this agent
        $previous = DB::table('leads')
            ->where('LeadID', '<', $id)
            ->where('AgentID', $AgentData->AgentID)
            ->orderBy('LeadID', 'desc')
            ->first();

        // Next lead assigned to this agent
        $next = DB::table('leads')
            ->where('LeadID', '>', $id)
            ->where('AgentID', $AgentData->AgentID)
            ->orderBy('LeadID', 'asc')
            ->first();

        return view(
            'agent-dashboard.lead.show',
            compact('lead', 'previous', 'next', 'activities')
        );
    }

    /*      public function show($id)
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
        return view('agent-dashboard.lead.show', compact('lead', 'previous', 'next', 'activities'));
    } */
}
