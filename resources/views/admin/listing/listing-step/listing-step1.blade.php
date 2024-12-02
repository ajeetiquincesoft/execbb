@extends('admin.layout.master')
@section('content')
<div class="container-fluid content bg-light">
    <div class="row card p-4">
        <form id="addnewliststep1" action="{{ route('store.listing.step1') }}" method="post" enctype="multipart/form-data">
            @csrf
            <!-- One "tab" for each step in the form: -->
            <div class="tab" style="display: block;">
                <h3>General:</h3>
                <hr>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="busCategory" class="form-label">Bus. Category <span class="text-danger">*</span></label>
                        <select id="busCategory" class="form-select" name="bus_category">
                            <option value="" selected="">Select category</option>
                            @foreach($categoryData as $key=>$data)
                            <option value="{{$data->CategoryID}}" {{ (old('bus_category') == $data->CategoryID || session('formData.bus_category') == $data->CategoryID) ? 'selected' : '' }}>{{$data->BusinessCategory}}</option>
                            @endforeach
                        </select>
                        @error('bus_category')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="busType" class="form-label">Bus. Type <span class="text-danger">*</span></label>
                        <select id="busType" class="form-select" name="bus_type">
                            <option value="" selected>Select type</option>
                            @foreach($sub_categories as $key=>$bus_type)
                            <option value="{{$bus_type->SubCatID}}" {{ (old('bus_type') == $bus_type->SubCatID || session('formData.bus_type') == $bus_type->SubCatID) ? 'selected' : '' }}>{{$bus_type->SubCategory}}</option>
                            @endforeach
                        </select>
                        @error('bus_type')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-4" style="height: 70px;">
                        <label for="franchise" class="form-check-label">Franchise</label>
                        <input type="checkbox" id="franchise" class="form-check-input" name="franchise" value="1" {{ (old('franchise') || session('formData.franchise') == 1) ? 'checked' : '' }} onchange="changeFranchiseValue()">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="cropName" class="form-label">Crop Name <span class="text-danger">*</span></label>
                        <input type="text" id="cropName" class="form-control" name="cropName" value="{{ session('formData.cropName') ?? old('cropName')}}">
                        @error('cropName')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dba" class="form-label">DBA <span class="text-danger">*</span></label>
                        <input type="text" id="dba" class="form-control" name="dba" value="{{ session('formData.dba') ?? old('dba')}}">
                        @error('dba')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="productMix" class="form-label">Product Mix</label>
                        <input type="text" id="productMix" class="form-control" name="productMix" value="{{ session('formData.productMix') ?? old('productMix')}}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-8 mb-3">
                        <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                        <input type="text" id="address" class="form-control" name="address" value="{{ session('formData.address') ?? old('address')}}">
                        @error('address')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="">City <span class="text-danger">*</span></label>
                        <input type="text" id="city" class="form-control" placeholder="City" name="city" value="{{ session('formData.city') ?? old('city')}}">
                        @error('city')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="">State <span class="text-danger">*</span></label>
                        <select id="State" class="form-select" name="state">
                            <option value="" selected="">Select state</option>
                            @foreach($states as $key=>$value)
                            <option value="{{$value->State}}" {{ (old('state') == $value->State || session('formData.state') == $value->State) ? 'selected' : '' }}>{{$value->StateName}}</option>
                            @endforeach
                        </select>
                        @error('state')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="">Zip <span class="text-danger">*</span></label>
                        <input type="text" id="Zip" class="form-control" placeholder="Zip" name="zip_code" value="{{ session('formData.zip_code') ?? old('zip_code')}}">
                        @error('zip_code')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="country" class="form-label">Country</label>
                        <!-- <input type="text" id="country" class="form-control" name="country" value="{{ session('formData.country') ?? old('country')}}"> -->
                        <select id="country" class="form-select" name="country">
                            <option value="" selected="">Select country</option>
                            @foreach($counties as $key=>$country)
                            <option value="{{$country->County}}" {{ (old('country') == $country->County || session('formData.country') == $country->County) ? 'selected' : '' }}>{{$country->County}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                        <input type="tel" id="phone" class="form-control" name="phone" value="{{ session('formData.phone') ?? old('phone')}}">
                        @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="fax" class="form-label">Fax</label>
                        <input type="text" id="fax" class="form-control" name="fax" value="{{ session('formData.fax') ?? old('fax')}}">
                    </div>
                    <div class="col-md-4" style="height: 70px;">
                        <label for="featuredListing" class="form-check-label">Featured Listing</label>
                        <input type="checkbox" id="featuredListing" class="form-check-input" name="featuredListing" value="1" {{ (old('featuredListing') || session('formData.featureCheckbox') == 1) ? 'checked' : '' }} onchange="changeFeatureValue()">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3">
                        <u><span id="fileLink">View Image</span> </u>
                        <br><!-- Placeholder for the file name -->
                        <label for="fileUpload" class="upload-button mt-1">
                            <input type="file" id="fileUpload" accept="image/*" style="display:none;" name="listing_img">
                            <span class="button-text"> <img src="{{url('assets/images/uploadicon.svg')}}" alt="">Upload</span>
                            @error('listing_img')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </label>
                        <div class="avatar-upload-agent">
                            <div id="imagePreview" class="avatar-circle"></div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="avatar-upload-agent">
                            <div class="avatar-circle">
                                @if(session('formData.listing_img'))
                                <img id="avatar-preview" src="{{ asset('assets/uploads/images/' . session('formData.listing_img')) }}" alt="Avatar Preview" class="avatar_agent">
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="firstName" class="form-label">First Name <span class="text-danger">*</span></label>
                        <input type="text" id="firstName" class="form-control" name="first_name" value="{{ session('formData.first_name') ?? old('first_name')}}">
                        @error('first_name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="lastName" class="form-label">Last Name <span class="text-danger">*</span></label>
                        <input type="text" id="lastName" class="form-control" name="last_name" value="{{ session('formData.last_name') ?? old('last_name')}}">
                        @error('last_name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="homeAddress" class="form-label">Home Address</label>
                        <input type="text" id="homeAddress" class="form-control" name="home_address" value="{{ session('formData.home_address') ?? old('home_address')}}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="user_city" class="form-label">City</label>
                        <input type="text" id="city2" class="form-control" placeholder="City" name="user_city" value="{{ session('formData.user_city') ?? old('user_city')}}">
                        @error('user_city')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="user_state" class="form-label">State</label>
                        <select id="State2" class="form-select" name="user_state">
                            <option selected="">Select state</option>
                            @foreach($states as $key=>$value)
                            <option value="{{$value->State}}" {{ (old('user_state') == $value->State || session('formData.user_state') == $value->State) ? 'selected' : '' }}>{{$value->StateName}}</option>
                            @endforeach
                        </select>
                        @error('user_state')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="user_zip_code" class="form-label">State</label>
                        <input type="text" id="Zip2" class="form-control" placeholder="Zip" name="user_zip_code" value="{{ session('formData.user_zip_code') ?? old('user_zip_code')}}">
                        @error('user_zip_code')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" id="email" class="form-control" name="user_email" value="{{ session('formData.user_email') ?? old('user_email')}}">
                        @error('user_email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="homePhone" class="form-label">Home Phone</label>
                        <input type="text" id="homePhone" class="form-control" name="user_home_phone" value="{{ session('formData.user_home_phone') ?? old('user_home_phone')}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="homeFax" class="form-label">Home Fax</label>
                        <input type="text" id="homeFax" class="form-control" name="user_home_fax" value="{{ session('formData.user_home_fax') ?? old('user_home_fax')}}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="pager" class="form-label">Pager</label>
                        <input type="text" id="pager" class="form-control" name="user_pager" value="{{ session('formData.user_pager') ?? old('user_pager')}}">
                    </div>
                    <div class="col-md-4" style="height: 70px;">
                        <label for="review" class="form-check-label">Review</label>
                        <input type="checkbox" id="review" class="form-check-input" name="review" value="1" {{ (old('review') || session('formData.reviewCheckbox') == 1) ? 'checked' : '' }} onchange="changeReviewValue()">
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center" style="overflow:auto;">
                <div>
                    <button class="btn-primary" type="submit" id="nextBtn">Next</button>
                </div>
            </div>
            <div id="errorMessage" class="alert alert-danger mt-3 d-none"></div>
        </form>
    </div>
</div>
<div p-8="">
    <p>&nbsp;</p>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#addnewliststep1').validate({
            rules: {
                user_email: {
                    required: true,
                    email: true
                },
                bus_category: {
                    required: true
                },
                bus_type: {
                    required: true
                },
                cropName: {
                    required: true
                },
                dba: {
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
                zip_code: {
                    required: true,
                    minlength: 5, // Minimum length for US ZIP code
                    maxlength: 10 // Maximum length for 9-digit ZIP code
                },
                phone: {
                    required: true,
                    regex: /^(?:\+?1[-. ]?)?\(?\d{3}\)?[-. ]?\d{3}[-. ]?\d{4}$/ // Custom regex rule
                },
                user_home_phone: {
                    regex: /^(?:\+?1[-. ]?)?\(?\d{3}\)?[-. ]?\d{3}[-. ]?\d{4}$/ // Custom regex rule
                },
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                listing_img: {
                    extension: "jpeg,png,gif,svg",
                    filesize: 5 * 1024 * 1024 // 5MB
                }
            },
            messages: {
                phone: {
                    required: 'Phone number is required.',
                    regex: 'Must be a valid phone number.'
                },
                user_home_phone: {
                    regex: 'Must be a valid phone number.'
                },
                listing_img: {
                    extension: 'File must be a valid image type (jpeg, png, gif, svg).',
                    filesize: 'File size must be less than 2MB.'
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });

        // Custom method for regex validation
        $.validator.addMethod("regex", function(value, element, regexpr) {
            return this.optional(element) || regexpr.test(value);
        }, "Please check your input.");

        // Custom method for file size validation
        $.validator.addMethod("filesize", function(value, element, param) {
            return this.optional(element) || (element.files[0].size <= param);
        }, "File size must be less than {0} bytes.");
    });
</script>
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
    $(document).ready(function() {
        $('#busCategory').change(function() {
            var id = $(this).val();
            if (id) {
                $.ajax({
                    url: "{{ route('get.options', ['id' => '__ID__']) }}".replace('__ID__', id),
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#busType').empty(); // Clear existing options
                        $('#busType').append('<option value="">Select an option</option>'); // Add default option
                        $.each(data, function(key, value) {
                            $('#busType').append('<option value="' + value.SubCatID + '">' + value.SubCategory + '</option>');
                        });
                    }
                });
            } else {
                $('#second-dropdown').empty().append('<option value="">Select an option</option>'); // Reset second dropdown
            }
        });
    });
</script>
<!--  <script>
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
    </script> -->
<script>
    document.getElementById('fileUpload').addEventListener('change', function(event) {
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            const fileLink = document.getElementById('fileLink');

            reader.onload = function(e) {
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
                fileLink.addEventListener('click', function() {
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