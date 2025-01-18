<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function index(Request $request){
        $query = $request->input('query');
        $leads = DB::table('leads');
        $categories = DB::table('categories')->pluck('BusinessCategory', 'CategoryID');
        $lead_status = DB::table('lead_status')->pluck('Status', 'LeadStatusID');
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
        $leads = $leads->orderBy('created_at', 'desc')
        ->paginate(10);
        return view('admin.lead.index', compact('leads','categories','lead_status'));
    }
    public function create(){
        $categoryData = DB::table('categories')->get();
        $states = DB::table('states')->get();
        $counties = DB::table('counties')->get();
        $status = DB::table('lead_status')->get();
        $sub_categories = DB::table('sub_categories')->get();
        return view('admin.lead.create',compact('categoryData','states','counties','sub_categories','status'));
        
    }
    public function store(Request $request){
        $request->validate([
            'appointment' => 'required',
            'time' => 'required',
            'leadDate' => 'required',
            'category' => 'required',
            'subCategory' => 'required',
            'firstName' => 'required',
            'lastName' => 'required',
            'busPhone' => 'required',
            'home_phone' => 'required',
            'cellPhone' => 'required',
            'yearInBus' => 'required',
        ]);
        
        DB::beginTransaction();
        $listed = $request->has('listed') ? 1 : 0;
        $reInc = $request->has('reInc') ? 1 : 0;
        $sfbo = $request->has('sfbo') ? 1 : 0;
        $insert = DB::table('leads')->insert([
            'Status' => $request->status,
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
            /* 'AgentID' => 'FD', */
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
        if($insert){
            return redirect()->route('all.lead')->with('success','Lead generate successfully');
        }
        else{
            return redirect()->route('all.lead')->with('error','There are some error! can not be create.');
        }
    }
    public function edit($id){
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
        return view('admin.lead.edit',compact('categoryData','states','counties','sub_categories','status','lead','previous','next'));
       
   

    }
    public function update(Request $request,$id){
        $request->validate([
            'appointment' => 'required',
            'time' => 'required',
            'leadDate' => 'required',
            'category' => 'required',
            'subCategory' => 'required',
            'firstName' => 'required',
            'lastName' => 'required',
            'busPhone' => 'required',
            'home_phone' => 'required',
            'cellPhone' => 'required',
            'yearInBus' => 'required',
        ]);
        $listed = $request->has('listed') ? 1 : 0;
        $reInc = $request->has('reInc') ? 1 : 0;
        $sfbo = $request->has('sfbo') ? 1 : 0;
       $update =  DB::table('leads')->where('LeadID', $id)->update([
        'Status' => $request->status,
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
        /* 'AgentID' => 'FD', */
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
        if($update){
            return redirect()->route('all.lead')->with('success','Lead update successfully');
        }
        else{
            return redirect()->route('all.lead')->with('error','There are some error! can not be update.');
        }
    }
    public function show($id){
        $lead =  DB::table('leads')->where('LeadID', $id)->first();
        //dd($lead->toSql(), $lead->getBindings());
         // Get the previous lead ID
         $previous = DB::table('leads')->where('LeadID', '<', $id)->orderBy('LeadID', 'desc')->first();
         // Get the next lead ID
         $next = DB::table('leads')->where('LeadID', '>', $id)->orderBy('LeadID', 'asc')->first();
        return view('admin.lead.show', compact('lead', 'previous', 'next'));

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

            // Delete the lead
            DB::table('leads')->where('LeadID', $id)->delete();

            return redirect()->route('all.lead')
                ->with('success', 'Lead deleted successfully.');
      
    }
   
}
