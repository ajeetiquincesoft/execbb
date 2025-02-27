<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buyer;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Agent;
use Illuminate\Support\Facades\Hash;
use App\Events\BuyerRegister;

class RegisterWithEbbController extends Controller
{
    public function getBusType($id)
    {
        // Fetch options based on the selected ID (e.g., from a database)
        $options = DB::table('sub_categories')->where('CatID', $id)->get();

        return response()->json($options);
    }
    public function register(Request $request)
    {
        $queryParams = $request->query();
        session()->forget(['buyerData', 'step']);
        return redirect()->route('register.with.ebb', $queryParams);
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
        $uniqueAgID = '';
        if($request->query('agent_id')){
            $agId = $request->query('agent_id');
            $getUniqueID = Agent::where('AgentUserRegisterId',$agId)->first();
            $uniqueAgID = $getUniqueID->AgentID;
        }
        return view('frontend.register-with-ebb', compact('step', 'buyerData', 'categoryData', 'states', 'counties', 'agents', 'sub_categories','uniqueAgID'));
    }

    public function storeRegisterWithEbb(Request $request)
    {
        // Start the transaction
        DB::beginTransaction();

        try {
            $step = session('step', 1);
            $this->validateStep($request, $step);
            if ($step == 1) {
                $existingUser = User::where('email', $request->email)->where('role_name','buyer')->first();
                // If the email exists in the users table, rollback and show an error
                if ($existingUser) {
                    return back()->with('error', 'Email is already registered!')->withInput();
                }
                // Check if the buyer already exists
                if (session()->has('buyerData.buyer_id')) {
                    $buyer_id = session()->get('buyerData.buyer_id');
                    $buyer = Buyer::where('BuyerID', $buyer_id)->first();

                    if (!$buyer) {
                        return back()->with('error', 'Buyer not found!');
                    }

                    // Update existing buyer
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

                    // Save the buyer to the database
                    $buyer->save();

                    // Merge session data with new request data
                    $buyerData = $request->session()->get('buyerData', []);
                    $mergedData = array_merge($buyerData, $request->all());
                    $request->session()->put('buyerData', $mergedData);
                    $request->session()->put('buyerData.buyer_id',  $buyer_id);
                } else {
                    // Create a new buyer
                    $data = $request->all();
                    /* event(new BuyerRegister($data)); */
                    $check = $this->buyerRegistration($data);
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
                    $buyer->user_id  =  $check->id;
                    
                    // Save the new buyer to the database
                    $buyer->save();

                    // Merge session data with new request data
                    $buyerData = $request->session()->get('buyerData', []);
                    $mergedData = array_merge($buyerData, $request->all());
                    $request->session()->put('buyerData', $mergedData);

                    // Store the inserted buyer ID in session
                    $insertedId = $buyer->BuyerID;
                    $request->session()->put('buyerData.buyer_id',  $insertedId);
                }
            } elseif ($step == 2) {
                if ($request->has('next')) {
                    $buyer_id = session()->get('buyerData.buyer_id');
                    $buyer = Buyer::where('BuyerID', $buyer_id)->first();

                    if (!$buyer) {
                        return back()->with('error', 'Buyer not found!');
                    }
                    // Update the buyer data in step 2
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

                    // Save the updated buyer record
                    $buyer->save();

                    // Handle session and other operations
                    session()->forget(['buyerData', 'step']);

                    // Commit the transaction if all operations are successful
                    DB::commit();

                    return redirect()->route('register.with.ebb')->with('success', 'Your buyer created successfully!');
                }
            }

            // Update step in session if necessary
            if ($request->has('previous')) {
                $step = $step - 1;
            }
            if ($request->has('next')) {
                $step = $step + 1;
            }

            // Store the updated step in session
            session(['step' => $step]);

            // Commit the transaction if no errors
            DB::commit();

            return redirect()->route('register.with.ebb', $request->query());
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'An error occurred while processing your request. Please try again.');
        }
    }

    public function buyerRegistration(array $data)
    {
        $password = $data['first_name'] . '@123';
        return User::create([
            'name' => $data['first_name'],
            'email' => $data['email'],
            'role_name' => 'buyer',
            'password' => Hash::make($password)
        ]);
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
                     ];
                     break;
             }
 
             // Validate the request with the current step's rules
             $request->validate($rules);
         }
     }
}
