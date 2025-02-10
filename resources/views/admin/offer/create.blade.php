@extends('admin.layout.master')
@section('content')
<div class="container-fluid content bg-light">
    <div class="row card p-4">
        <form action="{{ route('offer.form.process') }}" method="POST" id="offerForm">
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
                        <input type="text" class="form-control" id="offerID" name="offerID" value="{{ session('offerData.offerID') ?: old('offerID') ?: $nextOfferId }}" readonly>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="companyName">Company Name <span class="text-danger">*</span></label>
                        <select class="form-control" id="companyName" name="companyName">
                            <option value="">Select company name</option>
                            @foreach($listings as $listing)
                            <option value="{{$listing->ListingID}}" {{ (old('companyName') == $listing->ListingID  || session('offerData.companyName') == $listing->ListingID) ? 'selected' : '' }}>{{$listing->SellerCorpName}}</option>
                            @endforeach
                        </select>
                        @error('companyName')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4" style="height: 70px;">
                        <label for="status">Status <span class="text-danger">*</span></label>
                        <select class="form-control" id="status" name="status">
                            <option value="" selected>Select Status</option>
                            @foreach($offer_types as $offer_type)
                            <option value="{{$offer_type->Status}}" {{ (old('status') == $offer_type->Status  || session('offerData.status') == $offer_type->Status || $offer_type->Status == 'Pending') ? 'selected' : '' }}>{{$offer_type->Status}}</option>
                            @endforeach
                        </select>
                        @error('status')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="buyer">Buyer <span class="text-danger">*</span></label>
                        <select class="form-control" id="buyer" name="buyer">
                            <option value="" selected>Select Buyer</option>
                            @foreach($buyers as $buyer)
                            <option value="{{$buyer->BuyerID}}" {{ (old('buyer') == $buyer->BuyerID || session('offerData.buyer') == $buyer->BuyerID) ? 'selected' : '' }}>{{$buyer->FName}}</option>
                            @endforeach
                        </select>
                        @error('buyer')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="listingAgent">Listing Agent <span class="text-danger">*</span></label>
                        <select class="form-control" id="listingAgent" name="listingAgent">
                            <option value="">Select Listing Agent</option>
                            @foreach($agents as $agent)
                            <option value="{{$agent->AgentID}}" {{ (old('listingAgent') == $agent->AgentID || session('offerData.listingAgent') == $agent->AgentID) ? 'selected' : '' }}>{{$agent->FName}}</option>
                            @endforeach
                        </select>
                        @error('listingAgent')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="sellingAgent">Selling Agent <span class="text-danger">*</span></label>
                        <select class="form-control" id="sellingAgent" name="sellingAgent">
                            <option value="">Select Selling Agent</option>
                            @foreach($agents as $agent)
                            <option value="{{$agent->AgentID}}" {{ (old('sellingAgent') == $agent->AgentID || session('offerData.sellingAgent') == $agent->AgentID) ? 'selected' : '' }}>{{$agent->FName}}</option>
                            @endforeach
                        </select>
                        @error('sellingAgent')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 mb-3">
                        <label for="dateOfOffer">Date of Offer <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="dateOfOffer" name="dateOfOffer" value="{{ session('offerData.dateOfOffer') ?? old('dateOfOffer')}}">
                        @error('dateOfOffer')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="expDate">Exp. Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="expDate" name="expDate" value="{{ session('offerData.expDate') ?? old('expDate')}}" min="{{ \Carbon\Carbon::now()->toDateString() }}">
                        @error('expDate')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="accDate">Acc Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="accDate" name="accDate" value="{{ session('offerData.accDate') ?? old('accDate')}}" min="{{ \Carbon\Carbon::now()->toDateString() }}">
                        @error('accDate')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="closeDate">Close Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="closeDate" name="closeDate" value="{{ session('offerData.closeDate') ?? old('closeDate')}}" min="{{ \Carbon\Carbon::now()->toDateString() }}">
                        @error('closeDate')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="purchasePrice">Purchase Price <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="purchasePrice" name="purchasePrice" value="{{ session('offerData.purchasePrice') ?? old('purchasePrice')}}">
                        @error('purchasePrice')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4" style="height: 70px;">
                        <label for="downPayment">Down Payment <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="downPayment" name="downPayment" value="{{ session('offerData.downPayment') ?? old('downPayment')}}">
                        @error('downPayment')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4" style="height: 70px;">
                        <label for="commAmount">Comm. Amount <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="commAmount" name="commAmount" value="{{ session('offerData.commAmount') ?? old('commAmount')}}">
                        @error('commAmount')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="commissionPercent">Commission % <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="commissionPercent"
                            name="commissionPercent" value="{{ session('offerData.commissionPercent') ?? old('commissionPercent')}}">
                        @error('commissionPercent')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="balanceDue">Balance Due <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="balanceDue" name="balanceDue" value="{{ session('offerData.balanceDue') ?? old('balanceDue')}}">
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
                            <input type="number" class="form-control" id="offer-price" name="off_price" value="{{ session('offerData.off_price') ?? old('off_price')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="offer-deposit">Deposit</label>
                            <input type="number" class="form-control" id="offer-deposit" name="deposit" value="{{ session('offerData.deposit') ?? old('deposit')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="offer-addDeposit">Add. Deposit</label>
                            <input type="number" class="form-control" id="offer-addDeposit" name="addDeposit" value="{{ session('offerData.addDeposit') ?? old('addDeposit')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="offer-downPayBal">Down Pay Bal.</label>
                            <input type="number" class="form-control" id="offer-downPayBal" name="downPayBal" value="{{ session('offerData.downPayBal') ?? old('downPayBal')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="offer-downPayBal2">Down Pay Bal.2</label>
                            <input type="number" class="form-control" id="offer-downPayBal2" name="downPayBal2" value="{{ session('offerData.downPayBal2') ?? old('downPayBal2')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="offer-totalDownPayBal">Total Down Pay Bal.</label>
                            <input type="number" class="form-control" id="offer-totalDownPayBal"
                                name="totalDownPayBal" value="{{ session('offerData.totalDownPayBal') ?? old('totalDownPayBal')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="offer-assumption">Assumption</label>
                            <input type="number" class="form-control" id="offer-assumption" name="assumption" value="{{ session('offerData.assumption') ?? old('assumption')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="offer-addAssumption">Add Assumption</label>
                            <input type="number" class="form-control" id="offer-addAssumption"
                                name="addAssumption" value="{{ session('offerData.addAssumption') ?? old('addAssumption')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="offer-balanceDue">Balance Due</label>
                            <input type="number" class="form-control" id="offer-balanceDue" name="off_balanceDue" value="{{ session('offerData.off_balanceDue') ?? old('downPayBal2')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="offer-perMonth">Per Month</label>
                            <input type="number" class="form-control" id="offer-perMonth" name="perMonth" value="{{ session('offerData.perMonth') ?? old('perMonth')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="offer-interest">Interest</label>
                            <input type="number" class="form-control" id="offer-interest" name="interest" value="{{ session('offerData.interest') ?? old('interest')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="offer-addTerms">Add. Terms</label>
                            <input type="text" class="form-control" id="offer-addTerms" name="addTerms" value="{{ session('offerData.addTerms') ?? old('addTerms')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="offer-inventory">Inventory</label>
                            <input type="number" class="form-control" id="offer-inventory" name="inventory" value="{{ session('offerData.inventory') ?? old('inventory')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="offer-maxInventory">Max. Inventory</label>
                            <input type="number" class="form-control" id="offer-maxInventory"
                                name="maxInventory" value="{{ session('offerData.maxInventory') ?? old('maxInventory')}}">
                        </div>

                    </div>
                    <div class="col-md-4 counter mb-3">
                        <h4 class="mb-3 form-sec">Counter Offer</h4>
                        <div class="field-item mb-3">
                            <label for="counter-price">Price</label>
                            <input type="number" class="form-control" id="counter-price" name="co_price" value="{{ session('offerData.co_price') ?? old('co_price')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="counter-deposit">Deposit</label>
                            <input type="number" class="form-control" id="counter-deposit" name="co_deposit" value="{{ session('offerData.co_deposit') ?? old('co_deposit')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="counter-addDeposit">Add. Deposit</label>
                            <input type="number" class="form-control" id="counter-addDeposit" name="co_addDeposit" value="{{ session('offerData.co_addDeposit') ?? old('co_addDeposit')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="counter-downPayBal">Down Pay Bal.</label>
                            <input type="number" class="form-control" id="counter-downPayBal" name="co_downPayBal" value="{{ session('offerData.co_downPayBal') ?? old('co_downPayBal')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="counter-downPayBal2">Down Pay Bal.2</label>
                            <input type="number" class="form-control" id="counter-downPayBal2"
                                name="co_downPayBal2" value="{{ session('offerData.co_downPayBal2') ?? old('co_downPayBal2')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="counter-totalDownPayBal">Total Down Pay Bal.</label>
                            <input type="number" class="form-control" id="counter-totalDownPayBal"
                                name="co_totalDownPayBal" value="{{ session('offerData.co_totalDownPayBal') ?? old('co_totalDownPayBal')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="counter-assumption">Assumption</label>
                            <input type="number" class="form-control" id="counter-assumption" name="co_assumption" value="{{ session('offerData.co_assumption') ?? old('co_assumption')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="counter-addAssumption">Add Assumption</label>
                            <input type="number" class="form-control" id="counter-addAssumption"
                                name="co_addAssumption" value="{{ session('offerData.co_addAssumption') ?? old('co_addAssumption')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="counter-balanceDue">Balance Due</label>
                            <input type="number" class="form-control" id="counter-balanceDue" name="co_balanceDue" value="{{ session('offerData.co_balanceDue') ?? old('co_balanceDue')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="counter-perMonth">Per Month</label>
                            <input type="number" class="form-control" id="counter-perMonth" name="co_perMonth" value="{{ session('offerData.co_perMonth') ?? old('co_perMonth')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="counter-interest">Interest</label>
                            <input type="number" class="form-control" id="counter-interest" name="co_interest" value="{{ session('offerData.co_interest') ?? old('co_interest')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="counter-addTerms">Add. Terms</label>
                            <input type="text" class="form-control" id="counter-addTerms" name="co_addTerms" value="{{ session('offerData.co_addTerms') ?? old('co_addTerms')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="counter-inventory">Inventory</label>
                            <input type="number" class="form-control" id="counter-inventory" name="co_inventory" value="{{ session('offerData.co_inventory') ?? old('co_inventory')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="counter-maxInventory">Max. Inventory</label>
                            <input type="number" class="form-control" id="counter-maxInventory"
                                name="co_maxInventory" value="{{ session('offerData.co_maxInventory') ?? old('co_maxInventory')}}">
                        </div>

                    </div>
                    <div class="col-md-4 accepted mb-3">
                        <h4 class="mb-3 form-sec">Accepted Offer</h4>
                        <div class="field-item mb-3">
                            <label for="accepted-price">Price</label>
                            <input type="number" class="form-control" id="accepted-price" name="ac_price" value="{{ session('offerData.ac_price') ?? old('ac_price')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="accepted-deposit">Deposit</label>
                            <input type="number" class="form-control" id="accepted-deposit" name="ac_deposit" value="{{ session('offerData.ac_deposit') ?? old('ac_deposit')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="accepted-addDeposit">Add. Deposit</label>
                            <input type="number" class="form-control" id="accepted-addDeposit"
                                name="ac_addDeposit" value="{{ session('offerData.ac_addDeposit') ?? old('ac_addDeposit')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="accepted-downPayBal">Down Pay Bal.</label>
                            <input type="number" class="form-control" id="accepted-downPayBal"
                                name="ac_downPayBal" value="{{ session('offerData.ac_downPayBal') ?? old('ac_downPayBal')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="accepted-downPayBal2">Down Pay Bal.2</label>
                            <input type="number" class="form-control" id="accepted-downPayBal2"
                                name="ac_downPayBal2" value="{{ session('offerData.ac_downPayBal2') ?? old('ac_downPayBal2')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="accepted-totalDownPayBal">Total Down Pay Bal.</label>
                            <input type="number" class="form-control" id="accepted-totalDownPayBal"
                                name="ac_totalDownPayBal" value="{{ session('offerData.ac_totalDownPayBal') ?? old('ac_totalDownPayBal')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="accepted-assumption">Assumption</label>
                            <input type="number" class="form-control" id="accepted-assumption"
                                name="ac_assumption" value="{{ session('offerData.ac_assumption') ?? old('ac_assumption')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="accepted-addAssumption">Add Assumption</label>
                            <input type="number" class="form-control" id="accepted-addAssumption"
                                name="ac_addAssumption" value="{{ session('offerData.ac_addAssumption') ?? old('ac_addAssumption')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="accepted-balanceDue">Balance Due</label>
                            <input type="number" class="form-control" id="accepted-balanceDue"
                                name="ac_balanceDue" value="{{ session('offerData.ac_balanceDue') ?? old('ac_balanceDue')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="accepted-perMonth">Per Month</label>
                            <input type="number" class="form-control" id="accepted-perMonth" name="ac_perMonth" value="{{ session('offerData.ac_perMonth') ?? old('ac_perMonth')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="accepted-interest">Interest</label>
                            <input type="number" class="form-control" id="accepted-interest" name="ac_interest" value="{{ session('offerData.ac_interest') ?? old('ac_interest')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="accepted-addTerms">Add. Terms</label>
                            <input type="text" class="form-control" id="accepted-addTerms" name="ac_addTerms" value="{{ session('offerData.ac_addTerms') ?? old('ac_addTerms')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="accepted-inventory">Inventory</label>
                            <input type="number" class="form-control" id="accepted-inventory" name="ac_inventory" value="{{ session('offerData.ac_inventory') ?? old('ac_inventory')}}">
                        </div>
                        <div class="field-item mb-3">
                            <label for="accepted-maxInventory">Max. Inventory</label>
                            <input type="number" class="form-control" id="accepted-maxInventory"
                                name="ac_maxInventory" value="{{ session('offerData.ac_maxInventory') ?? old('ac_maxInventory')}}">
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
                        <input type="checkbox" id="realEstateTransaction" name="realEstateTransaction" value="1" {{ (old('realEstateTransaction') || session('offerData.realEstateTransaction') == 1) ? 'checked' : '' }} onchange="changeRealStateTransValue()">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="depositCheck">Deposit Check</label>
                        <input type="text" class="form-control" id="depositCheck" name="depositCheck" value="{{ session('offerData.depositCheck') ?? old('depositCheck')}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="bank">Bank</label>
                        <input type="text" class="form-control" id="bank" name="bank_name" value="{{ session('offerData.bank_name') ?? old('bank_name')}}">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 mb-3">
                        <label for="dateDeposited">Date Deposited</label>
                        <input type="date" class="form-control" id="dateDeposited" name="dateDeposited" value="{{ session('offerData.dateDeposited') ?? old('dateDeposited')}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="nameOnCheck">Name on Check</label>
                        <input type="text" class="form-control" id="nameOnCheck" name="nameOnCheck" value="{{ session('offerData.nameOnCheck') ?? old('nameOnCheck')}}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Check on Hold</label>
                        <input type="checkbox" id="checkOnHold" name="checkOnHold" value="1" {{ (old('checkOnHold') || session('offerData.checkOnHold') == 1) ? 'checked' : '' }} onchange="changeCheckOnHoldValue()">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Bounced</label>
                        <input type="checkbox" id="bounced" name="bounced" value="1" {{ (old('bounced') || session('offerData.bounced') == 1) ? 'checked' : '' }} onchange="changeCheckBouncedValue()">
                    </div>
                </div>


                <div class="row mb-2">

                    <div class="col-md-4 mb-3">
                        <label for="reason">Reason</label>
                        <input type="text" class="form-control" id="reason" name="reason" value="{{ session('offerData.reason') ?? old('reason')}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="amount">Amount</label>
                        <input type="number" class="form-control" id="amount" name="amount" value="{{ session('offerData.amount') ?? old('amount')}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dateReturned">Date Returned</label>
                        <input type="date" class="form-control" id="dateReturned" name="dateReturned" value="{{ session('offerData.dateReturned') ?? old('dateReturned')}}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="returnCheck">Return Check</label>
                        <input type="text" class="form-control" id="returnCheck" name="returnCheck" value="{{ session('offerData.returnCheck') ?? old('returnCheck')}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="checkReturnedTo">Check Returned To</label>
                        <input type="text" class="form-control" id="checkReturnedTo" name="checkReturnedTo" value="{{ session('offerData.checkReturnedTo') ?? old('checkReturnedTo')}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="relationship">Relationship</label>
                        <input type="text" class="form-control" id="relationship" name="relationship" value="{{ session('offerData.relationship') ?? old('relationship')}}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-8 mb-3">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ session('offerData.address') ?? old('address')}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="">City</label>
                        <input type="text" id="city" class="form-control" placeholder="City" name="escrow_city" value="{{ session('offerData.escrow_city') ?? old('escrow_city')}}">
                        @error('escrow_city')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="">State</label>
                        <select id="State" class="form-select" name="escrow_state">
                            <option value="" selected="">Select state</option>
                            @foreach($states as $key=>$value)
                            <option value="{{$value->State}}" {{ (old('escrow_state') == $value->State || session('offerData.escrow_state') == $value->State) ? 'selected' : '' }}>{{$value->StateName}}</option>
                            @endforeach
                        </select>
                        @error('escrow_state')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="">Zip</label>
                        <input type="text" id="Zip" class="form-control" placeholder="Zip" name="escrow_zip_code" value="{{ session('offerData.escrow_zip_code') ?? old('escrow_zip_code')}}">
                        @error('escrow_zip_code')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ session('offerData.phone') ?? old('phone')}}">
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
                        <input type="text" class="form-control" id="buyerAttorney" name="buyerAttorney" value="{{ session('offerData.buyerAttorney') ?? old('buyerAttorney')}}">
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">
                        <label for="sellerAttorney">Seller Attorney</label>
                        <input type="text" class="form-control" id="sellerAttorney" name="sellerAttorney" value="{{ session('offerData.sellerAttorney') ?? old('sellerAttorney')}}">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">
                        <label for="buyerAccountant">Buyer Accountant</label>
                        <input type="text" class="form-control" id="buyerAccountant" name="buyerAccountant" value="{{ session('offerData.buyerAccountant') ?? old('buyerAccountant')}}">
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">
                        <label for="sellerAccountant">Seller Accountant</label>
                        <input type="text" class="form-control" id="sellerAccountant" name="sellerAccountant" value="{{ session('offerData.sellerAccountant') ?? old('sellerAccountant')}}">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">
                        <label for="landlord">Landlord</label>
                        <input type="text" class="form-control" id="landlord" name="landlord" value="{{ session('offerData.landlord') ?? old('landlord')}}">
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                        <label for="referral">Referral</label>
                        <input type="text" class="form-control" id="referral" name="referral" value="{{ session('offerData.referral') ?? old('referral')}}">
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                        <label for="referralFeePaid">Referral Fee Paid</label>
                        <input type="text" class="form-control" id="referralFeePaid" name="referralFeePaid" value="{{ session('offerData.referralFeePaid') ?? old('referralFeePaid')}}">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">
                        <label for="schedClosedDate">Scheduled Closed Date</label>
                        <input type="date" class="form-control" id="schedClosedDate" name="schedClosedDate" value="{{ session('offerData.schedClosedDate') ?? old('schedClosedDate')}}">
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">
                        <label for="schedCloseTime">Scheduled Close Time</label>
                        <input type="text" class="form-control" id="schedCloseTime" name="schedCloseTime" value="{{ session('offerData.schedCloseTime') ?? old('schedCloseTime')}}">
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">
                        <label for="attorneyLetters">Attorney Letters</label>
                        <input type="text" class="form-control" id="attorneyLetters" name="attorneyLetters" value="{{ session('offerData.attorneyLetters') ?? old('attorneyLetters')}}">
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">
                        <label for="closingAnticipationLetters">Closing Anticipation Letters Sent</label>
                        <input type="text" class="form-control" id="closingAnticipationLetters"
                            name="closingAnticipationLetters" value="{{ session('offerData.closingAnticipationLetters') ?? old('closingAnticipationLetters')}}">
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
                        <input type="checkbox" id="realEstateIncluded" name="realEstateIncluded" value="1" {{ (old('realEstateIncluded') || session('offerData.realEstateIncluded') == 1) ? 'checked' : '' }} onchange="changeRealEstateIncludedValue()">
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                        <label>Option to Buy</label>
                        <input type="checkbox" id="optionToBuy" name="optionToBuy" value="1" {{ (old('optionToBuy') || session('offerData.optionToBuy') == 1) ? 'checked' : '' }} onchange="changeOptionToBuyValue()">
                    </div>
                </div>

                <div class="row mb-3">
                    <h4 class="form-sec">Real Estate</h4>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                        <label for="real-price">Price</label>
                        <input type="text" class="form-control" id="real-price" name="rest_price" value="{{ session('offerData.rest_price') ?? old('rest_price')}}">
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                        <label for="real-terms">Terms</label>
                        <input type="text" class="form-control" id="real-terms" name="rest_terms" value="{{ session('offerData.rest_terms') ?? old('rest_terms')}}">
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                        <label for="real-downPay">Down Payment</label>
                        <input type="text" class="form-control" id="real-downPay" name="rest_downPay" value="{{ session('offerData.rest_downPay') ?? old('rest_downPay')}}">
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                        <label for="real-balance">Balance</label>
                        <input type="text" class="form-control" id="real-balance" name="rest_balance" value="{{ session('offerData.rest_balance') ?? old('rest_balance')}}">
                    </div>
                </div>

                <div class="row mb-3">
                    <h4 class="form-sec">Option to Buy</h4>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                        <label for="option-price">Price</label>
                        <input type="text" class="form-control" id="option-price" name="otb_price" value="{{ session('offerData.otb_price') ?? old('otb_price')}}">
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                        <label for="option-terms">Terms</label>
                        <input type="text" class="form-control" id="option-terms" name="otb_terms" value="{{ session('offerData.otb_terms') ?? old('otb_terms')}}">
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                        <label for="option-downPay">Down Payment</label>
                        <input type="text" class="form-control" id="option-downPay" name="otb_downPay" value="{{ session('offerData.otb_downPay') ?? old('otb_downPay')}}">
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                        <label for="option-balance">Balance</label>
                        <input type="text" class="form-control" id="option-balance" name="otb_balance" value="{{ session('offerData.otb_balance') ?? old('otb_balance')}}">
                    </div>
                </div>
                <div class="row mb-3">
                    <h4 class="form-sec">Lease Terms</h4>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                        <label for="leaseTerms">Lease Terms</label>
                        <input type="text" class="form-control" id="leaseTerms" name="leaseTerms" value="{{ session('offerData.leaseTerms') ?? old('leaseTerms')}}">
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                        <label for="optionYears">Option Years</label>
                        <input type="text" class="form-control" id="optionYears" name="optionYears" value="{{ session('offerData.optionYears') ?? old('optionYears')}}">
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                        <label for="doiMonth">Doi Month</label>
                        <input type="text" class="form-control" id="doiMonth" name="doiMonth" value="{{ session('offerData.doiMonth') ?? old('doiMonth')}}">
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                        <label for="options">Options</label>
                        <input type="text" class="form-control" id="options" name="options" value="{{ session('offerData.options') ?? old('options')}}">
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
                                rows="3"></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="comments">Comments</label>
                            <textarea class="form-control" id="comments" name="comments" rows="3"></textarea>
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
        $('#offer-downPayBal, #offer-downPayBal2').on('input', function() {
            var input1Value = parseFloat($('#offer-downPayBal').val()) || 0; // Get value from input1, default to 0 if empty
            var input2Value = parseFloat($('#offer-downPayBal2').val()) || 0; // Get value from input2, default to 0 if empty

            // Calculate the sum
            var sum = input1Value + input2Value;

            // Display the result in the third input field
            $('#offer-totalDownPayBal').val(sum);
        });
        $('#counter-downPayBal, #counter-downPayBal2').on('input', function() {
            var input1Value = parseFloat($('#counter-downPayBal').val()) || 0; // Get value from input1, default to 0 if empty
            var input2Value = parseFloat($('#counter-downPayBal2').val()) || 0; // Get value from input2, default to 0 if empty

            // Calculate the sum
            var sum = input1Value + input2Value;

            // Display the result in the third input field
            $('#counter-totalDownPayBal').val(sum);
        });
        $('#accepted-downPayBal, #accepted-downPayBal2').on('input', function() {
            var input1Value = parseFloat($('#accepted-downPayBal').val()) || 0; // Get value from input1, default to 0 if empty
            var input2Value = parseFloat($('#accepted-downPayBal2').val()) || 0; // Get value from input2, default to 0 if empty

            // Calculate the sum
            var sum = input1Value + input2Value;

            // Display the result in the third input field
            $('#accepted-totalDownPayBal').val(sum);
        });

    });
</script>
@endsection