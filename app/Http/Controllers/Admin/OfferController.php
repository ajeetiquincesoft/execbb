<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buyer;
use App\Models\Agent;
use App\Models\Offer;
use App\Models\Listing;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{
    public function index(Request $request){
        session()->forget(['offerData', 'step']);
        $query = $request->input('query');
        $offers = Offer::query();
        if ($query) {
            $offers->whereHas('listing', function ($queryBuilder) use ($query) {
                $queryBuilder->where('SellerCorpName', 'like', '%' . $query . '%');
            })
            ->orWhere('Status', 'like', '%' . $query . '%');
        }
        $offers = $offers->with('listing')
                        ->orderBy('created_at', 'desc')
                        ->paginate(5);
        $company_name = DB::table('listings')->pluck('SellerCorpName', 'ListingID');
         return view('admin.offer.index', compact('offers', 'company_name'));
    }
    public function create(){
        session()->forget(['offerData', 'step']);
        return redirect()->route('offer.form');
        
    }
    public function destroy(Request $request, $id)
    {
       
            // Find the offer ID
            $offer = Offer::where('OfferID', $id)->first();
            //dd($listing);
            // Check if the offer exists
            if (!$offer) {
                return redirect()->route('all.offer')
                    ->with('err_message', 'Offer not found.');
            }

            // Delete the offer
            Offer::where('OfferID', $id)->delete();

            return redirect()->route('all.offer')
                ->with('success', 'Offer deleted successfully.');
      
    }
    // Show the form for a specific step
    public function showForm(Request $request)
    {
        /*  $offer_id = session()->get('offerData.listing_id');
                dd($offer_id); */
        // session()->forget(['offerData', 'step']);
        // Retrieve the current step from the session, default to 1
        $step = session('step', 1);
        $offerData = session('offerData', []); // Retrieve saved form data from session
        // dd($offerData);
        $buyers = Buyer::orderBy('created_at', 'desc')->get();
        $agents = Agent::orderBy('created_at', 'desc')->get();
        $listings = Listing::orderBy('created_at', 'desc')->get();
        $states = DB::table('states')->get();
        $offer_types = DB::table('offer_types')->get();
         // Get the next ID
        $nextOfferId = Offer::max('OfferID') + 1;
        return view('admin.offer.create', compact('step', 'offerData', 'buyers', 'agents','states','listings','nextOfferId','offer_types'));
    }

    // Process the form data and move to the next step
    public function processForm(Request $request)
    {
        $step = session('step', 1);
        $this->validateStep($request,$step);
        if ($request->has('previous')) {
            $step = $step - 1;
        }
        // Logic to handle form submission based on current step
        if ($step == 1) {
            if (session()->has('offerData.offer_id')) {
                $offer_id = session()->get('offerData.offer_id');
                $offer = Offer::where('OfferID', $offer_id)->first();
                if (!$offer) {
                    return back()->with('error', 'Offer not found!');
                }
                // Update the fields with the request data
                $offer->ListingID = $request->companyName;
                $offer->Status = $request->status;
                $offer->BuyerID = $request->buyer;
                $offer->ListingAgent = $request->listingAgent;
                $offer->SellingAgent = $request->sellingAgent;
                $offer->DateOfOffer = $request->dateOfOffer;
                $offer->ExpDate = $request->expDate;
                $offer->AccDate = $request->accDate;
                $offer->ClosingDate = $request->closeDate;
                $offer->PurchasePrice = $request->purchasePrice;
                $offer->DownPaymnt = $request->downPayment;
                $offer->Commission = $request->commAmount;
                $offer->CommissionPct = $request->commissionPercent;
                $offer->BalanceDue = $request->balanceDue;
                $offer->offer_step = $step;

                // Save the updated record
                $offer->save();
                $offerData = $request->session()->get('offerData', []);
                $mergedData = array_merge($offerData, $request->all());
                $request->session()->put('offerData', $mergedData);
            } else {
                $offer = new Offer;
                $offer->ListingID = $request->companyName;
                $offer->Status = $request->status;
                $offer->BuyerID  = $request->buyer;
                $offer->ListingAgent = $request->listingAgent;
                $offer->SellingAgent = $request->sellingAgent;
                $offer->DateOfOffer = $request->dateOfOffer;
                $offer->ExpDate = $request->expDate;
                $offer->AccDate = $request->accDate;
                $offer->ClosingDate = $request->closeDate;
                $offer->PurchasePrice = $request->purchasePrice;
                $offer->DownPaymnt = $request->downPayment;
                $offer->Commission = $request->commAmount;
                $offer->CommissionPct = $request->commissionPercent;
                $offer->BalanceDue = $request->balanceDue;
                $offer->offer_step = $step;
                $offer->save();
                $offerData = $request->session()->get('offerData', []);
                $mergedData = array_merge($offerData, $request->all());
                $request->session()->put('offerData', $mergedData);
                $insertedId = $offer->OfferID;
                $request->session()->put('offerData.offer_id',  $insertedId);
            }
        } elseif ($step == 2) {
            $offer_id = session()->get('offerData.offer_id');
            $offer = Offer::where('OfferID', $offer_id)->first();
            if (!$offer) {
                return back()->with('error', 'Offer not found!');
            }
            // Update the fields Offer Data with the request data
            $offer->OfferPrice = $request->off_price;
            $offer->OffDeposit = $request->deposit;
            $offer->OffAddlDep = $request->addDeposit;
            $offer->OffBalDownPay = $request->downPayBal;
            $offer->OffDownPay = $request->downPayBal2;
            $offer->OffAssump = $request->assumption;
            $offer->OffAssump2 = $request->addAssumption;
            $offer->OffBalDue = $request->off_balanceDue;
            $offer->OffPerMonth = $request->perMonth;
            $offer->OffInterest = $request->interest;
            $offer->OffAddTerms = $request->addTerms;
            $offer->OffInvInc = $request->inventory;
            $offer->OffMaxInv = $request->maxInventory;

             // Update the fields Counter Offer Data with the request data
             $offer->COfferPrice = $request->co_price;
             $offer->COffDeposit = $request->co_deposit;
             $offer->COffAddlDep = $request->co_addDeposit;
             $offer->COffBalDownPay = $request->co_downPayBal;
             $offer->COffDownPay = $request->co_downPayBal2;
             $offer->COffAssump = $request->co_assumption;
             $offer->COffAssump2 = $request->co_addAssumption;
             $offer->COffBalDue = $request->co_balanceDue;
             $offer->COffPerMonth = $request->co_perMonth;
             $offer->COffInterest = $request->co_interest;
             $offer->COffAddTerms = $request->co_addTerms;
             $offer->COffInvInc = $request->co_inventory;
             $offer->COffMaxInv = $request->co_maxInventory;

              // Update the fields Accepted Offer Data with the request data
              $offer->AccPrice = $request->ac_price;
              $offer->AccDeposit = $request->ac_deposit;
              $offer->AccAddlDep = $request->ac_addDeposit;
              $offer->AccBalDownPay = $request->ac_downPayBal;
              $offer->AccDownPay = $request->ac_downPayBal2;
              $offer->AccAssump = $request->ac_assumption;
              $offer->AccAssump2 = $request->ac_addAssumption;
              $offer->AccBalDue = $request->ac_balanceDue;
              $offer->AccPerMonth = $request->ac_perMonth;
              $offer->AccInt = $request->ac_interest;
              $offer->AccAddTerm = $request->ac_addTerms;
              $offer->AccInvInc = $request->ac_inventory;
              $offer->AccMaxInv = $request->ac_maxInventory;

            // Save the updated record
            $offer->offer_step = $step;
            $offer->save();
            $offerData = $request->session()->get('offerData', []);
            $mergedData = array_merge($offerData, $request->all());
            $request->session()->put('offerData', $mergedData);
            
        } elseif ($step == 3) {
            $offer_id = session()->get('offerData.offer_id');
                $offer = Offer::where('OfferID', $offer_id)->first();
                if (!$offer) {
                    return back()->with('error', 'Offer not found!');
                }
                // Update the fields with the request Escrow data
                $realEstateTransaction = $request->has('realEstateTransaction') ? 1 : 0;
                $checkOnHold = $request->has('checkOnHold') ? 1 : 0;
                $bounced = $request->has('bounced') ? 1 : 0;
                $offer->RealEstateTrans = $realEstateTransaction;
                $offer->DepositCheckNumber = $request->depositCheck;
                $offer->BankDraw = $request->bank_name;
                $offer->DateDeposited = $request->dateDeposited;
                $offer->NameOnCheck = $request->nameOnCheck;
                $offer->CheckOnHold = $checkOnHold;
                $offer->Bounced = $bounced;
                $offer->BounceReason = $request->reason;
                $offer->CheckAmt = $request->amount;
                $offer->CheckReturned = $request->dateReturned;
                $offer->CheckEBBReturnNumber = $request->returnCheck;
                $offer->CheckReturnedTo = $request->checkReturnedTo;
                $offer->ReturneeRelationship = $request->relationship;
                $offer->ReturneeAddress = $request->address;
                $offer->ReturneeCity = $request->escrow_city;
                $offer->ReturneeState = $request->escrow_state;
                $offer->ReturneeZip = $request->escrow_zip_code;
                $offer->ReturneePhone = $request->phone;

                // Save the updated record
                $offer->offer_step = $step;
                $offer->save();
                $offerData = $request->session()->get('offerData', []);
                $mergedData = array_merge($offerData, $request->all());
                $request->session()->put('offerData', $mergedData);
                $request->session()->put('offerData.realEstateTransaction',  $realEstateTransaction);
                $request->session()->put('offerData.checkOnHold',  $checkOnHold);
                $request->session()->put('offerData.bounced',  $bounced);
        } elseif ($step == 4) {
            $offer_id = session()->get('offerData.offer_id');
                $offer = Offer::where('OfferID', $offer_id)->first();
                if (!$offer) {
                    return back()->with('error', 'Offer not found!');
                }
             // Update the fields contact info with the request data
             $offer->SchedCloseDate = $request->schedClosedDate;
             $offer->SchedCloseTime = $request->schedCloseTime;
             $offer->AttorneyLetters = $request->attorneyLetters;
             $offer->AnticipationLetters = $request->closingAnticipationLetters;

             // Save the updated record
             $offer->offer_step = $step;
             $offer->save();
             $offerData = $request->session()->get('offerData', []);
             $mergedData = array_merge($offerData, $request->all());
             $request->session()->put('offerData', $mergedData);
        } elseif ($step == 5) {

            $offer_id = session()->get('offerData.offer_id');
            $offer = Offer::where('OfferID', $offer_id)->first();
            if (!$offer) {
                return back()->with('error', 'Offer not found!');
            }
            // Update the fields with the request data
            $realEstateIncluded = $request->has('realEstateIncluded') ? 1 : 0;
            $optionToBuy = $request->has('optionToBuy') ? 1 : 0;
            $offer->RealEstateInc = $realEstateIncluded;
            $offer->REPrice = $request->rest_price;
            $offer->RETerms = $request->rest_terms;
            $offer->REDownPay = $request->rest_downPay;
            $offer->REBal = $request->rest_balance;
            $offer->OpToBuy = $optionToBuy;
            $offer->OpPrice = $request->otb_price;
            $offer->OpTerms = $request->otb_terms;
            $offer->OpDownPay = $request->otb_downPay;
            $offer->OpBal = $request->otb_balance;
            $offer->LeaseTerm = $request->leaseTerms;
            $offer->LeaseNoYears = $request->optionYears;
            $offer->LeaseDolMonth = $request->doiMonth;
            $offer->LeaseOptions = $request->options;

            // Save the updated record
            $offer->offer_step = $step;
            $offer->save();
            $offerData = $request->session()->get('offerData', []);
            $mergedData = array_merge($offerData, $request->all());
            $request->session()->put('offerData', $mergedData);
            $request->session()->put('offerData.realEstateIncluded',  $realEstateIncluded);
            $request->session()->put('offerData.optionToBuy',  $optionToBuy);
            
        } elseif ($step == 6) {
            $offer_id = session()->get('offerData.offer_id');
            $offer = Offer::where('OfferID', $offer_id)->first();
            if (!$offer) {
                return back()->with('error', 'Offer not found!');
            }
            // Update the fields with the request data
            $offer->Contingencies = $request->contingencies;
            $offer->Comments = $request->comments;
            
            // Save the updated record
            $offer->offer_step = $step;
            $offer->save();
            session()->forget(['offerData', 'step']);
            return redirect()->route('all.offer')->with('success', 'Your offer create successful!');
        }

        // Update the session with the next step
        if ($request->has('next')) {
            $step = $step + 1;
        }

       

        // Store the new step in the session
        session(['step' => $step]);
        return redirect()->route('offer.form');
    }
    public function editForm(Request $request,$id)
    {
        
       //session()->forget(['offerData', 'step']);
        
        // Find the offer ID
        $offer = Offer::where('OfferID', $id)->first();
        if (!$offer) {
            return redirect()->back()
                ->with('err_message', 'Offer not found.');
        }
        // Retrieve the current step from the session, default to 1
        if ($offer->offer_step == 6) {
            // Retrieve session data if available, else default to 1
            $step = session('step', 1);
        } else {
            // Set the session data only if it's not already set
            if (!session()->has('step')) {
                session(['step' => $offer->offer_step + 1]);
            }
            $step = session('step');
        }
        $offerData = session('offerData', []);
        $request->session()->put('offerData.offer_id',  $id);
        $buyers = Buyer::orderBy('created_at', 'desc')->get();
        $agents = Agent::orderBy('created_at', 'desc')->get();
        $listings = Listing::orderBy('created_at', 'desc')->get();
        $states = DB::table('states')->get();
        $offer_types = DB::table('offer_types')->get();
        
        return view('admin.offer.edit', compact('step', 'offerData', 'buyers', 'agents','states','listings','offer','offer_types'));
    }
    public function editProcessForm(Request $request,$id)
    {
        $step = session('step', 1);
        $this->validateStep($request,$step);
        if ($request->has('previous')) {
            $step = $step - 1;
        }
        //dd($request->all());
        // Logic to handle form submission based on current step
        $offer_id = session()->get('offerData.offer_id');     
        $offer = Offer::where('OfferID', $offer_id)->first();
        if (!$offer) {
            return back()->with('error', 'Offer not found!');
        }
        if ($step == 1) {
           // dd($request->all());
           /*  $offerData = $request->session()->get('offerData', []);
            dd($offerData); */
                // Update the fields with the request data
                if ($request->has('companyName')) {
                $offer->ListingID = $request->companyName;
                $offer->Status = $request->status;
                $offer->BuyerID = $request->buyer;
                $offer->ListingAgent = $request->listingAgent;
                $offer->SellingAgent = $request->sellingAgent;
                $offer->DateOfOffer = $request->dateOfOffer;
                $offer->ExpDate = $request->expDate;
                $offer->AccDate = $request->accDate;
                $offer->ClosingDate = $request->closeDate;
                $offer->PurchasePrice = $request->purchasePrice;
                $offer->DownPaymnt = $request->downPayment;
                $offer->Commission = $request->commAmount;
                $offer->CommissionPct = $request->commissionPercent;
                $offer->BalanceDue = $request->balanceDue;

                // Save the updated record
                $offer->offer_step = $step;
                $offer->save();
                $offerData = $request->session()->get('offerData', []);
                $mergedData = array_merge($offerData, $request->all());
                $request->session()->put('offerData', $mergedData);
                }
            
        } elseif ($step == 2) {
           
            // Update the fields Offer Data with the request data
            if ($request->has('off_price')) {
            $offer->OfferPrice = $request->off_price;
            $offer->OffDeposit = $request->deposit;
            $offer->OffAddlDep = $request->addDeposit;
            $offer->OffBalDownPay = $request->downPayBal;
            $offer->OffDownPay = $request->downPayBal2;
            $offer->OffAssump = $request->assumption;
            $offer->OffAssump2 = $request->addAssumption;
            $offer->OffBalDue = $request->off_balanceDue;
            $offer->OffPerMonth = $request->perMonth;
            $offer->OffInterest = $request->interest;
            $offer->OffAddTerms = $request->addTerms;
            $offer->OffInvInc = $request->inventory;
            $offer->OffMaxInv = $request->maxInventory;

             // Update the fields Counter Offer Data with the request data
             $offer->COfferPrice = $request->co_price;
             $offer->COffDeposit = $request->co_deposit;
             $offer->COffAddlDep = $request->co_addDeposit;
             $offer->COffBalDownPay = $request->co_downPayBal;
             $offer->COffDownPay = $request->co_downPayBal2;
             $offer->COffAssump = $request->co_assumption;
             $offer->COffAssump2 = $request->co_addAssumption;
             $offer->COffBalDue = $request->co_balanceDue;
             $offer->COffPerMonth = $request->co_perMonth;
             $offer->COffInterest = $request->co_interest;
             $offer->COffAddTerms = $request->co_addTerms;
             $offer->COffInvInc = $request->co_inventory;
             $offer->COffMaxInv = $request->co_maxInventory;

              // Update the fields Accepted Offer Data with the request data
              $offer->AccPrice = $request->ac_price;
              $offer->AccDeposit = $request->ac_deposit;
              $offer->AccAddlDep = $request->ac_addDeposit;
              $offer->AccBalDownPay = $request->ac_downPayBal;
              $offer->AccDownPay = $request->ac_downPayBal2;
              $offer->AccAssump = $request->ac_assumption;
              $offer->AccAssump2 = $request->ac_addAssumption;
              $offer->AccBalDue = $request->ac_balanceDue;
              $offer->AccPerMonth = $request->ac_perMonth;
              $offer->AccInt = $request->ac_interest;
              $offer->AccAddTerm = $request->ac_addTerms;
              $offer->AccInvInc = $request->ac_inventory;
              $offer->AccMaxInv = $request->ac_maxInventory;

            // Save the updated record
            $offer->offer_step = $step;
            $offer->save();
            $offerData = $request->session()->get('offerData', []);
            $mergedData = array_merge($offerData, $request->all());
            $request->session()->put('offerData', $mergedData);
            }
            
        } elseif ($step == 3) {
            
                // Update the fields with the request Escrow data
                if ($request->has('depositCheck')) {
                $realEstateTransaction = $request->has('realEstateTransaction') ? 1 : 0;
                $checkOnHold = $request->has('checkOnHold') ? 1 : 0;
                $bounced = $request->has('bounced') ? 1 : 0;
                $offer->RealEstateTrans = $realEstateTransaction;
                $offer->DepositCheckNumber = $request->depositCheck;
                $offer->BankDraw = $request->bank_name;
                $offer->DateDeposited = $request->dateDeposited;
                $offer->NameOnCheck = $request->nameOnCheck;
                $offer->CheckOnHold = $checkOnHold;
                $offer->Bounced = $bounced;
                $offer->BounceReason = $request->reason;
                $offer->CheckAmt = $request->amount;
                $offer->CheckReturned = $request->dateReturned;
                $offer->CheckEBBReturnNumber = $request->returnCheck;
                $offer->CheckReturnedTo = $request->checkReturnedTo;
                $offer->ReturneeRelationship = $request->relationship;
                $offer->ReturneeAddress = $request->address;
                $offer->ReturneeCity = $request->escrow_city;
                $offer->ReturneeState = $request->escrow_state;
                $offer->ReturneeZip = $request->escrow_zip_code;
                $offer->ReturneePhone = $request->phone;

                // Save the updated record
                $offer->offer_step = $step;
                $offer->save();
                $offerData = $request->session()->get('offerData', []);
                $mergedData = array_merge($offerData, $request->all());
                $request->session()->put('offerData', $mergedData);
                $request->session()->put('offerData.realEstateTransaction',  $realEstateTransaction);
                $request->session()->put('offerData.checkOnHold',  $checkOnHold);
                $request->session()->put('offerData.bounced',  $bounced);
                }
        } elseif ($step == 4) {
            if ($request->has('schedClosedDate')) {
             // Update the fields contact info with the request data
             $offer->SchedCloseDate = $request->schedClosedDate;
             $offer->SchedCloseTime = $request->schedCloseTime;
             $offer->AttorneyLetters = $request->attorneyLetters;
             $offer->AnticipationLetters = $request->closingAnticipationLetters;

             // Save the updated record
             $offer->offer_step = $step;
             $offer->save();
             $offerData = $request->session()->get('offerData', []);
             $mergedData = array_merge($offerData, $request->all());
             $request->session()->put('offerData', $mergedData);
            }
        } elseif ($step == 5) {

           
            // Update the fields with the request data
            if ($request->has('rest_price')) {
            $realEstateIncluded = $request->has('realEstateIncluded') ? 1 : 0;
            $optionToBuy = $request->has('optionToBuy') ? 1 : 0;
            $offer->RealEstateInc = $realEstateIncluded;
            $offer->REPrice = $request->rest_price;
            $offer->RETerms = $request->rest_terms;
            $offer->REDownPay = $request->rest_downPay;
            $offer->REBal = $request->rest_balance;
            $offer->OpToBuy = $optionToBuy;
            $offer->OpPrice = $request->otb_price;
            $offer->OpTerms = $request->otb_terms;
            $offer->OpDownPay = $request->otb_downPay;
            $offer->OpBal = $request->otb_balance;
            $offer->LeaseTerm = $request->leaseTerms;
            $offer->LeaseNoYears = $request->optionYears;
            $offer->LeaseDolMonth = $request->doiMonth;
            $offer->LeaseOptions = $request->options;

            // Save the updated record
            $offer->offer_step = $step;
            $offer->save();
            $offerData = $request->session()->get('offerData', []);
            $mergedData = array_merge($offerData, $request->all());
            $request->session()->put('offerData', $mergedData);
            $request->session()->put('offerData.realEstateIncluded',  $realEstateIncluded);
            $request->session()->put('offerData.optionToBuy',  $optionToBuy);
            }
            
        } elseif ($step == 6) {
            
            // Update the fields with the request data
            if ($request->has('comments')) {
            $offer->Contingencies = $request->contingencies;
            $offer->Comments = $request->comments;
            
            // Save the updated record
            $offer->offer_step = $step;
            $offer->save();
            session()->forget(['offerData', 'step']);
            return redirect()->route('all.offer')->with('success', 'Your offer has been update successful!');
            }
        }

        // Update the session with the next step
        if ($request->has('next')) {
            $step = $step + 1;
        }

       

        // Store the new step in the session
        session(['step' => $step]);
        return redirect()->route('edit.offer.form', ['id' => $offer->OfferID]);
    }
    // Validate data for each step
    private function validateStep(Request $request, $step)
    {
        $rules = [];

        switch ($step) {
            case 1:
                $rules = [
                    'companyName' => 'required',
                    'status' => 'required',
                    'buyer' => 'required',
                    'listingAgent' => 'required',
                    'sellingAgent' => 'required',
                    'dateOfOffer' => 'required',
                    'expDate' => 'required',
                    'accDate' => 'required',
                    'closeDate' => 'required',
                    'purchasePrice' => 'required',
                    'downPayment' => 'required',
                    'commAmount' => 'required',
                    'commissionPercent' => 'required',
                    'balanceDue' => 'required',
                ];
                break;
        }
        
        $request->validate($rules);
    }

    // Save data to the database
    public function show($id)
    {
        $offer = Offer::where('OfferID', $id)->first();
        if (!$offer) {
            return back()->with('error', 'Offer not found!');
        }
        // Get the previous Offer ID
        $previous = Offer::where('OfferID', '<', $id)->orderBy('OfferID', 'desc')->first();
        // Get the next Offer ID
        $next = Offer::where('OfferID', '>', $id)->orderBy('OfferID', 'asc')->first();
        $company_name = DB::table('listings')->pluck('SellerCorpName', 'ListingID');
        $buyer_name = Buyer::selectRaw("CONCAT(FName, ' ', LName) AS full_name, BuyerID")
        ->pluck('full_name', 'BuyerID');
       return view('admin.offer.show', compact('offer', 'previous', 'next','company_name','buyer_name'));
    }
}