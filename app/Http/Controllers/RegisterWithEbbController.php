<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buyer;
use Illuminate\Support\Facades\DB;
use App\Models\User;
class RegisterWithEbbController extends Controller
{
    public function getBusType($id)
    {
        // Fetch options based on the selected ID (e.g., from a database)
        $options = DB::table('sub_categories')->where('CatID', $id)->get();

        return response()->json($options);
    }
    public function registerWithEbb(Request $request)
    {
        //session()->forget(['buyerData', 'step']);
        $step = session('step', 1);
        $buyerData = session('buyerData', []);
        $categoryData = DB::table('categories')->get();
        $states = DB::table('states')->get();
        $counties = DB::table('counties')->get();
        $agents = User::with('agent_info')->where('role_name', 'agent')->get();
        $sub_categories = DB::table('sub_categories')->get();
        return view('frontend.register-with-ebb', compact('step', 'buyerData', 'categoryData','states', 'counties', 'agents', 'sub_categories'));
    }
    public function storeRegisterWithEbb(Request $request)
    {
        $step = session('step', 1);
        //$this->validateStep($request, $step);
        if ($step == 1) {
            if (session()->has('buyerData.buyer_id')) {
                $buyer_id = session()->get('buyerData.buyer_id');
                $buyer = Buyer::where('BuyerID', $buyer_id)->first();
                if (!$buyer) {
                    return back()->with('error', 'Buyer not found!');
                }
                $buyer->FName = $request->first_name;
                $buyer->LName = $request->last_name;
                $buyer->AgentID = $request->agent;
                $buyer->BDate = $request->BDate;
                $buyer->Address1 = $request->address;
                $buyer->City = $request->city;
                $buyer->State = $request->state;
                $buyer->Zip = $request->zip;
                $buyer->County = $request->county;
                $buyer->HomePhone = $request->home_phone;
                $buyer->BusPhone = $request->business_phone;
                $buyer->Email = $request->email;
                $buyer->callWhen = $request->callWhen;
                // Save the new record to the database
                $buyer->save();
                $buyerData = $request->session()->get('buyerData', []);
                $mergedData = array_merge($buyerData, $request->all());
                $request->session()->put('buyerData', $mergedData);
                $request->session()->put('buyerData.buyer_id',  $buyer_id);
            } else {
                $buyer = new Buyer;
                $buyer->FName = $request->first_name;
                $buyer->LName = $request->last_name;
                $buyer->AgentID = $request->agent;
                $buyer->BDate = $request->BDate;
                $buyer->Address1 = $request->address;
                $buyer->City = $request->city;
                $buyer->State = $request->state;
                $buyer->Zip = $request->zip;
                $buyer->County = $request->county;
                $buyer->HomePhone = $request->home_phone;
                $buyer->BusPhone = $request->business_phone;
                $buyer->Email = $request->email;
                $buyer->callWhen = $request->callWhen;
                // Save the new record to the database
                $buyer->save();
                $buyerData = $request->session()->get('buyerData', []);
                $mergedData = array_merge($buyerData, $request->all());
                $request->session()->put('buyerData', $mergedData);
                $insertedId = $buyer->BuyerID;
                $request->session()->put('buyerData.buyer_id',  $insertedId);
            }
        }elseif ($step == 2) {
            if ($request->has('next')) {
                $buyer_id = session()->get('buyerData.buyer_id');
                $buyer = Buyer::where('BuyerID', $buyer_id)->first();
                if (!$buyer) {
                    return back()->with('error', 'Buyer not found!');
                }
                $buyer->CurrentEmploy = $request->business_interest;
                $buyer->Interest = $request->Interest ?? 0;
                $buyer->BusType1 = $request->bus_type1;
                $buyer->BusType2 = $request->bus_type2;
                $buyer->BusType3 = $request->bus_type3;
                $buyer->BusType4 = $request->bus_type4;
                $buyer->BusCounty1 = $request->desiredCounty1;
                $buyer->BusCounty2 = $request->desiredCounty2;
                $buyer->BusCounty3 = $request->desiredCounty3;
                $buyer->BusCounty4 = $request->desiredCounty4;
                $buyer->BusLocation = $request->desiredLocation;
                $buyer->Comments = $request->comments;
                // Save the new record to the database
                $buyer->save();
                session()->forget(['buyerData', 'step']);
                return redirect()->route('register.with.ebb')->with('success', 'Your buyer create successfully!');
            }
        }
        // Update the session with the next step
        if ($request->has('previous')) {

            $step = $step - 1;
        }
        if ($request->has('next')) {
            $step = $step + 1;
        }
        // Store the new step in the session
        session(['step' => $step]);
        return redirect()->route('register.with.ebb');
    }
}
