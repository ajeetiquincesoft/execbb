<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buyer;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class BuyerController extends Controller
{
    public function index(Request $request)
    {
        try {
            session()->forget(['buyerData', 'step']);
            $query = $request->input('query');
            $buyers = Buyer::query();
            if ($query) {

                $buyers = Buyer::where('BuyerID', 'LIKE', '%' . $query . '%')
                    ->orWhere('FName', 'LIKE', '%' . $query . '%')
                    ->orWhere('LName', 'LIKE', '%' . $query . '%')
                    ->orWhere('Address1', 'LIKE', '%' . $query . '%')
                    ->orWhere('HomePhone', 'LIKE', '%' . $query . '%')
                    ->orWhere('BusPhone', 'LIKE', '%' . $query . '%')
                    ->orWhere('Email', 'LIKE', '%' . $query . '%');
            }

            $buyers = $buyers->orderBy('BuyerID', 'desc')->paginate(10);
            //dd($buyers);
            return view('admin.buyer.index', compact('buyers'));
        } catch (\Exception $e) {
            return redirect()->back()->with('err_message', $e->getMessage());
        }
    }
    public function showForm(Request $request)
    {
        $step = session('step', 1);
        $buyerData = session('buyerData', []);
        $categoryData = DB::table('categories')->get();
        $states = DB::table('states')->get();
        $counties = DB::table('counties')->get();
        $sub_categories = DB::table('sub_categories')->get();
        $agents = User::with('agent_info')->where('role_name', 'agent')->get();
        return view('admin.buyer.create', compact('step', 'buyerData', 'categoryData', 'states', 'sub_categories', 'counties', 'agents'));
    }
    // Process the form data and move to the next step
    public function processForm(Request $request)
    {
        $step = session('step', 1);
        $this->validateStep($request, $step);
        if ($step == 1) {
            $existingUser = User::where('email', $request->email)->where('role_name','buyer')->first();
                // If the email exists in the users table, rollback and show an error
                if ($existingUser) {
                    return back()->with('error', 'Email is already registered!')->withInput();
                }
            $corporateBuyer = $request->has('corporateBuyer') ? 1 : 0;
            $emailOptOut = $request->has('emailOptOut') ? 1 : 0;
            if (session()->has('buyerData.buyer_id')) {
                $buyer_id = session()->get('buyerData.buyer_id');
                $buyer = Buyer::where('BuyerID', $buyer_id)->first();
                if (!$buyer) {
                    return back()->with('error', 'Buyer not found!');
                }
                $buyer->Honorific = $request->honorific;
                $buyer->FName = $request->firstName;
                $buyer->LName = $request->lastName;
                $buyer->Corp = $request->corporateName;
                $buyer->AgentID = $request->agentID;
                $buyer->BDate = $request->BDate;
                $buyer->Address1 = $request->address;
                $buyer->City = $request->city;
                $buyer->State = $request->state;
                $buyer->Zip = $request->zip;
                $buyer->County = $request->country;
                $buyer->DLNo = $request->dlNumber;
                $buyer->HomePhone = $request->homePhone;
                $buyer->Fax = $request->fax;
                $buyer->Email = $request->email;
                $buyer->callWhen = $request->callWhen;

                /*  $buyer->corporateBuyer = $request->corporateBuyer;
                $buyer->preferredTerms = $request->preferredTerms; */
                $buyer->ExpDate = $request->monthExpDate;
                $buyer->OptOut = $emailOptOut;

                $buyer->SocSecNo = $request->ssNumber;
                $buyer->BusPhone = $request->businessPhone;
                $buyer->Pager = $request->pager;


                // Save the new record to the database
                $buyer->save();
                $buyerData = $request->session()->get('buyerData', []);
                $mergedData = array_merge($buyerData, $request->all());
                $request->session()->put('buyerData', $mergedData);
                $request->session()->put('buyerData.buyer_id',  $buyer_id);
            } else {
                $data = $request->all();
                $check = $this->buyerRegistration($data);
                $buyer = new Buyer;
                $buyer->Honorific = $request->honorific;
                $buyer->FName = $request->firstName;
                $buyer->LName = $request->lastName;
                $buyer->Corp = $request->corporateName;
                $buyer->AgentID = $request->agentID;
                $buyer->BDate = $request->BDate;
                $buyer->Address1 = $request->address;
                $buyer->City = $request->city;
                $buyer->State = $request->state;
                $buyer->Zip = $request->zip;
                $buyer->County = $request->country;
                $buyer->DLNo = $request->dlNumber;
                $buyer->HomePhone = $request->homePhone;
                $buyer->Fax = $request->fax;
                $buyer->Email = $request->email;
                $buyer->callWhen = $request->callWhen;

                /*  $buyer->corporateBuyer = $request->corporateBuyer;*/
                $buyer->Group = $request->preferredTerms ?? 0;
                $buyer->ExpDate = $request->monthExpDate;
                $buyer->OptOut = $emailOptOut;

                $buyer->SocSecNo = $request->ssNumber;
                $buyer->BusPhone = $request->businessPhone;
                $buyer->Pager = $request->pager;
                $buyer->user_id = $check->id;


                $buyer->save();
                Activity::create([
                    'action' => 'Buyer add',
                    'user_id' => Auth::id(),
                    'details' => 'created a new buyer with name: ' . $request->firstName .' '.$request->lastName,
                ]);
                Activity::create([
                    'action' => 'Buyer registered',
                    'user_id' => $check->id,
                    'details' => 'registered buyer with email: ' . $request->email,
                ]);
                $buyerData = $request->session()->get('buyerData', []);
                $mergedData = array_merge($buyerData, $request->all());
                $request->session()->put('buyerData', $mergedData);
                $insertedId = $buyer->BuyerID;
                $request->session()->put('buyerData.buyer_id',  $insertedId);
            }
        } elseif ($step == 2) {
            $buyer_id = session()->get('buyerData.buyer_id');
            $buyer = Buyer::where('BuyerID', $buyer_id)->first();
            if (!$buyer) {
                return back()->with('error', 'Buyer not found!');
            }
            $buyer->PartnerName = $request->partnerName;
            $buyer->PartnerPhone = $request->partnerPhone;
            $buyer->CurrentEmploy = $request->currentEmployment1;
            $buyer->Interest = $request->motivation ?? 0;
            $buyer->Comments = $request->comments;
            // Save the new record to the database
            $buyer->save();
            $buyerData = $request->session()->get('buyerData', []);
            $mergedData = array_merge($buyerData, $request->all());
            $request->session()->put('buyerData', $mergedData);
        } elseif ($step == 3) {
            if ($request->has('next')) {
                $buyer_id = session()->get('buyerData.buyer_id');
                $buyer = Buyer::where('BuyerID', $buyer_id)->first();
                if (!$buyer) {
                    return back()->with('error', 'Buyer not found!');
                }
                //dd($request->all());
                $buyer->BusType1 = $request->busType1;
                $buyer->BusType2 = $request->busType2;
                $buyer->BusType3 = $request->busType3;
                $buyer->BusType4 = $request->busType4;
                $buyer->BusCounty1 = $request->desiredCounty1;
                $buyer->BusCounty2 = $request->desiredCounty2;
                $buyer->BusCounty3 = $request->desiredCounty3;
                $buyer->BusCounty4 = $request->desiredCounty4;
                $buyer->BusLocation = $request->desiredLocation;
                $buyer->PPMax = $request->maxPrice;
                $buyer->DownPmtMax = $request->downPayMax;
                $buyer->VolMin = $request->annualSalesMin;
                $buyer->NetProfMin = $request->netProfitMin;
                $buyer->BusInt = $request->busInterest;
                $buyer->Location = $request->location;
                $buyer->Price = $request->price;
                $buyer->DownPay = $request->downPay;
                $buyer->SalesVol = $request->salesVol;
                $buyer->Profit = $request->profit;
                // Save the new record to the database
                $buyer->save();
                session()->forget(['buyerData', 'step']);
                return redirect()->route('list.buyer')->with('success', 'Your buyer create successfully!');
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
        return redirect()->route('buyerForm');
    }
    public function editForm(Request $request, $id)
    {
        $previousBuyerId = session('buyerData.prevBuyerId', null);
        // Find the buyer ID
        $buyerData = Buyer::where('BuyerID', $id)->first();
        //dd($buyerDatas);
        if (!$buyerData) {
            return redirect()->back()
                ->with('err_message', 'Buyer not found.');
        }

        if ($previousBuyerId != $id) {
            session(['step' => 1]);
            session(['buyerData.prevBuyerId' => $id]);
        }

        $step = session('step', 1);
        $buyerDatas = session('listingData', []);
        $request->session()->put('buyerData.buyer_id',  $id);
        $categoryData = DB::table('categories')->get();
        $states = DB::table('states')->get();
        $counties = DB::table('counties')->get();
        $sub_categories = DB::table('sub_categories')->get();
        $agents = User::with('agent_info')->where('role_name', 'agent')->get();

        return view('admin.buyer.edit', compact('step', 'buyerDatas', 'buyerData', 'categoryData', 'states', 'sub_categories', 'counties', 'agents'));
    }
    public function editProcessForm(Request $request, $id)
    {
        $step = session('step', 1);
        $this->validateStep($request, $step);
        $buyer_id = session()->get('buyerData.buyer_id');

        $buyer = Buyer::where('BuyerID', $buyer_id)->first();
        if (!$buyer) {
            return back()->with('error', 'Listing not found!');
        }
        $logCreated = session()->get('logCreated', false);
        // dd( $buyer);
        if ($step == 1) {
            $corporateBuyer = $request->has('corporateBuyer') ? 1 : 0;
            $emailOptOut = $request->has('emailOptOut') ? 1 : 0;
            if ($request->has('firstName')) {
                $buyer->Honorific = $request->honorific;
                $buyer->FName = $request->firstName;
                $buyer->LName = $request->lastName;
                $buyer->Corp = $request->corporateName;
                $buyer->AgentID = $request->agentID;
                $buyer->BDate = $request->BDate;
                $buyer->Address1 = $request->address;
                $buyer->City = $request->city;
                $buyer->State = $request->state;
                $buyer->Zip = $request->zip;
                $buyer->County = $request->country;
                $buyer->DLNo = $request->dlNumber;
                $buyer->HomePhone = $request->homePhone;
                $buyer->Fax = $request->fax;
                $buyer->Email = $request->email;
                $buyer->callWhen = $request->callWhen;

                /*  $buyer->corporateBuyer = $request->corporateBuyer;*/
                $buyer->Group = $request->preferredTerms ?? 0;
                $buyer->ExpDate = $request->monthExpDate;
                $buyer->OptOut = $emailOptOut;

                $buyer->SocSecNo = $request->ssNumber;
                $buyer->BusPhone = $request->businessPhone;
                $buyer->Pager = $request->pager;


                // Save the new record to the database
                $buyer->save();
                if (!$logCreated) {
                    Activity::create([
                        'action' => 'Buyer update',
                        'user_id' => Auth::id(),
                        'details' => 'update buyer with name: ' . $request->firstName .' '.$request->lastName,
                    ]);
    
                    // Mark the log as created in the session to prevent duplicate logs
                    session(['logCreated' => true]);
                }
                $buyerData = $request->session()->get('buyerData', []);
                $mergedData = array_merge($buyerData, $request->all());
                $request->session()->put('buyerData', $mergedData);
                $request->session()->put('buyerData.buyer_id',  $buyer_id);
            }
        } elseif ($step == 2) {
            if ($request->has('partnerName')) {
                $buyer->PartnerName = $request->partnerName;
                $buyer->PartnerPhone = $request->partnerPhone;
                $buyer->CurrentEmploy = $request->currentEmployment1;
                $buyer->Interest = $request->motivation ?? 0;
                $buyer->Comments = $request->comments;
                // Save the new record to the database
                $buyer->save();
                $buyerData = $request->session()->get('buyerData', []);
                $mergedData = array_merge($buyerData, $request->all());
                $request->session()->put('buyerData', $mergedData);
            }
        } elseif ($step == 3) {
            if ($request->has('next')) {
                if ($request->has('busType1')) {
                    $buyer->BusType1 = $request->busType1;
                    $buyer->BusType2 = $request->busType2;
                    $buyer->BusType3 = $request->busType3;
                    $buyer->BusType4 = $request->busType4;
                    $buyer->BusCounty1 = $request->desiredCounty1;
                    $buyer->BusCounty2 = $request->desiredCounty2;
                    $buyer->BusCounty3 = $request->desiredCounty3;
                    $buyer->BusCounty4 = $request->desiredCounty4;
                    $buyer->BusLocation = $request->desiredLocation;
                    $buyer->PPMax = $request->maxPrice;
                    $buyer->DownPmtMax = $request->downPayMax;
                    $buyer->VolMin = $request->annualSalesMin;
                    $buyer->NetProfMin = $request->netProfitMin;
                    $buyer->BusInt = $request->busInterest;
                    $buyer->Location = $request->location;
                    $buyer->Price = $request->price;
                    $buyer->DownPay = $request->downPay;
                    $buyer->SalesVol = $request->salesVol;
                    $buyer->Profit = $request->profit;
                    // Save the new record to the database
                    $buyer->save();
                    session()->forget(['buyerData', 'step']);
                    return redirect()->route('list.buyer')->with('success', 'Your buyer update successfully!');
                }
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
        return redirect()->route('edit.buyer.form', ['id' => $buyer->BuyerID]);
    }
    public function show($id)
    {

        $buyer = Buyer::where('BuyerID', $id)->first();
        $activities = Activity::latest()->paginate(10);
        // Get the previous buyer ID
        $previous = Buyer::where('BuyerID', '<', $id)->orderBy('BuyerID', 'desc')->first();
        // Get the next buyer ID
        $next = Buyer::where('BuyerID', '>', $id)->orderBy('BuyerID', 'asc')->first();
        return view('admin.buyer.show', compact('buyer', 'previous', 'next','activities'));
    }
    public function destroy(Request $request, $id)
    {
        try {
            $buyer = Buyer::find($id);
            Activity::create([
                'action' => 'Buyer delete',
                'user_id' => Auth::id(),
                'details' => 'deleted a buyer. Buyer details: Email: ' . $buyer->Email,
            ]);
            $buyer->delete();
            return redirect()->route('list.buyer')
                ->with('success', 'Buyer deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('err_message', $e->getMessage());
        }
    }
    // Validate data for each step
    private function validateStep(Request $request, $step)
    {
        // Initialize validation rules as an empty array
        $rules = [];

        // Check if the "next" button is pressed (we assume the button name is 'next')
        if ($request->has('next')) {
            // Switch case based on the current step
            switch ($step) {
                case 1:
                    // Step 1 validation rules
                    $rules = [
                        'firstName' => 'required',
                        'lastName' => 'required',
                        'agentID' => 'required',
                        'BDate' => 'required',
                        'address' => 'required',
                        'city' => 'required',
                        'state' => 'required',
                        'zip' => 'required',
                        'homePhone' => 'required',
                        'country' => 'required',
                        'email' => 'required|email',
                    ];
                    break;
            }

            // Validate the request with the current step's rules
            $request->validate($rules);
        }
    }
    public function bulkAction(Request $request)
    {
        $action = $request->action;
        $buyer_id = $request->buyer_id;
        $emails = Buyer::whereIn('BuyerID', $buyer_id)->pluck('Email')->toArray();
        if ($action == "active") {
            Buyer::whereIn('BuyerID', $buyer_id)->update(['Active' => '1']);
            Activity::create([
                'action' => 'Buyer status update',
                'user_id' =>  Auth::id(),
                'details' => 'set buyer as active. Buyer Email: ' . implode(", ", $emails),
            ]);
            return response()->json(array('message' => 'Buyer status has been change successfully!'));
        } else if ($action == "Inactive") {
            Buyer::whereIn('BuyerID', $buyer_id)->update(['Active' => '0']);
            Activity::create([
                'action' => 'Buyer status update',
                'user_id' =>  Auth::id(),
                'details' => 'set buyer as inactive. Buyer Email: ' . implode(", ", $emails),
            ]);
            return response()->json(array('message' => 'Buyer status has been change successfully!'));
        } else {
            Buyer::whereIn('BuyerID', $buyer_id)->delete();
            Activity::create([
                'action' => 'Buyer delete',
                'user_id' =>  Auth::id(),
                'details' => 'deleted buyer. Buyer Email: ' . implode(", ", $emails),
            ]);
            return response()->json(array('message' => 'Buyer delete successfully!'));
        }
    }
    public function buyerRegistration(array $data)
    {
        $password = $data['firstName'] . '@123';
        return User::create([
            'name' => $data['firstName'],
            'email' => $data['email'],
            'role_name' => 'buyer',
            'password' => Hash::make($password)
        ]);
    }
}
