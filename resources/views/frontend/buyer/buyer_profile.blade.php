@extends('frontend.layout.buyer-master')
@section('content')
<div class="profile-container">
    <h2>My Profile</h2>
    <p>Update your profile information.</p>
    @if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
        <strong>{{ Session::get('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="row">
        <!-- Profile Information Form -->
        <form action="{{route('buyer.update.info',$buyerData->BuyerID)}}" method="POST" id="buyer-form-update">
            @csrf
            <div class="form-multi-tab">
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <input type="text" id="first_name" name="first_name" class="form-control form-control-lg" placeholder="First Name" value="{{$buyerData->FName}}" />
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <input type="text" id="last_name" name="last_name" class="form-control form-control-lg" placeholder="Last Name" value="{{$buyerData->LName}}" />
                        </div>
                    </div>
                </div>
                <div class="row g-3">

                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <select class="form-select form-select-lg" id="agent" name="agent">
                                <option value="" selected="">Select Agent</option>
                                @foreach($agents as $key=>$agent)
                                <option value="{{$agent->agent_info->AgentID}}" {{ $agent->agent_info->AgentID == $buyerData->AgentID ? 'selected' : '' }}>{{$agent->agent_info->FName}} {{$agent->agent_info->LName}}</option>
                                @endforeach
                            </select>
                            @error('agent')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <input type="date" id="BDate" name="BDate" class="form-control form-control-lg" placeholder="BDate" value="{{$buyerData->BDate}}"/>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <input type="text" id="mailling_address" name="address" class="form-control form-control-lg" placeholder="Mailing Address" value="{{$buyerData->Address1}}" />
                </div>
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <input type="text" id="cityTown" name="city" class="form-control form-control-lg" placeholder="City/Town" value="{{$buyerData->City}}" />
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <select class="form-select form-select-lg" id="state" name="state">
                                <option value="" selected="">Select state</option>
                                @foreach($states as $key=>$value)
                                <option value="{{$value->State}}" {{ ($buyerData->State == $value->State ) ? 'selected' : '' }}>{{$value->StateName}}</option>
                                @endforeach
                            </select>
                            @error('state')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <select class="form-select form-select-lg" id="county" name="county">
                                <option value="" selected="">Select country</option>
                                @foreach($counties as $key=>$country)
                                <option value="{{$country->County}}" {{ ($buyerData->County == $country->County) ? 'selected' : '' }}>{{$country->County}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <input type="text" id="zip" name="zip" class="form-control form-control-lg" placeholder="Zip Code" value="{{ $buyerData->Zip}}" />
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <input type="text" id="home_phone" name="home_phone" class="form-control form-control-lg" placeholder="Home Phone" value="{{ $buyerData->HomePhone}}" />
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <input type="text" id="business_phone" name="business_phone" class="form-control form-control-lg" placeholder="Business Phone" value="{{ $buyerData->BusPhone}}" />
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-12 col-md-12">
                        <div class="mb-3">
                            <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Email Address" value="{{$buyerData->Email}}" />
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
                        <option value="9:00 am - 11:00 pm" {{ ($buyerData->CallWhen == '9:00 am - 11:00 pm') ? 'selected' : '' }}>9:00 am - 11:00 pm</option>
                        <option value="11:00 am - 2:00 pm" {{ ($buyerData->CallWhen == '11:00 am - 2:00 pm') ? 'selected' : '' }}>11:00 am - 2:00 pm</option>
                        <option value="2:00 pm - 5:00 pm" {{ ($buyerData->CallWhen == '2:00 pm - 5:00 pm') ? 'selected' : '' }}>2:00 pm - 5:00 pm</option>
                        <option value="After 5:00 pm" {{ ($buyerData->CallWhen == 'After 5:00 pm') ? 'selected' : '' }}>After 5:00 pm</option>
                    </select>
                </div>
                <div class="row mb-2">
                    <div class="col-12 col-md-12 mb-3 interest_business">
                        <div class="form-group">
                            <label class="form-label" for="motivation">I am a buyer interested in this type of business:</label>
                            <div class="d-flex justify-content-between">
                                <div class="custom-radio">
                                    <input type="radio" id="business_interest1" name="business_interest" value="existing business" {{ $buyerData->TypeBus == 'existing business' ? 'checked' : '' }}>
                                    <label class="form-label" for="business_interest1">Existing Business:</label>
                                </div>
                                <div class="custom-radio">
                                    <input type="radio" id="business_interest2" name="business_interest" value="a startup business" {{ $buyerData->TypeBus == 'a startup business' ? 'checked' : '' }}>
                                    <label class="form-label" for="business_interest2">Start-up:</label>
                                </div>
                                <div class="custom-radio">
                                    <input type="radio" id="business_interest3" name="business_interest" value="a franchise" {{ $buyerData->TypeBus == 'a franchise' ? 'checked' : '' }}>
                                    <label class="form-label" for="business_interest3">Franchise:</label>
                                </div>
                                <div class="custom-radio">
                                    <input type="radio" id="business_interest4" name="business_interest" value="a merger or aquisition" {{ $buyerData->TypeBus == 'a merger or aquisition' ? 'checked' : '' }}>
                                    <label class="form-label" for="business_interest4">Mergers and Acquisitions:</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12 col-md-8 mb-3 interest">
                        <div class="form-group">
                            <label class="form-label" for="readyToBuy">When will you be ready to buy?</label>
                            <div class="d-flex justify-content-between">
                                <div class="custom-radio">
                                    <input type="radio" id="readyToBuy1" name="Interest" value="1" {{ $buyerData->Interest == 1 ? 'checked' : '' }}>
                                    <label class="form-label" for="readyToBuy1">Now:</label>
                                </div>
                                <div class="custom-radio">
                                    <input type="radio" id="readyToBuy2" name="Interest" value="2" {{ $buyerData->Interest == 2 ? 'checked' : '' }}>
                                    <label class="form-label" for="readyToBuy2">Within 6 months:</label>
                                </div>
                                <div class="custom-radio">
                                    <input type="radio" id="readyToBuy3" name="Interest" value="3" {{ $buyerData->Interest == 3 ? 'checked' : '' }}>
                                    <label class="form-label" for="readyToBuy3">Within a year:</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    @for ($i = 1; $i <= 4; $i++)
                        <div class="col-12 col-md-6 mb-3">
                        <select id="busCategory{{ $i }}" class="form-select form-select-lg busCategory" name="bus_category{{ $i }}">
                            <option value="" selected>Select Bus. Category</option>
                            @foreach($categoryData as $data)
                            <option value="{{ $data->CategoryID }}">{{ $data->BusinessCategory }}</option>
                            @endforeach
                        </select>
                        @error("bus_category{{ $i }}")
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <select id="busType{{ $i }}" class="form-select form-select-lg busType" name="bus_type{{ $i }}">
                        <option value="" selected>Select Bus Type</option>
                        @foreach($sub_categories as $bus_type)
                        <option value="{{ $bus_type->SubCatID }}"
                            data-category="{{ $bus_type->CatID }}"
                            {{ (optional($buyerData)->{'BusType' . $i} && $bus_type->SubCatID == optional($buyerData)->{'BusType' . $i}) ? 'selected' : '' }}>
                            {{ $bus_type->SubCategory }}
                        </option>
                        @endforeach
                    </select>
                    @error("bus_type{{ $i }}")
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                @endfor
            </div>
            <div class="row mb-2">
                <div class="col-12 col-md-12 mb-3">
                    <input type="text" class="form-control form-control-lg" id="desiredLocation" name="desiredLocation" placeholder="Preferred City/Town" value="{{$buyerData->BusLocation}}" />
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-6 mb-3">
                    <select class="form-select form-select-lg" id="desiredCounty1" name="desiredCounty1">
                        <option value="">Select County 1</option>
                        @foreach($counties as $key=>$country)
                        <option value="{{$country->County}}" {{ ($country->County == $buyerData->BusCounty1) ? 'selected' : '' }}>{{$country->County}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-sm-6  mb-3">
                    <select class="form-select form-select-lg" id="desiredCounty2" name="desiredCounty2">
                        <option value="">Select County 2</option>
                        @foreach($counties as $key=>$country)
                        <option value="{{$country->County}}" {{ ($country->County == $buyerData->BusCounty2) ? 'selected' : '' }}>{{$country->County}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12 col-sm-6 mb-3">
                    <select class="form-select form-select-lg" id="desiredCounty3" name="desiredCounty3">
                        <option value="">Select County 3</option>
                        @foreach($counties as $key=>$country)
                        <option value="{{$country->County}}" {{ ($country->County == $buyerData->BusCounty3) ? 'selected' : '' }}>{{$country->County}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-sm-6 mb-3">
                    <select class="form-select form-select-lg" id="desiredCounty4" name="desiredCounty4">
                        <option value="">Select County 4</option>
                        @foreach($counties as $key=>$country)
                        <option value="{{$country->County}}" {{ ($country->County == $buyerData->BusCounty4) ? 'selected' : '' }}>{{$country->County}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-2">
                <h6 class="form-sec mb-3">Financial Information</h6>
                <div class="col-12 col-md-6 mb-3">
                    <input type="number" class="form-control form-control-lg" id="netWorth" name="netWorth" value="{{$buyerData->NetWorth}}" placeholder="Net Worth">
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <input type="number" class="form-control form-control-lg" id="cashAvailable" name="cashAvailable" value="{{$buyerData->CashAvailable}}" placeholder="Cash Available for Down Payment">
                </div>
            </div>
            <div class="row mb-2">
                <h6 class="form-sec mb-3">Investment Price Range</h6>
                <div class="col-12 col-md-6 mb-3">
                    <input type="number" class="form-control form-control-lg" id="priceRangeMinimum" name="priceRangeMinimum" value="{{$buyerData->PPMin}}" placeholder="Minimum">
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <input type="number" class="form-control form-control-lg" id="priceRangeMaximum" name="priceRangeMaximum" value="{{$buyerData->PPMax}}" placeholder="Maximum">
                </div>
            </div>
            <div class="row mb-2">
                <h6 class="form-sec mb-3">Sales Volume</h6>
                <div class="col-12 col-md-6 mb-3">
                    <input type="number" class="form-control form-control-lg" id="salesVolumeMinimum" name="salesVolumeMinimum" value="{{$buyerData->VolMin}}"
                        placeholder="Minimum">
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <input type="number" class="form-control form-control-lg" id="salesVolumeMaximum" name="salesVolumeMaximum" value="{{$buyerData->VolMax}}" placeholder="Maximum">
                </div>
            </div>
            <div class="row mb-2">
                <h6 class="form-sec mb-3">Amount of Net Income Required</h6>
                <div class="col-12 col-md-6 mb-3">
                    <input type="number" class="form-control form-control-lg" id="netIncomeMinimum" name="netIncomeMinimum" value="{{$buyerData->NetProfMin}}" placeholder="Minimum">
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <input type="number" class="form-control form-control-lg" id="netIncomeMaximum" name="netIncomeMaximum" value="{{$buyerData->NetProfMax}}" placeholder="Maximum">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12 col-md-12 mb-3">
                    <label class="form-label" for="comments">Comments</label>
                    <textarea class="form-control form-control-lg" id="comments" name="comments" rows="5">{{$buyerData->Comments}}</textarea>
                </div>
            </div>
    </div>
    <div class="save_buyer_info">
        <button type="submit" class="btn btn-save">Save Changes</button>
    </div>
    </form>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $.validator.addMethod("regex", function(value, element, regexpr) {
            return this.optional(element) || regexpr.test(value); // Allows optional fields to be empty
        }, "Invalid phone number format.");
        var form = $('#buyer-form-update');
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
                    regex: /^\d{10}$/
                },
                business_phone: {
                    regex: /^\d{10}$/
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
    });
</script>
<script>
    $(document).ready(function() {
        function updateCategory(selectElement) {
            let busTypeId = $(selectElement).attr('id'); // Get the ID of the selected busType
            let index = busTypeId.replace('busType', ''); // Extract the index number (e.g., "1", "2", etc.)
            let categoryDropdown = $('#busCategory' + index); // Find the corresponding busCategory

            let selectedOption = $(selectElement).find(":selected"); // Get the selected option
            let selectedCategory = selectedOption.data('category'); // Get associated category ID

            if (selectedCategory) {
                categoryDropdown.val(selectedCategory); // Set category only if a valid type is selected
            } else {
                categoryDropdown.val(""); // Reset if no valid selection
            }
        }

        // Apply on page load for pre-selected values
        $('[id^="busType"]').each(function() {
            updateCategory(this);
        });

        // Update dynamically when a user selects a new bus type
        $('[id^="busType"]').change(function() {
            updateCategory(this);
        });

        // Handle change event for any bus category dropdown
        $('[id^="busCategory"]').change(function() {
            var categoryDropdown = $(this);
            var categoryId = categoryDropdown.val();
            var index = categoryDropdown.attr('id').replace('busCategory', ''); // Extract the number (1,2,3,4)
            var typeDropdown = $('#busType' + index); // Find the corresponding busType dropdown

            if (categoryId) {
                var url = "{{ route('buyer.bus.sub.category', ['id' => '__ID__']) }}".replace('__ID__', categoryId);
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        typeDropdown.empty().append('<option value="">Select an option</option>'); // Clear and add default option
                        $.each(data, function(key, value) {
                            typeDropdown.append('<option value="' + value.SubCatID + '" data-category="' + value.CatID + '">' + value.SubCategory + '</option>');
                        });
                    }
                });
            } else {
                typeDropdown.empty().append('<option value="">Select an option</option>'); // Reset if no selection
            }
        });
    });
</script>


@endsection