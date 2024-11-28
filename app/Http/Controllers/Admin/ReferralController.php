<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Referral;
use Illuminate\Support\Facades\DB;

class ReferralController extends Controller
{
    public function index(Request $request){
        //$referrals = Referral::orderBy('created_at','desc')->paginate(5);
        $query = $request->input('query');
            $referrals = Referral::query();
            if ($query) {
                
                    $referrals = Referral::where('RefID', 'LIKE', '%' . $query . '%')
                                    ->orWhere('RefCompany', 'LIKE', '%' . $query . '%')
                                    ->orWhere('AgentName', 'LIKE', '%' . $query . '%')
                                    ->orWhere('Address1', 'LIKE', '%' . $query . '%')
                                    ->orWhere('City', 'LIKE', '%' . $query . '%')
                                    ->orWhere('State', 'LIKE', '%' . $query . '%')
                                    ->orWhere('Zip', 'LIKE', '%' . $query . '%')
                                    ->orWhere('Phone', 'LIKE', '%' . $query . '%');
            }
            
            $referrals = $referrals->orderBy('created_at', 'desc')->paginate(10);
         return view('admin.referral.index', compact('referrals'));
    }
    public function create(){
        $states = DB::table('states')->get();
        $referral_types = DB::table('referral_types')->get();
        $referral_sources = DB::table('referral_sources')->get();
       return view('admin.referral.create',compact('states','referral_types','referral_sources'));  
    }
    public function store(Request $request){
        $request->validate([
            'follow_up' => 'required',
            'agent_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'phone' => 'required',
        ]);
        $referral = new Referral;
        $referral->RefCompany = $request->follow_up;
        $referral->BrokOfRec  = $request->broke_of_rac;
        $referral->AgentName = $request->agent_name;
        $referral->Address1 = $request->address;
        $referral->City = $request->city;
        $referral->State = $request->state;
        $referral->Zip = $request->zip;
        $referral->Phone = $request->phone;
        $referral->RefFee = $request->ref_fee;
        $referral->RefAmt = $request->ref_amt_paid;
        $referral->FlatFee = $request->flat_fee;
        $referral->RefSource = $request->ref_source;
        $referral->RefType = $request->ref_type;
        $referral->Comments = $request->comments;
        $referral->Fax = $request->fax;
        $referral->ReferredName = $request->referral_name;
        $referral->ReferredAdd1 = $request->referral_address;
        $referral->ReferredCity = $request->referral_city;
        $referral->ReferredState = $request->referral_state;
        $referral->ReferredZip = $request->referral_zip;
        $referral->ReferredPhone = $request->referral_phone;
        $referral->ReferredInterest = $request->ref_interest;
        $referral->ReferredDBA = $request->ref_dba;
        $referral->save();
        return redirect()->route('all.referral')->with('success', 'Your referral create successful!');

    }
    public function editReferral(Request $request,$id){
        $referral = Referral::where('RefID',$id)->first();
        if (!$referral) {
            return redirect()->route('all.referral')
                ->with('err_message', 'Referral not found.');
        }
        $states = DB::table('states')->get();
        $referral_types = DB::table('referral_types')->get();
        $referral_sources = DB::table('referral_sources')->get();
         // Get the previous Referral ID
         $previous = Referral::where('RefID', '<', $id)->orderBy('RefID', 'desc')->first();
         // Get the next referral ID
         $next = Referral::where('RefID', '>', $id)->orderBy('RefID', 'asc')->first();
       return view('admin.referral.edit',compact('states','referral','referral_types','referral_sources','previous','next'));

    }
    public function updateReferral(Request $request,$id){
        $request->validate([
            'follow_up' => 'required',
            'agent_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'phone' => 'required',
        ]);
        $referral = Referral::where('RefID',$id)->first();
        $referral->RefCompany = $request->follow_up;
        $referral->BrokOfRec  = $request->broke_of_rac;
        $referral->AgentName = $request->agent_name;
        $referral->Address1 = $request->address;
        $referral->City = $request->city;
        $referral->State = $request->state;
        $referral->Zip = $request->zip;
        $referral->Phone = $request->phone;
        $referral->RefFee = $request->ref_fee;
        $referral->RefAmt = $request->ref_amt_paid;
        $referral->FlatFee = $request->flat_fee;
        $referral->RefSource = $request->ref_source;
        $referral->RefType = $request->ref_type;
        $referral->Comments = $request->comments;
        $referral->Fax = $request->fax;
        $referral->ReferredName = $request->referral_name;
        $referral->ReferredAdd1 = $request->referral_address;
        $referral->ReferredCity = $request->referral_city;
        $referral->ReferredState = $request->referral_state;
        $referral->ReferredZip = $request->referral_zip;
        $referral->ReferredPhone = $request->referral_phone;
        $referral->ReferredInterest = $request->ref_interest;
        $referral->ReferredDBA = $request->ref_dba;
        $referral->save();
        return redirect()->route('all.referral')->with('success', 'Your referral update successful!');

    }
    public function show($id)
    {
        $referral = Referral::where('RefID',$id)->first();
        if (!$referral) {
            return back()->with('error', 'Contact not found!');
        }
        // Get the previous Referral ID
        $previous = Referral::where('RefID', '<', $id)->orderBy('RefID', 'desc')->first();
        // Get the next referral ID
        $next = Referral::where('RefID', '>', $id)->orderBy('RefID', 'asc')->first();
        
       return view('admin.referral.show', compact('referral', 'previous', 'next'));

    }
    public function destroy(Request $request, $id)
    {
       
            // Find the contact ID
            $referral = Referral::where('RefID',$id)->first();
            // Check if the contact exists
            if (!$referral) {
                return redirect()->route('all.referral')
                    ->with('err_message', 'Referral not found.');
            }

            // Delete the contact
            Referral::where('RefID', $id)->delete();

            return redirect()->route('all.referral')
                ->with('success', 'Referral deleted successfully.');
      
    }
}
