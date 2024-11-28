@extends('admin.layout.master')
@section('content')

<div class="container-fluid content" style="background-color: #f8f9fa; padding: 2rem 2rem 0rem 2rem;">
    <div class="next-back-page d-flex justify-content-between">
        @if ($previous)
        <a href="{{ route('edit.prev.next', $previous->OfferID) }}"><button><i class="fa fa-chevron-left"></i>Back</button></a>
        @endif

        @if ($next)
        <a href="{{ route('edit.prev.next', $next->OfferID) }}"><button>Next <i class="fa fa-chevron-right"></i></button></a>
        @endif
    </div>
</div>
<div class="container-fluid content bg-light">
    <div class="row card p-4">
        <form action="{{ route('edit.offer.form.process',$offer->OfferID) }}" method="POST" id="offerForm">
            @csrf
            <input type="hidden" name="step" value="{{ session('step', 1) }}">
            <!-- One "form-multi-tab" for each step in the form: -->

            @if (session('step', 1) == 1)
            <div class="form-multi-tab">
                <h3>General:</h3>
                <hr>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="offerID">Offer ID</label>
                        <input type="text" class="form-control" id="offerID" name="offerID" value="{{$offer->OfferID}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="companyName">Company Name</label>
                        <select class="form-control" id="companyName" name="companyName">
                            <option value="">Select company name</option>
                            @foreach($listings as $listing)
                            <option value="{{$listing->ListingID}}" {{($listing->ListingID  ==  $offer->ListingID) ? 'selected' : '' }}>{{$listing->SellerCorpName}}</option>
                            @endforeach
                        </select>
                        @error('companyName')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4" style="height: 70px;">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="" selected>Select Status</option>
                            @foreach($offer_types as $offer_type)
                            <option value="{{$offer_type->Status}}" {{$offer->Status  == $offer_type->Status ? 'selected' : '' }}>{{$offer_type->Status}}</option>
                            @endforeach
                        </select>
                        @error('status')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="buyer">Buyer</label>
                        <select class="form-control" id="buyer" name="buyer">
                            <option value="" selected>Select Buyer</option>
                            @foreach($buyers as $buyer)
                            <option value="{{$buyer->BuyerID}}" {{ ($buyer->BuyerID  == $offer->BuyerID) ? 'selected' : '' }}>{{$buyer->FName}}</option>
                            @endforeach
                        </select>
                        @error('buyer')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="listingAgent">Listing Agent</label>
                        <select class="form-control" id="listingAgent" name="listingAgent">
                            <option value="">Select Listing Agent</option>
                            @foreach($agents as $agent)
                            <option value="{{$agent->AgentID}}" {{ ($agent->AgentID == $offer->ListingAgent) ? 'selected' : '' }}>{{$agent->FName}}</option>
                            @endforeach
                        </select>
                        @error('listingAgent')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="sellingAgent">Selling Agent</label>
                        <select class="form-control" id="sellingAgent" name="sellingAgent">
                            <option value="">Select Selling Agent</option>
                            @foreach($agents as $agent)
                            <option value="{{$agent->AgentID}}" {{ ($agent->AgentID == $offer->SellingAgent) ? 'selected' : '' }}>{{$agent->FName}}</option>
                            @endforeach
                        </select>
                        @error('sellingAgent')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 mb-3">
                        <label for="dateOfOffer">Date of Offer</label>
                        <input type="date" class="form-control" id="dateOfOffer" name="dateOfOffer" value="{{$offer->DateOfOffer}}">
                        @error('dateOfOffer')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="expDate">Exp. Date</label>
                        <input type="date" class="form-control" id="expDate" name="expDate" value="{{ $offer->ExpDate}}">
                        @error('expDate')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="accDate">Acc Date</label>
                        <input type="date" class="form-control" id="accDate" name="accDate" value="{{ $offer->AccDate}}">
                        @error('accDate')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="closeDate">Close Date</label>
                        <input type="date" class="form-control" id="closeDate" name="closeDate" value="{{$offer->ClosingDate}}">
                        @error('closeDate')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="purchasePrice">Purchase Price</label>
                        <input type="number" class="form-control" id="purchasePrice" name="purchasePrice" value="{{ $offer->PurchasePrice}}">
                        @error('purchasePrice')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4" style="height: 70px;">
                        <label for="downPayment">Down Payment</label>
                        <input type="text" class="form-control" id="downPayment" name="downPayment" value="{{ $offer->DownPaymnt}}">
                        @error('downPayment')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4" style="height: 70px;">
                        <label for="commAmount">Comm. Amount</label>
                        <input type="text" class="form-control" id="commAmount" name="commAmount" value="{{ $offer->Commission}}">
                        @error('commAmount')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="commissionPercent">Commission %</label>
                        <input type="number" class="form-control" id="commissionPercent"
                            name="commissionPercent" value="{{ $offer->CommissionPct}}">
                        @error('commissionPercent')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="balanceDue">Balance Due</label>
                        <input type="text" class="form-control" id="balanceDue" name="balanceDue" value="{{ $offer->BalanceDue}}">
                        @error('balanceDue')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

            @endif

            <!-- Step 2 -->
            @if (session('step', 1) == 2)
            <!-- Next tab Business -->
            <div class="form-multi-tab">
                <h3>Offer</h3>
                <hr>
                <div class="row mt-5">
                    <div class="col-md-4 offer-data mb-3">
                        <h4 class="mb-3 form-sec">Offer Data</h4>
                        <div class="field-item mb-3">
                            <label for="offer-price">Price</label>
                            <input type="number" class="form-control" id="offer-price" name="off_price" value="{{ $offer->OfferPrice}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="offer-deposit">Deposit</label>
                            <input type="number" class="form-control" id="offer-deposit" name="deposit" value="{{ $offer->OffDeposit}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="offer-addDeposit">Add. Deposit</label>
                            <input type="number" class="form-control" id="offer-addDeposit" name="addDeposit" value="{{ $offer->OffAddlDep}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="offer-downPayBal">Down Pay Bal.</label>
                            <input type="number" class="form-control" id="offer-downPayBal" name="downPayBal" value="{{ $offer->OffBalDownPay}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="offer-downPayBal2">Down Pay Bal.2</label>
                            <input type="number" class="form-control" id="offer-downPayBal2" name="downPayBal2" value="{{ $offer->OffDownPay}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="offer-totalDownPayBal">Total Down Pay Bal.</label>
                            <input type="number" class="form-control" id="offer-totalDownPayBal"
                                name="totalDownPayBal" value="">
                        </div>
                        <div class="field-item mb-3">
                            <label for="offer-assumption">Assumption</label>
                            <input type="number" class="form-control" id="offer-assumption" name="assumption" value="{{ $offer->OffAssump}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="offer-addAssumption">Add Assumption</label>
                            <input type="number" class="form-control" id="offer-addAssumption"
                                name="addAssumption" value="{{ $offer->OffAssump2}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="offer-balanceDue">Balance Due</label>
                            <input type="number" class="form-control" id="offer-balanceDue" name="off_balanceDue" value="{{ $offer->OffBalDue}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="offer-perMonth">Per Month</label>
                            <input type="number" class="form-control" id="offer-perMonth" name="perMonth" value="{{ $offer->OffPerMonth}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="offer-interest">Interest</label>
                            <input type="number" class="form-control" id="offer-interest" name="interest" value="{{ $offer->OffInterest}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="offer-addTerms">Add. Terms</label>
                            <input type="text" class="form-control" id="offer-addTerms" name="addTerms" value="{{ $offer->OffAddTerms}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="offer-inventory">Inventory</label>
                            <input type="number" class="form-control" id="offer-inventory" name="inventory" value="{{ $offer->OffInvInc}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="offer-maxInventory">Max. Inventory</label>
                            <input type="number" class="form-control" id="offer-maxInventory"
                                name="maxInventory" value="{{ $offer->OffMaxInv}}">
                        </div>

                    </div>
                    <div class="col-md-4 counter mb-3">
                        <h4 class="mb-3 form-sec">Counter Offer</h4>
                        <div class="field-item mb-3">
                            <label for="counter-price">Price</label>
                            <input type="number" class="form-control" id="counter-price" name="co_price" value="{{ $offer->COfferPrice}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="counter-deposit">Deposit</label>
                            <input type="number" class="form-control" id="counter-deposit" name="co_deposit" value="{{ $offer->COffDeposit}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="counter-addDeposit">Add. Deposit</label>
                            <input type="number" class="form-control" id="counter-addDeposit" name="co_addDeposit" value="{{ $offer->COffAddlDep}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="counter-downPayBal">Down Pay Bal.</label>
                            <input type="number" class="form-control" id="counter-downPayBal" name="co_downPayBal" value="{{ $offer->COffBalDownPay}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="counter-downPayBal2">Down Pay Bal.2</label>
                            <input type="number" class="form-control" id="counter-downPayBal2"
                                name="co_downPayBal2" value="{{ $offer->COffDownPay}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="counter-totalDownPayBal">Total Down Pay Bal.</label>
                            <input type="number" class="form-control" id="counter-totalDownPayBal"
                                name="co_totalDownPayBal">
                        </div>
                        <div class="field-item mb-3">
                            <label for="counter-assumption">Assumption</label>
                            <input type="number" class="form-control" id="counter-assumption" name="co_assumption" value="{{ $offer->COffAssump}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="counter-addAssumption">Add Assumption</label>
                            <input type="number" class="form-control" id="counter-addAssumption"
                                name="co_addAssumption" value="{{$offer->COffAssump2}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="counter-balanceDue">Balance Due</label>
                            <input type="number" class="form-control" id="counter-balanceDue" name="co_balanceDue" value="{{ $offer->COffBalDue}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="counter-perMonth">Per Month</label>
                            <input type="number" class="form-control" id="counter-perMonth" name="co_perMonth" value="{{ $offer->COffPerMonth}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="counter-interest">Interest</label>
                            <input type="number" class="form-control" id="counter-interest" name="co_interest" value="{{ $offer->COffInterest}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="counter-addTerms">Add. Terms</label>
                            <input type="text" class="form-control" id="counter-addTerms" name="co_addTerms" value="{{ $offer->COffAddTerms}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="counter-inventory">Inventory</label>
                            <input type="number" class="form-control" id="counter-inventory" name="co_inventory" value="{{ $offer->COffInvInc}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="counter-maxInventory">Max. Inventory</label>
                            <input type="number" class="form-control" id="counter-maxInventory"
                                name="co_maxInventory" value="{{ $offer->COffMaxInv}}">
                        </div>

                    </div>
                    <div class="col-md-4 accepted mb-3">
                        <h4 class="mb-3 form-sec">Accepted Offer</h4>
                        <div class="field-item mb-3">
                            <label for="accepted-price">Price</label>
                            <input type="number" class="form-control" id="accepted-price" name="ac_price" value="{{ $offer->AccPrice}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="accepted-deposit">Deposit</label>
                            <input type="number" class="form-control" id="accepted-deposit" name="ac_deposit" value="{{ $offer->AccDeposit}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="accepted-addDeposit">Add. Deposit</label>
                            <input type="number" class="form-control" id="accepted-addDeposit"
                                name="ac_addDeposit" value="{{ $offer->AccAddlDep}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="accepted-downPayBal">Down Pay Bal.</label>
                            <input type="number" class="form-control" id="accepted-downPayBal"
                                name="ac_downPayBal" value="{{ $offer->AccBalDownPay}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="accepted-downPayBal2">Down Pay Bal.2</label>
                            <input type="number" class="form-control" id="accepted-downPayBal2"
                                name="ac_downPayBal2" value="{{ $offer->AccDownPay}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="accepted-totalDownPayBal">Total Down Pay Bal.</label>
                            <input type="number" class="form-control" id="accepted-totalDownPayBal"
                                name="ac_totalDownPayBal">
                        </div>
                        <div class="field-item mb-3">
                            <label for="accepted-assumption">Assumption</label>
                            <input type="number" class="form-control" id="accepted-assumption"
                                name="ac_assumption" value="{{ $offer->AccAssump}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="accepted-addAssumption">Add Assumption</label>
                            <input type="number" class="form-control" id="accepted-addAssumption"
                                name="ac_addAssumption" value="{{$offer->AccAssump2}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="accepted-balanceDue">Balance Due</label>
                            <input type="number" class="form-control" id="accepted-balanceDue"
                                name="ac_balanceDue" value="{{ $offer->AccBalDue}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="accepted-perMonth">Per Month</label>
                            <input type="number" class="form-control" id="accepted-perMonth" name="ac_perMonth" value="{{ $offer->AccPerMonth}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="accepted-interest">Interest</label>
                            <input type="number" class="form-control" id="accepted-interest" name="ac_interest" value="{{ $offer->AccInt}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="accepted-addTerms">Add. Terms</label>
                            <input type="text" class="form-control" id="accepted-addTerms" name="ac_addTerms" value="{{ $offer->AccAddTerm}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="accepted-inventory">Inventory</label>
                            <input type="number" class="form-control" id="accepted-inventory" name="ac_inventory" value="{{ $offer->AccInvInc}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="accepted-maxInventory">Max. Inventory</label>
                            <input type="number" class="form-control" id="accepted-maxInventory"
                                name="ac_maxInventory" value="{{ $offer->AccMaxInv}}">
                        </div>

                    </div>
                </div>
            </div>

            @endif
            <!-- Step 3 -->
            @if (session('step', 1) == 3)
            <!-- Next tab Business -->
            <div class="form-multi-tab">
                <h3>Escrow</h3>
                <hr>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label>Real Estate Transaction</label>
                        <input type="checkbox" id="realEstateTransaction" name="realEstateTransaction" value="1" {{ ($offer->RealEstateTrans == 1) ? 'checked' : '' }} onchange="changeRealStateTransValue()">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="depositCheck">Deposit Check</label>
                        <input type="text" class="form-control" id="depositCheck" name="depositCheck" value="{{ $offer->DepositCheckNumber}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="bank">Bank</label>
                        <input type="text" class="form-control" id="bank" name="bank_name" value="{{ $offer->BankDraw}}">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 mb-3">
                        <label for="dateDeposited">Date Deposited</label>
                        <input type="date" class="form-control" id="dateDeposited" name="dateDeposited" value="{{ $offer->DateDeposited}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="nameOnCheck">Name on Check</label>
                        <input type="text" class="form-control" id="nameOnCheck" name="nameOnCheck" value="{{ $offer->NameOnCheck}}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Check on Hold</label>
                        <input type="checkbox" id="checkOnHold" name="checkOnHold" value="1" {{ ($offer->CheckOnHold == 1) ? 'checked' : '' }} onchange="changeCheckOnHoldValue()">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Bounced</label>
                        <input type="checkbox" id="bounced" name="bounced" value="1" {{ ($offer->Bounced == 1) ? 'checked' : '' }} onchange="changeCheckBouncedValue()">
                    </div>
                </div>


                <div class="row mb-2">

                    <div class="col-md-4 mb-3">
                        <label for="reason">Reason</label>
                        <input type="text" class="form-control" id="reason" name="reason" value="{{ $offer->BounceReason}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="amount">Amount</label>
                        <input type="number" class="form-control" id="amount" name="amount" value="{{$offer->CheckAmt}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dateReturned">Date Returned</label>
                        <input type="date" class="form-control" id="dateReturned" name="dateReturned" value="{{ $offer->CheckReturned}}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="returnCheck">Return Check</label>
                        <input type="text" class="form-control" id="returnCheck" name="returnCheck" value="{{ $offer->CheckEBBReturnNumber}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="checkReturnedTo">Check Returned To</label>
                        <input type="text" class="form-control" id="checkReturnedTo" name="checkReturnedTo" value="{{ $offer->CheckReturnedTo}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="relationship">Relationship</label>
                        <input type="text" class="form-control" id="relationship" name="relationship" value="{{ $offer->ReturneeRelationship}}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{$offer->ReturneeAddress}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="row">
                            <div class="col-md-4 p-0 m-0">
                                <label for="">City</label>
                                <input type="text" id="city" class="form-control" placeholder="City" name="escrow_city" value="{{ $offer->ReturneeCity }}">
                                @error('escrow_city')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-5 p-0 m-0">
                                <label for="">State</label>
                                <select id="State" class="form-select" name="escrow_state">
                                    <option value="" selected="">Select state</option>
                                    @foreach($states as $key=>$value)
                                    <option value="{{$value->State}}" {{  $value->State == $offer->ReturneeState ? 'selected' : '' }}>{{$value->StateName}}</option>
                                    @endforeach
                                </select>
                                @error('escrow_state')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3 p-0 m-0">
                                <label for="">Zip</label>
                                <input type="text" id="Zip" class="form-control" placeholder="Zip" name="escrow_zip_code" value="{{$offer->ReturneeZip}}">
                                @error('escrow_zip_code')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $offer->ReturneePhone}}">
                    </div>
                </div>
            </div>
            @endif

            <!-- Step 4 -->
            @if (session('step', 1) == 4)
            <!-- Next tab Business -->
            <div class="form-multi-tab">
                <h3>Contacts</h3>
                <hr>
                <div class="row mb-3">
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">
                        <label for="buyerAttorney">Buyer Attorney</label>
                        <input type="text" class="form-control" id="buyerAttorney" name="buyerAttorney">
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">
                        <label for="sellerAttorney">Seller Attorney</label>
                        <input type="text" class="form-control" id="sellerAttorney" name="sellerAttorney">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">
                        <label for="buyerAccountant">Buyer Accountant</label>
                        <input type="text" class="form-control" id="buyerAccountant" name="buyerAccountant">
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">
                        <label for="sellerAccountant">Seller Accountant</label>
                        <input type="text" class="form-control" id="sellerAccountant" name="sellerAccountant">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">
                        <label for="landlord">Landlord</label>
                        <input type="text" class="form-control" id="landlord" name="landlord">
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                        <label for="referral">Referral</label>
                        <input type="text" class="form-control" id="referral" name="referral">
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                        <label for="referralFeePaid">Referral Fee Paid</label>
                        <input type="text" class="form-control" id="referralFeePaid" name="referralFeePaid">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">
                        <label for="schedClosedDate">Scheduled Closed Date</label>
                        <input type="date" class="form-control" id="schedClosedDate" name="schedClosedDate" value="{{ $offer->SchedCloseDate}}">
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">
                        <label for="schedCloseTime">Scheduled Close Time</label>
                        <input type="text" class="form-control" id="schedCloseTime" name="schedCloseTime" value="{{ $offer->SchedCloseTime}}">
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">
                        <label for="attorneyLetters">Attorney Letters</label>
                        <input type="text" class="form-control" id="attorneyLetters" name="attorneyLetters" value="{{ $offer->AttorneyLetters}}">
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">
                        <label for="closingAnticipationLetters">Closing Anticipation Letters Sent</label>
                        <input type="text" class="form-control" id="closingAnticipationLetters"
                            name="closingAnticipationLetters" value="{{ $offer->AnticipationLetters}}">
                    </div>
                </div>
            </div>
            @endif

            <!-- Step 5 -->
            @if (session('step', 1) == 5)
            <!-- Next tab Business -->
            <div class="form-multi-tab">
                <h3 class="form-sec">Property</h3>
                <hr>
                <div class="row mb-3">
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                        <label>Real Estate Included</label>
                        <input type="checkbox" id="realEstateIncluded" name="realEstateIncluded" value="1" {{ $offer->RealEstateInc == 1 ? 'checked' : '' }} onchange="changeRealEstateIncludedValue()">
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                        <label>Option to Buy</label>
                        <input type="checkbox" id="optionToBuy" name="optionToBuy" value="1" {{ $offer->OpToBuy == 1 ? 'checked' : '' }} onchange="changeOptionToBuyValue()">
                    </div>
                </div>

                <div class="row mb-3">
                    <h4 class="form-sec">Real Estate</h4>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                        <label for="real-price">Price</label>
                        <input type="text" class="form-control" id="real-price" name="rest_price" value="{{ $offer->REPrice}}">
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                        <label for="real-terms">Terms</label>
                        <input type="text" class="form-control" id="real-terms" name="rest_terms" value="{{$offer->RETerms}}">
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                        <label for="real-downPay">Down Payment</label>
                        <input type="text" class="form-control" id="real-downPay" name="rest_downPay" value="{{ $offer->REDownPay}}">
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                        <label for="real-balance">Balance</label>
                        <input type="text" class="form-control" id="real-balance" name="rest_balance" value="{{ $offer->REBal}}">
                    </div>
                </div>

                <div class="row mb-3">
                    <h4 class="form-sec">Option to Buy</h4>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                        <label for="option-price">Price</label>
                        <input type="text" class="form-control" id="option-price" name="otb_price" value="{{ $offer->OpPrice}}">
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                        <label for="option-terms">Terms</label>
                        <input type="text" class="form-control" id="option-terms" name="otb_terms" value="{{ $offer->OpTerms}}">
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                        <label for="option-downPay">Down Payment</label>
                        <input type="text" class="form-control" id="option-downPay" name="otb_downPay" value="{{ $offer->OpDownPay}}">
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                        <label for="option-balance">Balance</label>
                        <input type="text" class="form-control" id="option-balance" name="otb_balance" value="{{ $offer->OpBal}}">
                    </div>
                </div>
                <div class="row mb-3">
                    <h4 class="form-sec">Lease Terms</h4>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                        <label for="leaseTerms">Lease Terms</label>
                        <input type="text" class="form-control" id="leaseTerms" name="leaseTerms" value="{{ $offer->LeaseTerm}}">
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                        <label for="optionYears">Option Years</label>
                        <input type="text" class="form-control" id="optionYears" name="optionYears" value="{{ $offer->LeaseNoYears}}">
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                        <label for="doiMonth">Doi Month</label>
                        <input type="text" class="form-control" id="doiMonth" name="doiMonth" value="{{ $offer->LeaseDolMonth}}">
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                        <label for="options">Options</label>
                        <input type="text" class="form-control" id="options" name="options" value="{{$offer->LeaseOptions}}">
                    </div>
                </div>
            </div>

            @endif

            <!-- Step 6 -->
            @if (session('step', 1) == 6)
            <!-- Next tab Business -->
            <div class="form-multi-tab">
                <h3 class="form-sec">Comments</h3>
                <hr>
                <div class="row mb-3">
                    <div class="comment-area w-100 mt-4">
                        <div class="col-md-12 mb-3">
                            <label for="contingencies">Contingencies</label>
                            <textarea class="form-control" id="contingencies" name="contingencies"
                                rows="3">{{$offer->Contingencies}}</textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="comments">Comments</label>
                            <textarea class="form-control" id="comments" name="comments" rows="3">{{$offer->Comments}}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            @endif
            <div class="d-flex justify-content-center" style="overflow:auto;">
                <div>
                    <!-- Previous button -->
                    @if (session('step', 1) > 1)
                    <button type="submit" name="previous" class="btn-primary" id="prevBtn">Previous</button>
                    @endif

                    <!-- Next button or Submit -->
                    <button type="submit" name="next" class="btn-primary" id="nextBtn">
                        {{ session('step', 1) < 6 ? 'Next' : 'Submit' }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<div p-8="">
    <p>&nbsp;</p>
</div>
<style>
    .hidden-step {
        display: none;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var form = $('#offerForm');
        form.validate({
            rules: {
                companyName: {
                    required: true
                },
                status: {
                    required: true
                },
                buyer: {
                    required: true
                },
                listingAgent: {
                    required: true
                },
                sellingAgent: {
                    required: true
                },
                dateOfOffer: {
                    required: true
                },
                expDate: {
                    required: true
                },
                accDate: {
                    required: true
                },
                closeDate: {
                    required: true
                },
                purchasePrice: {
                    required: true
                },
                downPayment: {
                    required: true
                },
                commAmount: {
                    required: true
                },
                commissionPercent: {
                    required: true
                },
                balanceDue: {
                    required: true
                }

            },
            messages: {},
            submitHandler: function(form) {
                form.submit();
            }
        });
        $('#nextBtn').on('click', function(event) {
            if (form.valid()) {
                form.submit();
            } else {
                event.preventDefault();
            }
        });

        // Handle the Previous button click event
        $('#prevBtn').on('click', function(event) {
            form.unbind('submit');
            form.submit();
        });
        var offer1Value = parseFloat($('#offer-downPayBal').val()) || 0; 
        var offer2Value = parseFloat($('#offer-downPayBal2').val()) || 0;
        var sumOffer = offer1Value + offer2Value;
        $('#offer-totalDownPayBal').val(sumOffer);

        var counter1Value = parseFloat($('#counter-downPayBal').val()) || 0;
        var counter2Value = parseFloat($('#counter-downPayBal2').val()) || 0; 
        var sumCounter = counter1Value + counter2Value;
        $('#counter-totalDownPayBal').val(sumCounter);

        var accepted1Value = parseFloat($('#accepted-downPayBal').val()) || 0; 
        var accepted2Value = parseFloat($('#accepted-downPayBal2').val()) || 0; 
        var sumAccepted = accepted1Value + accepted2Value;
        $('#accepted-totalDownPayBal').val(sumAccepted);

        $('#offer-downPayBal, #offer-downPayBal2').on('input', function() {
            var input1Value = parseFloat($('#offer-downPayBal').val()) || 0; 
            var input2Value = parseFloat($('#offer-downPayBal2').val()) || 0;
            var sum = input1Value + input2Value;
            $('#offer-totalDownPayBal').val(sum);
        });
        $('#counter-downPayBal, #counter-downPayBal2').on('input', function() {
            var input1Value = parseFloat($('#counter-downPayBal').val()) || 0;
            var input2Value = parseFloat($('#counter-downPayBal2').val()) || 0; 
            var sum = input1Value + input2Value;
            $('#counter-totalDownPayBal').val(sum);
        });
        $('#accepted-downPayBal, #accepted-downPayBal2').on('input', function() {
            var input1Value = parseFloat($('#accepted-downPayBal').val()) || 0; 
            var input2Value = parseFloat($('#accepted-downPayBal2').val()) || 0; 
            var sum = input1Value + input2Value;
            $('#accepted-totalDownPayBal').val(sum);
        });
    });
</script>
@endsection