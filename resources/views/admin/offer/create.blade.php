
   
@extends('admin.layout.master')
@section('content')
      
        <div class="container-fluid content" style="background-color: #f8f9fa; padding: 2rem 2rem 0rem 2rem;">
            <div class="next-back-page d-flex justify-content-between">
                <button><i class="fa fa-chevron-left"></i>Back</button>
                <button>Next <i class="fa fa-chevron-right"></i></button>
            </div>
        </div>
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
                                <input type="text" class="form-control" id="offerID" name="offerID">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="companyName">Company Name</label>
                                <input type="text" class="form-control" id="companyName" name="companyName">
                            </div>
                            <div class="col-md-4" style="height: 70px;">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option>Select Status</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label for="buyer">Buyer</label>
                                <select class="form-control" id="buyer" name="buyer">
                                    <option>Select Buyer</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="listingAgent">Listing Agent</label>
                                <select class="form-control" id="listingAgent" name="listingAgent">
                                    <option>Select Listing Agent</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="sellingAgent">Selling Agent</label>
                                <select class="form-control" id="sellingAgent" name="sellingAgent">
                                    <option>Select Selling Agent</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3 mb-3">
                                <label for="dateOfOffer">Date of Offer</label>
                                <input type="date" class="form-control" id="dateOfOffer" name="dateOfOffer">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="expDate">Exp. Date</label>
                                <input type="date" class="form-control" id="expDate" name="expDate">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="accDate">Acc Date</label>
                                <input type="date" class="form-control" id="accDate" name="accDate">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="closeDate">Close Date</label>
                                <input type="date" class="form-control" id="closeDate" name="closeDate">
                            </div>
                        </div>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label for="purchasePrice">Purchase Price</label>
                                <input type="number" class="form-control" id="purchasePrice" name="purchasePrice">
                            </div>
                            <div class="col-md-4" style="height: 70px;">
                                <label for="downPayment">Down Payment</label>
                                <input type="text" class="form-control" id="downPayment" name="downPayment">
                            </div>
                            <div class="col-md-4" style="height: 70px;">
                                <label for="commAmount">Comm. Amount</label>
                                <input type="text" class="form-control" id="commAmount" name="commAmount">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label for="commissionPercent">Commission %</label>
                                <input type="number" class="form-control" id="commissionPercent"
                                    name="commissionPercent">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="balanceDue">Balance Due</label>
                                <input type="text" class="form-control" id="balanceDue" name="balanceDue">
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
                                    <input type="number" class="form-control" id="offer-price" name="price">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="offer-deposit">Deposit</label>
                                    <input type="number" class="form-control" id="offer-deposit" name="deposit">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="offer-addDeposit">Add. Deposit</label>
                                    <input type="number" class="form-control" id="offer-addDeposit" name="addDeposit">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="offer-downPayBal">Down Pay Bal.</label>
                                    <input type="number" class="form-control" id="offer-downPayBal" name="downPayBal">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="offer-downPayBal2">Down Pay Bal.2</label>
                                    <input type="number" class="form-control" id="offer-downPayBal2" name="downPayBal2">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="offer-totalDownPayBal">Total Down Pay Bal.</label>
                                    <input type="number" class="form-control" id="offer-totalDownPayBal"
                                        name="totalDownPayBal">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="offer-assumption">Assumption</label>
                                    <input type="number" class="form-control" id="offer-assumption" name="assumption">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="offer-addAssumption">Add Assumption</label>
                                    <input type="number" class="form-control" id="offer-addAssumption"
                                        name="addAssumption">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="offer-balanceDue">Balance Due</label>
                                    <input type="number" class="form-control" id="offer-balanceDue" name="balanceDue">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="offer-perMonth">Per Month</label>
                                    <input type="number" class="form-control" id="offer-perMonth" name="perMonth">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="offer-interest">Interest</label>
                                    <input type="number" class="form-control" id="offer-interest" name="interest">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="offer-addTerms">Add. Terms</label>
                                    <input type="text" class="form-control" id="offer-addTerms" name="addTerms">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="offer-inventory">Inventory</label>
                                    <input type="number" class="form-control" id="offer-inventory" name="inventory">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="offer-maxInventory">Max. Inventory</label>
                                    <input type="number" class="form-control" id="offer-maxInventory"
                                        name="maxInventory">
                                </div>

                            </div>
                            <div class="col-md-4 counter mb-3">
                                <h4 class="mb-3 form-sec">Counter Offer</h4>
                                <div class="field-item mb-3">
                                    <label for="counter-price">Price</label>
                                    <input type="number" class="form-control" id="counter-price" name="price">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="counter-deposit">Deposit</label>
                                    <input type="number" class="form-control" id="counter-deposit" name="deposit">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="counter-addDeposit">Add. Deposit</label>
                                    <input type="number" class="form-control" id="counter-addDeposit" name="addDeposit">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="counter-downPayBal">Down Pay Bal.</label>
                                    <input type="number" class="form-control" id="counter-downPayBal" name="downPayBal">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="counter-downPayBal2">Down Pay Bal.2</label>
                                    <input type="number" class="form-control" id="counter-downPayBal2"
                                        name="downPayBal2">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="counter-totalDownPayBal">Total Down Pay Bal.</label>
                                    <input type="number" class="form-control" id="counter-totalDownPayBal"
                                        name="totalDownPayBal">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="counter-assumption">Assumption</label>
                                    <input type="number" class="form-control" id="counter-assumption" name="assumption">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="counter-addAssumption">Add Assumption</label>
                                    <input type="number" class="form-control" id="counter-addAssumption"
                                        name="addAssumption">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="counter-balanceDue">Balance Due</label>
                                    <input type="number" class="form-control" id="counter-balanceDue" name="balanceDue">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="counter-perMonth">Per Month</label>
                                    <input type="number" class="form-control" id="counter-perMonth" name="perMonth">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="counter-interest">Interest</label>
                                    <input type="number" class="form-control" id="counter-interest" name="interest">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="counter-addTerms">Add. Terms</label>
                                    <input type="text" class="form-control" id="counter-addTerms" name="addTerms">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="counter-inventory">Inventory</label>
                                    <input type="number" class="form-control" id="counter-inventory" name="inventory">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="counter-maxInventory">Max. Inventory</label>
                                    <input type="number" class="form-control" id="counter-maxInventory"
                                        name="maxInventory">
                                </div>

                            </div>
                            <div class="col-md-4 accepted mb-3">
                                <h4 class="mb-3 form-sec">Accepted Offer</h4>
                                <div class="field-item mb-3">
                                    <label for="accepted-price">Price</label>
                                    <input type="number" class="form-control" id="accepted-price" name="price">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="accepted-deposit">Deposit</label>
                                    <input type="number" class="form-control" id="accepted-deposit" name="deposit">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="accepted-addDeposit">Add. Deposit</label>
                                    <input type="number" class="form-control" id="accepted-addDeposit"
                                        name="addDeposit">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="accepted-downPayBal">Down Pay Bal.</label>
                                    <input type="number" class="form-control" id="accepted-downPayBal"
                                        name="downPayBal">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="accepted-downPayBal2">Down Pay Bal.2</label>
                                    <input type="number" class="form-control" id="accepted-downPayBal2"
                                        name="downPayBal2">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="accepted-totalDownPayBal">Total Down Pay Bal.</label>
                                    <input type="number" class="form-control" id="accepted-totalDownPayBal"
                                        name="totalDownPayBal">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="accepted-assumption">Assumption</label>
                                    <input type="number" class="form-control" id="accepted-assumption"
                                        name="assumption">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="accepted-addAssumption">Add Assumption</label>
                                    <input type="number" class="form-control" id="accepted-addAssumption"
                                        name="addAssumption">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="accepted-balanceDue">Balance Due</label>
                                    <input type="number" class="form-control" id="accepted-balanceDue"
                                        name="balanceDue">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="accepted-perMonth">Per Month</label>
                                    <input type="number" class="form-control" id="accepted-perMonth" name="perMonth">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="accepted-interest">Interest</label>
                                    <input type="number" class="form-control" id="accepted-interest" name="interest">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="accepted-addTerms">Add. Terms</label>
                                    <input type="text" class="form-control" id="accepted-addTerms" name="addTerms">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="accepted-inventory">Inventory</label>
                                    <input type="number" class="form-control" id="accepted-inventory" name="inventory">
                                </div>
                                <div class="field-item mb-3">
                                    <label for="accepted-maxInventory">Max. Inventory</label>
                                    <input type="number" class="form-control" id="accepted-maxInventory"
                                        name="maxInventory">
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
                                <input type="checkbox" id="realEstateTransaction">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="depositCheck">Deposit Check</label>
                                <input type="text" class="form-control" id="depositCheck">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="bank">Bank</label>
                                <input type="text" class="form-control" id="bank">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 mb-3">
                                <label for="dateDeposited">Date Deposited</label>
                                <input type="date" class="form-control" id="dateDeposited" name="dateDeposited">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="nameOnCheck">Name on Check</label>
                                <input type="text" class="form-control" id="nameOnCheck" name="nameOnCheck">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Check on Hold</label>
                                <input type="checkbox" id="checkOnHold">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Bounced</label>
                                <input type="checkbox" id="bounced">
                            </div>
                        </div>


                        <div class="row mb-2">

                            <div class="col-md-4 mb-3">
                                <label for="reason">Reason</label>
                                <input type="text" class="form-control" id="reason" name="reason">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="amount">Amount</label>
                                <input type="number" class="form-control" id="amount" name="amount">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="dateReturned">Date Returned</label>
                                <input type="date" class="form-control" id="dateReturned" name="dateReturned">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label for="returnCheck">Return Check</label>
                                <input type="text" class="form-control" id="returnCheck" name="returnCheck">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="checkReturnedTo">Check Returned To</label>
                                <input type="text" class="form-control" id="checkReturnedTo" name="checkReturnedTo">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="relationship">Relationship</label>
                                <input type="text" class="form-control" id="relationship" name="relationship">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="city">City, State, Zip</label>
                                <div class="d-flex">
                                    <input type="text" class="form-control" id="city" name="city">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone">
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
                                <input type="date" class="form-control" id="schedClosedDate" name="schedClosedDate">
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">
                                <label for="schedCloseTime">Scheduled Close Time</label>
                                <input type="text" class="form-control" id="schedCloseTime" name="schedCloseTime">
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">
                                <label for="attorneyLetters">Attorney Letters</label>
                                <input type="text" class="form-control" id="attorneyLetters" name="attorneyLetters">
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">
                                <label for="closingAnticipationLetters">Closing Anticipation Letters Sent</label>
                                <input type="text" class="form-control" id="closingAnticipationLetters"
                                    name="closingAnticipationLetters">
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
                                <input type="checkbox" id="realEstateIncluded">
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                                <label>Option to Buy</label>
                                <input type="checkbox" id="optionToBuy">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <h4 class="form-sec">Real Estate</h4>
                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                                <label for="real-price">Price</label>
                                <input type="text" class="form-control" id="real-price" name="price">
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                                <label for="real-terms">Terms</label>
                                <input type="text" class="form-control" id="real-terms" name="terms">
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                                <label for="real-downPay">Down Payment</label>
                                <input type="text" class="form-control" id="real-downPay" name="downPay">
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                                <label for="real-balance">Balance</label>
                                <input type="text" class="form-control" id="real-balance" name="balance">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <h4 class="form-sec">Option to Buy</h4>
                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                                <label for="option-price">Price</label>
                                <input type="text" class="form-control" id="option-price" name="price">
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                                <label for="option-terms">Terms</label>
                                <input type="text" class="form-control" id="option-terms" name="terms">
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                                <label for="option-downPay">Down Payment</label>
                                <input type="text" class="form-control" id="option-downPay" name="downPay">
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                                <label for="option-balance">Balance</label>
                                <input type="text" class="form-control" id="option-balance" name="balance">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <h4 class="form-sec">Lease Terms</h4>
                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                                <label for="leaseTerms">Lease Terms</label>
                                <input type="text" class="form-control" id="leaseTerms" name="leaseTerms">
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                                <label for="optionYears">Option Years</label>
                                <input type="text" class="form-control" id="optionYears" name="optionYears">
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                                <label for="doiMonth">Doi Month</label>
                                <input type="text" class="form-control" id="doiMonth" name="doiMonth">
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                                <label for="options">Options</label>
                                <input type="text" class="form-control" id="options" name="options">
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
                                <button type="submit" name="previous" class="btn-primary" onclick="goToPreviousStep()"  id="prevBtn">Previous</button>
                            @endif

                            <!-- Next button or Submit -->
                            <button type="submit" name="next" class="btn-primary"  id="nextBtn">
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
<script>
    // Previous step function
    function goToPreviousStep() {
        // Get the current step input field and decrement the value
        const stepInput = document.querySelector('input[name="step"]');
        let currentStep = parseInt(stepInput.value);

        // Decrement the step only if it's greater than 1
        if (currentStep > 1) {
            stepInput.value = currentStep - 1;
        }

        // Optionally submit the form (if necessary)
       //document.querySelector('#offerForm').submit();
    }
</script>
@endsection