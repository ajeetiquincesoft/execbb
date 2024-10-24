<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Listing;
use App\Models\User;
use Throwable;
use Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ListingController extends Controller
{
    public function form(Request $request){
            $request->session()->forget('formData');
            $request->session()->forget('business');
            $request->session()->forget('pricing');
            $request->session()->forget('financial');
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
    public function index(){
        $listings =  Listing::orderBy('created_at', 'desc')->paginate(5);
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
        $bus_category = DB::table('categories')->get();
        return view('admin.listing.listing-step.listing-step1',compact('bus_category'));
    }
    public function createStep2(){
        $formData = session('formData');
        return view('admin.listing.listing-step.listing-step2');
    }
    public function createStep3(){
        $agents = User::with('agent_info')->where('role_name','agent')->get();
        //dd($agents);
        return view('admin.listing.listing-step.listing-step3', compact('agents'));
    }
    public function createStep4(){
        return view('admin.listing.listing-step.listing-step4');
    }
    public function createStep5(){
        return view('admin.listing.listing-step.listing-step5');
    }
    public function storeStep1(Request $request){
        
            $validator = Validator::make($request->all(), [ 
                'bus_category' => 'required',
                'bus_type' => 'required',
                'cropName' => 'required',
            ]);
            if ($validator->fails()) { 
                return response()->json(['errors' => $validator->errors()], 422);
             }
             $reviewcheckboxValue = $request->has('review') ? 1 : 0;
             $franchisecheckboxValue = $request->has('franchise') ? 1 : 0;
             $featuredListingcheckboxValue = $request->has('featuredListing') ? 1 : 0;
             if (session()->has('formData.listing_id')){
                $listing_id = session()->get('formData.listing_id');
                $listing = Listing::where('ListingID',$listing_id)->update([
                    'BusCategory' => $request->bus_category,
                    'BusType' => $request->bus_type,
                    'Franchise' => $franchisecheckboxValue,
                    'SellerCorpName' => $request->cropName,
                    'DBA' =>$request->dba,
                    'Product' => $request->productMix,
                    'Address1' => $request->address,
                    'City' => $request->user_city,
                    'State' => $request->user_state,
                    'Zip' =>$request->user_zip_code,
                    'County' => $request->country,
                    'SHomePh' => $request->phone,
                    'SHomeFax' => $request->fax,
                    'featured' => $featuredListingcheckboxValue,
                    'SellerFName' => $request->first_name,
                    'SellerLName'=>  $request->last_name,
                    'SHomeAdd1'=>  $request->home_address,
                    'SCity'=>  $request->city,
                    'SState'=>  $request->state,
                    'SZip'=>  $request->zip_code,
                    'Email'=>  $request->email,
                    'SHomePh'=>  $request->user_home_phone,
                    'SHomeFax'=>  $request->user_home_fax,
                    'Pager'=>  $request->user_pager,
                    'Review'=> $reviewcheckboxValue,
                    /* 'imagepath'=> $filename, */
                ]);
                $redirectUrl = url('/admin/create/listing/step2');
                $formData = $request->session()->get('formData', []);
                $mergedData = array_merge($formData, $request->all());
                $request->session()->put('formData', $mergedData);
                $request->session()->put('formData.listing_id',  $listing_id);
                $request->session()->put('formData.reviewCheckbox',  $reviewcheckboxValue);
                $request->session()->put('formData.franchCheckbox',  $franchisecheckboxValue);
                $request->session()->put('formData.featureCheckbox',  $featuredListingcheckboxValue);
                $request->session()->put('formData.step',  1);
                Log::info('Session Data:', $request->session()->all());
                return response()->json(['success' => 'Listing updated successfully!','redirect' => $redirectUrl]);
             }
             else{
                $listing = new Listing;
                $listing->BusCategory = $request->bus_category;
                $listing->BusType = $request->bus_type;
                $listing->Franchise = $franchisecheckboxValue;
                $listing->SellerCorpName = $request->cropName;
                $listing->DBA = $request->dba;
                $listing->Product = $request->productMix;
                $listing->Address1 = $request->address;
                $listing->City = $request->user_city;
                $listing->State = $request->user_state;
                $listing->Zip = $request->user_zip_code;
                $listing->County = $request->country;
                $listing->SHomePh = $request->phone;
                $listing->SHomeFax = $request->fax;
                $listing->featured = $featuredListingcheckboxValue;
                $listing->SellerFName = $request->first_name;
                $listing->SellerLName = $request->last_name;
                $listing->SHomeAdd1 = $request->home_address;
                $listing->SCity = $request->city;
                $listing->SState = $request->state;
                $listing->SZip = $request->zip_code;
                $listing->Email = $request->user_email;
                $listing->SHomePh = $request->user_home_phone;
                $listing->SHomeFax = $request->user_home_fax;
                $listing->Pager = $request->user_pager;
                $listing->Review = $reviewcheckboxValue;
                $listing->SubCat = 2;
                $listing->Steps= 1;
               if( $request->hasFile('listing_img')) {
                    $image = $request->file('listing_img');
                    $path = public_path(). '/assets/uploads/images/';
                    $filename = time() . '.' . $image->getClientOriginalExtension();
                    $image->move($path, $filename);
                
                    $listing->imagepath = $filename;
                }
                $listing->save();
                $redirectUrl = url('/admin/create/listing/step2');
                $formData = $request->session()->get('formData', []);
                $mergedData = array_merge($formData, $request->all());
                $request->session()->put('formData', $mergedData);
                $insertedId = $listing->ListingID;
                $request->session()->put('formData.listing_id',  $insertedId);
                $request->session()->put('formData.reviewCheckbox',  $reviewcheckboxValue);
                $request->session()->put('formData.franchCheckbox',  $franchisecheckboxValue);
                $request->session()->put('formData.featureCheckbox',  $featuredListingcheckboxValue);
                $request->session()->put('formData.step',  1);
                Log::info('Session Data:', $request->session()->all());
                return response()->json(['success' => 'Listing created successfully!','redirect' => $redirectUrl]);

             }
           
       
    }
    public function storeStep2(Request $request){
        try {
            $validator = Validator::make($request->all(), [ 
                'buildingSize' => 'required',
                'basementSize' => 'required'
            ]);
            if ($validator->fails()) { 
                return response()->json(['errors' => $validator->errors()], 422);
             }
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
            $redirectUrl = url('/admin/create/listing/step3');
            $formData = $request->session()->get('formData', []);
            $mergedData = array_merge($formData, $request->all());
            $request->session()->put('formData', $mergedData);
            $request->session()->put('formData.YrsEstablished',  $yearsEstablished);
            $request->session()->put('formData.Basement',  $basement);
            $request->session()->put('formData.step',  2);
            return response()->json(['success' => 'Listing update successfully!','redirect' => $redirectUrl]);
            }
        } catch (Throwable $e) {
            // If there's an error, return a JSON response with a 500 status
            return response()->json(['error' => 'Failed to update listing.'], 500);
        }
    }
    public function storeStep3(Request $request){
        try {
            $validator = Validator::make($request->all(), [ 
                'managementAgentName' => 'required',
                'managementAgentPhone' => 'required'
            ]);
            if ($validator->fails()) { 
                return response()->json(['errors' => $validator->errors()], 422);
             }
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
            $redirectUrl = url('/admin/create/listing/step4');
            $formData = $request->session()->get('formData', []);
            $mergedData = array_merge($formData, $request->all());
            $request->session()->put('formData', $mergedData);
            $request->session()->put('formData.step',  3);
            return response()->json(['success' => 'Listing update successfully!','redirect' => $redirectUrl]);
            }
        } catch (Throwable $e) {
            // If there's an error, return a JSON response with a 500 status
            return response()->json(['error' => 'Failed to update listing.'], 500);
        }
    }
    public function storeStep4(Request $request){
        try {
            $validator = Validator::make($request->all(), [ 
                'goods_name1' => 'required',
                'goods_name2' => 'required'
            ]);
            if ($validator->fails()) { 
                return response()->json(['errors' => $validator->errors()], 422);
             }
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
            $redirectUrl = url('/admin/create/listing/step5');
            $formData = $request->session()->get('formData', []);
            $mergedData = array_merge($formData, $request->all());
            $request->session()->put('formData', $mergedData);
            $request->session()->put('formData.step',  4);
            return response()->json(['success' => 'Listing update successfully!','redirect' => $redirectUrl]);
            }
        } catch (Throwable $e) {
            // If there's an error, return a JSON response with a 500 status
            return response()->json(['error' => 'Failed to update listing.'], 500);
        }
    }
    public function storeStep5(Request $request){
        try {
            $validator = Validator::make($request->all(), [ 
                'highlights' => 'required',
                'comments' => 'required'
            ]);
            if ($validator->fails()) { 
                return response()->json(['errors' => $validator->errors()], 422);
             }
             $listing = Listing::where('ListingID',$request->id)->update([
                'Highlights' => $request->highlights,
                'Comments' => $request->directions,
                'Directions' => $request->comments,
                'LeadID' => $request->leadId,
                'Steps'=> 5,
                'Status'=> 'published'
            ]);
            if($listing){
            $redirectUrl = url('/admin/listing/all');
            $request->session()->forget('formData');
            return response()->json(['success' => 'Listing created successfully!','redirect' => $redirectUrl]);
            }
        } catch (Throwable $e) {
            // If there's an error, return a JSON response with a 500 status
            return response()->json(['error' => 'Failed to update listing.'], 500);
        }
    }
}
