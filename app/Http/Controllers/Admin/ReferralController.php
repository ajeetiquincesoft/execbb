<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Referral;
use Illuminate\Support\Facades\DB;

class ReferralController extends Controller
{
    public function create(){
        $states = DB::table('states')->get();
       return view('admin.referral.create',compact('states'));  
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
        //return redirect()->route('all.contact')->with('success', 'Your contact create successful!');

    }
}
