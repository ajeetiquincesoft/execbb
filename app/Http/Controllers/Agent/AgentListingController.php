<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Listing;
use App\Models\Buyer;
use App\Models\Agent;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Activity;
use Dompdf\Dompdf;
use Dompdf\Options;

class AgentListingController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $agent = User::with('agent_info')->where('id', $user->id)->first();
        $refAgentID = $agent->agent_info->AgentID;
        session()->forget(['listingData', 'step']);
        /* $query = $request->input('query');
        $listings = Listing::where('AgentID', $refAgentID); */
        $query = $request->input('query');
        $listings = Listing::query();
        $listings->where(function ($q) {
            $q->whereNull('ExpDate')
                ->orWhere('ExpDate', '>=', now());
        });


        if ($query) {
            $listings = Listing::where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('SellerFName', 'LIKE', '%' . $query . '%')
                    ->orWhere('SellerLName', 'LIKE', '%' . $query . '%')
                    ->orWhere('CorpName', 'LIKE', '%' . $query . '%')
                    ->orWhere('SHomeAdd1', 'LIKE', '%' . $query . '%')
                    ->orWhere('SCity', 'LIKE', '%' . $query . '%')
                    ->orWhere('SHomePh', 'LIKE', '%' . $query . '%')
                    ->orWhere('Address1', 'LIKE', '%' . $query . '%')
                    ->orWhere('City', 'LIKE', '%' . $query . '%')
                    ->orWhere('Phone', 'LIKE', '%' . $query . '%')
                    ->orWhere('Email', 'LIKE', '%' . $query . '%')
                    ->orWhere('Status', 'LIKE', '%' . $query . '%');
            });
        }
        $listings = $listings->orderBy('ListingID', 'desc')->paginate(10);
        /*   $listings =  Listing::orderBy('created_at', 'desc')->paginate(5); */
        return view('agent-dashboard.listing.index', compact('listings'));
    }
    public function show($id)
    {
        /* $user = auth()->user();
        $activities = Activity::latest()->paginate(10);
        $listing = Listing::where('ListingID', $id)->where('RefAgentID', $user->id)->first();
        // Get the previous listing ID
        $previous = Listing::where('ListingID', '<', $id)->where('RefAgentID', auth()->user()->id)->orderBy('ListingID', 'desc')->first();
        // Get the next listing ID
        $next = Listing::where('ListingID', '>', $id)->where('RefAgentID', auth()->user()->id)->orderBy('ListingID', 'asc')->first(); */
        $listing = Listing::where('ListingID', $id)->first();
        $activities = Activity::latest()->paginate(10);
        // Get the previous listing ID
        $previous = Listing::where('ListingID', '<', $id)->orderBy('ListingID', 'desc')->first();
        // Get the next listing ID
        $next = Listing::where('ListingID', '>', $id)->orderBy('ListingID', 'asc')->first();
        return view('agent-dashboard.listing.show', compact('listing', 'previous', 'next', 'activities'));
    }
    public function getOptions($id)
    {
        // Fetch options based on the selected ID (e.g., from a database)
        $options = DB::table('sub_categories')->where('CatID', $id)->get();

        return response()->json($options);
    }
    public function create()
    {
        session()->forget(['listingData', 'step']);
        return redirect()->route('agent.listing.form');
    }
    public function showForm(Request $request)
    {
        /*  $listing_id = session()->get('listingData.listing_id');
                dd($listing_id); */
        // session()->forget(['listingData', 'step']);
        // Retrieve the current step from the session, default to 1
        $step = session('step', 1);
        $listingData = session('listingData', []); // Retrieve saved form data from session
        //dd($listingData);
        $categoryData = DB::table('categories')->get();
        $states = DB::table('states')->get();
        $counties = DB::table('counties')->get();
        $sub_categories = DB::table('sub_categories')->get();
        $agents = User::with('agent_info')->where('role_name', 'agent')->get();
        $listingTypes = DB::table('listing_types')->get();
        $leads = DB::table('leads')->get();
        return view('agent-dashboard.listing.create', compact('step', 'listingData', 'categoryData', 'states', 'sub_categories', 'counties', 'agents', 'listingTypes', 'leads'));
    }
    // Process the form data and move to the next step
    public function processForm(Request $request)
    {
        /*  $listing_id = session()->get('listingData.bus_category');
        dd( $request->bus_category); */
        $step = session('step', 1);
        $this->validateStep($request, $step);
        //dd($step);
        // Logic to handle form submission based on current step
        if ($step == 1) {
            //dd('santosh');
            // dd($request->all());
            $filename = '';
            $userID = auth()->user()->id;
            $reviewcheckboxValue = $request->has('review') ? 1 : 0;
            $franchisecheckboxValue = $request->has('franchise') ? 1 : 0;
            $featuredListingcheckboxValue = $request->has('featuredListing') ? 1 : 0;
            if (session()->has('listingData.listing_id')) {
                $bus_id = session()->get('listingData.bus_category');
                $sub_cat_id = session()->get('listingData.bus_type');
                $categoryData = DB::table('categories')->where('CategoryID', $bus_id)->first();
                $category_name = $categoryData->BusinessCategory;

                $listing_id = session()->get('listingData.listing_id');

                $listing = Listing::where('ListingID', $listing_id)->first();

                if (!$listing) {
                    return back()->with('error', 'Listing not found!');
                }
                if ($request->hasFile('listing_img')) {
                    $image = $request->file('listing_img');
                    $path = public_path() . '/assets/uploads/images/';
                    $filename = time() . '.' . $image->getClientOriginalExtension();
                    $image->move($path, $filename);

                    $imagepath = $filename;
                } else {
                    $imageVal = Listing::where('ListingID', $listing_id)->first();
                    $imagepath = $imageVal->imagepath;
                }
                $listing->BusCategory = $bus_id;
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
                $listing->imagepath = $imagepath;
                $listing->SubCat = $sub_cat_id;
                $listing->RefAgentID = $userID;

                // Save the new record to the database
                $listing->save();
                $listingData = $request->session()->get('listingData', []);
                $mergedData = array_merge($listingData, $request->all());
                $request->session()->put('listingData', $mergedData);
                $request->session()->put('listingData.listing_img', $imagepath);
                $request->session()->put('listingData.listing_id',  $listing_id);
                $request->session()->put('listingData.reviewCheckbox',  $reviewcheckboxValue);
                $request->session()->put('listingData.franchCheckbox',  $franchisecheckboxValue);
                $request->session()->put('listingData.featureCheckbox',  $featuredListingcheckboxValue);
            } else {
                $categoryData = DB::table('categories')->where('CategoryID', $request->bus_category)->first();
                $category_name = $categoryData->BusinessCategory;
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
                $listing->RefAgentID = $userID;
                $listing->CreatedBy = Auth::id();
                $listing->Status = 'review';
                $listing->Steps = 1;
                if ($request->hasFile('listing_img')) {
                    $image = $request->file('listing_img');
                    $path = public_path() . '/assets/uploads/images/';
                    $filename = time() . '.' . $image->getClientOriginalExtension();
                    $image->move($path, $filename);
                    $listing->imagepath = $filename;
                }
                $listing->save();
                $listingData = $request->session()->get('listingData', []);
                $mergedData = array_merge($listingData, $request->all());
                $request->session()->put('listingData', $mergedData);
                $insertedId = $listing->ListingID;
                $request->session()->put('listingData.listing_id',  $insertedId);
                $request->session()->put('listingData.listing_img', $filename);
                $request->session()->put('listingData.reviewCheckbox',  $reviewcheckboxValue);
                $request->session()->put('listingData.franchCheckbox',  $franchisecheckboxValue);
                $request->session()->put('listingData.featureCheckbox',  $featuredListingcheckboxValue);
            }
        } elseif ($step == 2) {
            $listing_id = session()->get('listingData.listing_id');
            $listing = Listing::where('ListingID', $listing_id)->first();
            if (!$listing) {
                return back()->with('error', 'Listing not found!');
            }
            $basement = $request->has('basement') ? 1 : 0;
            $listing = Listing::where('ListingID', $listing_id);
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
                'YrsEstablished' => $request->yearsEstablished,
                'YrsPresentOwner' => $request->yearsPrevOwner,
                'Motivation' => $request->motivation,
                'PTEmp' => $request->PTEmp,
                'FTEmp' => $request->FTEmp,
                'Steps' => 2
            ];
            $listing->update($data);
            $listingData = $request->session()->get('listingData', []);
            $mergedData = array_merge($listingData, $request->all());
            $request->session()->put('listingData', $mergedData);
            $request->session()->put('listingData.Basement',  $basement);
        } elseif ($step == 3) {
            $listing_id = session()->get('listingData.listing_id');
            $listing = Listing::where('ListingID', $listing_id)->first();
            if (!$listing) {
                return back()->with('error', 'Listing not found!');
            }
            // Update the fields with the request Escrow data
            $untilSolid = $request->has('untilSolid') ? 1 : 0;
            $realEstate = $request->has('realEstate') ? 1 : 0;
            $optionToBuy = $request->has('optionToBuy') ? 1 : 0;
            $soldByEBB = $request->has('soldByEBB') ? 1 : 0;
            if (!empty($request->referringAgentName)) {
                $RefAgentID = $request->referringAgentName;
            } else {
                $RefAgentID = auth()->user()->id;
            }
            $validStatus = '';
            $currentDate = Carbon::now();
            if ($request->expDate == '' || $request->expDate > $currentDate) {
                $validStatus = 'valid';
            }
            if ($listing) {
                // Update the attributes
                $listing->MgtAgentName = $request->managementAgentName;
                $listing->MgtAgentPh = $request->managementAgentPhone;
                $listing->RefAgentID = $RefAgentID;
                $listing->RefAgentPh = $request->referringAgentPhone;
                $listing->ListDate = $request->listingDate;
                $listing->ExpDate = $request->expDate;
                $listing->ListType = $request->listingType;
                $listing->CoBrokID = $request->coBroker;
                $listing->SaleReas = $request->reasonForSale;
                $listing->ListPrice = $request->listPrice;
                $listing->PurPrice = $request->purPrice;
                $listing->DownPay = $request->downPay;
                $listing->Balance = $request->balance;
                $listing->Interest = $request->interest;
                $listing->AddTerm = $request->addTerms;
                $listing->InvInPrice = $request->invInPrice;
                $listing->InvNot = $request->invNotInPrice;
                $listing->UntilSold = $untilSolid;
                $listing->AgentID = $request->agents;
                $listing->Commission = $request->commission;
                $listing->FlatFee = $request->flatFee;
                $listing->REAskingPrice = $request->reAskingPrice;
                $listing->RealEstate = $realEstate;
                $listing->ToBuy = $optionToBuy;
                $listing->SoldEBB = $soldByEBB;
                $listing->Status = $validStatus;
                $listing->Steps = 3;

                // Save the model to the database
                $listing->save();
            }
            $listingData = $request->session()->get('listingData', []);
            $mergedData = array_merge($listingData, $request->all());
            $request->session()->put('listingData', $mergedData);
        } elseif ($step == 4) {
            $listing_id = session()->get('listingData.listing_id');
            $listing = Listing::where('ListingID', $listing_id)->first();
            if (!$listing) {
                return back()->with('error', 'Listing not found!');
            }
            // Check if the listing exists
            if ($listing) {
                // Update the attributes
                $listing->AnnualSales = $request->annualSales;
                $listing->CostOfSale = $request->costOfSales;
                $listing->GrossProfit = $request->grossProfit;
                $listing->TotalExpenses = $request->totalExpenses;
                $listing->COG1Label = $request->goods_name1;
                $listing->COG2Label = $request->goods_name2;
                $listing->COG3Label = $request->goods_name3;
                $listing->COG1 = $request->cost0_1;
                $listing->COG2 = $request->cost0_2;
                $listing->COG3 = $request->cost0_3;
                $listing->AnnRent = $request->baseAnnRent;
                $listing->CommonAreaMaint = $request->commAreaMaint;
                $listing->RealEstateTax = $request->realEstateTax;
                $listing->AnnPayroll = $request->annPayroll;
                $listing->PayrollTax = $request->payrollTax;
                $listing->LicFee = $request->licenseFees;
                $listing->Advertising = $request->advertising;
                $listing->Telephone = $request->telephone;
                $listing->Utilities = $request->utilities;
                $listing->Insurance = $request->insurance;
                $listing->AcctLeg = $request->accountingLegal;
                $listing->Maintenance = $request->maintenance;
                $listing->Trash = $request->trash;
                $listing->Other = $request->other;
                $listing->Steps = 4; // You can keep the fixed value for Steps

                // Save the model to the database
                $listing->save();
            }
            $listingData = $request->session()->get('listingData', []);
            $mergedData = array_merge($listingData, $request->all());
            $request->session()->put('listingData', $mergedData);
        } elseif ($step == 5) {
            if ($request->has('next')) {
                $listing_id = session()->get('listingData.listing_id');
                $listing = Listing::where('ListingID', $listing_id)->first();
                if (!$listing) {
                    return back()->with('error', 'Listing not found!');
                }
                // Update the fields with the request data
                $listing->Highlights = $request->highlights;
                $listing->Comments = $request->comments;
                $listing->Directions = $request->directions;
                $listing->LeadID = $request->leadId;
                $listing->Status = 'valid';
                $listing->Active = 0;

                // Save the updated record
                $listing->Steps = $step;
                $listing->save();
                session()->forget(['listingData', 'step']);
                return redirect()->route('agent.all.listing')->with('success', 'Your listing create successfully!');
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
        return redirect()->route('agent.listing.form');
    }
    public function editForm(Request $request, $id)
    {
        $previousListingId = session('listingData.prevListingId', null);
        // Find the listing ID
        $listingData = Listing::where('ListingID', $id)->first();
        if (!$listingData) {
            return redirect()->back()
                ->with('err_message', 'Listing not found.');
        }
        if ($previousListingId != $id) {
            session(['step' => 1]);
            session(['listingData.prevListingId' => $id]);
        }
        $step = session('step', 1);
        $listingDatas = session('listingData', []);
        $request->session()->put('listingData.listing_id',  $id);
        $categoryData = DB::table('categories')->get();
        $states = DB::table('states')->get();
        $counties = DB::table('counties')->get();
        $sub_categories = DB::table('sub_categories')->get();
        $agents = User::with('agent_info')->where('role_name', 'agent')->get();
        $agentSelect = json_decode($listingData->AgentID, true);
        if (!$agentSelect) {
            $selectedAgents = array();
        } else {
            $selectedAgents = $agentSelect;
        }
        $listingTypes = DB::table('listing_types')->get();
        $leads = DB::table('leads')->get();
        // Get the previous listing ID
        $previous = Listing::where('ListingID', '<', $id)->where('RefAgentID', auth()->user()->id)->orderBy('ListingID', 'desc')->first();
        // Get the next listing ID
        $next = Listing::where('ListingID', '>', $id)->where('RefAgentID', auth()->user()->id)->orderBy('ListingID', 'asc')->first();
        return view('agent-dashboard.listing.edit', compact('step', 'listingDatas', 'categoryData', 'states', 'sub_categories', 'counties', 'agents', 'listingTypes', 'leads', 'listingData', 'selectedAgents', 'previous', 'next'));
    }
    public function editProcessForm(Request $request, $id)
    {
        /*  $listing_id = session()->get('listingData.bus_category');
        dd( $request->bus_category); */
        $step = session('step', 1);
        $this->validateStep($request, $step);
        $listing_id = session()->get('listingData.listing_id');
        $listing = Listing::where('ListingID', $listing_id)->first();
        if (!$listing) {
            return back()->with('error', 'Listing not found!');
        }
        // Logic to handle form submission based on current step
        if ($step == 1) {
            $filename = '';
            $reviewcheckboxValue = $request->has('review') ? 1 : 0;
            $franchisecheckboxValue = $request->has('franchise') ? 1 : 0;
            $featuredListingcheckboxValue = $request->has('featuredListing') ? 1 : 0;
            if ($request->has('bus_category')) {
                $categoryData = DB::table('categories')->where('CategoryID', $request->bus_category)->first();
                $category_name = $categoryData->BusinessCategory;
                if ($request->hasFile('listing_img')) {
                    $image = $request->file('listing_img');
                    $path = public_path() . '/assets/uploads/images/';
                    $filename = time() . '.' . $image->getClientOriginalExtension();
                    $image->move($path, $filename);

                    $imagepath = $filename;
                } else {
                    $imageVal = Listing::where('ListingID', $listing_id)->first();
                    $imagepath = $imageVal->imagepath;
                }
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
                $listing->imagepath = $imagepath;
                $listing->SubCat = $request->bus_type;

                // Save the new record to the database
                $listing->save();
                $listingData = $request->session()->get('listingData', []);
                $mergedData = array_merge($listingData, $request->all());
                $request->session()->put('listingData', $mergedData);
                $request->session()->put('listingData.listing_img', $imagepath);
                $request->session()->put('listingData.listing_id',  $listing_id);
                $request->session()->put('listingData.reviewCheckbox',  $reviewcheckboxValue);
                $request->session()->put('listingData.franchCheckbox',  $franchisecheckboxValue);
                $request->session()->put('listingData.featureCheckbox',  $featuredListingcheckboxValue);
            }
        } elseif ($step == 2) {
            if ($request->has('parking')) {
                $basement = $request->has('basement') ? 1 : 0;
                $listing->BldgSize = $request->buildingSize;
                $listing->BaseSize = $request->basementSize;
                $listing->Basement = $basement;
                $listing->Parking = $request->parking;
                $listing->LicenseReq = $request->licenseRequired;
                $listing->BaseMonthRent = $request->baseMonthlyRent;
                $listing->LeaseTerms = $request->leaseTerms;
                $listing->LeaseOpt = $request->leaseOptions;
                $listing->NoDaysOpen = $request->daysOpen;
                $listing->HoursOfOp = $request->hoursOperation;
                $listing->Seats = $request->numSeats;
                $listing->YrsEstablished = $request->yearsEstablished;
                $listing->YrsPresentOwner = $request->yearsPrevOwner;
                $listing->Motivation = $request->motivation;
                $listing->PTEmp = $request->PTEmp;
                $listing->FTEmp = $request->FTEmp;
                $listing->Steps = 2;
                // Save the model to the database
                $listing->save();
                $listingData = $request->session()->get('listingData', []);
                $mergedData = array_merge($listingData, $request->all());
                $request->session()->put('listingData', $mergedData);
                $request->session()->put('listingData.Basement',  $basement);
            }
        } elseif ($step == 3) {
            if ($request->has('managementAgentName')) {
                $validStatus = '';
                $currentDate = Carbon::now();
                if ($request->expDate == '' || $request->expDate > $currentDate) {
                    $validStatus = 'valid';
                }
                // Update the fields with the request Escrow data
                $untilSolid = $request->has('untilSolid') ? 1 : 0;
                $realEstate = $request->has('realEstate') ? 1 : 0;
                $optionToBuy = $request->has('optionToBuy') ? 1 : 0;
                $soldByEBB = $request->has('soldByEBB') ? 1 : 0;
                $listing->MgtAgentName = $request->managementAgentName;
                $listing->MgtAgentPh = $request->managementAgentPhone;
                $listing->RefAgentID = $request->referringAgentName;
                $listing->RefAgentPh = $request->referringAgentPhone;
                $listing->ListDate = $request->listingDate;
                $listing->ExpDate = $request->expDate;
                $listing->ListType = $request->listingType;
                $listing->CoBrokID = $request->coBroker;
                $listing->SaleReas = $request->reasonForSale;
                $listing->ListPrice = $request->listPrice;
                $listing->PurPrice = $request->purPrice;
                $listing->DownPay = $request->downPay;
                $listing->Balance = $request->balance;
                $listing->Interest = $request->interest;
                $listing->AddTerm = $request->addTerms;
                $listing->InvInPrice = $request->invInPrice;
                $listing->InvNot = $request->invNotInPrice;
                $listing->UntilSold = $untilSolid;
                $listing->AgentID = $request->agents;
                $listing->Commission = $request->commission;
                $listing->FlatFee = $request->flatFee;
                $listing->REAskingPrice = $request->reAskingPrice;
                $listing->RealEstate = $realEstate;
                $listing->ToBuy = $optionToBuy;
                $listing->SoldEBB = $soldByEBB;
                $listing->Status = $validStatus;
                $listing->Steps = 3;

                // Save the model to the database
                $listing->save();

                $listingData = $request->session()->get('listingData', []);
                $mergedData = array_merge($listingData, $request->all());
                $request->session()->put('listingData', $mergedData);
            }
        } elseif ($step == 4) {
            if ($request->has('annualSales')) {
                // Update the attributes
                $listing->AnnualSales = $request->annualSales;
                $listing->CostOfSale = $request->costOfSales;
                $listing->GrossProfit = $request->grossProfit;
                $listing->TotalExpenses = $request->totalExpenses;
                $listing->COG1Label = $request->goods_name1;
                $listing->COG2Label = $request->goods_name2;
                $listing->COG3Label = $request->goods_name3;
                $listing->COG1 = $request->cost0_1;
                $listing->COG2 = $request->cost0_2;
                $listing->COG3 = $request->cost0_3;
                $listing->AnnRent = $request->baseAnnRent;
                $listing->CommonAreaMaint = $request->commAreaMaint;
                $listing->RealEstateTax = $request->realEstateTax;
                $listing->AnnPayroll = $request->annPayroll;
                $listing->PayrollTax = $request->payrollTax;
                $listing->LicFee = $request->licenseFees;
                $listing->Advertising = $request->advertising;
                $listing->Telephone = $request->telephone;
                $listing->Utilities = $request->utilities;
                $listing->Insurance = $request->insurance;
                $listing->AcctLeg = $request->accountingLegal;
                $listing->Maintenance = $request->maintenance;
                $listing->Trash = $request->trash;
                $listing->Other = $request->other;
                $listing->Steps = 4; // You can keep the fixed value for Steps

                // Save the model to the database
                $listing->save();

                $listingData = $request->session()->get('listingData', []);
                $mergedData = array_merge($listingData, $request->all());
                $request->session()->put('listingData', $mergedData);
            }
        } elseif ($step == 5) {
            if ($request->has('next')) {
                if ($request->has('highlights')) {
                    $listing->Highlights = $request->highlights;
                    $listing->Comments = $request->comments;
                    $listing->Directions = $request->directions;
                    $listing->LeadID = $request->leadId;
                    $listing->Status = 'valid';
                    $listing->Active = 0;
                    // Save the updated record
                    $listing->Steps = $step;
                    $listing->save();
                    session()->forget(['listingData', 'step']);
                    return redirect()->route('agent.all.listing')->with('success', 'Your listing create successfully!');
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
        return redirect()->route('agent.edit.listing.form', ['id' => $listing->ListingID]);
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
                    ];
                    break;
                case 2:
                    // Step 2 validation rules
                    $rules = [
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
                    ];
                    break;
                case 3:
                    // Step 3 validation rules
                    $rules = [
                        'managementAgentName' => 'required',
                        'managementAgentPhone' => 'required',
                        'referringAgentName' => 'required',
                        'referringAgentPhone' => 'required',
                        'listingDate' => 'required',
                        'expDate' => 'required',
                        'coBroker' => 'required',
                        'reasonForSale' => 'required',
                        'agents' => 'required',
                    ];
                    break;
                case 4:
                    // Step 4 validation rules
                    $rules = [
                        'annualSales' => 'required',
                        'costOfSales' => 'required',
                        'grossProfit' => 'required',
                        'totalExpenses' => 'required',
                    ];
                    break;
                case 5:
                    // Step 5 validation rules
                    $rules = [
                        'highlights' => 'required',
                        'comments' => 'required',
                        'leadId' => 'required',
                    ];
                    break;
            }

            // Validate the request with the current step's rules
            $request->validate($rules);
        }
    }

    public function destroy(Request $request, $id)
    {
        // Find the listing by custom ID
        $listing = Listing::where('ListingID', $id)->first();
        if (!$listing) {
            return redirect()->route('agent.all.listing')
                ->with('err_message', 'Listing not found.');
        }
        // Delete the listing
        $listing->delete();
        return redirect()->route('agent.all.listing')
            ->with('success', 'Listing deleted successfully.');
    }
    public function prevNext(Request $request, $id)
    {

        session()->forget(['listingData', 'step']);
        $step = session('step', 1);
        return redirect()->route('agent.edit.listing.form', $id);
    }
    public function bulkAction(Request $request)
    {
        $action = $request->action;
        $listing_id = $request->listing_id;
        $currentDate = Carbon::now();
        if ($action == "active") {
            Listing::whereIn('ListingID', $listing_id)->update(['Active' => '1']);
            return response()->json(array('message' => 'Listing status has been change successfully!'));
        } else if ($action == "inactive") {
            Listing::whereIn('ListingID', $listing_id)->update(['Active' => '0']);
            return response()->json(array('message' => 'Listing status has been change successfully!'));
        } else if ($action == "close") {
            Listing::whereIn('ListingID', $listing_id)->update(['Status' => 'close']);
            return response()->json(array('message' => 'Listing status has been change successfully!'));
        } else if ($action == "valid") {
            Listing::whereIn('ListingID', $listing_id)
                ->where('Active', 1)
                ->where('ExpDate', '>', $currentDate)
                ->where('Status', '!=', 'valid')
                ->orWhereNull('ExpDate')
                ->update(['Status' => 'valid']);
            return response()->json(array('message' => 'Listing status has been change successfully!'));
        } else if ($action == "delete") {
            Listing::whereIn('ListingID', $listing_id)->delete();
            return response()->json(array('message' => 'Listing delete successfully!'));
        }
    }

    public function factsheet($id)
    {
        $listingData = Listing::findOrFail($id);
        $annualSaleAmount = $listingData->AnnualSales;
        $listingAgent = Agent::where('AgentID', $listingData->AgentID)->first();
        $lname = $listingAgent ? $listingAgent->LName : '';
        $fname = $listingAgent ? $listingAgent->FName : '';
        // Prepare HTML for PDF
        $html = view('agent-dashboard.listing.factsheet', compact('listingData', 'annualSaleAmount', 'fname', 'lname'))->render();

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Download or inline
        return $dompdf->stream("listing-factsheet-{$listingData->ListingID}.pdf");
    }
}
