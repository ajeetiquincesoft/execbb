<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Listing;
use App\Models\User;
use App\Models\Activity;
use Throwable;
use Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Notifications\SendNotification;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;

class ListingController extends Controller
{
    protected $database;
    protected $reference;

    public function __construct()
    {
        // Set the path to your Firebase service account JSON file
        $serviceAccountPath = storage_path('app/firebase/exeb-443511-firebase-adminsdk-fbsvc-99ad7c8b12.json');

        // Initialize Firebase with the service account and database URI
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccountPath)
            ->withDatabaseUri('https://exeb-443511-default-rtdb.firebaseio.com');

        // Create the database instance
        $this->database = $firebase->createDatabase();

        // Set the reference to 'notifications'
        $this->reference = $this->database->getReference('notifications');
    }
    public function getOptions($id)
    {
        // Fetch options based on the selected ID (e.g., from a database)
        $options = DB::table('sub_categories')->where('CatID', $id)->get();

        return response()->json($options);
    }
    public function form(Request $request)
    {
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
    public function index(Request $request)
    {
        $query = $request->input('query');
        $listings = Listing::query();
        if ($query) {
            $listings = Listing::where('SellerFName', 'LIKE', '%' . $query . '%')
                ->orWhere('SellerLName', 'LIKE', '%' . $query . '%')
                ->orWhere('CorpName', 'LIKE', '%' . $query . '%')
                ->orWhere('SHomeAdd1', 'LIKE', '%' . $query . '%')
                ->orWhere('SCity', 'LIKE', '%' . $query . '%')
                ->orWhere('SHomePh', 'LIKE', '%' . $query . '%')
                ->orWhere('Address1', 'LIKE', '%' . $query . '%')
                ->orWhere('City', 'LIKE', '%' . $query . '%')
                ->orWhere('Phone', 'LIKE', '%' . $query . '%')
                ->orWhere('Email', 'LIKE', '%' . $query . '%');
        }
        $listings = $listings->orderBy('ListingID', 'desc')
            ->paginate(10);
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
            Activity::create([
                'action' => 'Listing delete',
                'user_id' => Auth::id(),
                'details' => 'deleted a listing. Listing details: ID: ' . $listing->ListingID . ', Business Name: ' . $listing->CorpName,
            ]);
            $data = [
                'title' => 'Listing delete',
                'body' => 'Admin deleted a listing.',
                'timestamp' => Carbon::now()->toIso8601String(),
                'user_id' => $listing->RefAgentID,
                'is_read' => false,
            ];
            $this->reference->push($data);
            if ($listing->document_path && Storage::disk('public')->exists($listing->document_path)) {
                Storage::disk('public')->delete($listing->document_path);
            }
            $listing->delete();

            return redirect()->route('all.listing')
                ->with('success', 'Listing deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('err_message', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function show($id)
    {
        $listing = Listing::where('ListingID', $id)->first();
        $activities = Activity::latest()->paginate(10);
        // Get the previous listing ID
        $previous = Listing::where('ListingID', '<', $id)->orderBy('ListingID', 'desc')->first();
        // Get the next listing ID
        $next = Listing::where('ListingID', '>', $id)->orderBy('ListingID', 'asc')->first();
        return view('admin.listing.show', compact('listing', 'previous', 'next', 'activities'));
    }
    public function createStep1()
    {
        $categoryData = DB::table('categories')->get();
        $states = DB::table('states')->get();
        $counties = DB::table('counties')->get();
        $sub_categories = DB::table('sub_categories')->get();
        return view('admin.listing.listing-step.listing-step1', compact('categoryData', 'states', 'sub_categories', 'counties'));
    }
    public function createStep2()
    {
        $step = 2;
        $completedSteps = session()->get('complete_step', []);
        // dd($completedSteps);
        // Check if the previous step is completed
        if (!in_array($step - 1, $completedSteps) && $step > 1) {
            return redirect()->route('create.listing.step' . $step - 1);
        }
        return view('admin.listing.listing-step.listing-step2');
    }
    public function createStep3()
    {
        $agents = User::with('agent_info')->where('role_name', 'agent')->get();
        $listingTypes = DB::table('listing_types')->get();
        $step = 3;
        $completedSteps = session()->get('complete_step', []);
        // Check if the previous step is completed
        if (!in_array($step - 1, $completedSteps) && $step > 1) {
            return redirect()->route('create.listing.step' . $step - 1);
        }
        return view('admin.listing.listing-step.listing-step3', compact('agents', 'listingTypes'));
    }
    public function createStep4()
    {
        $step = 4;
        $completedSteps = session()->get('complete_step', []);

        // Check if the previous step is completed
        if (!in_array($step - 1, $completedSteps) && $step > 1) {
            return redirect()->route('create.listing.step' . $step - 1);
        }
        return view('admin.listing.listing-step.listing-step4');
    }
    public function createStep5()
    {
        $step = 5;
        $completedSteps = session()->get('complete_step', []);
        $leads = DB::table('leads')->get();

        // Check if the previous step is completed
        if (!in_array($step - 1, $completedSteps) && $step > 1) {
            return redirect()->route('create.listing.step' . $step - 1);
        }
        return view('admin.listing.listing-step.listing-step5', compact('leads'));
    }
    public function storeStep1(Request $request)
    {
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
            'listing_img' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'document' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:5120',
        ]);
        $completeStep = session('complete_step', []);
        $filename = '';
        $categoryData = DB::table('categories')->where('CategoryID', $request->bus_category)->first();
        $category_name = $categoryData->BusinessCategory;
        $reviewcheckboxValue = $request->has('review') ? 1 : 0;
        $franchisecheckboxValue = $request->has('franchise') ? 1 : 0;
        $featuredListingcheckboxValue = $request->has('featuredListing') ? 1 : 0;
        if (session()->has('formData.listing_id')) {
            $listing_id = session()->get('formData.listing_id');
            $model = Listing::findOrFail($listing_id);
            if ($request->hasFile('listing_img')) {
                $oldImagePath = public_path('assets/uploads/images/' . $model->imagepath);
                if (File::exists($oldImagePath)) {
                    // Delete the old image from the directory
                    File::delete($oldImagePath);
                }
                $image = $request->file('listing_img');
                $path = public_path() . '/assets/uploads/images/';
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $image->move($path, $filename);

                $imagepath = $filename;
            } else {
                $imageVal = Listing::where('ListingID', $listing_id)->first();
                $imagepath = $imageVal->imagepath;
            }
            if ($request->hasFile('document')) {
                // Delete old document if exists
                if ($model->document_path && Storage::disk('public')->exists($model->document_path)) {
                    Storage::disk('public')->delete($model->document_path);
                }

                // Store new file
                $docPath = $request->file('document')->store('listing_documents', 'public');
            } else {
                $docVal = Listing::where('ListingID', $listing_id)->first();
                $docPath = $docVal->document_path;
            }
            $listing = Listing::where('ListingID', $listing_id)->update([
                'BusCategory' => $request->bus_category,
                'BusType' => $category_name,
                'Franchise' => $franchisecheckboxValue,
                'CorpName' => $request->cropName,
                'DBA' => $request->dba,
                'Product' => $request->productMix,
                'Address1' => $request->address,
                'City' => $request->city,
                'State' => $request->state,
                'Zip' => $request->zip_code,
                'County' => $request->country,
                'Phone' => $request->phone,
                'Fax' => $request->fax,
                'featured' => $featuredListingcheckboxValue,
                'SellerFName' => $request->first_name,
                'SellerLName' =>  $request->last_name,
                'SHomeAdd1' =>  $request->home_address,
                'SCity' =>  $request->user_city,
                'SState' =>  $request->user_state,
                'SZip' =>  $request->user_zip_code,
                'Email' =>  $request->user_email,
                'SHomePh' =>  $request->user_home_phone,
                'SHomeFax' =>  $request->user_home_fax,
                'Pager' =>  $request->user_pager,
                'Review' => $reviewcheckboxValue,
                'imagepath' => $imagepath,
                'SubCat' => $request->bus_type,
                'document_path' => $docPath
            ]);
            $formData = $request->session()->get('formData', []);
            $mergedData = array_merge($formData, $request->all());
            $request->session()->put('formData', $mergedData);
            $request->session()->put('formData.listing_img', $imagepath);
            $request->session()->put('formData.uploadDoc', $docPath);
            $request->session()->put('formData.listing_id',  $listing_id);
            $request->session()->put('formData.reviewCheckbox',  $reviewcheckboxValue);
            $request->session()->put('formData.franchCheckbox',  $franchisecheckboxValue);
            $request->session()->put('formData.featureCheckbox',  $featuredListingcheckboxValue);
            $request->session()->put('formData.step',  1);
            Log::info('Session Data:', $request->session()->all());
            return redirect()->route('create.listing.step2')->with('success', 'Listing updated successfully!');
        } else {
            $listing = new Listing;
            $listing->BusCategory = $request->bus_category;
            $listing->BusType = $category_name;
            $listing->Franchise = $franchisecheckboxValue;
            $listing->CorpName = $request->cropName;
            $listing->DBA = $request->dba;
            $listing->Product = $request->productMix;
            $listing->Address1 = $request->address;
            $listing->City = $request->city;
            $listing->State = $request->state;
            $listing->Zip = $request->zip_code;
            $listing->County = $request->country;
            $listing->Phone = $request->phone;
            $listing->Fax = $request->fax;
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
            $listing->Status = 'review';
            $listing->CreatedBy = Auth::id();
            $listing->Steps = 1;
            if ($request->hasFile('listing_img')) {
                $image = $request->file('listing_img');
                $path = public_path() . '/assets/uploads/images/';
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $image->move($path, $filename);

                $listing->imagepath = $filename;
            }
            if ($request->hasFile('document')) {
                $docname = $request->file('document')->store('listing_documents', 'public');
                $listing->document_path = $docname;
            }
            $listing->save();
            $formData = $request->session()->get('formData', []);
            /* $mergedData = array_merge($formData, $request->all()); */
            $mergedData = array_merge($formData, $request->except(['document', 'listing_img']));
            $request->session()->put('formData', $mergedData);
            $insertedId = $listing->ListingID;
            $request->session()->put('formData.listing_img', $filename);
            $request->session()->put('formData.uploadDoc', $docname);
            $request->session()->put('formData.listing_id',  $insertedId);
            $request->session()->put('formData.reviewCheckbox',  $reviewcheckboxValue);
            $request->session()->put('formData.franchCheckbox',  $franchisecheckboxValue);
            $request->session()->put('formData.featureCheckbox',  $featuredListingcheckboxValue);
            $request->session()->put('formData.step',  1);
            $completeStep[] = 1;
            session(['complete_step' => $completeStep]);
            Log::info('Session Data:', $request->session()->all());
            Activity::create([
                'action' => 'Listing add',
                'user_id' => Auth::id(),
                'details' => 'create listing for all users, listing is ' . $listing->CorpName,
            ]);
            return redirect()->route('create.listing.step2')->with('success', 'Listing created successfully!');
        }
    }
    public function storeStep2(Request $request)
    {

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
        $listing = Listing::where('ListingID', $request->id);
        $data = [
            'BldgSize' => $request->buildingSize,
            'BaseSize' => $request->basementSize,
            'Basement' => $basement,
            'Parking' => $request->parking,
            'LicenseReq' => $request->licenseRequired,
            'BaseMonthRent' => $request->baseMonthlyRent,
            'LeaseTerms' => $request->leaseTerms,
            'LeaseOpt' => $request->leaseOptions,
            'NoDaysOpen' => $request->daysOpen,
            'HoursOfOp' => $request->hoursOperation,
            'Seats' => $request->numSeats,
            'YrsEstablished' => $yearsEstablished,
            'YrsPresentOwner' => $request->yearsPrevOwner,
            'Motivation' => $request->motivation,
            'PTEmp' => $request->PTEmp,
            'FTEmp' => $request->FTEmp,
            'Steps' => 2
        ];
        $listing->update($data);
        if ($listing) {
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
    public function storeStep3(Request $request)
    {
        $request->validate([
            'managementAgentName' => 'required',
            'managementAgentPhone' => 'required',
            'referringAgentName' => 'required',
            'referringAgentPhone' => 'required',
            'listingDate' => 'required',
            'coBroker' => 'required',
            'reasonForSale' => 'required',
            'agents' => 'required',
        ]);
        $untilSolid = $request->has('untilSolid') ? 1 : 0;
        $realEstate = $request->has('realEstate') ? 1 : 0;
        $optionToBuy = $request->has('optionToBuy') ? 1 : 0;
        $soldByEBB = $request->has('soldByEBB') ? 1 : 0;
        $currentDate = Carbon::now();
        $validStatus = '';
        if ($request->expDate == '' || $request->expDate > $currentDate) {
            $validStatus = 'valid';
        }
        $listing = Listing::where('ListingID', $request->id)->update([
            'MgtAgentName' => $request->managementAgentName,
            'MgtAgentPh' => $request->managementAgentPhone,
            'RefAgentID' => $request->referringAgentName,
            'RefAgentPh' => $request->referringAgentPhone,
            'ListDate' => $request->listingDate,
            'ExpDate' => $request->expDate,
            'ListType' => $request->listingType,
            'CoBrokID' => $request->coBroker,
            'SaleReas' => $request->reasonForSale,
            'ListPrice' => $request->listPrice,
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
            'Status' => $validStatus,
            'Steps' => 3
        ]);
        if ($listing) {
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
    public function storeStep4(Request $request)
    {
        $request->validate([
            'annualSales' => 'required',

        ]);
        $listing = Listing::where('ListingID', $request->id)->update([
            'AnnualSales' => $request->annualSales,
            'CostOfSale' => $request->costOfSales,
            'GrossProfit' => $request->grossProfit,
            'TotalExpenses' => $request->totalExpenses,
            'OtherInc' => $request->otherIncome,
            'AnnualNetProfit' => $request->annNetProfit,
            'COG1Label' => $request->goods_name1,
            'COG2Label' => $request->goods_name2,
            'COG3Label' => $request->goods_name3,
            'COG1' => $request->cost0_1,
            'COG2' => $request->cost0_2,
            'COG3' => $request->cost0_3,
            'AnnRent' => $request->baseAnnRent,
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
            'Opt1Label' => $request->Opt1Label,
            'Opt2Label' => $request->Opt2Label,
            'Opt1' => $request->Opt1,
            'Opt2' => $request->Opt2,
            'Steps' => 4
        ]);
        if ($listing) {
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
    public function storeStep5(Request $request)
    {
        $request->validate([
            'leadId' => 'required',
        ]);
        $listing = Listing::where('ListingID', $request->id)->update([
            'Highlights' => $request->highlights,
            'Comments' => $request->comments,
            'Directions' => $request->directions,
            'LeadID' => $request->leadId,
            'Steps' => 5,
            'Status' => 'valid',
            'Active' => 1
        ]);
        if ($listing) {
            $request->session()->forget('formData');
            $request->session()->forget('complete_step');
            return redirect()->route('all.listing')->with('success', 'Listing updated successfully!');
        } else {
            return redirect()->back()->with('error_message', 'Listing updated successfully!');
        }
    }
    public function editListingForm(Request $request, $id)
    {
        $request->session()->forget('formData');
        $request->session()->forget('edit_complete_step');
        $listing = Listing::where('ListingID', $id)->first();
        $listing_id = $listing->ListingID;
        $listing_step = $listing->Steps;
        $editCompleteStep = session('edit_complete_step', []);
        for ($i = 1; $i <= $listing_step; $i++) {
            $editCompleteStep[] = $i;
        }
        session(['edit_complete_step' => $editCompleteStep]);
        return redirect()->route('edit.listing.step1', ['id' => $listing_id]);
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
    public function editStep1($id)
    {
        $listingData = Listing::where('ListingID', $id)->first();
        // Check if listing not exists
        if (!$listingData) {
            return redirect()->route('all.listing')->with('error', 'User not found.');
        }
        $categoryData = DB::table('categories')->get();
        $states = DB::table('states')->get();
        $counties = DB::table('counties')->get();
        $sub_categories = DB::table('sub_categories')->get();
        // Get the previous listing ID
        $previous = Listing::where('ListingID', '<', $id)->orderBy('ListingID', 'desc')->first();
        // Get the next listing ID
        $next = Listing::where('ListingID', '>', $id)->orderBy('ListingID', 'asc')->first();
        return view('admin.listing.edit-listing-step.edit-listing-step1', compact('categoryData', 'states', 'sub_categories', 'listingData', 'counties', 'previous', 'next'));
    }
    public function editStep2($id)
    {
        $listingData = Listing::where('ListingID', $id)->first();
        // Check if listing not exists
        if (!$listingData) {
            return redirect()->route('all.listing')->with('error', 'User not found.');
        }
        //dd($listingData);

        $step = 2;
        $editCompletedSteps = session()->get('edit_complete_step', []);
        //dd($editCompletedSteps);
        // Check if the previous step is completed
        if (!in_array($step - 1, $editCompletedSteps) && $step > 1) {
            return redirect()->route('edit.listing.step' . $step - 1, ['id' => $id]);
        }
        // Get the previous listing ID
        $previous = Listing::where('ListingID', '<', $id)->orderBy('ListingID', 'desc')->first();
        // Get the next listing ID
        $next = Listing::where('ListingID', '>', $id)->orderBy('ListingID', 'asc')->first();

        return view('admin.listing.edit-listing-step.edit-listing-step2', compact('listingData', 'previous', 'next'));
    }
    public function editStep3($id)
    {
        $listingData = Listing::where('ListingID', $id)->first();
        $listingTypes = DB::table('listing_types')->get();
        // Check if listing not exists
        if (!$listingData) {
            return redirect()->route('all.listing')->with('error', 'User not found.');
        }
        $agents = User::with('agent_info')->where('role_name', 'agent')->get();
        $agentSelect = json_decode($listingData->AgentID, true);
        if (!$agentSelect) {
            $selectedAgents = array();
        } else {
            $selectedAgents = $agentSelect;
        }
        // dd($selectedAgents);
        $step = 3;
        $editCompletedSteps = session()->get('edit_complete_step', []);
        //dd($editCompletedSteps);
        // Check if the previous step is completed
        if (!in_array($step - 1, $editCompletedSteps) && $step > 1) {
            return redirect()->route('edit.listing.step' . $step - 1, ['id' => $id]);
        }
        // Get the previous listing ID
        $previous = Listing::where('ListingID', '<', $id)->orderBy('ListingID', 'desc')->first();
        // Get the next listing ID
        $next = Listing::where('ListingID', '>', $id)->orderBy('ListingID', 'asc')->first();
        return view('admin.listing.edit-listing-step.edit-listing-step3', compact('agents', 'listingData', 'selectedAgents', 'listingTypes', 'previous', 'next'));
    }
    public function editStep4($id)
    {
        $listingData = Listing::where('ListingID', $id)->first();
        // Check if listing not exists
        if (!$listingData) {
            return redirect()->route('all.listing')->with('error', 'User not found.');
        }
        $step = 4;
        $editCompletedSteps = session()->get('edit_complete_step', []);
        // dd($editCompletedSteps);
        // Check if the previous step is completed
        if (!in_array($step - 1, $editCompletedSteps) && $step > 1) {
            return redirect()->route('edit.listing.step' . $step - 1, ['id' => $id]);
        }
        // Get the previous listing ID
        $previous = Listing::where('ListingID', '<', $id)->orderBy('ListingID', 'desc')->first();
        // Get the next listing ID
        $next = Listing::where('ListingID', '>', $id)->orderBy('ListingID', 'asc')->first();
        return view('admin.listing.edit-listing-step.edit-listing-step4', compact('listingData', 'previous', 'next'));
    }
    public function editStep5($id)
    {
        $listingData = Listing::where('ListingID', $id)->first();
        $leads = DB::table('leads')->get();
        // Check if listing not exists
        if (!$listingData) {
            return redirect()->route('all.listing')->with('error', 'User not found.');
        }
        $step = 5;
        $editCompletedSteps = session()->get('edit_complete_step', []);
        // dd($editCompletedSteps);
        // Check if the previous step is completed
        if (!in_array($step - 1, $editCompletedSteps) && $step > 1) {
            return redirect()->route('edit.listing.step' . $step - 1, ['id' => $id]);
        }
        // Get the previous listing ID
        $previous = Listing::where('ListingID', '<', $id)->orderBy('ListingID', 'desc')->first();
        // Get the next listing ID
        $next = Listing::where('ListingID', '>', $id)->orderBy('ListingID', 'asc')->first();
        return view('admin.listing.edit-listing-step.edit-listing-step5', compact('listingData', 'previous', 'next', 'leads'));
    }
    public function updateStep1(Request $request, $id)
    {
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
            'listing_img' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'document' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:5120',
        ]);
        $model = Listing::findOrFail($id);
        $filename = '';
        $docPath = '';
        $categoryData = DB::table('categories')->where('CategoryID', $request->bus_category)->first();
        $category_name = $categoryData->BusinessCategory;
        $reviewcheckboxValue = $request->has('review') ? 1 : 0;
        $franchisecheckboxValue = $request->has('franchise') ? 1 : 0;
        $featuredListingcheckboxValue = $request->has('featuredListing') ? 1 : 0;
        if ($request->hasFile('listing_img')) {
            $oldImagePath = public_path('assets/uploads/images/' . $model->imagepath);
            if (File::exists($oldImagePath)) {
                // Delete the old image from the directory
                File::delete($oldImagePath);
            }
            $image = $request->file('listing_img');
            $path = public_path() . '/assets/uploads/images/';
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $filename);

            $imagepath = $filename;
        } else {
            $imageVal = Listing::where('ListingID', $id)->first();
            $imagepath = $imageVal->imagepath;
        }
        if ($request->hasFile('document')) {
            // Delete old document if exists
            if ($model->document_path && Storage::disk('public')->exists($model->document_path)) {
                Storage::disk('public')->delete($model->document_path);
            }
            // Store new file
            $docPath = $request->file('document')->store('listing_documents', 'public');
        } else {
            $docVal = Listing::where('ListingID', $id)->first();
            $docPath = $docVal->document_path;
        }
        $currentStep = 1;
        $listingStep =  Listing::where('ListingID', $id)->first();
        if ($listingStep->Steps  >  $currentStep) {
            $updateStep = $listingStep->Steps;
        } else {
            $updateStep = $currentStep;
        }
        $listing = Listing::where('ListingID', $id)->update([
            'BusCategory' => $request->bus_category,
            'BusType' => $category_name,
            'Franchise' => $franchisecheckboxValue,
            'CorpName' => $request->cropName,
            'DBA' => $request->dba,
            'Product' => $request->productMix,
            'Address1' => $request->address,
            'City' => $request->city,
            'State' => $request->state,
            'Zip' => $request->zip_code,
            'County' => $request->country,
            'Phone' => $request->phone,
            'Fax' => $request->fax,
            'featured' => $featuredListingcheckboxValue,
            'SellerFName' => $request->first_name,
            'SellerLName' =>  $request->last_name,
            'SHomeAdd1' =>  $request->home_address,
            'SCity' =>  $request->user_city,
            'SState' =>  $request->user_state,
            'SZip' =>  $request->user_zip_code,
            'Email' =>  $request->user_email,
            'SHomePh' =>  $request->user_home_phone,
            'SHomeFax' =>  $request->user_home_fax,
            'Pager' =>  $request->user_pager,
            'Review' => $reviewcheckboxValue,
            'imagepath' => $imagepath,
            'SubCat' => $request->bus_type,
            'document_path' => $docPath,
            'Steps' => 1,
        ]);
        Activity::create([
            'action' => 'Listing update',
            'user_id' => Auth::id(),
            'details' => 'update listing, listing is ' .  $request->cropName,
        ]);
        if ($listing) {
            for ($i = 1; $i <= $updateStep; $i++) {
                $editCompleteStep[] = $i;
            }
            $request->session()->put('edit_complete_step', $editCompleteStep);
            return redirect()->route('edit.listing.step2', ['id' => $id])->with('success', 'Listing updated successfully!');
        }
    }
    public function updateStep2(Request $request, $id)
    {

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
        $listingStep =  Listing::where('ListingID', $id)->first();
        if ($listingStep->Steps  >  $currentStep) {
            $updateStep = $listingStep->Steps;
        } else {
            $updateStep = $currentStep;
        }
        $listing = Listing::where('ListingID', $id);
        $data = [
            'BldgSize' => $request->buildingSize,
            'BaseSize' => $request->basementSize,
            'Basement' => $basement,
            'Parking' => $request->parking,
            'LicenseReq' => $request->licenseRequired,
            'BaseMonthRent' => $request->baseMonthlyRent,
            'LeaseTerms' => $request->leaseTerms,
            'LeaseOpt' => $request->leaseOptions,
            'NoDaysOpen' => $request->daysOpen,
            'HoursOfOp' => $request->hoursOperation,
            'Seats' => $request->numSeats,
            'YrsEstablished' => $yearsEstablished,
            'YrsPresentOwner' => $request->yearsPrevOwner,
            'Motivation' => $request->motivation,
            'PTEmp' => $request->PTEmp,
            'FTEmp' => $request->FTEmp,
            'Steps' => 2
        ];
        $listing->update($data);
        if ($listing) {
            for ($i = 1; $i <= $updateStep; $i++) {
                $editCompleteStep[] = $i;
            }
            $request->session()->put('edit_complete_step', $editCompleteStep);

            return redirect()->route('edit.listing.step3', ['id' => $id])->with('success', 'Listing updated successfully!');
        }
    }
    public function updateStep3(Request $request, $id)
    {
        // dd($request->agents);
        $request->validate([
            'listingDate' => 'required',
        ]);
        $untilSolid = $request->has('untilSolid') ? 1 : 0;
        $realEstate = $request->has('realEstate') ? 1 : 0;
        $optionToBuy = $request->has('optionToBuy') ? 1 : 0;
        $soldByEBB = $request->has('soldByEBB') ? 1 : 0;
        $currentStep = 3;
        $listingStep =  Listing::where('ListingID', $id)->first();
        if ($listingStep->Steps  >  $currentStep) {
            $updateStep = $listingStep->Steps;
        } else {
            $updateStep = $currentStep;
        }
        $currentDate = Carbon::now();
        $validStatus = '';
        if ($request->expDate == '' || $request->expDate > $currentDate) {
            $validStatus = 'valid';
        }
        $listing = Listing::where('ListingID', $id)->update([
            'MgtAgentName' => $request->managementAgentName,
            'MgtAgentPh' => $request->managementAgentPhone,
            'RefAgentID' => $request->referringAgentName,
            'RefAgentPh' => $request->referringAgentPhone,
            'ListDate' => $request->listingDate,
            'ExpDate' => $request->expDate,
            'ListType' => $request->listingType,
            'CoBrokID' => $request->coBroker,
            'SaleReas' => $request->reasonForSale,
            'ListPrice' => $request->listPrice,
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
            'Status' => $validStatus,
            'Steps' => $updateStep
        ]);
        if ($listing) {
            //dd('sdd');
            for ($i = 1; $i <= $updateStep; $i++) {
                $editCompleteStep[] = $i;
            }
            $request->session()->put('edit_complete_step', $editCompleteStep);
            return redirect()->route('edit.listing.step4', ['id' => $id])->with('success', 'Listing updated successfully!');
        }
    }
    public function updateStep4(Request $request, $id)
    {
        $request->validate([
            'annualSales' => 'required',

        ]);
        $currentStep = 4;
        $listingStep =  Listing::where('ListingID', $id)->first();
        if ($listingStep->Steps  >  $currentStep) {
            $updateStep = $listingStep->Steps;
        } else {
            $updateStep = $currentStep;
        }
        $listing = Listing::where('ListingID', $id)->update([
            'AnnualSales' => $request->annualSales,
            'CostOfSale' => $request->costOfSales,
            'GrossProfit' => $request->grossProfit,
            'TotalExpenses' => $request->totalExpenses,
            'OtherInc' => $request->otherIncome,
            'AnnualNetProfit' => $request->annNetProfit,
            'COG1Label' => $request->goods_name1,
            'COG2Label' => $request->goods_name2,
            'COG3Label' => $request->goods_name3,
            'COG1' => $request->cost0_1,
            'COG2' => $request->cost0_2,
            'COG3' => $request->cost0_3,
            'AnnRent' => $request->baseAnnRent,
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
            'Opt1Label' => $request->Opt1Label,
            'Opt2Label' => $request->Opt2Label,
            'Opt1' => $request->Opt1,
            'Opt2' => $request->Opt2,
            'Steps' => $updateStep
        ]);
        if ($listing) {
            for ($i = 1; $i <= $updateStep; $i++) {
                $editCompleteStep[] = $i;
            }
            $request->session()->put('edit_complete_step', $editCompleteStep);
            return redirect()->route('edit.listing.step5', ['id' => $id])->with('success', 'Listing updated successfully!');
        }
    }
    public function updateStep5(Request $request, $id)
    {
        $request->validate([
            'leadId' => 'required',
        ]);
        $listing = Listing::where('ListingID', $id)->update([
            'Highlights' => $request->highlights,
            'Directions' => $request->directions,
            'Comments' => $request->comments,
            'LeadID' => $request->leadId,
            'Steps' => 5,
            'Status' => 'valid',
            'Active' => 1
        ]);
        if ($listing) {
            return redirect()->route('all.listing')->with('success', 'Listing updated successfully!');
        }
    }
    public function updateImage(Request $request, $id)
    {
        if ($request->hasFile('avatar')) {
            $model = Listing::findOrFail($id);
            $oldImagePath = public_path('assets/uploads/images/' . $model->imagepath);
            if (File::exists($oldImagePath)) {
                // Delete the old image from the directory
                File::delete($oldImagePath);
            }
            $image = $request->file('avatar');
            $path = public_path() . '/assets/uploads/images/';
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $filename);
        } else {
            $data = Listing::where('ListingID', $id)->first();
            $filename = $data->image;
        }
        $listing_img = Listing::where('ListingID', $id)->update([
            'imagepath' => $filename,
        ]);
        $userId = Auth::id();
        $listingData = Listing::findOrFail($id);
        if ($listing_img) {
            $data = [
                'title' => 'Listing image update',
                'body' => 'Admin update your listing image.',
                'timestamp' => Carbon::now()->toIso8601String(),
                'user_id' => $listingData->RefAgentID,
                'is_read' => false,
            ];
            $this->reference->push($data);
            Activity::create([
                'action' => 'Listing image update',
                'user_id' => $userId,
                'details' => 'update listing image Listing name: ' . $listingData->CorpName,
            ]);
            return redirect()->back()->with('success_message', 'Listing image update successfully');
        } else {
            return redirect()->back()->with('success_message', 'There are some error! can not be update.');
        }
    }
    /*  public function bulkAction(Request $request)
    {
        $action = $request->action;
        $listing_id = $request->listing_id;
        $currentDate = Carbon::now();
        $userId = Auth::id();
        if ($action == "active") {
            Listing::whereIn('ListingID', $listing_id)->update(['Active' => '1']);
            $listings = Listing::whereIn('ListingID', $listing_id)
                ->whereNotNull('RefAgentID')
                ->where('RefAgentID', '!=', '')
                ->get(['ListingID', 'RefAgentID']);

            if ($listings->isNotEmpty()) {
                foreach ($listings as $listing) {
                    $data = [
                        'title' => 'Listing status update',
                        'body' => 'set listings as active.',
                        'timestamp' => Carbon::now()->toIso8601String(),
                        'user_id' => $listing->RefAgentID,
                        'is_read' => false,
                    ];

                    $this->reference->push($data);
                }
            }
            Activity::create([
                'action' => 'Listing status update',
                'user_id' => $userId,
                'details' => 'set listings as active. Listing IDs: ' . implode(", ", $listing_id),
            ]);
            return response()->json(array('message' => 'Listing status has been change successfully!'));
        } else if ($action == "inactive") {
            Listing::whereIn('ListingID', $listing_id)->update(['Active' => '0']);
            $listings = Listing::whereIn('ListingID', $listing_id)
                ->whereNotNull('RefAgentID')
                ->where('RefAgentID', '!=', '')
                ->get(['ListingID', 'RefAgentID']);

            if ($listings->isNotEmpty()) {
                foreach ($listings as $listing) {
                    $data = [
                        'title' => 'Listing status update',
                        'body' => 'set listings as inactive.',
                        'timestamp' => Carbon::now()->toIso8601String(),
                        'user_id' => $listing->RefAgentID,
                        'is_read' => false,
                    ];

                    $this->reference->push($data);
                }
            }
            Activity::create([
                'action' => 'Listing status update',
                'user_id' => $userId,
                'details' => 'set listings as inactive. Listing IDs: ' . implode(", ", $listing_id),
            ]);
            return response()->json(array('message' => 'Listing status has been change successfully!'));
        } else if ($action == "close") {
            Listing::whereIn('ListingID', $listing_id)->update(['Status' => 'close']);
            $listings = Listing::whereIn('ListingID', $listing_id)
                ->whereNotNull('RefAgentID')
                ->where('RefAgentID', '!=', '')
                ->get(['ListingID', 'RefAgentID']);

            if ($listings->isNotEmpty()) {
                foreach ($listings as $listing) {
                    $data = [
                        'title' => 'Listing status update',
                        'body' => 'closed listing.',
                        'timestamp' => Carbon::now()->toIso8601String(),
                        'user_id' => $listing->RefAgentID,
                        'is_read' => false,
                    ];

                    $this->reference->push($data);
                }
            }
            Activity::create([
                'action' => 'Listing status update',
                'user_id' => $userId,
                'details' => 'closed listings. Listing IDs: ' . implode(", ", $listing_id),
            ]);
            return response()->json(array('message' => 'Listing status has been change successfully!'));
        } else if ($action == "valid") {
            Listing::whereIn('ListingID', $listing_id)
                ->where('Active', 1)
                ->where('ExpDate', '>', $currentDate)
                ->where('Status', '!=', 'valid')
                ->orWhereNull('ExpDate')
                ->update(['Status' => 'valid']);
            $listings = Listing::whereIn('ListingID', $listing_id)
                ->whereNotNull('RefAgentID')
                ->where('RefAgentID', '!=', '')
                ->get(['ListingID', 'RefAgentID']);

            if ($listings->isNotEmpty()) {
                foreach ($listings as $listing) {
                    $data = [
                        'title' => 'Listing status update',
                        'body' => 'set listings as valid.',
                        'timestamp' => Carbon::now()->toIso8601String(),
                        'user_id' => $listing->RefAgentID,
                        'is_read' => false,
                    ];

                    $this->reference->push($data);
                }
            }
            Activity::create([
                'action' => 'Listing status update',
                'user_id' => $userId,
                'details' => 'set listings as valid. Listing IDs: ' . implode(", ", $listing_id),
            ]);
            return response()->json(array('message' => 'Listing status has been change successfully!'));
        } else if ($action == "sole exclusive") {
            Listing::whereIn('ListingID', $listing_id)->update(['Status' => 'sole exclusive']);
            $listings = Listing::whereIn('ListingID', $listing_id)
                ->whereNotNull('RefAgentID')
                ->where('RefAgentID', '!=', '')
                ->get(['ListingID', 'RefAgentID']);

            if ($listings->isNotEmpty()) {
                foreach ($listings as $listing) {
                    $data = [
                        'title' => 'Listing status update',
                        'body' => 'set listings as sole exclusive.',
                        'timestamp' => Carbon::now()->toIso8601String(),
                        'user_id' => $listing->RefAgentID,
                        'is_read' => false,
                    ];

                    $this->reference->push($data);
                }
            }
            Activity::create([
                'action' => 'Listing status update',
                'user_id' => $userId,
                'details' => 'set listings as sole exclusive. Listing IDs: ' . implode(", ", $listing_id),
            ]);
            return response()->json(array('message' => 'Listing status has been change successfully!'));
        } else if ($action == "delete") {
            Listing::whereIn('ListingID', $listing_id)->delete();
            $listings = Listing::whereIn('ListingID', $listing_id)
                ->whereNotNull('RefAgentID')
                ->where('RefAgentID', '!=', '')
                ->get(['ListingID', 'RefAgentID']);

            if ($listings->isNotEmpty()) {
                foreach ($listings as $listing) {
                    $data = [
                        'title' => 'Listing delete',
                        'body' => 'deleted listing',
                        'timestamp' => Carbon::now()->toIso8601String(),
                        'user_id' => $listing->RefAgentID,
                        'is_read' => false,
                    ];

                    $this->reference->push($data);
                }
            }
            Activity::create([
                'action' => 'Listing delete',
                'user_id' => $userId,
                'details' => 'deleted listings. Listing IDs: ' . implode(", ", $listing_id),
            ]);
            return response()->json(array('message' => 'Listing delete successfully!'));
        }
    } */
    public function bulkAction(Request $request)
    {
        $action = $request->action;
        $listing_id = $request->listing_id;
        $currentDate = Carbon::now();
        $userId = Auth::id();

        // Define a mapping for actions to update columns
        $statusColumnMapping = [
            'active' => ['column' => 'Active', 'value' => 1, 'message' => 'set listings as active.'],
            'inactive' => ['column' => 'Active', 'value' => 0, 'message' => 'set listings as inactive.'],
            'close' => ['column' => 'Status', 'value' => 'close', 'message' => 'closed listing.'],
            'valid' => ['column' => 'Status', 'value' => 'valid', 'message' => 'set listings as valid.'],
        ];

        // Check if the action exists in our mapping
        if (isset($statusColumnMapping[$action])) {
            $column = $statusColumnMapping[$action]['column'];
            $value = $statusColumnMapping[$action]['value'];
            $message = $statusColumnMapping[$action]['message'];

            // Update the listings in bulk based on the action
            Listing::whereIn('ListingID', $listing_id)->update([$column => $value]);

            // Get the listings for sending notifications
            $listings = Listing::whereIn('ListingID', $listing_id)
                ->whereNotNull('RefAgentID')
                ->where('RefAgentID', '!=', '')
                ->get(['ListingID', 'RefAgentID']);

            // Send notifications to the RefAgentID of the listings
            foreach ($listings as $listing) {
                $data = [
                    'title' => 'Listing status update',
                    'body' => $message,
                    'timestamp' => Carbon::now()->toIso8601String(),
                    'user_id' => $listing->RefAgentID,
                    'is_read' => false,
                ];
                $this->reference->push($data);
            }

            // Log activity
            Activity::create([
                'action' => 'Listing status update',
                'user_id' => $userId,
                'details' => $message . ' Listing IDs: ' . implode(", ", $listing_id),
            ]);

            return response()->json(['message' => 'Listing status has been changed successfully!']);
        } elseif ($action === 'delete') {
            // Handle the delete action
            Listing::whereIn('ListingID', $listing_id)->delete();

            // Get the listings for sending notifications
            $listings = Listing::whereIn('ListingID', $listing_id)
                ->whereNotNull('RefAgentID')
                ->where('RefAgentID', '!=', '')
                ->get(['ListingID', 'RefAgentID']);

            // Send notifications to the RefAgentID of the listings
            foreach ($listings as $listing) {
                $data = [
                    'title' => 'Listing delete',
                    'body' => 'deleted listing',
                    'timestamp' => Carbon::now()->toIso8601String(),
                    'user_id' => $listing->RefAgentID,
                    'is_read' => false,
                ];
                $this->reference->push($data);
            }

            // Log activity
            Activity::create([
                'action' => 'Listing delete',
                'user_id' => $userId,
                'details' => 'deleted listings. Listing IDs: ' . implode(", ", $listing_id),
            ]);

            return response()->json(['message' => 'Listing deleted successfully!']);
        }

        return response()->json(['message' => 'Invalid action!'], 400);
    }
}
