<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Agent;
use App\Models\Listing;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Activity;

class LeadController extends Controller
{
    /*  public function index(Request $request)
    {
        $query = $request->input('query');
        $leads = DB::table('leads');
        $categories = DB::table('categories')->pluck('BusinessCategory', 'CategoryID');
        $lead_status = DB::table('lead_status')->pluck('Status', 'LeadStatusID');
        $agents = User::with('agent_info')->where('role_name', 'agent')->get();
        if ($query) {
            $leads = DB::table('leads')
                ->leftJoin('categories', 'leads.Category', '=', 'categories.CategoryID')
                ->leftJoin('lead_status', 'leads.Status', '=', 'lead_status.LeadStatusID')
                ->select('leads.*', 'categories.BusinessCategory as category_name', 'lead_status.Status as status')
                ->where('leads.SellerFName', 'LIKE', '%' . $query . '%')
                ->orWhere('leads.SellerLName', 'LIKE', '%' . $query . '%')
                ->orWhere('leads.BusName', 'LIKE', '%' . $query . '%')
                ->orWhere('leads.Address', 'LIKE', '%' . $query . '%')
                ->orWhere('leads.Phone', 'LIKE', '%' . $query . '%')
                ->orWhere('leads.AppointmentDate', 'LIKE', '%' . $query . '%')
                ->orWhere('categories.BusinessCategory', 'LIKE', '%' . $query . '%')
                ->orWhere('lead_status.Status', 'LIKE', '%' . $query . '%');
        }
        $leads = $leads->orderBy('LeadID', 'desc')
            ->paginate(10);
        return view('admin.lead.index', compact('leads', 'categories', 'lead_status', 'agents'));
    } */

    public function index(Request $request)
    {
        $query = trim($request->input('query', ''));

        $sort = $request->input('sort', 'LeadID');
        $direction = strtolower($request->input('direction', 'desc'));

        // Approved sortable columns
        $allowedSortColumns = [
            'LeadID'          => 'leads.LeadID',
            'SellerFName'     => 'leads.SellerFName',
            'Category'        => 'categories.BusinessCategory',
            'BusName'         => 'leads.BusName',
            'AgentFName'      => 'agents.FName',
            'AppointmentDate' => 'leads.AppointmentDate',
        ];

        if (!array_key_exists($sort, $allowedSortColumns)) {
            $sort = 'LeadID';
        }

        if (!in_array($direction, ['asc', 'desc'], true)) {
            $direction = 'desc';
        }

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

        // Search leads and related agent details
        if ($query !== '') {
            $search = '%' . $query . '%';

            $leads->where(function ($q) use ($search) {
                $q->where('leads.LeadID', 'LIKE', $search)
                    ->orWhere('leads.SellerFName', 'LIKE', $search)
                    ->orWhere('leads.SellerLName', 'LIKE', $search)
                    ->orWhereRaw(
                        "CONCAT(
                        COALESCE(leads.SellerFName, ''),
                        ' ',
                        COALESCE(leads.SellerLName, '')
                    ) LIKE ?",
                        [$search]
                    )
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

        // Apply sorting
        if ($sort === 'SellerFName') {
            $leads->orderBy('leads.SellerFName', $direction)
                ->orderBy('leads.SellerLName', $direction);
        } elseif ($sort === 'AgentFName') {
            $leads->orderBy('agents.FName', $direction)
                ->orderBy('agents.LName', $direction);
        } else {
            $leads->orderBy($allowedSortColumns[$sort], $direction);
        }

        // Stable secondary ordering
        if ($sort !== 'LeadID') {
            $leads->orderBy('leads.LeadID', 'desc');
        }

        $leads = $leads
            ->paginate(10)
            ->appends($request->except('page'));

        $categories = DB::table('categories')
            ->pluck('BusinessCategory', 'CategoryID');

        $lead_status = DB::table('lead_status')
            ->pluck('Status', 'LeadStatusID');

        // Admin agent dropdown
        $agents = User::with('agent_info')
            ->where('role_name', 'agent')
            ->whereHas('agent_info', function ($q) {
                $q->whereNotNull('FName')
                    ->where('FName', '!=', '');
            })
            ->get()
            ->sortBy(function ($agent) {
                return strtolower($agent->agent_info->FName ?? '');
            })
            ->values();

        return view(
            'admin.lead.index',
            compact('leads', 'categories', 'lead_status', 'agents')
        );
    }

    public function create()
    {
        $categoryData = DB::table('categories')->get();
        $states = DB::table('states')->get();
        $counties = DB::table('counties')->get();
        $status = DB::table('lead_status')->get();
        $sub_categories = DB::table('sub_categories')->get();
        $agents = User::with('agent_info')
            ->where('role_name', 'agent')
            ->whereHas('agent_info', function ($query) {
                $query->where(function ($q) {
                    $q->whereNotNull('FName')
                        ->where('FName', '!=', '');
                });
            })
            ->get()
            ->sortBy(function ($agent) {
                return $agent->agent_info?->FName ?? '';
            })
            ->values();
        $listings = Listing::whereNull('ExpDate')
            ->orWhere('ExpDate', '>=', now())
            ->get();
        return view('admin.lead.create', compact('categoryData', 'states', 'counties', 'sub_categories', 'status', 'agents', 'listings'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'appointment' => 'required',
            'time' => 'required',
            'leadDate' => 'required',
            'category' => 'required',
            'subCategory' => 'required',
            'firstName' => 'required',
            'lastName' => 'required',
            'businessName' => 'required',
            'busPhone' => 'required',
            'cellPhone' => 'required',
            'yearInBus' => 'required',
        ]);

        DB::beginTransaction();
        $listed = $request->has('listed') ? 1 : 0;
        $reInc = $request->has('reInc') ? 1 : 0;
        $sfbo = $request->has('sfbo') ? 1 : 0;
        $changeStatus = $request->has('listed') ? 4 : $request->status;
        $insert = DB::table('leads')->insert([
            'Status' => $changeStatus,
            'BusName' => $request->businessName,
            'Address' => $request->address,
            'City' => $request->city,
            'State' => $request->state,
            'Zip' => $request->zip,
            'County' => $request->county,
            'Category' => $request->category,
            'SubCategory' => $request->subCategory,
            'Source' => $request->source,
            'AdCopy' => $request->adCopy,
            'AdDate' => $request->adDate,
            'Phone' => $request->busPhone,
            'Comments' => $request->comments,
            'AgentID' => $request->assign_agent,
            'ListingID' => $request->business_listing,
            'LDate' => $request->leadDate,
            'Listed' => $listed,
            'SellerFName' => $request->firstName,
            'SellerLName' => $request->lastName,
            'AppointmentDate' => $request->appointment,
            'AppointmentTime' => $request->time,
            'FSBO' => $sfbo,
            'HomePhone' => $request->home_phone,
            'CellPhone' => $request->cellPhone,
            'RealEstateInc' => $reInc,
            'REAsking' => $request->askPriceRE,
            'AnnSales' => $request->approxSales,
            'YearsInBus' => $request->yearInBus,
            'PresentOwner' => $request->presOwner,
            'SizeOfFacility' => $request->sizeOfFacility,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::commit();
        if ($insert) {
            Activity::create([
                'action' => 'Lead add',
                'user_id' => Auth::id(),
                'details' => 'created a lead for all users. Lead details: Name: ' . $request->firstName . ', Business Name: ' . $request->businessName,
            ]);
            return redirect()->route('all.lead')->with('success', 'Lead generate successfully');
        } else {
            return redirect()->route('all.lead')->with('error', 'There are some error! can not be create.');
        }
    }
    public function edit($id)
    {
        $lead =  DB::table('leads')->where('LeadID', $id)->first();
        $categoryData = DB::table('categories')->get();
        $states = DB::table('states')->get();
        $counties = DB::table('counties')->get();
        $status = DB::table('lead_status')->get();
        $sub_categories = DB::table('sub_categories')->get();
        // Get the previous lead ID
        $previous =  DB::table('leads')->where('LeadID', '<', $id)->orderBy('LeadID', 'desc')->first();
        // Get the next lead ID
        $next =  DB::table('leads')->where('LeadID', '>', $id)->orderBy('LeadID', 'asc')->first();
        $agents = User::with('agent_info')
            ->where('role_name', 'agent')
            ->whereHas('agent_info', function ($query) {
                $query->where(function ($q) {
                    $q->whereNotNull('FName')
                        ->where('FName', '!=', '');
                });
            })
            ->get()
            ->sortBy(function ($agent) {
                return $agent->agent_info?->FName ?? '';
            })
            ->values();
        $listings = Listing::whereNull('ExpDate')
            ->orWhere('ExpDate', '>=', now())
            ->get();
        return view('admin.lead.edit', compact('categoryData', 'states', 'counties', 'sub_categories', 'status', 'lead', 'previous', 'next', 'agents', 'listings'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'appointment' => 'required',
            'time' => 'required',
            'leadDate' => 'required',
            'category' => 'required',
            'subCategory' => 'required',
            'firstName' => 'required',
            'lastName' => 'required',
            'businessName' => 'required',
            'busPhone' => 'required',
            'cellPhone' => 'required',
            'yearInBus' => 'required',
        ]);
        $listed = $request->has('listed') ? 1 : 0;
        $reInc = $request->has('reInc') ? 1 : 0;
        $sfbo = $request->has('sfbo') ? 1 : 0;
        $changeStatus = $request->has('listed') ? 4 : $request->status;
        $update =  DB::table('leads')->where('LeadID', $id)->update([
            'Status' => $changeStatus,
            'BusName' => $request->businessName,
            'Address' => $request->address,
            'City' => $request->city,
            'State' => $request->state,
            'Zip' => $request->zip,
            'County' => $request->county,
            'Category' => $request->category,
            'SubCategory' => $request->subCategory,
            'Source' => $request->source,
            'AdCopy' => $request->adCopy,
            'AdDate' => $request->adDate,
            'Phone' => $request->busPhone,
            'Comments' => $request->comments,
            'AgentID' => $request->assign_agent,
            'ListingID' => $request->business_listing,
            'LDate' => $request->leadDate,
            'Listed' => $listed,
            'SellerFName' => $request->firstName,
            'SellerLName' => $request->lastName,
            'AppointmentDate' => $request->appointment,
            'AppointmentTime' => $request->time,
            'FSBO' => $sfbo,
            'HomePhone' => $request->home_phone,
            'CellPhone' => $request->cellPhone,
            'RealEstateInc' => $reInc,
            'REAsking' => $request->askPriceRE,
            'AnnSales' => $request->approxSales,
            'YearsInBus' => $request->yearInBus,
            'PresentOwner' => $request->presOwner,
            'SizeOfFacility' => $request->sizeOfFacility,
            'updated_at' => now(),
        ]);
        if ($update) {
            Activity::create([
                'action' => 'Lead update',
                'user_id' => Auth::id(),
                'details' => 'update a lead for all users. Lead details: Name: ' . $request->firstName . ', Business Name: ' . $request->businessName,
            ]);
            return redirect()->route('all.lead')->with('success', 'Lead update successfully');
        } else {
            return redirect()->route('all.lead')->with('error', 'There are some error! can not be update.');
        }
    }
    public function show($id)
    {
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
            ->leftJoin('lead_status', 'leads.Status', '=', 'lead_status.LeadStatusID')
            ->where('leads.LeadID', $id)
            ->select(
                'leads.*',
                'categories.BusinessCategory as category_name',
                'agents.FName as agent_fname',
                'agents.LName as agent_lname',
                'lead_status.Status as status_name'
            )
            ->first();

        if (!$lead) {
            return redirect()
                ->back()
                ->with('err_message', 'Lead not found.');
        }

        $activities = Activity::latest()->paginate(10);

        // Previous lead
        $previous = DB::table('leads')
            ->where('LeadID', '<', $id)
            ->orderBy('LeadID', 'desc')
            ->first();

        // Next lead
        $next = DB::table('leads')
            ->where('LeadID', '>', $id)
            ->orderBy('LeadID', 'asc')
            ->first();

        return view(
            'admin.lead.show',
            compact('lead', 'previous', 'next', 'activities')
        );
    }
    public function destroy(Request $request, $id)
    {

        // Find the lead ID
        $lead = DB::table('leads')->where('LeadID', $id)->first();
        //dd($listing);
        // Check if the lead exists
        if (!$lead) {
            return redirect()->route('all.lead')
                ->with('err_message', 'Lead not found.');
        }
        Activity::create([
            'action' => 'Lead delete',
            'user_id' => Auth::id(),
            'details' => 'deleted a lead. Lead details: ID: ' . $lead->LeadID,
        ]);
        // Delete the lead
        DB::table('leads')->where('LeadID', $id)->delete();

        return redirect()->route('all.lead')
            ->with('success', 'Lead deleted successfully.');
    }
    public function bulkAction(Request $request)
    {
        $status_val = $request->status_val;
        $lead_id = $request->lead_id;
        $status = DB::table('lead_status')->where('LeadStatusID', $status_val)->first();
        if (!$status) {
            return response()->json(['error' => 'Invalid status ID'], 400);
        }
        $userId = Auth::id();
        DB::table('leads')
            ->whereIn('LeadID', $lead_id)
            ->update([
                'Status' => $status_val
            ]);
        Activity::create([
            'action' => 'Lead status update',
            'user_id' => $userId,
            'details' => 'set leads status as ' .  $status->Status . '. Lead IDs: ' . implode(", ", $lead_id),
        ]);
        return response()->json(array('message' => 'Lead status has been change successfully!'));
    }
    public function leadAssign(Request $request)
    {
        $agent_id = $request->agent_id;
        $lead_id = $request->lead_id;
        $userId = Auth::id();
        $agentInfo = Agent::where('AgentID', $agent_id)->first();
        if (!$agentInfo) {
            return response()->json(['error' => 'Invalid agent ID'], 400);
        }
        DB::table('leads')
            ->where('LeadID', $lead_id)
            ->update([
                'AgentID' => $agent_id,
                'Status' => 2
            ]);
        Activity::create([
            'action' => 'Assign lead to agent',
            'user_id' => $userId,
            'details' => 'assign leads to agent, agent name: ' .  $agentInfo->FName . '. Lead ID: ' . $lead_id,
        ]);
        return redirect()->back()->with('success', 'Lead assigned to agent successfully');
    }


    /**
     * Display a print-ready version of a single lead.
     */
    public function print($id)
    {
        $lead = DB::table('leads')
            ->leftJoin(
                'lead_status',
                'leads.Status',
                '=',
                'lead_status.LeadStatusID'
            )
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
            ->leftJoin(
                'listings',
                'leads.ListingID',
                '=',
                'listings.ListingID'
            )
            ->where('leads.LeadID', $id)
            ->select(
                'leads.*',

                // Status and category
                'lead_status.Status as status_name',
                'categories.BusinessCategory as category_name',

                // Assigned agent
                'agents.AgentID as related_agent_id',
                'agents.FName as agent_fname',
                'agents.LName as agent_lname',

                // Related business listing
                'listings.ListingID as related_listing_id',
                'listings.DBA as listing_dba'
            )
            ->first();

        if (!$lead) {
            abort(404, 'Lead not found.');
        }

        // Agent display information
        $lead->agent_display_name = 'Unassigned';

        if ($lead->related_agent_id !== null) {
            $name = trim(
                ($lead->agent_fname ?? '') . ' ' .
                    ($lead->agent_lname ?? '')
            );

            $lead->agent_display_name = $name !== ''
                ? $name
                : 'Agent #' . $lead->AgentID;
        }

        // Listing display information
        $lead->listing_display_name = 'Not Assigned';

        if ($lead->related_listing_id !== null) {
            $dba = trim((string) ($lead->listing_dba ?? ''));

            $lead->listing_display_name = $dba !== ''
                ? $dba
                : 'DBA Not Available';
        }

        return view('admin.lead.print', compact('lead'));
    }
}
