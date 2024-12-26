@extends('admin.layout.master')
@section('content')
        <div class="container-fluid content bg-light">
        @if(Session::has('success_message'))
        <div class="alert alert-success alert-block" id="alert-success">
          <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong>{{ Session::get('success_message') }}</strong>
        </div>
        @endif
            <div class="row card p-4 font-fm mb-5">
                <h4>Lead</h4>
                <hr><br>
                <form id="editleadForm" action="{{ route('update.lead', $lead->LeadID) }}" method="post" >
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <!-- Appointment -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="appointment">Appointment <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="appointment" name="appointment" value="{{$lead->AppointmentDate}}" min="{{ \Carbon\Carbon::now()->toDateString() }}">
                                @error('appointment')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <!-- Time -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="time">Time <span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control" id="time" name="time"  value="{{$lead->AppointmentTime}}" min="{{ \Carbon\Carbon::now()->toDateTimeString() }}">
                                @error('time')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <!-- Lead Date -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="leadDate">Lead Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="leadDate" name="leadDate"  value="{{$lead->LDate}}" max="{{ \Carbon\Carbon::now()->toDateString() }}">
                                @error('leadDate')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <!-- Category -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="category">Category <span class="text-danger">*</span></label>
                                <!-- <input type="text" class="form-control" id="category" name="category"> -->
                                <select id="category" class="form-select" name="category">
                                    <option value="" selected="">Select category</option>
                                    @foreach($categoryData as $key=>$data)
                                    <option value="{{$data->CategoryID}}" {{ $lead->Category == $data->CategoryID  ? 'selected' : '' }}>{{$data->BusinessCategory}}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <!-- Sub Category -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="subCategory">Sub Category <span class="text-danger">*</span></label>
                               <!--  <input type="text" class="form-control" id="subCategory" name="subCategory"> -->
                               <select id="subCategory" class="form-select" name="subCategory">
                                    <option value="" selected>Select sub category</option>
                                    @foreach($sub_categories as $key=>$sub_cat)
                                    <option value="{{$sub_cat->SubCatID}}" {{ $lead->SubCategory == $sub_cat->SubCatID ? 'selected' : '' }}>{{$sub_cat->SubCategory}}</option>
                                    @endforeach
                                </select>
                                @error('subCategory')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                         <!-- Status -->
                         <div class="col-md-4">
                            <div class="form-group">
                                <label for="comments">Status</label>
                                <select id="status" class="form-select" name="status">
                                    <option value="" selected="">Select status</option>
                                    @foreach($status as $key=>$leadStatus)
                                    <option value="{{$leadStatus->LeadStatusID}}"  {{ $lead->Status == $leadStatus->LeadStatusID  ? 'selected' : '' }}>{{$leadStatus->Status}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- Source -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="source">Source</label>
                                <input type="text" class="form-control" id="source" name="source" value="{{$lead->Source}}">
                            </div>
                        </div>
                        <!-- First Name -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="firstName">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="firstName" name="firstName" value="{{$lead->SellerFName}}">
                                @error('firstName')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <!-- Last Name -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lastName">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="lastName" name="lastName" value="{{$lead->SellerLName}}">
                                @error('lastName')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <!-- Business Name -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="businessName">Business Name</label>
                                <input type="text" class="form-control" id="businessName" name="businessName" value="{{$lead->BusName}}">
                            </div>
                        </div>
                         <!-- SFBO -->
                         <div class="col-md-4">
                            <div class="form-check d-flex flex-column check-column p-0 m-0">
                                <label class="form-check-label" for="listed">Listed</label>
                                <input type="checkbox" class="form-check-input" id="listed" name="listed" value="1" {{ $lead->Listed == 1 ? 'checked' : '' }} onchange="changeListedValue()">
                            </div>
                        </div>
                        <!-- Address -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{$lead->Address}}">
                            </div>
                        </div>
                        <!-- City -->
                        <div class="col-md-4">
                            <div class="form-group">
                            <label for="city" class="col p-0">City</label>
                            <input type="text" class="form-control col" id="city" name="city" placeholder="City" value="{{$lead->City}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label for="state" class="col">State</label>
                            <select id="state" class="form-select" name="state">
                                    <option value="" selected="">Select state</option>
                                    @foreach($states as $key=>$value)
                                    <option value="{{$value->State}}"  {{ $lead->State == $value->State  ? 'selected' : '' }}>{{$value->StateName}}</option>
                                    @endforeach
                                    </select>
                                    @error('state')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label for="zip" class="col">Zip</label>
                                    <input type=" text" class="form-control" id="zip" name="zip"
                                         placeholder="Zip" value="{{$lead->Zip}}">
                            </div>
                        </div>
                        <!-- County Dropdown -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="county">County</label>
                                <select id="county" class="form-select" name="county">
                                    <option value="" selected="">Select country</option>
                                    @foreach($counties as $key=>$country)
                                    <option value="{{$country->County}}"  {{ $lead->County == $country->County  ? 'selected' : '' }}>{{$country->County}}</option>
                                    @endforeach
                                    </select>
                            </div>
                        </div>
                        <!-- Business Phone -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="busPhone">Business Phone <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" id="busPhone" name="busPhone" value="{{ $lead->Phone}}">
                                @error('busPhone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <!-- Home -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="home">Home phone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="home_phone" name="home_phone" value="{{ $lead->HomePhone}}">
                                @error('home_phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <!-- Cell Phone -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cellPhone">Cell Phone <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" id="cellPhone" name="cellPhone" value="{{ $lead->CellPhone}}">
                                @error('cellPhone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <!-- Approx. Sales -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="approxSales">Approx. Sales</label>
                                <input type="text" class="form-control" id="approxSales" name="approxSales" value="{{ $lead->AnnSales}}">
                            </div>
                        </div>
                        <!-- Asking Price -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="askPrice">Asking Price</label>
                                <input type="number" class="form-control" id="askPrice" name="askPrice" value="{{ $lead->REAsking}}">
                            </div>
                        </div>
                        <!-- Year In Business -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="yearInBus">Year In Business <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="yearInBus" name="yearInBus" value="{{ $lead->YearsInBus}}">
                                @error('yearInBus')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <!-- Pres Owner -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="presOwner">Pres Owner</label>
                                <input type="text" class="form-control" id="presOwner" name="presOwner" value="{{ $lead->PresentOwner}}">
                            </div>
                        </div>
                        <!-- Size Of Facility -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sizeOfFacility">Size Of Facility</label>
                                <input type="text" class="form-control" id="sizeOfFacility" name="sizeOfFacility" value="{{ $lead->SizeOfFacility}}">
                            </div>
                        </div>
                        <!-- R/E Inc -->
                        <div class="col-md-2">
                            <div class="form-check d-flex flex-column check-column p-0 m-0">
                                <label class="form-check-label" for="reInc">R/E Inc</label>
                                <input type="checkbox" class="form-check-input" id="reInc" name="reInc" value="1" {{ $lead->RealEstateInc == 1 ? 'checked' : '' }} onchange="changeREInCValue()">
                            </div>
                        </div>
                        <!-- Asking Price (if R/E Inc) -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="askPriceRE">If Yes, Asking Price</label>
                                <input type="number" class="form-control" id="askPriceRE" name="askPriceRE"  value="{{ $lead->REAsking}}">
                            </div>
                        </div>
                        <!-- Ad Date -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="adDate">Ad Date</label>
                                <input type="date" class="form-control" id="adDate" name="adDate"  value="{{ $lead->AdDate}}">
                            </div>
                        </div>
                        <!-- SFBO -->
                        <div class="col-md-2">
                            <div class="form-check d-flex flex-column check-column p-0 m-0">
                                <label class="form-check-label" for="sfbo">FSBO</label>
                                <input type="checkbox" class="form-check-input" id="sfbo" name="sfbo" value="1" {{ $lead->FSBO ? 'checked' : '' }}  onchange="changeSFBOValue()">
                            </div>
                        </div>
                        <!-- Ad Copy -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="adCopy">Ad Copy</label>
                                <input class="form-control" id="adCopy" name="adCopy" value="{{ $lead->AdCopy}}">
                            </div>
                        </div>
                        <!-- Comments -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="comments">Comments</label>
                                <input class="form-control" id="comments" name="comments" value="{{ $lead->Comments}}">
                            </div>
                        </div>
                       
                        <!-- Submit Button -->
                        <div class="col-md-12 d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div p-8>
            <p>&nbsp;</p>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
           $(document).ready(function () {
                $('#editleadForm').validate({
                    rules: {
                        appointment: {
                            required: true
                        },
                        time: {
                            required: true
                        },
                        leadDate: {
                            required: true
                        },
                        category: {
                            required: true
                        },
                        subCategory: {
                            required: true
                        },
                        firstName: {
                            required: true
                        },
                        lastName: {
                            required: true
                        },
                        yearInBus: {
                            required: true
                        },
                        busPhone: {
                            required: true,
                            regex: /^(?:\+?1[-. ]?)?\(?\d{3}\)?[-. ]?\d{3}[-. ]?\d{4}$/ // Custom regex rule
                        },
                        home_phone: {
                            required: true,
                            regex: /^(?:\+?1[-. ]?)?\(?\d{3}\)?[-. ]?\d{3}[-. ]?\d{4}$/ // Custom regex rule
                        },
                        cellPhone: {
                            required: true,
                            regex: /^(?:\+?1[-. ]?)?\(?\d{3}\)?[-. ]?\d{3}[-. ]?\d{4}$/ // Custom regex rule
                        }
                    },
                    messages: {
                        busPhone: {
                            required: 'Phone number is required.',
                            regex: 'Must be a valid phone number.'
                        },
                        home_phone: {
                            required: 'Phone number is required.',
                            regex: 'Must be a valid phone number.'
                        },
                        cellPhone: {
                            required: 'Phone number is required.',
                            regex: 'Must be a valid phone number.'
                        }
                    },
                    submitHandler: function (form) {
                        form.submit();
                    }
                });

            // Custom method for regex validation
            $.validator.addMethod("regex", function(value, element, regexpr) {
                return this.optional(element) || regexpr.test(value);
            }, "Please check your input.");

});

            </script>
        <script>
    $(document).ready(function() {
        $('#category').change(function() {
            var id = $(this).val();
            if (id) {
                $.ajax({
                    url: "{{ route('get.options', ['id' => '__ID__']) }}".replace('__ID__', id),
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#subCategory').empty(); // Clear existing options
                        $('#subCategory').append('<option value="">Select an option</option>'); // Add default option
                        $.each(data, function(key, value) {
                            $('#subCategory').append('<option value="' + value.SubCatID + '">' + value.SubCategory + '</option>');
                        });
                    }
                });
            } else {
                $('#second-dropdown').empty().append('<option value="">Select an option</option>'); // Reset second dropdown
            }
        });
    });

   
</script>
        @endsection