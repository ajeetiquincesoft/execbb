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
                <form id="addnewlist" action="">

                    <!-- One "tab" for each step in the form: -->
                    <div class="tab" style="display: block;">
                        <h3>General:</h3>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label for="busCategory" class="form-label">Bus. Category</label>
                                <select id="busCategory" class="form-select">
                                    <option selected="">Select category</option>
                                    <option>Category 1</option>
                                    <option>Category 2</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="busType" class="form-label">Bus. Type</label>
                                <select id="busType" class="form-select">
                                    <option selected="">Select type</option>
                                    <option>Type 1</option>
                                    <option>Type 2</option>
                                </select>
                            </div>
                            <div class="col-md-4" style="height: 70px;">
                                <label for="franchise" class="form-check-label">Franchise</label>
                                <input type="checkbox" id="franchise" class="form-check-input">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label for="cropName" class="form-label">Crop Name</label>
                                <input type="text" id="cropName" class="form-control">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="dba" class="form-label">DBA</label>
                                <input type="text" id="dba" class="form-control">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="productMix" class="form-label">Product Mix</label>
                                <input type="text" id="productMix" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" id="address" class="form-control">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="cityStateZip" class="form-label">City</label>
                                <div class="d-flex">
                                    <input type="text" id="city" class="form-control" placeholder="City">
                                    <input type="text" id="State" class="form-control" placeholder="State">
                                    <input type="text" id="Zip" class="form-control" placeholder="Zip">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="county" class="form-label">County</label>
                                <input type="text" id="county" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel" id="phone" class="form-control">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="fax" class="form-label">Fax</label>
                                <input type="text" id="fax" class="form-control">
                            </div>
                            <div class="col-md-4" style="height: 70px;">
                                <label for="featuredListing" class="form-check-label">Featured Listing</label>
                                <input type="checkbox" id="featuredListing" class="form-check-input">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <u><span id="fileLink">View Image</span> </u>
                                <br><!-- Placeholder for the file name -->
                                <label for="fileUpload" class="upload-button mt-1">
                                    <input type="file" id="fileUpload" accept="image/*" style="display:none;">
                                    <span class="button-text"> <img src="images/uploadicon.svg" alt="">Upload</span>
                                </label>
                                <div id="imagePreview"></div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" id="firstName" class="form-control">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" id="lastName" class="form-control">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="homeAddress" class="form-label">Home Address</label>
                                <input type="text" id="homeAddress" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label for="cityStateZip2" class="form-label">City</label>
                                <div class="d-flex">
                                    <input type="text" id="city2" class="form-control" placeholder="City">
                                    <input type="text" id="State2" class="form-control" placeholder="State">
                                    <input type="text" id="Zip2" class="form-control" placeholder="Zip">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" class="form-control">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="homePhone" class="form-label">Home Phone</label>
                                <input type="text" id="homePhone" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label for="homeFax" class="form-label">Home Fax</label>
                                <input type="text" id="homeFax" class="form-control">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="pager" class="form-label">Pager</label>
                                <input type="text" id="pager" class="form-control">
                            </div>
                            <div class="col-md-4" style="height: 70px;">
                                <label for="review" class="form-check-label">Review</label>
                                <input type="checkbox" id="review" class="form-check-input">
                            </div>
                        </div>
                    </div>
                    <div class="tab" style="display: none;">
                        <h3>Business</h3>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label for="buildingSize">Building Size</label>
                                <input type="text" class="form-control" id="buildingSize" name="buildingSize">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="basementSize">Basement Size</label>
                                <input type="text" class="form-control" id="basementSize" name="basementSize">
                            </div>
                            <div class="col-md-4" style="height: 70px;">
                                <label class="form-check-label me-2">Basement?</label>
                                <input type="checkbox" class="form-check-input" id="basement" name="basement">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label for="parking">Parking</label>
                                <input type="text" class="form-control" id="parking" name="parking">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="licenseRequired">License Required</label>
                                <input type="text" class="form-control" id="licenseRequired" name="licenseRequired">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="baseMonthlyRent">Base Monthly Rent</label>
                                <input type="text" class="form-control" id="baseMonthlyRent" name="baseMonthlyRent">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label for="leaseTerms">Lease Terms</label>
                                <input type="text" class="form-control" id="leaseTerms" name="leaseTerms">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="leaseOptions">Lease Options</label>
                                <input type="text" class="form-control" id="leaseOptions" name="leaseOptions">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="daysOpen">No. of Days Open</label>
                                <input type="text" class="form-control" id="daysOpen" name="daysOpen">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label for="hoursOperation">Hours of Operation</label>
                                <input type="text" class="form-control" id="hoursOperation" name="hoursOperation">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="numSeats">No. of Seats</label>
                                <input type="text" class="form-control" id="numSeats" name="numSeats">
                            </div>
                            <div class="col-md-4" style="height: 70px;">
                                <label class="form-check-label me-2">Years Established?</label>
                                <input type="checkbox" class="form-check-input" id="yearsEstablished" name="yearsEstablished">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label for="yearsPrevOwner">Years Previous Owner</label>
                                <input type="text" class="form-control" id="yearsPrevOwner" name="yearsPrevOwner">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Interest</label>
                                <div class="d-flex">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="interestHot" name="interest" value="Hot">
                                        <label class="form-check-label" for="interestHot">Hot</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="interestMedium" name="interest" value="Medium">
                                        <label class="form-check-label" for="interestMedium">Medium</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="interestCold" name="interest" value="Cold">
                                        <label class="form-check-label" for="interestCold">Cold</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Employees</label>
                                <div class="d-flex">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="interestPartTime" name="interestType" value="Part Time">
                                        <label class="form-check-label" for="interestPartTime">Part Time</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="interestFullTime" name="interestType" value="Full Time">
                                        <label class="form-check-label" for="interestFullTime">Full Time</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab" style="display: none;">
                        <h3>Pricing</h3>
                        <hr>
                        <!-- Management and Referring Agent -->
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <h4 class="form-sec mb-3">Management Agent</h4>
                                <div class="d-flex">
                                    <div class="col-sm-6 p-0  mb-3">
                                        <label for="managementAgentName">Name</label>
                                        <input type="text" class="form-control" id="managementAgentName" name="managementAgentName">
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label for="managementAgentPhone">Phone</label>
                                        <input type="text" class="form-control" id="managementAgentPhone" name="managementAgentPhone">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6  mb-2">
                                <h4 class="form-sec mb-3">Referring Agent</h4>
                                <div class="d-flex">
                                    <div class="col p-0 mb-3">
                                        <label for="referringAgentName">Name</label>
                                        <input type="text" class="form-control" id="referringAgentName" name="referringAgentName">
                                    </div>
                                    <div class="col mb-3">
                                        <label for="referringAgentPhone">Phone</label>
                                        <input type="text" class="form-control" id="referringAgentPhone" name="referringAgentPhone">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Listing Data -->
                        <div class="row mb-2">
                            <h4 class="form-sec mb-3">Listing Data</h4>
                            <div class="col-md-3 mb-3">
                                <label for="listingDate">Listing Date</label>
                                <input type="date" class="form-control" id="listingDate" name="listingDate">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="expDate">Exp Date</label>
                                <input type="date" class="form-control" id="expDate" name="expDate">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="listingType">Listing Type</label>
                                <input type="text" class="form-control" id="listingType" name="listingType">
                            </div>
                        </div>

                        <!-- Co-Broker and Reason for Sale -->
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label for="coBroker">Co-Broker</label>
                                <input type="text" class="form-control" id="coBroker" name="coBroker">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="reasonForSale">Reason For Sale</label>
                                <input type="text" class="form-control" id="reasonForSale" name="reasonForSale">
                            </div>
                        </div>

                        <!-- Pricing Data -->
                        <div class="row mb-2">
                            <h4 class="form-sec mb-3">Pricing Data</h4>
                            <div class="col-md-3 mb-3">
                                <label for="listPrice">List Price</label>
                                <input type="text" class="form-control" id="listPrice" name="listPrice">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="purPrice">Pur. Price</label>
                                <input type="text" class="form-control" id="purPrice" name="purPrice">

                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="downPay">Down Pay</label>
                                <input type="text" class="form-control" id="downPay" name="downPay">

                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="balance">Balance</label>
                                <input type="text" class="form-control" id="balance" name="balance">

                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3 mb-3">
                                <label for="interest">Interest</label>
                                <input type="text" class="form-control" id="interest" name="interest">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="addTerms">Add. Terms</label>
                                <input type="text" class="form-control" id="addTerms" name="addTerms">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="invInPrice">Inv. in Price</label>
                                <input type="text" class="form-control" id="invInPrice" name="invInPrice">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="invNotInPrice">Inv. Not in Price</label>
                                <input type="text" class="form-control" id="invNotInPrice" name="invNotInPrice">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-check-label me-2" for="untilSolid">Until Solid</label>
                                <input type="checkbox" class="form-check-input" id="untilSolid" name="untilSolid">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <h4 class="form-sec mb-3">Real Estate Data</h4>
                            <div class="col-md-3 mb-3">
                                <label for="agent">Agent</label>
                                <input type="text" class="form-control" id="agent" name="agent">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="commission">Commission</label>
                                <input type="text" class="form-control" id="commission" name="commission">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="flatFee">Flat Fee</label>
                                <input type="text" class="form-control" id="flatFee" name="flatFee">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="reAskingPrice">Re Asking Price</label>
                                <input type="text" class="form-control" id="reAskingPrice" name="reAskingPrice">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3" style="height: 80px;">

                                <label class="form-check-label me-2" for="realEstate">Real Estate</label>
                                <input type="checkbox" class="form-check-input" id="realEstate" name="realEstate">
                            </div>

                            <div class="col-md-3" style="height: 80px;">
                                <label class="form-check-label me-2" for="optionToBuy">Option to Buy</label>
                                <input type="checkbox" class="form-check-input" id="optionToBuy" name="optionToBuy">

                            </div>

                            <div class="col-md-3" style="height: 80px;">
                                <label class="form-check-label me-2" for="soldByEBB">Sold by EBB</label>
                                <input type="checkbox" class="form-check-input" id="soldByEBB" name="soldByEBB">
                            </div>
                        </div>
                    </div>
                    <div class="tab" style="display: none;">
                        <h3>Financial</h3>
                        <hr>
                        <div class="row">
                            <h4 class="form-sec mb-3">Income &amp; Expenses</h4>
                            <div class="row mb-3">
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="annualSales">Annual Sales</label>
                                    <input type="text" class="form-control" id="annualSales" name="annualSales">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="costOfSales">Cost of Sales</label>
                                    <input type="text" class="form-control" id="costOfSales" name="costOfSales">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="grossProfit">Gross Profit</label>
                                    <input type="text" class="form-control" id="grossProfit" name="grossProfit">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="totalExpenses">Total Expenses</label>
                                    <input type="text" class="form-control" id="totalExpenses" name="totalExpenses">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <h4 class="form-sec mb-3">Cost of Goods</h4>
                            <div class="row mb-3">
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="food">Food</label>
                                    <input type="text" class="form-control" id="food" name="food">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="beverage">Beverage</label>
                                    <input type="text" class="form-control" id="beverage" name="beverage">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="cost0_1">Cost 1</label>
                                    <input type="text" class="form-control" id="cost0_1" name="cost0_1">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="cost0_2">Cost 2</label>
                                    <input type="text" class="form-control" id="cost0_2" name="cost0_2">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="cost0_3">Cost 3</label>
                                    <input type="text" class="form-control" id="cost0_3" name="cost0_3">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="cost0_4">Cost 4</label>
                                    <input type="text" class="form-control" id="cost0_4" name="cost0_4">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <h4 class="form-sec mb-3">Other Expenses</h4>
                            <div class="row mb-3">
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="baseAnnRent">Base Annual Rent</label>
                                    <input type="text" class="form-control" id="baseAnnRent" name="baseAnnRent">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="commAreaMaint">Comm Area Maintenance</label>
                                    <input type="text" class="form-control" id="commAreaMaint" name="commAreaMaint">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="realEstateTax">Real Estate Tax</label>
                                    <input type="text" class="form-control" id="realEstateTax" name="realEstateTax">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="annPayroll">Annual Payroll</label>
                                    <input type="text" class="form-control" id="annPayroll" name="annPayroll">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="payrollTax">Payroll Tax</label>
                                    <input type="text" class="form-control" id="payrollTax" name="payrollTax">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="licenseFees">License Fees</label>
                                    <input type="text" class="form-control" id="licenseFees" name="licenseFees">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="advertising">Advertising</label>
                                    <input type="text" class="form-control" id="advertising" name="advertising">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="telephone">Telephone</label>
                                    <input type="tel" class="form-control" id="telephone" name="telephone">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="utilities">Utilities</label>
                                    <input type="text" class="form-control" id="utilities" name="utilities">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="insurance">Insurance</label>
                                    <input type="text" class="form-control" id="insurance" name="insurance">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="accountingLegal">Accounting/Legal</label>
                                    <input type="text" class="form-control" id="accountingLegal" name="accountingLegal">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="maintenance">Maintenance</label>
                                    <input type="text" class="form-control" id="maintenance" name="maintenance">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="trash">Trash</label>
                                    <input type="text" class="form-control" id="trash" name="trash">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="other">Other</label>
                                    <input type="text" class="form-control" id="other" name="other">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab" style="display: none;">
                        <h4>Comments</h4>
                        <hr>
                        <div class="comment-area w-100">
                            <div class="row mb-3">
                                <!-- Highlights -->
                                <div class="col">
                                    <label for="highlights" class="form-label">Highlights</label>
                                    <textarea class="form-control" id="highlights" name="highlights" rows="4"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <!-- Directions -->
                                <div class="col">
                                    <label for="directions" class="form-label">Directions</label>
                                    <textarea class="form-control" id="directions" name="directions" rows="4"></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <!-- Comments -->
                                <div class="col">
                                    <label for="comments" class="form-label">Comments</label>
                                    <textarea class="form-control" id="comments" name="comments" rows="4"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <!-- Lead ID -->
                                <div class="col">
                                    <label for="leadId" class="form-label">Lead ID</label>
                                    <textarea class="form-control" id="leadId" name="leadId" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center" style="overflow:auto;">
                        <div>
                            <button class="btn-primary" type="button" id="prevBtn" onclick="nextPrev(-1)" style="display: none;">Previous</button>
                            <button class="btn-primary" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div p-8="">
            <p>&nbsp;</p>
        </div>
        <style>
        .accordion-button.collapsed {
            background: white;
            color: #000;
            /* Optional: Change the text color to black for better contrast */
        }

        .accordion-button.collapsed::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
        }

        .accordion-button.collapsed::before {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
        }

        .form-check-input[type=checkbox] {
            position: absolute !important;
            top: 40% !important;
            left: 5% !important;
            margin: 0;
        }

        h4.form-sec {
            font-family: inter;
            font-weight: 600;
            font-size: 1.1rem;
            color: #000;
        }

        .tab h3 {
            font-size: 23px;
            font-weight: 600;
            font-family: 'Inter';
            color: #000;
        }

        .tab label {
            font-weight: 600;
            color: #444444;
            font-size: 13px;
            font-family: 'Inter';
        }

        button#nextBtn,
        button#prevBtn {
            padding: 10px 45px;
            border-radius: 5px;
            box-shadow: unset;
        }

        select {
            font-size: 13px !important;
            font-family: 'Inter' !important;
            padding: 1rem !important;
        }

        input,
        select {
            padding: 0.7rem !important;
            border-radius: 0px !important;
        }

        input:not([type=checkbox]) {
            padding: 0.7rem !important;
            border-radius: 0px !important;
        }

        .form-control {
            height: unset !important;
        }

        .form-check label.form-check-label {
            margin: 7px 20px 7px 7px;
        }

        input:focus,
        select:focus {
            border-color: #5d1229 !important;
            box-shadow: unset !important;
            border-radius: 0px !important;
        }

        .comment-area {
            width: 55% !important;
            margin: auto;
        }

        /* upload button style */
        .upload-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .upload-btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }

        .thumbnail {
            width: 200px;
            height: 200px;
            object-fit: cover;
            margin-top: 20px;
            display: none;
        }

        .file-info {
            display: none;
            font-size: 14px;
            margin-top: 10px;
        }

        .upload-button {
            background-color: #620022 !important;
            /* Burgundy color */
            padding: 10px 20px !important;
            border-radius: 5px !important;
            cursor: pointer !important;
            color: #ffff !important;
        }

        .button-text {
            display: inline-block;
        }

        #imagePreview {
            margin-top: 20px;
            display: none;
        }

        #imagePreview img {
            max-width: 100px;
        }

        #fileLink {
            cursor: pointer;
            font-weight: 600;
        }

        span.button-text img {
            margin-right: 10px;
            width: 18px;
        }

        span.button-text {
            font-size: 0.80rem;
            font-weight: 400;
            font-family: 'Inter';
            letter-spacing: 0.50px;
        }
        </style>
 <script>
        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab

        function showTab(n) {
            // This function will display the specified tab of the form ...
            var x = document.getElementsByClassName("tab");
            x[n].style.display = "block";
            // ... and fix the Previous/Next buttons:
            if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
            } else {
                document.getElementById("prevBtn").style.display = "inline";
            }
            if (n == (x.length - 1)) {
                document.getElementById("nextBtn").innerHTML = "Submit";
            } else {
                document.getElementById("nextBtn").innerHTML = "Next";
            }
            // ... and run a function that displays the correct step indicator:
            fixStepIndicator(n)
        }

        function nextPrev(n) {
            // This function will figure out which tab to display
            var x = document.getElementsByClassName("tab");
            // Exit the function if any field in the current tab is invalid:
            // if (n == 1 && !validateForm()) return false;
            // Hide the current tab:
            x[currentTab].style.display = "none";
            // Increase or decrease the current tab by 1:
            currentTab = currentTab + n;
            // if you have reached the end of the form... :
            if (currentTab >= x.length) {
                //...the form gets submitted:
                document.getElementById("regForm").submit();
                return false;
            }
            // Otherwise, display the correct tab:
            showTab(currentTab);
        }

        function validateForm() {
            // This function deals with validation of the form fields
            var x, y, i, valid = true;
            x = document.getElementsByClassName("tab");
            y = x[currentTab].getElementsByTagName("input");
            // A loop that checks every input field in the current tab:
            for (i = 0; i < y.length; i++) {
                // If a field is empty...
                if (y[i].value == "") {
                    // add an "invalid" class to the field:
                    y[i].className += " invalid";
                    // and set the current valid status to false:
                    valid = false;
                }
            }
            // If the valid status is true, mark the step as finished and valid:
            if (valid) {
                document.getElementsByClassName("step")[currentTab].className += " finish";
            }
            return valid; // return the valid status
        }

        function fixStepIndicator(n) {
            // This function removes the "active" class of all steps...
            var i, x = document.getElementsByClassName("step");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            //... and adds the "active" class to the current step:
            x[n].className += " active";
        }
    </script>
    <script>
        document.getElementById('fileUpload').addEventListener('change', function (event) {
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                const fileLink = document.getElementById('fileLink');

                reader.onload = function (e) {
                    const fileType = file.type;

                    // Check if the file is an image
                    if (fileType.startsWith('image/')) {
                        const imagePreviewDiv = document.getElementById('imagePreview');
                        imagePreviewDiv.innerHTML = '<img src="' + e.target.result + '" alt="Image Preview">';
                        imagePreviewDiv.style.display = 'block';
                    } else {
                        // If not an image, just show the file type
                        document.getElementById('imagePreview').innerHTML = '<p>Uploaded file: ' + file.name + '</p>';
                    }

                    // Set the file name and make it clickable
                    fileLink.innerText = file.name;
                    fileLink.href = e.target.result;
                    fileLink.download = file.name; // Set the filename for download
                    fileLink.style.display = 'inline-block';

                    // Add click event for downloading
                    fileLink.addEventListener('click', function () {
                        const downloadLink = document.createElement('a');
                        downloadLink.href = e.target.result;
                        downloadLink.download = file.name;
                        document.body.appendChild(downloadLink);
                        downloadLink.click();
                        document.body.removeChild(downloadLink);
                    });
                };

                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection