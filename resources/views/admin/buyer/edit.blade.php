
   
@extends('admin.layout.master')
@section('content')
        <div class="container-fluid content bg-light">
            <div class="row card p-4">
                <form action="{{ route('edit.buyer.form.process', $buyerData->BuyerID) }}" method="POST" id="editBuyerForm">
                @csrf
                <input type="hidden" name="step" value="{{ session('step', 1) }}">
                    <!-- One "form-multi-tab" for each step in the form: -->
                    @if (session('step', 1) == 1)
                    <div class="form-multi-tab">
                        <h3>General Information:</h3>
                        <hr><br>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="honorific">Select Title</label>
                                <select class="form-select" id="honorific" name="honorific">
                                    <option value="" selected=""></option>
                                    <option value="mr" {{ $buyerData->Honorific == 'mr'  ? 'selected' : '' }}>Mr.</option>
                                    <option value="mrs" {{ $buyerData->Honorific == 'mrs'  ? 'selected' : '' }}>Mrs.</option>
                                    <option value="miss" {{ $buyerData->Honorific == 'miss'  ? 'selected' : '' }}>Miss</option>
                                    <option value="ms" {{ $buyerData->Honorific == 'ms'  ? 'selected' : '' }}>Ms.</option>
                                    <option value="dr" {{ $buyerData->Honorific == 'dr'  ? 'selected' : '' }}>Dr.</option>
                                    <option value="prof" {{ $buyerData->Honorific == 'prof'  ? 'selected' : '' }}>Prof.</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="firstName">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="firstName" name="firstName" value="{{ $buyerData->FName}}">
                                @error('firstName')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4 d-flex flex-column check-column">
                                <label class="form-label" for="lastName">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="lastName" name="lastName" value="{{ $buyerData->LName}}">
                                @error('lastName')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="corporateName">Corporate Name</label>
                                <input type="text" class="form-control" id="corporateName" name="corporateName" value="{{ $buyerData->Corp}}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="agent">Agent <span class="text-danger">*</span></label>
                                <select class="form-select" id="agentID" name="agentID">
                                    <option value="" selected="">Select Agent</option>
                                        @foreach($agents as $key=>$agent)
                                        <option value="{{$agent->agent_info->AgentID}}" {{  $agent->agent_info->AgentID == $buyerData->AgentID ? 'selected' : '' }}>{{$agent->agent_info->FName}} {{$agent->agent_info->LName}}</option>
                                        @endforeach
                                    </select>
                                    @error('agentID')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="BDate">BDate <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="BDate" name="BDate" value="{{$buyerData->BDate}}">
                                @error('BDate')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-8 mb-3">
                                <label class="form-label" for="address">Address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="address" name="address" value="{{$buyerData->Address1}}">
                                @error('address')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="cityStateZip" class="form-label">City <span class="text-danger">*</span></label>
                                    <input type="text" name="city" id="city" class="form-control" placeholder="City" value="{{$buyerData->City}}">
                                    @error('city')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="State">State <span class="text-danger">*</span></label>
                                <select id="State" class="form-select" name="state">
                                <option value="" selected="">Select state</option>
                                @foreach($states as $key=>$value)
                                <option value="{{$value->State}}" {{  $value->State == $buyerData->State ? 'selected' : '' }}>{{$value->StateName}}</option>
                                @endforeach
                                </select>
                                @error('state')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="cityStateZip" class="form-label">Zip <span class="text-danger">*</span></label>
                                    <input type="text" name="zip" id="Zip" class="form-control" placeholder="Zip" value="{{$buyerData->Zip}}">
                                    @error('zip')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="dlNumber">D/L Number</label>
                                <input type="number" class="form-control" id="dlNumber" name="dlNumber" value="{{$buyerData->DLNo}}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="homePhone">Home Phone <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" id="homePhone" name="homePhone" value="{{$buyerData->HomePhone}}">
                                @error('homePhone')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="fax">Fax</label>
                                <input type="text" class="form-control" id="fax" name="fax" value="{{$buyerData->Fax}}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" value="{{$buyerData->Email}}">
                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="callWhen">Call When</label>
                                <input type="datetime-local" class="form-control" id="callWhen" name="callWhen" value="{{$buyerData->callWhen}}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3 d-flex flex-column check-column">
                                <label class="form-label" for="corporateBuyer" class="form-check-label">Corporate Buyer</label>
                                <input type="checkbox" class="form-check-input" id="corporateBuyer"
                                    name="corporateBuyer" value="1" {{ (old('corporateBuyer') || session('buyerData.corporateBuyer') == 1) ? 'checked' : '' }}>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="preferredTerms">Proffered Terms </label>
                                <input type="number" class="form-control" id="preferredTerms" name="preferredTerms"  value="">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="monthExpDate">Month Exp Date</label>
                                <input type="date" class="form-control" id="monthExpDate" name="monthExpDate" value="{{$buyerData->ExpDate}}">
                            </div>
                            <div class="col-md-3 d-flex flex-column check-column">
                                <label class="form-label" for="county">County</label>
                                <select id="country" class="form-select" name="country">
                                    <option value="" selected="">Select country</option>
                                    @foreach($counties as $key=>$country)
                                    <option value="{{$country->County}}" {{ $country->County == $buyerData->County ? 'selected' : '' }}>{{$country->County}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3 d-flex flex-column check-column">
                                <label class="form-label" for="emailOptOut" class="form-check-label">Email Opt Out</label>
                                <input type="checkbox" class="form-check-input" id="emailOptOut" name="emailOptOut" value="1" {{ $buyerData->OptOut == 1 ? 'checked' : '' }}>

                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="ssNumber">SS Number</label>
                                <input type="number" class="form-control" id="ssNumber" name="ssNumber" value="{{ $buyerData->SocSecNo}}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="businessPhone">Business Phone</label>
                                <input type="tel" class="form-control" id="businessPhone" name="businessPhone" value="{{ $buyerData->BusPhone}}">
                            </div>
                            <div class="col-md-3 d-flex flex-column check-column">
                                <label class="form-label" for="pager">Pager</label>
                                <input type="text" class="form-control" id="pager" name="pager" value="{{ $buyerData->Pager}}">
                            </div>
                        </div>
                    </div>
                    @endif
                    @if (session('step', 1) == 2)
                    <!-- Next tab Business -->
                    <div class="form-multi-tab">
                        <h3>Personal Business</h3>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="partnerName">Partner Name</label>
                                <input type="text" class="form-control" id="partnerName" name="partnerName" value="{{ $buyerData->PartnerName}}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="partnerPhone">Partner Phone</label>
                                <input type="tel" class="form-control" id="partnerPhone" name="partnerPhone" value="{{ $buyerData->PartnerPhone}}">
                            </div>
                            <div class="col-md-4 d-flex flex-column check-column">
                                <label class="form-label" for="currentEmployment1">Current Employment</label>
                                <input type="text" class="form-control" id="currentEmployment1"
                                    name="currentEmployment1" value="{{ $buyerData->CurrentEmploy}}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="motivation">Motivation</label>
                                    <div class="d-flex justify-content-between">
                                        <input type="radio" id="motivation1" name="motivation" value="1" {{ $buyerData->Interest == 1 ? 'checked' : '' }}>
                                        <label class="form-label" for="motivation1">1 - Hot</label>
                                        <input type="radio" id="motivation2" name="motivation" value="2" {{ $buyerData->Interest == 2 ? 'checked' : '' }}>
                                        <label class="form-label" for="motivation2" checked>2 - Medium</label>
                                        <input type="radio" id="motivation3" name="motivation" value="3" {{ $buyerData->Interest == 3 ? 'checked' : '' }}>
                                        <label class="form-label" for="motivation3">3 - Cold</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col mb-3">
                                <label class="form-label" for="comments">Comments</label>
                                <textarea class="form-control" id="comments" name="comments" rows="5">{{ $buyerData->Comments}}</textarea>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if (session('step', 1) == 3)
                    <!-- Next tab Business -->
                    <div class="form-multi-tab">
                        <h3>Business Interest</h3>
                        <hr>
                        <h4 class="form-sec mb-3">Desired Business</h4>
                        <div class="row mb-2">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="busType1">Bus Type 1</label>
                                <select class="form-select" id="busType1" name="busType1">
                                    <option value="">Select Bus Type 1</option>
                                    @foreach($sub_categories as $key=>$bus_type)
                                    <option value="{{$bus_type->SubCatID}}" {{ $bus_type->SubCatID == $buyerData->BusType1 ? 'selected' : '' }}>{{$bus_type->SubCategory}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="busType2">Bus Type 2</label>
                                <select class="form-select" id="busType2" name="busType2">
                                    <option value="">Select Bus Type 2</option>
                                    @foreach($sub_categories as $key=>$bus_type)
                                    <option value="{{$bus_type->SubCatID}}" {{ $bus_type->SubCatID == $buyerData->BusType2 ? 'selected' : '' }}>{{$bus_type->SubCategory}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="busType3">Bus Type 3</label>
                                <select class="form-select" id="busType3" name="busType3">
                                    <option value="">Select Bus Type 3</option>
                                    @foreach($sub_categories as $key=>$bus_type)
                                    <option value="{{$bus_type->SubCatID}}" {{ $bus_type->SubCatID == $buyerData->BusType3 ? 'selected' : '' }}>{{$bus_type->SubCategory}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="busType4">Bus Type 4</label>
                                <select class="form-select" id="busType4" name="busType4">
                                    <option value="">Select Bus Type 4</option>
                                    @foreach($sub_categories as $key=>$bus_type)
                                    <option value="{{$bus_type->SubCatID}}" {{ $bus_type->SubCatID == $buyerData->BusType4 ? 'selected' : '' }}>{{$bus_type->SubCategory}}</option>
                                    @endforeach
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
                                            <option value="">Select County 1</option>
                                            @foreach($counties as $key=>$country)
                                            <option value="{{$country->County}}" {{ $country->County == $buyerData->BusCounty1 ? 'selected' : '' }}>{{$country->County}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-6  mb-3">
                                        <label class="form-label" for="desiredCounty2">Desired County 2</label>
                                        <select class="form-select" id="desiredCounty2" name="desiredCounty2">
                                            <option value="">Select County 2</option>
                                            @foreach($counties as $key=>$country)
                                            <option value="{{$country->County}}" {{ $country->County == $buyerData->BusCounty2 ? 'selected' : '' }}>{{$country->County}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6  mb-3">
                                        <label class="form-label" for="desiredCounty3">Desired County 3</label>
                                        <select class="form-select" id="desiredCounty3" name="desiredCounty3">
                                            <option value="">Select County 3</option>
                                            @foreach($counties as $key=>$country)
                                            <option value="{{$country->County}}" {{ $country->County == $buyerData->BusCounty3 ? 'selected' : '' }}>{{$country->County}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-6  mb-3">
                                        <label class="form-label" for="desiredCounty4">Desired County 4</label>
                                        <select class="form-select" id="desiredCounty4" name="desiredCounty4">
                                            <option value="">Select County 4</option>
                                            @foreach($counties as $key=>$country)
                                            <option value="{{$country->County}}" {{ $country->County == $buyerData->BusCounty4 ? 'selected' : '' }}>{{$country->County}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="form-label" for="desiredLocation">Desired Location</label>
                                <input type="text" class="form-control" id="desiredLocation" name="desiredLocation" value="{{ $buyerData->BusLocation}}">
                            </div>
                            <div class="col-md-4 mb-2">
                            </div>
                        </div>
                        <!-- Next tab Business -->
                        <div class="row mb-2">
                            <h4 class="form-sec mb-3">Pricing And Financial Information</h4>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="maxPrice">Max Price</label>
                                <input type="number" class="form-control" id="maxPrice" name="maxPrice" value="{{ $buyerData->PPMax}}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="downPayMax">Down Pay Max</label>
                                <input type="number" class="form-control" id="downPayMax" name="downPayMax" value="{{ $buyerData->DownPmtMax}}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="annualSalesMin">Annual Sales Min</label>
                                <input type="number" class="form-control" id="annualSalesMin" name="annualSalesMin" value="{{ $buyerData->VolMin}}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="netProfitMin">Net Profit Min</label>
                                <input type="number" class="form-control" id="netProfitMin" name="netProfitMin" value="{{ $buyerData->NetProfMin}}">
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
                                    <input type="text" class="form-control" id="busInterest" name="busInterest" value="{{ $buyerData->BusInt}}">
                                </div>
                                <div class="col">
                                    <label class="form-label" for="location">Location</label>
                                    <input type="text" class="form-control" id="location" name="location" value="{{ $buyerData->Location}}">
                                </div>
                                <div class="col">
                                    <label class="form-label" for="price">Price</label>
                                    <input type="text" class="form-control" id="price" name="price" value="{{ $buyerData->Price}}">
                                </div>
                                <div class="col">
                                    <label class="form-label" for="downPay">Down Pay</label>
                                    <input type="text" class="form-control" id="downPay" name="downPay" value="{{ $buyerData->DownPay}}">
                                </div>
                                <div class="col">
                                    <label class="form-label" for="salesVol">Sales Vol</label>
                                    <input type="text" class="form-control" id="salesVol" name="salesVol" value="{{ $buyerData->SalesVol}}">
                                </div>
                                <div class="col">
                                    <label class="form-label" for="profit">Profit</label>
                                    <input type="text" class="form-control" id="profit" name="profit" value="{{ $buyerData->Profit}}">
                                </div>
                                <div class="col">
                                    <label class="form-label" for="total">Total</label>
                                    <input type="text" class="form-control" id="total" name="total" value="">
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
                                {{ session('step', 1) < 3 ? 'Next' : 'Submit' }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div p-8="">
            <p>&nbsp;</p>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $.validator.addMethod("regex", function(value, element, regexpr) {
            return this.optional(element) || regexpr.test(value); // Allows optional fields to be empty
        }, "Invalid phone number format.");
        var form = $('#editBuyerForm');
        form.validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                firstName: {
                    required: true
                },
                lastName: {
                    required: true
                },
                agentID: {
                    required: true
                },
                BDate: {
                    required: true
                },
                address: {
                    required: true
                },
                city: {
                    required: true
                },
                state: {
                    required: true
                },
                zip: {
                    required: true,
                    minlength: 5, // Minimum length for US ZIP code
                    maxlength: 10 // Maximum length for 9-digit ZIP code
                },
                country: {
                    required: true
                },
                homePhone: {
                    required: true,
                    regex: /^(?:\+?1[-. ]?)?\(?\d{3}\)?[-. ]?\d{3}[-. ]?\d{4}$/
                },
                businessPhone: {
                    regex: /^(?:\+?1[-. ]?)?\(?\d{3}\)?[-. ]?\d{3}[-. ]?\d{4}$/
                }
                
            },
            messages: {
                homePhone: {
                    required: 'Phone number is required.',
                    regex: 'Must be a valid phone number.'
                },
                businessPhone: {
                    regex: 'Must be a valid phone number.'
                }
            },
            submitHandler: function(form) {
                form.submit(); // Proceed with form submission if valid
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
    });
</script>
@endsection