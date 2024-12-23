@extends('frontend.layout.master')

@section('content')
<!-- Register with ebb Start -->
<div class="container py-5 container-padding" style="background-color: #FFFFFF; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); margin-top:60px;">
    <div class="row g-5">
        <div class="col-md-12 d-flex align-items-center justify-content-center">
            <div class="text-black" style="width: 100%;">
                <div class="d-flex pb-1">
                    <h5 class="fw-normal mb-2 m-0 client_login">Register with EBB</h5>
                </div>
                <p class="m-0 mb-3 an_account" style="color: #5D5D5D;">Already have an account? <a href="{{route('login')}}" class="buyer_program">Sign in here</a></p>
            </div>
        </div>
        @if(Session::has('error'))
            <div class="alert alert-danger alert-block" id="alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ Session::get('error') }}</strong>
            </div>
            @endif
        <div class="col-lg-7 mt-0 column-divider">
            <div class="RegisterWithEbb">
                <form method="POST" action="{{ route('store.register.with.ebb') }}" id="registerEbb">
                    @csrf
                    <input type="hidden" name="step" value="{{ session('step', 1) }}">
                    @if (session('step', 1) == 1)
                    <div class="form-multi-tab">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="text" id="first_name" name="first_name" class="form-control form-control-lg" placeholder="First Name"  value="{{ session('buyerData.first_name') ?? old('first_name')}}"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="text" id="last_name" name="last_name" class="form-control form-control-lg" placeholder="Last Name"  value="{{ session('buyerData.last_name') ?? old('last_name')}}"/>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <select class="form-select form-select-lg" id="agent" name="agent">
                                        <option value="" selected="">Select Agent</option>
                                        @foreach($agents as $key=>$agent)
                                        <option value="{{$agent->agent_info->AgentID}}" {{ (old('agent') == $agent->agent_info->AgentID  || session('buyerData.agent') == $agent->agent_info->AgentID ) ? 'selected' : '' }}>{{$agent->agent_info->FName}} {{$agent->agent_info->LName}}</option>
                                        @endforeach
                                    </select>
                                    @error('agent')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="date" id="BDate" name="BDate" class="form-control form-control-lg" placeholder="BDate"  value="{{ session('buyerData.BDate') ?? old('BDate')}}" max="{{ \Carbon\Carbon::now()->toDateString() }}"/>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="text" id="mailling_address" name="address" class="form-control form-control-lg" placeholder="Mailing Address" value="{{ session('buyerData.address') ?? old('address')}}" />
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="text" id="cityTown" name="city" class="form-control form-control-lg" placeholder="City/Town" value="{{ session('buyerData.city') ?? old('city')}}"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <select class="form-select form-select-lg" id="state" name="state">
                                        <option value="" selected="">Select state</option>
                                        @foreach($states as $key=>$value)
                                        <option value="{{$value->State}}" {{ (old('state') == $value->State || session('buyerData.state') == $value->State) ? 'selected' : '' }}>{{$value->StateName}}</option>
                                        @endforeach
                                    </select>
                                    @error('state')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <select class="form-select form-select-lg" id="county" name="county">
                                        <option value="" selected="">Select country</option>
                                        @foreach($counties as $key=>$country)
                                        <option value="{{$country->County}}" {{ (old('county') == $country->County || session('buyerData.county') == $country->County) ? 'selected' : '' }}>{{$country->County}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="text" id="zip" name="zip" class="form-control form-control-lg" placeholder="Zip Code"  value="{{ session('buyerData.zip') ?? old('zip')}}"/>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="text" id="home_phone" name="home_phone" class="form-control form-control-lg" placeholder="Home Phone" value="{{ session('buyerData.home_phone') ?? old('home_phone')}}"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="text" id="business_phone" name="business_phone" class="form-control form-control-lg" placeholder="Business Phone" value="{{ session('buyerData.business_phone') ?? old('business_phone')}}"/>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Email Address" value="{{ session('buyerData.email') ?? old('email')}}"/>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <p class="valid_email">You must enter a valid email address to activate your account.</p>
                            <p class="mb-4"><a href="#" class="sellorgive">We will never sell or give your email address away.</a></p>
                        </div>
                        <div class="mb-3">
                            <select class="form-select form-select-lg" id="callWhen" name="callWhen">
                                <option selected disabled>Best Time to Contact</option>
                                <option value="9:00 am - 11:00 pm" {{ (old('callWhen') == '9:00 am - 11:00 pm' || session('buyerData.callWhen') == '9:00 am - 11:00 pm') ? 'selected' : '' }}>9:00 am - 11:00 pm</option>
                                <option value="11:00 am - 2:00 pm" {{ (old('callWhen') == '11:00 am - 2:00 pm' || session('buyerData.callWhen') == '11:00 am - 2:00 pm') ? 'selected' : '' }}>11:00 am - 2:00 pm</option>
                                <option value="2:00 pm - 5:00 pm" {{ (old('callWhen') == '2:00 pm - 5:00 pm' || session('buyerData.callWhen') == '2:00 pm - 5:00 pm') ? 'selected' : '' }}>2:00 pm - 5:00 pm</option>
                                <option value="After 5:00 pm" {{ (old('callWhen') == 'After 5:00 pm' || session('buyerData.callWhen') == 'After 5:00 pm') ? 'selected' : '' }}>After 5:00 pm</option>
                            </select>
                        </div>
                    </div>
                    @endif
                    @if (session('step', 1) == 2)
                    <div class="form-multi-tab">
                        <div class="row mb-2">
                            <div class="col-md-12 mb-3 interest_business">
                                <div class="form-group">
                                    <label class="form-label" for="motivation">I am a buyer interested in this type of business:</label>
                                    <div class="d-flex justify-content-between">
                                        <input type="radio" id="business_interest1" name="business_interest" value="existing business">
                                        <label class="form-label" for="business_interest1">Existing Business:</label>

                                        <input type="radio" id="business_interest2" name="business_interest" value="a startup business">
                                        <label class="form-label" for="business_interest2">Start-up:</label>

                                        <input type="radio" id="business_interest3" name="business_interest" value="a franchise">
                                        <label class="form-label" for="business_interest3">Franchise:</label>

                                        <input type="radio" id="business_interest4" name="business_interest" value="a merger or aquisition">
                                        <label class="form-label" for="business_interest4">Mergers and Acquisitions:</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-8 mb-3 interest">
                                <div class="form-group">
                                    <label class="form-label" for="readyToBuy">When will you be ready to buy?</label>
                                    <div class="d-flex justify-content-between">
                                        <input type="radio" id="readyToBuy1" name="Interest" value="1">
                                        <label class="form-label" for="readyToBuy">Now:</label>

                                        <input type="radio" id="readyToBuy2" name="Interest" value="2">
                                        <label class="form-label" for="readyToBuy">Within 6 months:</label>

                                        <input type="radio" id="readyToBuy3" name="Interest" value="3">
                                        <label class="form-label" for="readyToBuy">Within a year:</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6 mb-3">
                                <select id="busCategory1" class="form-select form-select-lg" name="bus_category1">
                                    <option value="" selected="">Select Bus. Category</option>
                                    @foreach($categoryData as $key=>$data)
                                    <option value="{{$data->CategoryID}}">{{$data->BusinessCategory}}</option>
                                    @endforeach
                                </select>
                                @error('bus_category')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <select id="busType1" class="form-select form-select-lg" name="bus_type1">
                                    <option value="" selected>Select Bus.Type</option>
                                    @foreach($sub_categories as $key=>$bus_type)
                                    <option value="{{$bus_type->SubCatID}}">{{$bus_type->SubCategory}}</option>
                                    @endforeach
                                </select>
                                @error('bus_type')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6 mb-3">
                                <select id="busCategory2" class="form-select form-select-lg" name="bus_category2">
                                <option value="" selected="">Select Bus. Category</option>
                                    @foreach($categoryData as $key=>$data)
                                    <option value="{{$data->CategoryID}}">{{$data->BusinessCategory}}</option>
                                    @endforeach
                                </select>
                                @error('bus_category')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <select id="busType2" class="form-select form-select-lg" name="bus_type2">
                                <option value="" selected>Select Bus.Type</option>
                                    @foreach($sub_categories as $key=>$bus_type)
                                    <option value="{{$bus_type->SubCatID}}">{{$bus_type->SubCategory}}</option>
                                    @endforeach
                                </select>
                                @error('bus_type')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6 mb-3">
                               
                                <select id="busCategory3" class="form-select form-select-lg" name="bus_category3">
                                <option value="" selected="">Select Bus. Category</option>
                                    @foreach($categoryData as $key=>$data)
                                    <option value="{{$data->CategoryID}}">{{$data->BusinessCategory}}</option>
                                    @endforeach
                                </select>
                                @error('bus_category')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <select id="busType3" class="form-select form-select-lg" name="bus_type3">
                                <option value="" selected>Select Bus.Type</option>
                                    @foreach($sub_categories as $key=>$bus_type)
                                    <option value="{{$bus_type->SubCatID}}">{{$bus_type->SubCategory}}</option>
                                    @endforeach
                                </select>
                                @error('bus_type')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6 mb-3">
                                <select id="busCategory4" class="form-select form-select-lg" name="bus_category4">
                                <option value="" selected="">Select Bus. Category</option>
                                    @foreach($categoryData as $key=>$data)
                                    <option value="{{$data->CategoryID}}">{{$data->BusinessCategory}}</option>
                                    @endforeach
                                </select>
                                @error('bus_category')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <select id="busType4" class="form-select form-select-lg" name="bus_type4">
                                <option value="" selected>Select Bus.Type</option>
                                    @foreach($sub_categories as $key=>$bus_type)
                                    <option value="{{$bus_type->SubCatID}}">{{$bus_type->SubCategory}}</option>
                                    @endforeach
                                </select>
                                @error('bus_type')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="desire_location">Preferred City/Town</label>
                                <input type="text" class="form-control form-control-lg" id="desiredLocation" name="desiredLocation" value=""/>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-6 mb-3">
                                <select class="form-select form-select-lg" id="desiredCounty1" name="desiredCounty1">
                                    <option value="">Select County 1</option>
                                    @foreach($counties as $key=>$country)
                                    <option value="{{$country->County}}">{{$country->County}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6  mb-3">
                                <select class="form-select form-select-lg" id="desiredCounty2" name="desiredCounty2">
                                    <option value="">Select County 2</option>
                                    @foreach($counties as $key=>$country)
                                    <option value="{{$country->County}}">{{$country->County}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-6 mb-3">
                                <select class="form-select form-select-lg" id="desiredCounty3" name="desiredCounty3">
                                    <option value="">Select County 3</option>
                                    @foreach($counties as $key=>$country)
                                    <option value="{{$country->County}}">{{$country->County}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <select class="form-select form-select-lg" id="desiredCounty4" name="desiredCounty4">
                                    <option value="">Select County 4</option>
                                    @foreach($counties as $key=>$country)
                                    <option value="{{$country->County}}">{{$country->County}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <h6 class="form-sec mb-3">Financial Information</h6>
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control form-control-lg" id="netWorth" name="netWorth" value="" placeholder="Net Worth">
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control form-control-lg" id="cashAvailable" name="cashAvailable" value="" placeholder="Cash Available for Down Payment">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <h6 class="form-sec mb-3">Investment Price Range</h6>
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control form-control-lg" id="priceRangeMinimum" name="priceRangeMinimum" value="" placeholder="Minimum">
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control form-control-lg" id="priceRangeMaximum" name="priceRangeMaximum" value="" placeholder="Maximum">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <h6 class="form-sec mb-3">Sales Volume</h6>
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control form-control-lg" id="salesVolumeMinimum" name="salesVolumeMinimum" value=""
                                placeholder="Minimum">
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control form-control-lg" id="salesVolumeMaximum" name="salesVolumeMaximum" value="" placeholder="Maximum">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <h6 class="form-sec mb-3">Amount of Net Income Required</h6>
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control form-control-lg" id="netIncomeMinimum" name="netIncomeMinimum" value="" placeholder="Minimum">
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control form-control-lg" id="netIncomeMaximum" name="netIncomeMaximum" value="" placeholder="Maximum">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="comments">Comments</label>
                                <textarea class="form-control form-control-lg" id="comments" name="comments" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="pt-1 mt-1 d-flex justify-content-center align-items-center" style="overflow:auto; flex-direction: row; gap: 10px;">
                        <!-- Previous button -->
                        @if (session('step', 1) > 1)
                        <button type="submit" name="previous" class="btn bg-5a102a text-white btn-block" id="prevBtn" style="height: 50px; width: 35%;">Previous</button>
                        @endif

                        <!-- Next button or Submit -->
                        <button type="submit" name="next" class="btn bg-5a102a text-white btn-block" id="nextBtn" style="height: 50px; width: 35%;">
                            {{ session('step', 1) < 2 ? 'Next' : 'Submit' }}
                        </button>
                    </div>
                </form>
            </div>
            @if(Session::has('success'))
            <div class="alert alert-success alert-block" id="alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ Session::get('success') }}</strong>
            </div>
            @endif
        </div>
        <div class="col-lg-5 mt-0 register_ebb">
            <p class="mb-4 notice">Notice: To register, you must use Internet Explorer. Please set this site to compatibility mode.</p>
            <p class="mb-4">EBB's listings are available free to everyone who uses our site. To view the detailed information, which is confidential in nature, we will ask you to sign a confidentiality agreement when you register.</p>
            <p class="mb-4">For buyers who are aggressively looking to find a business, we recommend that you sign up for our <a href="#" class="buyer_program">Preferred Buyer Program.</a></p>
        </div>
    </div>
</div>
<!-- Register with ebb End -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
        $.validator.addMethod("regex", function(value, element, regexpr) {
            return this.optional(element) || regexpr.test(value); // Allows optional fields to be empty
        }, "Invalid phone number format.");
        var form = $('#registerEbb');
        form.validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                agent: {
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
                county: {
                    required: true
                },
                home_phone: {
                    required: true,
                    regex: /^(?:\+?1[-. ]?)?\(?\d{3}\)?[-. ]?\d{3}[-. ]?\d{4}$/
                },
                business_phone: {
                    regex: /^(?:\+?1[-. ]?)?\(?\d{3}\)?[-. ]?\d{3}[-. ]?\d{4}$/
                },
                business_interest: {
                    required: true
                },
                Interest: {
                    required: true
                },
                bus_category1: {
                    required: true
                },
                bus_type1: {
                    required: true
                },
                desiredLocation: {
                    required: true
                },
                desiredCounty1: {
                    required: true
                },
                cashAvailable: {
                    required: true
                },
                priceRangeMinimum: {
                    required: true
                },
                priceRangeMaximum: {
                    required: true
                },
                netIncomeMinimum: {
                    required: true
                }

            },
            messages: {
                home_phone: {
                    required: 'Phone number is required.',
                    regex: 'Must be a valid phone number.'
                },
                business_phone: {
                    regex: 'Must be a valid phone number.'
                }
            },
            errorPlacement: function(error, element) {
                // Place the error messages directly under the respective fields
                if (element.attr("name") == "business_interest") {
                    error.appendTo(element.closest(".interest_business")); // Put the error after the field
                } else if (element.attr("name") == "Interest") {
                    error.appendTo(element.closest(".interest")); // Put the error after the field
                } else {
                    error.insertAfter(element); // Default placement for other fields
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

<script>
    $(document).ready(function() {
        $('#busCategory1').change(function() {
            var id = $(this).val();
            if (id) {
                $.ajax({
                    url: "{{ route('get.business.type', ['id' => '__ID__']) }}".replace('__ID__', id),
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#busType1').empty(); // Clear existing options
                        $('#busType1').append('<option value="">Select an option</option>'); // Add default option
                        $.each(data, function(key, value) {
                            $('#busType1').append('<option value="' + value.SubCatID + '">' + value.SubCategory + '</option>');
                        });
                    }
                });
            } else {
                $('#second-dropdown').empty().append('<option value="">Select an option</option>');
            }
        });
        $('#busCategory2').change(function() {
            var id = $(this).val();
            if (id) {
                $.ajax({
                    url: "{{ route('get.business.type', ['id' => '__ID__']) }}".replace('__ID__', id),
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#busType2').empty(); // Clear existing options
                        $('#busType2').append('<option value="">Select an option</option>'); // Add default option
                        $.each(data, function(key, value) {
                            $('#busType2').append('<option value="' + value.SubCatID + '">' + value.SubCategory + '</option>');
                        });
                    }
                });
            } else {
                $('#second-dropdown').empty().append('<option value="">Select an option</option>');
            }
        });
        $('#busCategory3').change(function() {
            var id = $(this).val();
            if (id) {
                $.ajax({
                    url: "{{ route('get.business.type', ['id' => '__ID__']) }}".replace('__ID__', id),
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#busType3').empty(); // Clear existing options
                        $('#busType3').append('<option value="">Select an option</option>'); // Add default option
                        $.each(data, function(key, value) {
                            $('#busType3').append('<option value="' + value.SubCatID + '">' + value.SubCategory + '</option>');
                        });
                    }
                });
            } else {
                $('#second-dropdown').empty().append('<option value="">Select an option</option>');
            }
        });
        $('#busCategory4').change(function() {
            var id = $(this).val();
            if (id) {
                $.ajax({
                    url: "{{ route('get.business.type', ['id' => '__ID__']) }}".replace('__ID__', id),
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#busType4').empty(); // Clear existing options
                        $('#busType4').append('<option value="">Select an option</option>'); // Add default option
                        $.each(data, function(key, value) {
                            $('#busType4').append('<option value="' + value.SubCatID + '">' + value.SubCategory + '</option>');
                        });
                    }
                });
            } else {
                $('#second-dropdown').empty().append('<option value="">Select an option</option>');
            }
        });
    });
</script>
@endsection