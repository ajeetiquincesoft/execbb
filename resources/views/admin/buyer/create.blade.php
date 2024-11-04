
   
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
                <form action="{{ route('buyerForm.process') }}" method="POST" id="buyerForm">
                @csrf
                <input type="hidden" name="steps" id="currentStep" value="{{ request()->input('steps', 1) }}">
                <input type="hidden" name="id" value="{{ $id }}">
                    <!-- One "form-multi-tab" for each step in the form: -->
                    <div class="form-multi-tab steps {{ request()->input('steps', 1) == 1 ? '' : 'hidden-step' }}" id="step-1">
                        <h3>General Information:</h3>
                        <hr><br>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="buyerId">Buyer ID</label>
                                <input type="text" class="form-control" id="buyerId" name="buyerId">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="firstName">First Name</label>
                                <input type="text" class="form-control" id="firstName" name="firstName">
                            </div>
                            <div class="col-md-4 d-flex flex-column check-column">
                                <label class="form-label" for="lastName">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="lastName">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="cityStateZip" class="form-label">City</label>
                                <div class="d-flex form-city-gap">
                                    <input type="text" id="city" class="form-control" placeholder="City">
                                    <input type="text" id="State" class="form-control" placeholder="State">
                                    <input type="text" id="Zip" class="form-control" placeholder="Zip">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="dlNumber">D/L Number</label>
                                <input type="number" class="form-control" id="dlNumber" name="dlNumber">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="homePhone">Home Phone</label>
                                <input type="tel" class="form-control" id="homePhone" name="homePhone">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="fax">Fax</label>
                                <input type="text" class="form-control" id="fax" name="fax">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="comment">Comment</label>
                                <input type="text" class="form-control" id="comment" name="comment">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3 d-flex flex-column check-column">
                                <label class="form-label" for="corporateBuyer" class="form-check-label">Corporate Buyer</label>
                                <input type="checkbox" class="form-check-input" id="corporateBuyer"
                                    name="corporateBuyer">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="profferedTerms">Proffered Terms</label>
                                <input type="text" class="form-control" id="profferedTerms" name="profferedTerms">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="monthExpDate">Month Exp Date</label>
                                <input type="date" class="form-control" id="monthExpDate" name="monthExpDate">
                            </div>
                            <div class="col-md-3 d-flex flex-column check-column">
                                <label class="form-label" for="county">County</label>
                                <select class="form-select" id="county" name="county">
                                    <option>Select County</option>
                                    <!-- Add options dynamically -->
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3 d-flex flex-column check-column">
                                <label class="form-label" for="emailOptOut" class="form-check-label">Email Opt Out</label>
                                <input type="checkbox" class="form-check-input" id="emailOptOut" name="emailOptOut">

                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="ssNumber">SS Number</label>
                                <input type="number" class="form-control" id="ssNumber" name="ssNumber">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="businessPhone">Business Phone</label>
                                <input type="tel" class="form-control" id="businessPhone" name="businessPhone">
                            </div>
                            <div class="col-md-3 d-flex flex-column check-column">
                                <label class="form-label" for="pager">Pager</label>
                                <input type="text" class="form-control" id="pager" name="pager">
                            </div>
                        </div>
                    </div>
                    <!-- Next tab Business -->
                    <div class="form-multi-tab  steps {{ request()->input('steps', 2) == 2 ? '' : 'hidden-step' }}" id="step-2">
                        <h3>Personal Business</h3>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="partnerName">Partner Name</label>
                                <input type="text" class="form-control" id="partnerName" name="partnerName">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="partnerPhone">Partner Phone</label>
                                <input type="tel" class="form-control" id="partnerPhone" name="partnerPhone">
                            </div>
                            <div class="col-md-4 d-flex flex-column check-column">
                                <label class="form-label" for="currentEmployment1">Current Employment</label>
                                <input type="text" class="form-control" id="currentEmployment1"
                                    name="currentEmployment1">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-8 mb-3">
                                <label class="form-label" for="currentEmployment2">Current Employment (2)</label>
                                <input type="text" class="form-control" id="currentEmployment2"
                                    name="currentEmployment2">
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="motivation">Motivation</label>
                                    <div class="d-flex justify-content-between">
                                        <input type="radio" id="motivation1" name="motivation" value="Hot">
                                        <label class="form-label" for="motivation1">1 - Hot</label>
                                        <input type="radio" id="motivation2" name="motivation" value="Medium">
                                        <label class="form-label" for="motivation2">2 - Medium</label>
                                        <input type="radio" id="motivation3" name="motivation" value="Cold">
                                        <label class="form-label" for="motivation3">3 - Cold</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col mb-3">
                                <label class="form-label" for="comments">Comments</label>
                                <textarea class="form-control" id="comments" name="comments" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- Next tab Business -->
                    <div class="form-multi-tab steps {{ request()->input('steps', 3) == 3 ? '' : 'hidden-step' }}" id="step-3">
                        <h3>Business Interest</h3>
                        <hr>
                        <h4 class="form-sec mb-3">Desired Business</h4>
                        <div class="row mb-2">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="busType1">Bus Type 1</label>
                                <select class="form-select" id="busType1" name="busType1">
                                    <option>Select Bus Type 1</option>
                                    <!-- Add options dynamically -->
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="busType2">Bus Type 2</label>
                                <select class="form-select" id="busType2" name="busType2">
                                    <option>Select Bus Type 2</option>
                                    <!-- Add options dynamically -->
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="busType3">Bus Type 3</label>
                                <select class="form-select" id="busType3" name="busType3">
                                    <option>Select Bus Type 3</option>
                                    <!-- Add options dynamically -->
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="busType4">Bus Type 4</label>
                                <select class="form-select" id="busType4" name="busType4">
                                    <option>Select Bus Type 4</option>
                                    <!-- Add options dynamically -->
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <h4 class="form-sec mb-3">Personal Information</h4>
                            <div class="col-md-8 mb-3">
                                <div class="row">
                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label" for="desiredCounty1">Desired County 1</label>
                                        <select class="form-select" id="desiredCounty1" name="desiredCounty1">
                                            <option>Select County 1</option>
                                            <!-- Add options dynamically -->
                                        </select>
                                    </div>
                                    <div class="col-sm-6  mb-3">
                                        <label class="form-label" for="desiredCounty2">Desired County 2</label>
                                        <select class="form-select" id="desiredCounty2" name="desiredCounty2">
                                            <option>Select County 2</option>
                                            <!-- Add options dynamically -->
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6  mb-3">
                                        <label class="form-label" for="desiredCounty3">Desired County 3</label>
                                        <select class="form-select" id="desiredCounty3" name="desiredCounty3">
                                            <option>Select County 3</option>
                                            <!-- Add options dynamically -->
                                        </select>
                                    </div>
                                    <div class="col-sm-6  mb-3">
                                        <label class="form-label" for="desiredCounty4">Desired County 4</label>
                                        <select class="form-select" id="desiredCounty4" name="desiredCounty4">
                                            <option>Select County 4</option>
                                            <!-- Add options dynamically -->
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="form-label" for="desiredLocation">Desired Location</label>
                                <input type="text" class="form-control" id="desiredLocation" name="desiredLocation">
                            </div>
                            <div class="col-md-4 mb-2">
                            </div>
                        </div>
                        <!-- Next tab Business -->
                        <div class="row mb-2">
                            <h4 class="form-sec mb-3">Pricing And Financial Information</h4>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="maxPrice">Max Price</label>
                                <input type="number" class="form-control" id="maxPrice" name="maxPrice">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="downPayMax">Down Pay Max</label>
                                <input type="number" class="form-control" id="downPayMax" name="downPayMax">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="annualSalesMin">Annual Sales Min</label>
                                <input type="number" class="form-control" id="annualSalesMin" name="annualSalesMin">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="netProfitMin">Net Profit Min</label>
                                <input type="number" class="form-control" id="netProfitMin" name="netProfitMin">
                            </div>
                            <div class="col-md-6 mb-3">
                            </div>
                            <div class="col-md-6 mb-3">

                            </div>
                        </div>
                        <!-- Next tab Business -->
                        <div class="row mb-2">
                            <h4 class="form-sec mb-3">Probable Match Criteria</h4>
                            <div class="d-flex flex-wrap gap match-criteria">
                                <div class="col">
                                    <label class="form-label" for="busInterest">Bus Interest</label>
                                    <input type="number" class="form-control" id="busInterest" name="busInterest">
                                </div>
                                <div class="col">
                                    <label class="form-label" for="location">Location</label>
                                    <input type="number" class="form-control" id="location" name="location">
                                </div>
                                <div class="col">
                                    <label class="form-label" for="price">Price</label>
                                    <input type="number" class="form-control" id="price" name="price">
                                </div>
                                <div class="col">
                                    <label class="form-label" for="downPay">Down Pay</label>
                                    <input type="number" class="form-control" id="downPay" name="downPay">
                                </div>
                                <div class="col">
                                    <label class="form-label" for="salesVol">Sales Vol</label>
                                    <input type="number" class="form-control" id="salesVol" name="salesVol">
                                </div>
                                <div class="col">
                                    <label class="form-label" for="profit">Profit</label>
                                    <input type="number" class="form-control" id="profit" name="profit">
                                </div>
                                <div class="col">
                                    <label class="form-label" for="total">Total</label>
                                    <input type="number" class="form-control" id="total" name="total">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="d-flex justify-content-center mt-3" style="overflow:auto;">
                <div>
                    <button class="btn-primary" type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                    <button class="btn-primary" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                </div>
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
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
        var x = document.getElementsByClassName("form-multi-tab");
        x[n].style.display = "block";
        
        // Adjust Previous button visibility
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        
        // Adjust Next button text and type for the last step
        var nextBtn = document.getElementById("nextBtn");
        if (n == (x.length - 1)) {
            nextBtn.innerHTML = "Submit";
            nextBtn.setAttribute("type", "submit"); // Set type to submit on last step
        } else {
            nextBtn.innerHTML = "Next";
            nextBtn.setAttribute("type", "button"); // Reset to button on other steps
        }

        fixStepIndicator(n); // Display the correct step indicator
    }

    function nextPrev(n) {
        var x = document.getElementsByClassName("form-multi-tab");

        // Hide the current tab:
        x[currentTab].style.display = "none";

        // Increase or decrease the current tab by 1:
        currentTab += n;

        // If the user has reached the end of the form, submit it:
        if (currentTab >= x.length) {
            document.getElementById("buyerForm").submit();
            return false;
        }

        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {
        var x, y, i, valid = true;
        x = document.getElementsByClassName("form-multi-tab");
        y = x[currentTab].getElementsByTagName("input");

        for (i = 0; i < y.length; i++) {
            if (y[i].value == "") {
                y[i].className += " invalid";
                valid = false;
            }
        }

        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid;
    }

    function fixStepIndicator(n) {
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        x[n].className += " active";
    }
</script>

@endsection