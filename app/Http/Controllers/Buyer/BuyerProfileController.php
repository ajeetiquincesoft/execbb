<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buyer;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BuyerProfileController extends Controller
{
    public function buyerProfile(Request $request)
    {
        $userId = Auth::user()->id;
        $buyerData = Buyer::where('user_id', $userId)->first();
        $categoryData = DB::table('categories')->get();
        $states = DB::table('states')->get();
        $counties = DB::table('counties')->get();
        $agents = User::with('agent_info')
            ->where('role_name', 'agent')
            ->whereHas('agent_info', function ($q) {
                $q->where('Active', 1);
                $q->orderBy('FName', 'asc');
            })
            ->get();
        $sub_categories = DB::table('sub_categories')->get();
        return view('frontend.buyer.buyer_profile', compact('categoryData', 'states', 'counties', 'agents', 'sub_categories', 'buyerData'));
    }
    public function getBusCategory($id)
    {
        // Fetch options based on the selected ID (e.g., from a database)
        $options = DB::table('sub_categories')->where('CatID', $id)->get();

        return response()->json($options);
    }
    public function updateBuyerInfo(Request $request, $id)
    {
        $buyer = Buyer::where('BuyerID', $id)->first();

        if (!$buyer) {
            return back()->with('error', 'Buyer not found!');
        }
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'agent' => 'required',
            'BDate' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'home_phone' => 'required',
            'county' => 'required',
            'email' => 'required|email',
        ]);
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
        $buyer->TypeBus = $request->business_interest;
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
        $buyer->NetWorth = $request->netWorth;
        $buyer->CashAvailable = $request->cashAvailable;
        $buyer->PPMin = $request->priceRangeMinimum;
        $buyer->PPMax = $request->priceRangeMaximum;
        $buyer->VolMin = $request->salesVolumeMinimum;
        $buyer->VolMax = $request->salesVolumeMaximum;
        $buyer->NetProfMin = $request->netIncomeMinimum;
        $buyer->NetProfMax = $request->netIncomeMaximum;
        $buyer->Comments = $request->comments;
        // Save the buyer to the database
        $buyer->save();
        return redirect()->route('buyer.profile')->with('success', 'Your profile update successfully!');
    }
}
