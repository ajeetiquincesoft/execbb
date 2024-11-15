<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Listing;
use App\Models\User;
use Throwable;
use Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ListingController extends Controller
{
    public function getOptions($id)
    {
        // Fetch options based on the selected ID (e.g., from a database)
        $options = DB::table('sub_categories')->where('CatID',$id)->get();

        return response()->json($options);
    }
    public function getImportFile(){
        return view('admin.import-file');

    }
    public function importCsv(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);
    
        $file = $request->file('file');
        $handle = fopen($file, 'r');
        $header = fgetcsv($handle); // Read header row
        $counter = 0;
        while (($row = fgetcsv($handle)) !== false  && $counter < 20) {
            // Skip empty rows
          /*   if (isset($row[2]) && $row[2] == '0') {
                continue; // Skip this row
            }
            if (isset($row[2]) && $row[2] == '30') {
                continue; // Skip this row
            } */
          
           // Check if Code is empty; if so, set it to null
          /*   if (isset($row[4]) && $row[4] !== '') {
                $row[4] = $row[4];
            } else {
                $row[4] = null; // Set to null if the value is empty
            }
            if (isset($row[3]) && $row[3] !== '') {
                $row[3] = $row[3];
            } else {
                $row[3] = null; // Set to null if the value is empty
            } */
            // Generate a dummy email address
            $dummyEmail = $this->generateDummyEmail();

            // Generate a dummy phone number
            $dummyPhone = $this->generateDummyPhone();
             // Insert data into the database
            DB::insert('INSERT INTO buyers (BDate, AgentID, LName, FName, Address1, HomePhone, Email, Interest, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $row[1],
                $row[2],
                $row[3],
                $row[4],
                $row[8],
                $dummyPhone,
                $dummyEmail,
                2,
                now(),  
                now(),
            ]);
            $counter++;

        }
    
        fclose($handle);
    
        return back()->with('success', 'CSV data imported successfully!');
    }
    // Helper function to generate a dummy email
    private function generateDummyEmail()
    {
        // Use a random string to generate a unique email
        return Str::random(10) . '@example.com';  // Example: randomstring@example.com
    }

    // Helper function to generate a dummy phone number
    private function generateDummyPhone()
    {
        // Generate a random phone number in a specific format
        return '+1-' . rand(100, 999) . '-' . rand(100, 999) . '-' . rand(1000, 9999);  // Example: +1-123-456-7890
    }
    public function form(Request $request){
            $request->session()->forget('formData');
            $request->session()->forget('business');
            $request->session()->forget('pricing');
            $request->session()->forget('financial');
            $request->session()->forget('complete_step');
            
            return redirect()->route('create.listing.step1');
       /*  if (session()->has('formData.listing_id')){
            $session_id = session()->get('formData.listing_id');
            $step = session()->get('formData.step');
            if($step == 1){
                return redirect()->route('create.listing.step2');
            }
            else if($step == 2){
                return redirect()->route('create.listing.step3');   
            }
            else if($step == 3){
                return redirect()->route('create.listing.step4');   
            }
            else if($step == 4){
                return redirect()->route('create.listing.step5');   
            }
            else{
                return redirect()->route('create.listing.step1');   
            }
            
        } */
        
    }
    public function index(Request $request){
        $query = $request->input('query');
        $listings = Listing::query();
        if ($query) {
        $listings = Listing::where('SellerFName', 'LIKE', '%' . $query . '%')
                            ->orWhere('SellerLName', 'LIKE', '%' . $query . '%')
                            ->orWhere('SellerCorpName', 'LIKE', '%' . $query . '%')
                            ->orWhere('SHomeAdd1', 'LIKE', '%' . $query . '%')
                            ->orWhere('SCity', 'LIKE', '%' . $query . '%')
                            ->orWhere('SHomePh', 'LIKE', '%' . $query . '%')
                            ->orWhere('Email', 'LIKE', '%' . $query . '%');
        }
        $listings = $listings->orderBy('created_at', 'desc')
        ->paginate(2);
      /*   $listings =  Listing::orderBy('created_at', 'desc')->paginate(5); */
        return view('admin.listing.index', compact('listings'));
    }
    public function destroy(Request $request, $id)
    {
       
        try {
            // Find the listing by custom ID
            $listing = Listing::where('ListingID', $id)->first();
            //dd($listing);
            // Check if the listing exists
            if (!$listing) {
                return redirect()->route('all.listing')
                    ->with('err_message', 'Listing not found.');
            }

            // Delete the listing
            $listing->delete();

            return redirect()->route('all.listing')
                ->with('success', 'Listing deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('err_message', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function show($id){
        $listing = Listing::where('ListingID', $id)->first();
         // Get the previous listing ID
         $previous = Listing::where('ListingID', '<', $id)->orderBy('ListingID', 'desc')->first();
         // Get the next listing ID
         $next = Listing::where('ListingID', '>', $id)->orderBy('ListingID', 'asc')->first();
        return view('admin.listing.show', compact('listing', 'previous', 'next'));
       
   

    }
    public function createStep1(){
        $categoryData = DB::table('categories')->get();
        $states = DB::table('states')->get();
        $counties = DB::table('counties')->get();
        $sub_categories = DB::table('sub_categories')->get();
        return view('admin.listing.listing-step.listing-step1',compact('categoryData','states','sub_categories','counties'));
    }
    public function createStep2(){
        $step = 2;
        $completedSteps = session()->get('complete_step', []);
      // dd($completedSteps);
            // Check if the previous step is completed
            if (!in_array($step - 1, $completedSteps) && $step > 1) {
                return redirect()->route('create.listing.step'.$step-1);
            }
            return view('admin.listing.listing-step.listing-step2');
       
    }
    public function createStep3(){
        $agents = User::with('agent_info')->where('role_name','agent')->get();
        $listingTypes = DB::table('listing_types')->get();
        $step = 3;
        $completedSteps = session()->get('complete_step', []);
            // Check if the previous step is completed
            if (!in_array($step - 1, $completedSteps) && $step > 1) {
                return redirect()->route('create.listing.step'.$step-1);
            }
            return view('admin.listing.listing-step.listing-step3', compact('agents','listingTypes'));
       
    }
    public function createStep4(){
        $step = 4;
        $completedSteps = session()->get('complete_step', []);

        // Check if the previous step is completed
        if (!in_array($step - 1, $completedSteps) && $step > 1) {
            return redirect()->route('create.listing.step'.$step-1);
        }
        return view('admin.listing.listing-step.listing-step4');
    }
    public function createStep5(){
        $step = 5;
        $completedSteps = session()->get('complete_step', []);

        // Check if the previous step is completed
        if (!in_array($step - 1, $completedSteps) && $step > 1) {
            return redirect()->route('create.listing.step'.$step-1);
        }
        return view('admin.listing.listing-step.listing-step5');
        
    }
    public function storeStep1(Request $request){
             $request->validate([
                'bus_category' => 'required',
                'bus_type' => 'required',
                'cropName' => 'required',
                'dba' => 'required',
                'address' => 'required',
                'city' => 'required',
                'state' => 'required',
                'zip_code' => 'required',
                'phone' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'user_email' => 'required|email',
                'listing_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            ]);
            $completeStep = session('complete_step', []);
             $filename = '';
             $categoryData = DB::table('categories')->where('CategoryID',$request->bus_category)->first();
             $category_name = $categoryData->BusinessCategory;
             $reviewcheckboxValue = $request->has('review') ? 1 : 0;
             $franchisecheckboxValue = $request->has('franchise') ? 1 : 0;
             $featuredListingcheckboxValue = $request->has('featuredListing') ? 1 : 0;
             if (session()->has('formData.listing_id')){
                $listing_id = session()->get('formData.listing_id');
                if( $request->hasFile('listing_img')) {
                    $image = $request->file('listing_img');
                    $path = public_path(). '/assets/uploads/images/';
                    $filename = time() . '.' . $image->getClientOriginalExtension();
                    $image->move($path, $filename);
                
                    $imagepath = $filename;
                }
                else{
                    $imageVal = Listing::where('ListingID',$listing_id)->first();
                    $imagepath = $imageVal->imagepath;
                }
                $listing = Listing::where('ListingID',$listing_id)->update([
                    'BusCategory' => $request->bus_category,
                    'BusType' => $category_name,
                    'Franchise' => $franchisecheckboxValue,
                    'SellerCorpName' => $request->cropName,
                    'DBA' =>$request->dba,
                    'Product' => $request->productMix,
                    'Address1' => $request->address,
                    'City' => $request->city,
                    'State' => $request->state,
                    'Zip' =>$request->zip_code,
                    'County' => $request->country,
                    'Phone' => $request->phone,
                    'Fax' => $request->fax,
                    'featured' => $featuredListingcheckboxValue,
                    'SellerFName' => $request->first_name,
                    'SellerLName'=>  $request->last_name,
                    'SHomeAdd1'=>  $request->home_address,
                    'SCity'=>  $request->user_city,
                    'SState'=>  $request->user_state,
                    'SZip'=>  $request->user_zip_code,
                    'Email'=>  $request->user_email,
                    'SHomePh'=>  $request->user_home_phone,
                    'SHomeFax'=>  $request->user_home_fax,
                    'Pager'=>  $request->user_pager,
                    'Review'=> $reviewcheckboxValue,
                    'imagepath'=> $imagepath,
                    'SubCat'=>$request->bus_type
                ]);
                $formData = $request->session()->get('formData', []);
                $mergedData = array_merge($formData, $request->all());
                $request->session()->put('formData', $mergedData);
                $request->session()->put('formData.listing_img', $imagepath);
                $request->session()->put('formData.listing_id',  $listing_id);
                $request->session()->put('formData.reviewCheckbox',  $reviewcheckboxValue);
                $request->session()->put('formData.franchCheckbox',  $franchisecheckboxValue);
                $request->session()->put('formData.featureCheckbox',  $featuredListingcheckboxValue);
                $request->session()->put('formData.step',  1);
                Log::info('Session Data:', $request->session()->all());
                return redirect()->route('create.listing.step2')->with('success', 'Listing updated successfully!');
              
             }
             else{
                $listing = new Listing;
                $listing->BusCategory = $request->bus_category;
                $listing->BusType = $category_name;
                $listing->Franchise = $franchisecheckboxValue;
                $listing->SellerCorpName = $request->cropName;
                $listing->DBA = $request->dba;
                $listing->Product = $request->productMix;
                $listing->Address1 = $request->address;
                $listing->City = $request->city;
                $listing->State = $request->state;
                $listing->Zip = $request->zip_code;
                $listing->County = $request->country;
                $listing->SHomePh = $request->phone;
                $listing->SHomeFax = $request->fax;
                $listing->featured = $featuredListingcheckboxValue;
                $listing->SellerFName = $request->first_name;
                $listing->SellerLName = $request->last_name;
                $listing->SHomeAdd1 = $request->home_address;
                $listing->SCity = $request->user_city;
                $listing->SState = $request->user_state;
                $listing->SZip = $request->user_zip_code;
                $listing->Email = $request->user_email;
                $listing->SHomePh = $request->user_home_phone;
                $listing->SHomeFax = $request->user_home_fax;
                $listing->Pager = $request->user_pager;
                $listing->Review = $reviewcheckboxValue;
                $listing->SubCat = $request->bus_type;
                $listing->Steps= 1;
               if( $request->hasFile('listing_img')) {
                    $image = $request->file('listing_img');
                    $path = public_path(). '/assets/uploads/images/';
                    $filename = time() . '.' . $image->getClientOriginalExtension();
                    $image->move($path, $filename);
                
                    $listing->imagepath = $filename;
                }
                $listing->save();
                $formData = $request->session()->get('formData', []);
                $mergedData = array_merge($formData, $request->all());
                $request->session()->put('formData', $mergedData);
                $insertedId = $listing->ListingID;
                $request->session()->put('formData.listing_img', $filename);
                $request->session()->put('formData.listing_id',  $insertedId);
                $request->session()->put('formData.reviewCheckbox',  $reviewcheckboxValue);
                $request->session()->put('formData.franchCheckbox',  $franchisecheckboxValue);
                $request->session()->put('formData.featureCheckbox',  $featuredListingcheckboxValue);
                $request->session()->put('formData.step',  1);
                $completeStep[] = 1;
                session(['complete_step' => $completeStep]);
                Log::info('Session Data:', $request->session()->all());
                return redirect()->route('create.listing.step2')->with('success', 'Listing created successfully!');

             }
           
       
    }
    public function storeStep2(Request $request){
    
             $request->validate([
                'buildingSize' => 'required',
                'basementSize' => 'required',
                'parking' => 'required',
                'licenseRequired' => 'required',
                'baseMonthlyRent' => 'required',
                'leaseTerms' => 'required',
                'leaseOptions' => 'required',
                'daysOpen' => 'required',
                'hoursOperation' => 'required',
                'numSeats' => 'required',
                'yearsEstablished' => 'required',
                'yearsPrevOwner' => 'required',
            ]);
             $basement = $request->has('basement') ? 1 : 0;
             $yearsEstablished = $request->has('yearsEstablished') ? 1 : 0;
             $listing = Listing::where('ListingID',$request->id)->update([
                'BldgSize' => $request->buildingSize,
                'BaseSize' => $request->basementSize,
                'Basement' => $basement,
                'Parking' => $request->parking,
                'LicenseReq' =>$request->licenseRequired,
                'BaseMonthRent' => $request->baseMonthlyRent,
                'LeaseTerms' => $request->leaseTerms,
                'LeaseOpt' => $request->leaseOptions,
                'NoDaysOpen' => $request->daysOpen,
                'HoursOfOp' =>$request->hoursOperation,
                'Seats' => $request->numSeats,
                'YrsEstablished' => $yearsEstablished,
                'YrsPresentOwner' => $request->yearsPrevOwner,
                'Interest' => $request->interest,
                'PTEmp' => $request->interestType,
                'Steps'=> 2
            ]);
            if($listing){
            $formData = $request->session()->get('formData', []);
            $mergedData = array_merge($formData, $request->all());
            $request->session()->put('formData', $mergedData);
            $request->session()->put('formData.YrsEstablished',  $yearsEstablished);
            $request->session()->put('formData.Basement',  $basement);
            $request->session()->put('formData.step',  2);
            $stepData = $request->session()->get('complete_step', []);
            if (!in_array(2, $stepData)) {
                $completeStep[] = 2;
                $mergedStepData = array_merge($stepData, $completeStep);
                $request->session()->put('complete_step', $mergedStepData);
            }
            
            return redirect()->route('create.listing.step3')->with('success', 'Listing updated successfully!');
            }
       
    }
    public function storeStep3(Request $request){
            $request->validate([
                'managementAgentName' => 'required',
                'managementAgentPhone' => 'required',
                'referringAgentName' => 'required',
                'referringAgentPhone' => 'required',
                'listingDate' => 'required',
                'expDate' => 'required',
                'coBroker' => 'required',
                'reasonForSale' => 'required',
                'agents' => 'required',
            ]);
             $untilSolid = $request->has('untilSolid') ? 1 : 0;
             $realEstate = $request->has('realEstate') ? 1 : 0;
             $optionToBuy = $request->has('optionToBuy') ? 1 : 0;
             $soldByEBB = $request->has('soldByEBB') ? 1 : 0;
             $listing = Listing::where('ListingID',$request->id)->update([
                'MgtAgentName' => $request->managementAgentName,
                'MgtAgentPh' => $request->managementAgentPhone,
                'RefAgentID' => $request->referringAgentName,
                'RefAgentPh' => $request->referringAgentPhone,
                'ListDate' =>$request->listingDate,
                'ExpDate' => $request->expDate,
                'ListType' => $request->listingType,
                'CoBrokID' => $request->coBroker,
                'SaleReas' => $request->reasonForSale,
                'ListPrice' =>$request->listPrice,
                'PurPrice' => $request->purPrice,
                'DownPay' => $request->downPay,
                'Balance' => $request->balance,
                'Interest' => $request->interest,
                'AddTerm' => $request->addTerms,
                'InvInPrice' => $request->invInPrice,
                'InvNot' => $request->invNotInPrice,
                'UntilSold' => $untilSolid,
                'AgentID' => $request->agents,
                'Commission' => $request->commission,
                'FlatFee' => $request->flatFee,
                'REAskingPrice' => $request->reAskingPrice,
                'RealEstate' => $realEstate,
                'ToBuy' => $optionToBuy,
                'SoldEBB' => $soldByEBB,
                'Steps'=> 3
            ]);
            if($listing){
            $formData = $request->session()->get('formData', []);
            $mergedData = array_merge($formData, $request->all());
            $request->session()->put('formData', $mergedData);
            $request->session()->put('formData.step',  3);
            $stepData = $request->session()->get('complete_step', []);
            if (!in_array(3, $stepData)) {
                $completeStep[] = 3;
                $mergedStepData = array_merge($stepData, $completeStep);
                $request->session()->put('complete_step', $mergedStepData);
            }
            return redirect()->route('create.listing.step4')->with('success', 'Listing updated successfully!');
            }
       
    }
    public function storeStep4(Request $request){
            $request->validate([
                'annualSales' => 'required',
                'costOfSales' => 'required',
                'grossProfit' => 'required',
                'totalExpenses' => 'required',
                
            ]);
             $listing = Listing::where('ListingID',$request->id)->update([
                'AnnualSales' => $request->annualSales,
               /*  '' => $request->costOfSales,
                '' => $request->grossProfit,
                '' => $request->totalExpenses, */
                'COG1Label' =>$request->goods_name1,
                'COG2Label' => $request->goods_name2,
                'COG3Label' => $request->goods_name3,
                'COG1' => $request->cost0_1,
                'COG2' => $request->cost0_2,
                'COG3' => $request->cost0_3,
                'PurPrice' => $request->baseAnnRent,
                'CommonAreaMaint' => $request->commAreaMaint,
                'RealEstateTax' => $request->realEstateTax,
                'AnnPayroll' => $request->annPayroll,
                'PayrollTax' => $request->payrollTax,
                'LicFee' => $request->licenseFees,
                'Advertising' => $request->advertising,
                'Telephone' => $request->telephone,
                'Utilities' => $request->utilities,
                'Insurance' => $request->insurance,
                'AcctLeg' => $request->accountingLegal,
                'Maintenance' => $request->maintenance,
                'Trash' => $request->trash,
                'Other' => $request->other,
                'Steps'=> 4
            ]);
            if($listing){
            $formData = $request->session()->get('formData', []);
            $mergedData = array_merge($formData, $request->all());
            $request->session()->put('formData', $mergedData);
            $request->session()->put('formData.step',  4);
            $stepData = $request->session()->get('complete_step', []);
            if (!in_array(4, $stepData)) {
                $completeStep[] = 4;
                $mergedStepData = array_merge($stepData, $completeStep);
                $request->session()->put('complete_step', $mergedStepData);
            }
            return redirect()->route('create.listing.step5')->with('success', 'Listing updated successfully!');
            }
    }
    public function storeStep5(Request $request){
            $request->validate([
                'highlights' => 'required',
                'comments' => 'required',
                'leadId' => 'required',
            ]);
             $listing = Listing::where('ListingID',$request->id)->update([
                'Highlights' => $request->highlights,
                'Comments' => $request->directions,
                'Directions' => $request->comments,
                'LeadID' => $request->leadId,
                'Steps'=> 5,
                'Status'=> 'published'
            ]);
            if($listing){
            $request->session()->forget('formData');
            $request->session()->forget('complete_step');
            return redirect()->route('all.listing')->with('success', 'Listing updated successfully!');
            }
            else{
                return redirect()->back()->with('error_message', 'Listing updated successfully!');
            }
       
    }
    public function editListingForm(Request $request, $id){
        $request->session()->forget('formData');
        $request->session()->forget('edit_complete_step');
        $listing = Listing::where('ListingID',$id)->first();
        $listing_id = $listing->ListingID;
        $listing_step = $listing->Steps;
        $editCompleteStep = session('edit_complete_step', []);
        for($i=1; $i<=$listing_step; $i++){
            $editCompleteStep[] = $i;
        }
        session(['edit_complete_step' => $editCompleteStep]);
        return redirect()->route('edit.listing.step1',['id' => $listing_id]);
        /* if($listing_step == 1){
            return redirect()->route('edit.listing.step2',['id' => $listing_id]);
        }
        if($listing_step == 2){
            return redirect()->route('edit.listing.step3',['id' => $listing_id]);
        }
        if($listing_step == 3){
            return redirect()->route('edit.listing.step4',['id' => $listing_id]);
        }
        if($listing_step == 4){
            return redirect()->route('edit.listing.step5',['id' => $listing_id]);
        }
        if($listing_step == 5){
            return redirect()->route('edit.listing.step1',['id' => $listing_id]);
        } */
    }
    public function editStep1($id){
        $listingData = Listing::where('ListingID',$id)->first();
         // Check if listing not exists
         if (!$listingData) {
            return redirect()->route('all.listing')->with('error', 'User not found.');
        }
        $categoryData = DB::table('categories')->get();
        $states = DB::table('states')->get();
        $counties = DB::table('counties')->get();
        $sub_categories = DB::table('sub_categories')->get();
        return view('admin.listing.edit-listing-step.edit-listing-step1',compact('categoryData','states','sub_categories','listingData','counties'));
    }
    public function editStep2($id){
        $listingData = Listing::where('ListingID',$id)->first();
          // Check if listing not exists
         if (!$listingData) {
            return redirect()->route('all.listing')->with('error', 'User not found.');
        }
        //dd($listingData);
       

        $step = 2;
        $editCompletedSteps = session()->get('edit_complete_step', []);
           // dd($editCompletedSteps);
            // Check if the previous step is completed
            if (!in_array($step - 1, $editCompletedSteps) && $step > 1) {
                return redirect()->route('edit.listing.step'.$step-1,['id' => $id]);
            }
            return view('admin.listing.edit-listing-step.edit-listing-step2',compact('listingData'));
    }
    public function editStep3($id){
        $listingData = Listing::where('ListingID',$id)->first();
        $listingTypes = DB::table('listing_types')->get();
          // Check if listing not exists
         if (!$listingData) {
            return redirect()->route('all.listing')->with('error', 'User not found.');
        }
        $agents = User::with('agent_info')->where('role_name','agent')->get();
        $agentSelect = json_decode($listingData->AgentID, true);
        if(!$agentSelect){
            $selectedAgents = array();
           
        }else{
            $selectedAgents = $agentSelect;
        }
       // dd($selectedAgents);
       $step = 3;
       $editCompletedSteps = session()->get('edit_complete_step', []);
          //dd($editCompletedSteps);
           // Check if the previous step is completed
           if (!in_array($step - 1, $editCompletedSteps) && $step > 1) {
               return redirect()->route('edit.listing.step'.$step-1,['id' => $id]);
           }
        return view('admin.listing.edit-listing-step.edit-listing-step3', compact('agents','listingData','selectedAgents','listingTypes'));
    }
    public function editStep4($id){
        $listingData = Listing::where('ListingID',$id)->first();
          // Check if listing not exists
         if (!$listingData) {
            return redirect()->route('all.listing')->with('error', 'User not found.');
        }
        $step = 4;
        $editCompletedSteps = session()->get('edit_complete_step', []);
           // dd($editCompletedSteps);
            // Check if the previous step is completed
            if (!in_array($step - 1, $editCompletedSteps) && $step > 1) {
                return redirect()->route('edit.listing.step'.$step-1,['id' => $id]);
            }
            return view('admin.listing.edit-listing-step.edit-listing-step4',compact('listingData'));
       
    }
    public function editStep5($id){
        $listingData = Listing::where('ListingID',$id)->first();
         // Check if listing not exists
         if (!$listingData) {
            return redirect()->route('all.listing')->with('error', 'User not found.');
        }
        $step = 5;
        $editCompletedSteps = session()->get('edit_complete_step', []);
        // dd($editCompletedSteps);
         // Check if the previous step is completed
         if (!in_array($step - 1, $editCompletedSteps) && $step > 1) {
             return redirect()->route('edit.listing.step'.$step-1,['id' => $id]);
         }
        return view('admin.listing.edit-listing-step.edit-listing-step5',compact('listingData'));
    }
    public function updateStep1(Request $request, $id){
        $request->validate([
           'bus_category' => 'required',
           'bus_type' => 'required',
           'cropName' => 'required',
           'dba' => 'required',
           'address' => 'required',
           'city' => 'required',
           'state' => 'required',
           'zip_code' => 'required',
           'phone' => 'required',
           'first_name' => 'required',
           'last_name' => 'required',
           'user_email' => 'required|email',
           'listing_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
       ]);
        $filename = '';
        $categoryData = DB::table('categories')->where('CategoryID',$request->bus_category)->first();
        $category_name = $categoryData->BusinessCategory;
        $reviewcheckboxValue = $request->has('review') ? 1 : 0;
        $franchisecheckboxValue = $request->has('franchise') ? 1 : 0;
        $featuredListingcheckboxValue = $request->has('featuredListing') ? 1 : 0;
           if( $request->hasFile('listing_img')) {
               $image = $request->file('listing_img');
               $path = public_path(). '/assets/uploads/images/';
               $filename = time() . '.' . $image->getClientOriginalExtension();
               $image->move($path, $filename);
           
               $imagepath = $filename;
           }
           else{
               $imageVal = Listing::where('ListingID',$id)->first();
               $imagepath = $imageVal->imagepath;
           }
           $listing = Listing::where('ListingID',$id)->update([
               'BusCategory' => $request->bus_category,
               'BusType' => $category_name,
               'Franchise' => $franchisecheckboxValue,
               'SellerCorpName' => $request->cropName,
               'DBA' =>$request->dba,
               'Product' => $request->productMix,
               'Address1' => $request->address,
               'City' => $request->city,
               'State' => $request->state,
               'Zip' =>$request->zip_code,
               'County' => $request->country,
               'Phone' => $request->phone,
               'Fax' => $request->fax,
               'featured' => $featuredListingcheckboxValue,
               'SellerFName' => $request->first_name,
               'SellerLName'=>  $request->last_name,
               'SHomeAdd1'=>  $request->home_address,
               'SCity'=>  $request->user_city,
               'SState'=>  $request->user_state,
               'SZip'=>  $request->user_zip_code,
               'Email'=>  $request->user_email,
               'SHomePh'=>  $request->user_home_phone,
               'SHomeFax'=>  $request->user_home_fax,
               'Pager'=>  $request->user_pager,
               'Review'=> $reviewcheckboxValue,
               'imagepath'=> $imagepath,
               'SubCat'=>$request->bus_type
           ]);
           return redirect()->route('edit.listing.step2',['id' => $id])->with('success', 'Listing updated successfully!');  
    }
    public function updateStep2(Request $request,$id){
    
        $request->validate([
           'buildingSize' => 'required',
           'basementSize' => 'required',
           'parking' => 'required',
           'licenseRequired' => 'required',
           'baseMonthlyRent' => 'required',
           'leaseTerms' => 'required',
           'leaseOptions' => 'required',
           'daysOpen' => 'required',
           'hoursOperation' => 'required',
           'numSeats' => 'required',
           'yearsEstablished' => 'required',
           'yearsPrevOwner' => 'required',
       ]);
        $basement = $request->has('basement') ? 1 : 0;
        $yearsEstablished = $request->has('yearsEstablished') ? 1 : 0;
        $currentStep = 2;
        $listingStep =  Listing::where('ListingID',$id)->first();
        if($listingStep->Steps  >  $currentStep){
            $updateStep = $listingStep->Steps;
        }
        else{
            $updateStep = $currentStep;
        }
        $listing = Listing::where('ListingID',$id)->update([
           'BldgSize' => $request->buildingSize,
           'BaseSize' => $request->basementSize,
           'Basement' => $basement,
           'Parking' => $request->parking,
           'LicenseReq' =>$request->licenseRequired,
           'BaseMonthRent' => $request->baseMonthlyRent,
           'LeaseTerms' => $request->leaseTerms,
           'LeaseOpt' => $request->leaseOptions,
           'NoDaysOpen' => $request->daysOpen,
           'HoursOfOp' =>$request->hoursOperation,
           'Seats' => $request->numSeats,
           'YrsEstablished' => $yearsEstablished,
           'YrsPresentOwner' => $request->yearsPrevOwner,
           'Interest' => $request->interest,
           'PTEmp' => $request->interestType,
           'Steps'=>  $updateStep
       ]);
       if($listing){
        for($i=1; $i<=$updateStep; $i++){
            $editCompleteStep[] = $i;
        }
            $request->session()->put('edit_complete_step', $editCompleteStep);
        
       return redirect()->route('edit.listing.step3',['id' => $id])->with('success', 'Listing updated successfully!');
       }
  
    }
    public function updateStep3(Request $request,$id){
       // dd($request->agents);
        $request->validate([
            'managementAgentName' => 'required',
            'managementAgentPhone' => 'required',
            'referringAgentName' => 'required',
            'referringAgentPhone' => 'required',
            'listingDate' => 'required',
            'expDate' => 'required',
            'coBroker' => 'required',
            'reasonForSale' => 'required',
            'agents' => 'required',
        ]);
         $untilSolid = $request->has('untilSolid') ? 1 : 0;
         $realEstate = $request->has('realEstate') ? 1 : 0;
         $optionToBuy = $request->has('optionToBuy') ? 1 : 0;
         $soldByEBB = $request->has('soldByEBB') ? 1 : 0;
         $currentStep = 3;
         $listingStep =  Listing::where('ListingID',$id)->first();
         if($listingStep->Steps  >  $currentStep){
             $updateStep = $listingStep->Steps;
         }
         else{
             $updateStep = $currentStep;
         }
         $listing = Listing::where('ListingID',$id)->update([
            'MgtAgentName' => $request->managementAgentName,
            'MgtAgentPh' => $request->managementAgentPhone,
            'RefAgentID' => $request->referringAgentName,
            'RefAgentPh' => $request->referringAgentPhone,
            'ListDate' =>$request->listingDate,
            'ExpDate' => $request->expDate,
            'ListType' => $request->listingType,
            'CoBrokID' => $request->coBroker,
            'SaleReas' => $request->reasonForSale,
            'ListPrice' =>$request->listPrice,
            'PurPrice' => $request->purPrice,
            'DownPay' => $request->downPay,
            'Balance' => $request->balance,
            'Interest' => $request->interest,
            'AddTerm' => $request->addTerms,
            'InvInPrice' => $request->invInPrice,
            'InvNot' => $request->invNotInPrice,
            'UntilSold' => $untilSolid,
            'AgentID' => $request->agents,
            'Commission' => $request->commission,
            'FlatFee' => $request->flatFee,
            'REAskingPrice' => $request->reAskingPrice,
            'RealEstate' => $realEstate,
            'ToBuy' => $optionToBuy,
            'SoldEBB' => $soldByEBB,
            'Steps'=> $updateStep
        ]);
        if($listing){
            //dd('sdd');
            for($i=1; $i<=$updateStep; $i++){
                $editCompleteStep[] = $i;
            }
            $request->session()->put('edit_complete_step', $editCompleteStep);
        return redirect()->route('edit.listing.step4',['id' => $id])->with('success', 'Listing updated successfully!');
        }
   
    }
    public function updateStep4(Request $request,$id){
        $request->validate([
            'annualSales' => 'required',
            'costOfSales' => 'required',
            'grossProfit' => 'required',
            'totalExpenses' => 'required',
            
        ]);
        $currentStep = 4;
         $listingStep =  Listing::where('ListingID',$id)->first();
         if($listingStep->Steps  >  $currentStep){
             $updateStep = $listingStep->Steps;
         }
         else{
             $updateStep = $currentStep;
         }
         $listing = Listing::where('ListingID',$id)->update([
            'AnnualSales' => $request->annualSales,
           /*  '' => $request->costOfSales,
            '' => $request->grossProfit,
            '' => $request->totalExpenses, */
            'COG1Label' =>$request->goods_name1,
            'COG2Label' => $request->goods_name2,
            'COG3Label' => $request->goods_name3,
            'COG1' => $request->cost0_1,
            'COG2' => $request->cost0_2,
            'COG3' => $request->cost0_3,
            /* '' => $request->baseAnnRent, */
            'CommonAreaMaint' => $request->commAreaMaint,
            'RealEstateTax' => $request->realEstateTax,
            'AnnPayroll' => $request->annPayroll,
            'PayrollTax' => $request->payrollTax,
            'LicFee' => $request->licenseFees,
            'Advertising' => $request->advertising,
            'Telephone' => $request->telephone,
            'Utilities' => $request->utilities,
            'Insurance' => $request->insurance,
            'AcctLeg' => $request->accountingLegal,
            'Maintenance' => $request->maintenance,
            'Trash' => $request->trash,
            'Other' => $request->other,
            'Steps'=> $updateStep
        ]);
        if($listing){
            for($i=1; $i<=$updateStep; $i++){
                $editCompleteStep[] = $i;
            }
            $request->session()->put('edit_complete_step', $editCompleteStep);
        return redirect()->route('edit.listing.step5',['id' => $id])->with('success', 'Listing updated successfully!');
        }
    }
    public function updateStep5(Request $request,$id){
        $request->validate([
            'highlights' => 'required',
            'comments' => 'required',
            'leadId' => 'required',
        ]);
         $listing = Listing::where('ListingID',$id)->update([
            'Highlights' => $request->highlights,
            'Comments' => $request->directions,
            'Directions' => $request->comments,
            'LeadID' => $request->leadId,
            'Steps'=> 5,
            'Status'=> 'published'
        ]);
        if($listing){
        return redirect()->route('all.listing')->with('success', 'Listing updated successfully!');
        }
   
    }
    public function updateImage(Request $request,$id){
        if( $request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $path = public_path(). '/assets/uploads/images/';
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $filename);
        }
        else{
            $data =Listing::where('ListingID',$id)->first();
            $filename = $data->image;

        }
        $listing_img = Listing::where('ListingID',$id)->update([
            'imagepath' => $filename,
        ]);
        if($listing_img){
            return redirect()->back()->with('success_message', 'Listing image update successfully');
        }
        else{
            return redirect()->back()->with('success_message', 'There are some error! can not be update.');
        }

    }
}
