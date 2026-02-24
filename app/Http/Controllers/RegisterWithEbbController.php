<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buyer;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Agent;
use App\Models\SignNda;
use Illuminate\Support\Facades\Hash;
use App\Events\BuyerRegister;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;
use Dompdf\Dompdf;
use Dompdf\Options;

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
        $step = session('step', 1);
        $buyerData = session('buyerData', []);
        $categoryData = DB::table('categories')->get();
        $states = DB::table('states')->get();
        $counties = DB::table('counties')->get();
        /* $agents = User::with('agent_info')->where('role_name', 'agent')->get(); */
        $agents = User::select(
            'users.*',
            'agents.FName',
            'agents.LName',
            'agents.AgentID'
        )
            ->join('agents', 'agents.AgentUserRegisterId', '=', 'users.id')
            ->where('users.role_name', 'agent')
            ->where('agents.Active', 1)
            ->orderBy('agents.FName', 'asc')
            ->get();
        $sub_categories = DB::table('sub_categories')->get();
        $uniqueAgID = '';
        if ($request->query('agent_id')) {
            $agId = $request->query('agent_id');
            $getUniqueID = Agent::where('AgentUserRegisterId', $agId)->first();
            $uniqueAgID = $getUniqueID->AgentID;
        }
        return view('frontend.register-with-ebb', compact('step', 'buyerData', 'categoryData', 'states', 'counties', 'agents', 'sub_categories', 'uniqueAgID'));
        /*  return redirect()->route('register.with.ebb', $queryParams); */
    }
    public function registerWithEbb(Request $request)
    {
        //session()->forget(['buyerData', 'step']);
        $step = session('step', 1);
        $buyerData = session('buyerData', []);
        $categoryData = DB::table('categories')->get();
        $states = DB::table('states')->get();
        $counties = DB::table('counties')->get();
        /* $agents = User::with('agent_info')->where('role_name', 'agent')->get(); */
        $agents = User::select(
            'users.*',
            'agents.FName',
            'agents.LName',
            'agents.AgentID'
        )
            ->join('agents', 'agents.AgentUserRegisterId', '=', 'users.id')
            ->where('users.role_name', 'agent')
            ->where('agents.Active', 1)
            ->orderBy('agents.FName', 'asc')
            ->get();
        $sub_categories = DB::table('sub_categories')->get();
        $uniqueAgID = '';
        if ($request->query('agent_id')) {
            $agId = $request->query('agent_id');
            $getUniqueID = Agent::where('AgentUserRegisterId', $agId)->first();
            $uniqueAgID = $getUniqueID->AgentID;
        }
        return view('frontend.register-with-ebb', compact('step', 'buyerData', 'categoryData', 'states', 'counties', 'agents', 'sub_categories', 'uniqueAgID'));
    }

    public function storeRegisterWithEbb(Request $request)
    {
        // Start the transaction
        DB::beginTransaction();

        try {
            $step = session('step', 1);
            //$this->validateStep($request, $step);
            if ($step == 1) {
                if (session()->has('buyerData.email')) {
                    $ndaSignEmail = session()->get('buyerData.email');
                    $getSignData = SignNda::where('email', $ndaSignEmail)->first();
                    if (!$getSignData) {
                        return back()->with('error', 'NDA sign data not found!');
                    }
                    $getSignData->full_name = $request->full_name;
                    $getSignData->business_interest = $request->nda_business_interest;
                    $getSignData->home_address = $request->home_address;
                    $getSignData->home_phone = $request->nda_home_phone;
                    $getSignData->cell_phone = $request->nda_cell_phone;
                    $getSignData->email = $request->nda_email;
                    $getSignData->date = $request->nda_form_date;
                    $getSignData->nda_form_sign = 'yes';
                    $getSignData->signature = $request->signature;
                    $getSignData->save();
                    // Delete old PDF if exists
                    if ($getSignData->nda_pdf_path && file_exists(public_path($getSignData->nda_pdf_path))) {
                        unlink(public_path($getSignData->nda_pdf_path));
                    }

                    // Generate new PDF
                    $signaturePathForPdf = null;
                    if (!empty($request->signature)) {
                        $signature = $request->signature;
                        if (preg_match('/^data:image\/(\w+);base64,/', $signature, $type)) {

                            $signature = substr($signature, strpos($signature, ',') + 1);
                            $type = strtolower($type[1]);

                            $signature = base64_decode($signature);

                            if ($signature === false) {
                                return back()->with('error', 'Signature decode failed');
                            }
                        } else {
                            return back()->with('error', 'Invalid signature format');
                        }

                        $signFolder = public_path('nda_signatures');

                        if (!File::exists($signFolder)) {
                            File::makeDirectory($signFolder, 0755, true);
                        }

                        $signName = 'sign_' . time() . '.png';
                        file_put_contents($signFolder . '/' . $signName, $signature);

                        $getSignData->nda_pdf_path = 'nda_signatures/' . $signName;
                        $getSignData->save();
                        $signaturePathForPdf = public_path('nda_signatures/' . $signName);
                    }
                    $options = new Options();
                    $options->set('defaultFont', 'Helvetica');
                    $dompdf = new Dompdf($options);

                    $pdfContent = View::make('pdf.nda_form_pdf', [
                        'full_name' => $request->full_name,
                        'business_interest' => $request->nda_business_interest,
                        'home_address' => $request->home_address,
                        'home_phone' => $request->nda_home_phone,
                        'cell_phone' => $request->nda_cell_phone,
                        'email' => $request->nda_email,
                        'signature' => $signaturePathForPdf,
                        'date' => $request->nda_form_date,
                    ])->render();

                    $dompdf->loadHtml($pdfContent);
                    $dompdf->setPaper('A4', 'portrait');
                    $dompdf->render();

                    $filename = 'nda_' . time() . '.pdf';
                    $folderPath = public_path('nda_pdfs');

                    if (!File::exists($folderPath)) {
                        File::makeDirectory($folderPath, 0755, true);
                    }

                    file_put_contents($folderPath . '/' . $filename, $dompdf->output());

                    // Save new PDF path
                    $getSignData->nda_pdf_path = 'nda_pdfs/' . $filename;
                    $getSignData->save();

                    $buyerData = $request->session()->get('buyerData', []);
                    $mergedData = array_merge($buyerData, $request->all());
                    $request->session()->put('buyerData', $mergedData);
                    // Store the NDA form value in session
                    $ndaFormSign = 'yes';
                    $getFullname = preg_split('/\s+/', trim($request->full_name));
                    $firstName = array_shift($getFullname);
                    $lastName  = implode(' ', $getFullname);
                    $request->session()->put('buyerData.nda_form_sign',  $ndaFormSign);
                    $request->session()->put('buyerData.home_phone',  $request->nda_home_phone);
                    $request->session()->put('buyerData.address',  $request->home_address);
                    $request->session()->put('buyerData.email',  $request->nda_email);
                    $request->session()->put('buyerData.first_name',  $firstName);
                    $request->session()->put('buyerData.last_name',  $lastName ?? '');
                } else {
                    $existingUser = User::where('email', $request->nda_email)->where('role_name', 'buyer')->first();
                    if ($existingUser) {
                        return back()->with('error', 'Email is already registered!')->withInput();
                    }
                    $signNdaFormUser = SignNda::where('email', $request->nda_email)->first();
                    if (!$signNdaFormUser) {
                        $nda = new SignNda;
                        $nda->full_name = $request->full_name;
                        $nda->business_interest = $request->nda_business_interest;
                        $nda->home_address = $request->home_address;
                        $nda->home_phone = $request->nda_home_phone;
                        $nda->cell_phone = $request->nda_cell_phone;
                        $nda->email = $request->nda_email;
                        $nda->date = $request->nda_form_date;
                        $nda->nda_form_sign = 'yes';
                        $nda->signature = $request->signature;
                        $nda->save();
                        // Generate PDF
                        $signaturePathForPdf = null;

                        if (!empty($request->signature)) {

                            $signature = $request->signature;

                            if (preg_match('/^data:image\/(\w+);base64,/', $signature, $type)) {

                                $signature = substr($signature, strpos($signature, ',') + 1);
                                $type = strtolower($type[1]);

                                $signature = base64_decode($signature);

                                if ($signature === false) {
                                    return back()->with('error', 'Signature decode failed');
                                }
                            } else {
                                return back()->with('error', 'Invalid signature format');
                            }

                            $signFolder = public_path('nda_signatures');

                            if (!File::exists($signFolder)) {
                                File::makeDirectory($signFolder, 0755, true);
                            }
                            $signName = 'sign_' . time() . '.png';
                            file_put_contents($signFolder . '/' . $signName, $signature);
                            $nda->nda_pdf_path = 'nda_signatures/' . $signName;
                            $nda->save();
                            $signaturePathForPdf = public_path('nda_signatures/' . $signName);
                        }
                        $options = new Options();
                        $options->set('defaultFont', 'Helvetica');
                        $options->set('isRemoteEnabled', true);
                        $options->set('isHtml5ParserEnabled', true);
                        $options->set('isPhpEnabled', true);
                        $dompdf = new Dompdf($options);

                        $pdfContent = View::make('pdf.nda_form_pdf', [
                            'full_name' => $request->full_name,
                            'business_interest' => $request->nda_business_interest,
                            'home_address' => $request->home_address,
                            'home_phone' => $request->nda_home_phone,
                            'cell_phone' => $request->nda_cell_phone,
                            'email' => $request->nda_email,
                            'signature' =>  $signaturePathForPdf,
                            'date' => $request->nda_form_date,
                        ])->render();

                        $dompdf->loadHtml($pdfContent);
                        $dompdf->setPaper('A4', 'portrait');
                        $dompdf->render();

                        $filename = 'nda_' . time() . '.pdf';
                        $folderPath = public_path('nda_pdfs');

                        if (!File::exists($folderPath)) {
                            File::makeDirectory($folderPath, 0755, true);
                        }

                        file_put_contents($folderPath . '/' . $filename, $dompdf->output());

                        // Save path
                        $nda->nda_pdf_path = 'nda_pdfs/' . $filename;
                        $nda->save();

                        $nda_id = $nda->id;
                        $buyerData = $request->session()->get('buyerData', []);
                        $mergedData = array_merge($buyerData, $request->all());
                        $request->session()->put('buyerData', $mergedData);
                        // Store the NDA form value in session
                        $ndaFormSign = 'yes';

                        $getFullname = preg_split('/\s+/', trim($request->full_name));

                        $firstName = array_shift($getFullname);
                        $lastName  = implode(' ', $getFullname);
                        $request->session()->put('buyerData.nda_id',  $nda_id);
                        $request->session()->put('buyerData.nda_form_sign',  $ndaFormSign);
                        $request->session()->put('buyerData.home_phone',  $request->nda_home_phone);
                        $request->session()->put('buyerData.address',  $request->home_address);
                        $request->session()->put('buyerData.email',  $request->nda_email);
                        $request->session()->put('buyerData.first_name',  $firstName);
                        $request->session()->put('buyerData.last_name',  $lastName ?? '');
                    } else {
                        $buyerData = $request->session()->get('buyerData', []);
                        $ndaFormSign = 'yes';
                        $getFullname = preg_split('/\s+/', trim($signNdaFormUser->full_name));
                        $firstName = array_shift($getFullname);
                        $lastName  = implode(' ', $getFullname);
                        $request->session()->put('buyerData.nda_id',  $signNdaFormUser->id);
                        $request->session()->put('buyerData.nda_form_sign',  $ndaFormSign);
                        $request->session()->put('buyerData.home_phone',  $signNdaFormUser->home_phone);
                        $request->session()->put('buyerData.address',  $signNdaFormUser->home_address);
                        $request->session()->put('buyerData.email',  $signNdaFormUser->email);
                        $request->session()->put('buyerData.first_name',  $firstName);
                        $request->session()->put('buyerData.last_name',  $lastName ?? '');
                    }
                }
            } elseif ($step == 2) {
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
                    if ($request->has('next')) {
                        // Create a new buyer
                        $data = $request->all();
                        event(new BuyerRegister($data));
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
                        $ndaID = session()->get('buyerData.nda_id');
                        $getNdaData = SignNda::where('id', $ndaID)->first();
                        if ($getNdaData) {
                            $getNdaData->user_id = $check->id;
                            $getNdaData->save();
                        }
                        // Merge session data with new request data
                        $buyerData = $request->session()->get('buyerData', []);
                        $mergedData = array_merge($buyerData, $request->all());
                        $request->session()->put('buyerData', $mergedData);

                        // Store the inserted buyer ID in session
                        $insertedId = $buyer->BuyerID;
                        $request->session()->put('buyerData.buyer_id',  $insertedId);
                    }
                }
            } elseif ($step == 3) {
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
                    // Commit the transaction if all operations are successful
                    DB::commit();
                    // Handle session and other operations
                    session()->forget(['buyerData', 'step']);



                    return redirect()->route('login')->with('success', 'Your account has been successfully created. Please check your email for instructions to log in!');
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
                case 2:
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
