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
                <form id="addnewliststep1" action="" enctype="multipart/form-data">
                @csrf
                    <!-- One "tab" for each step in the form: -->
                    <div class="tab" style="display: block;">
                        <h3>General:</h3>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label for="busCategory" class="form-label">Bus. Category</label>
                                <select id="busCategory" class="form-select" name="bus_category">
                                    <option selected="">Select category</option>
                                    @foreach($bus_category as $key=>$value)
                                    <option value="{{$value->CategoryID}}" {{ session('formData.bus_category') == $value->CategoryID ? 'selected' : '' }}>{{$value->BusinessCategory}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="busType" class="form-label">Bus. Type</label>
                                <select id="busType" class="form-select" name="bus_type">
                                    <option value="" selected>Select type</option>
                                    <option value="Type 1" {{ session('formData.bus_type') == 'Type 1' ? 'selected' : '' }}>Type 1</option>
                                    <option value="Type 2" {{ session('formData.bus_type') == 'Type 2' ? 'selected' : '' }}>Type 2</option>
                                </select>
                            </div>
                          
                            <div class="col-md-4" style="height: 70px;">
                                <label for="franchise" class="form-check-label">Franchise</label>
                                <input type="checkbox" id="franchise" class="form-check-input" name="franchise" value="{{ session('formData.franchise') == '1' ? '1' : '0' }}" 
                                @if(session('formData.franchise') == '1') checked @endif onchange="changeFranchiseValue()">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label for="cropName" class="form-label">Crop Name</label>
                                <input type="text" id="cropName" class="form-control" name="cropName" value="{{ session('formData.cropName') ? session('formData.cropName') : '' }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="dba" class="form-label">DBA</label>
                                <input type="text" id="dba" class="form-control" name="dba" value="{{ session('formData.dba') ? session('formData.dba') : '' }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="productMix" class="form-label">Product Mix</label>
                                <input type="text" id="productMix" class="form-control"  name="productMix" value="{{ session('formData.productMix') ? session('formData.productMix') : '' }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" id="address" class="form-control" name="address" value="{{ session('formData.address') ? session('formData.address') : '' }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="cityStateZip" class="form-label">City</label>
                                <div class="d-flex">
                                    <input type="text" id="city" class="form-control" placeholder="City" name="city" value="{{ session('formData.city') ? session('formData.city') : '' }}">
                                    <input type="text" id="State" class="form-control" placeholder="State" name="state" value="{{ session('formData.state') ? session('formData.state') : '' }}">
                                    <input type="text" id="Zip" class="form-control" placeholder="Zip" name="zip_code" value="{{ session('formData.zip_code') ? session('formData.zip_code') : '' }}">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="country" class="form-label">Country</label>
                                <input type="text" id="country" class="form-control" name="country" value="{{ session('formData.country') ? session('formData.country') : '' }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel" id="phone" class="form-control" name="phone" value="{{ session('formData.phone') ? session('formData.phone') : '' }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="fax" class="form-label">Fax</label>
                                <input type="text" id="fax" class="form-control" name="fax" value="{{ session('formData.fax') ? session('formData.fax') : '' }}">
                            </div>
                            <div class="col-md-4" style="height: 70px;">
                                <label for="featuredListing" class="form-check-label">Featured Listing</label>
                                <input type="checkbox" id="featuredListing" class="form-check-input" name="featuredListing" value="{{ session('formData.featuredListing') == '1' ? '1' : '0' }}" 
                                @if(session('formData.featuredListing') == '1') checked @endif
                                 onchange="changeFeatureValue()">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <u><span id="fileLink">View Image</span> </u>
                                <br><!-- Placeholder for the file name -->
                                <label for="fileUpload" class="upload-button mt-1">
                                    <input type="file" id="fileUpload" accept="image/*" style="display:none;" name="listing_img">
                                    <span class="button-text"> <img src="{{url('assets/images/uploadicon.svg')}}" alt="">Upload</span>
                                </label>
                                <div id="imagePreview"></div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" id="firstName" class="form-control" name="first_name" value="{{ session('formData.first_name') ? session('formData.first_name') : '' }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" id="lastName" class="form-control" name="last_name" value="{{ session('formData.last_name') ? session('formData.last_name') : '' }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="homeAddress" class="form-label">Home Address</label>
                                <input type="text" id="homeAddress" class="form-control" name="home_address" value="{{ session('formData.home_address') ? session('formData.home_address') : '' }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label for="cityStateZip2" class="form-label">City</label>
                                <div class="d-flex">
                                    <input type="text" id="city2" class="form-control" placeholder="City" name="user_city" value="{{ session('formData.user_city') ? session('formData.user_city') : '' }}">
                                    <input type="text" id="State2" class="form-control" placeholder="State"  name="user_state" value="{{ session('formData.user_state') ? session('formData.user_state') : '' }}">
                                    <input type="text" id="Zip2" class="form-control" placeholder="Zip"  name="user_zip_code" value="{{ session('formData.user_zip_code') ? session('formData.user_zip_code') : '' }}">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" class="form-control"  name="user_email" value="{{ session('formData.user_email') ? session('formData.user_email') : '' }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="homePhone" class="form-label">Home Phone</label>
                                <input type="text" id="homePhone" class="form-control"  name="user_home_phone"  value="{{ session('formData.user_home_phone') ? session('formData.user_home_phone') : '' }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label for="homeFax" class="form-label">Home Fax</label>
                                <input type="text" id="homeFax" class="form-control"  name="user_home_fax" value="{{ session('formData.user_home_fax') ? session('formData.user_home_fax') : '' }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="pager" class="form-label">Pager</label>
                                <input type="text" id="pager" class="form-control" name="user_pager" value="{{ session('formData.user_pager') ? session('formData.user_pager') : '' }}">
                            </div>
                            <div class="col-md-4" style="height: 70px;">
                                <label for="review" class="form-check-label">Review</label>
                                <input type="checkbox" id="review" class="form-check-input"  name="review" value="{{ session('formData.review')}}" 
                                @if(session('formData.review') == '1') checked @endif
                                onchange="changeReviewValue()">
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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#addnewliststep1').on('submit', function(e) {
        e.preventDefault(); // Prevent normal form submission
        /* let formData = $(this).serialize(); */ // Get form data
        var formData = new FormData(this);

        $.ajax({
            url: "{{ route('store.listing.step1') }}", // Adjust the route as needed
            type: 'POST',
            data: formData,
            processData: false, // Prevent jQuery from converting the data
            contentType: false, // Let jQuery set the content type
            success: function(response) {
                if (response.success) {
                    alert(response.success);
                    if (response.redirect) {
                        window.location.href = response.redirect; // Redirect to the new URL
                    }
                   /*  $('#userForm')[0].reset(); */ // Reset form if successful
                }
            },
            error: function(xhr) {
                let errorMessage = xhr.responseJSON.error;
                //alert(errorMessage);
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    let errorHtml = '<ul>';
                    for (const key in errors) {
                        errors[key].forEach(function(error) {
                            errorHtml += '<li>' + error + '</li>';
                        });
                    }
                    errorHtml += '</ul>';
                    $('#errorMessage').html(errorHtml).css('color', 'red');
                }
                // Display the error message
                $('#errorMessage').text(errorMessage).removeClass('d-none');
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