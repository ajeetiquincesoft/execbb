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
                <form id="addnewliststep2" action="">
                    @csrf
                <input type="hidden" name="id" value="{{ session('formData.listing_id') ? session('formData.listing_id') : '' }}">
                    <!-- One "tab" for each step in the form: -->
                    
                    <div class="tab" style="display: block;">
                        <h3>Business</h3>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label for="buildingSize">Building Size</label>
                                <input type="text" class="form-control" id="buildingSize" name="buildingSize" value="{{ session('formData.buildingSize') ? session('formData.buildingSize') : '' }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="basementSize">Basement Size</label>
                                <input type="text" class="form-control" id="basementSize" name="basementSize" value="{{ session('formData.basementSize') ? session('formData.basementSize') : '' }}">
                            </div>
                            <div class="col-md-4" style="height: 70px;">
                                <label class="form-check-label me-2">Basement?</label>
                                <input type="checkbox" class="form-check-input" id="basement" name="basement" value="1" {{ session('formData.basement') == 1 ? 'checked' : '' }} onchange="changeBasementValue()">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label for="parking">Parking</label>
                                <input type="text" class="form-control" id="parking" name="parking" value="{{ session('formData.parking') ? session('formData.parking') : '' }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="licenseRequired">License Required</label>
                                <input type="text" class="form-control" id="licenseRequired" name="licenseRequired" value="{{ session('formData.licenseRequired') ? session('formData.licenseRequired') : '' }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="baseMonthlyRent">Base Monthly Rent</label>
                                <input type="number" class="form-control" id="baseMonthlyRent" name="baseMonthlyRent" value="{{ session('formData.baseMonthlyRent') ? session('formData.baseMonthlyRent') : '' }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label for="leaseTerms">Lease Terms</label>
                                <input type="text" class="form-control" id="leaseTerms" name="leaseTerms" value="{{ session('formData.leaseTerms') ? session('formData.leaseTerms') : '' }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="leaseOptions">Lease Options</label>
                                <input type="text" class="form-control" id="leaseOptions" name="leaseOptions" value="{{ session('formData.leaseOptions') ? session('formData.leaseOptions') : '' }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="daysOpen">No. of Days Open</label>
                                <input type="number" class="form-control" id="daysOpen" name="daysOpen" value="{{ session('formData.daysOpen') ? session('formData.daysOpen') : '' }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label for="hoursOperation">Hours of Operation</label>
                                <input type="text" class="form-control" id="hoursOperation" name="hoursOperation" value="{{ session('formData.hoursOperation') ? session('formData.hoursOperation') : '' }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="numSeats">No. of Seats</label>
                                <input type="number" class="form-control" id="numSeats" name="numSeats" value="{{ session('formData.numSeats') ? session('formData.numSeats') : '' }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="yearsEstablished">Years Established?</label>
                                <input type="number" class="form-control" id="yearsEstablished" name="yearsEstablished" value="{{ session('formData.yearsEstablished') ? session('formData.yearsEstablished') : '' }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label for="yearsPrevOwner">Years Previous Owner</label>
                                <input type="number" class="form-control" id="yearsPrevOwner" name="yearsPrevOwner" value="{{ session('formData.yearsPrevOwner') ? session('formData.yearsPrevOwner') : '' }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Interest</label>
                                <div class="d-flex">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="interestHot" name="interest" value="Hot"  {{ session('formData.interest') == 'Hot' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="interestHot">Hot</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="interestMedium" name="interest" value="Medium" {{ session('formData.interest') == 'Medium' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="interestMedium">Medium</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="interestCold" name="interest" value="Cold" {{ session('formData.interest') == 'Cold' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="interestCold">Cold</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Employees</label>
                                <div class="d-flex">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="interestPartTime" name="interestType" value="Part Time">
                                        <label class="form-check-label" for="interestPartTime" {{ session('formData.interestType') == 'Part Time' ? 'checked' : '' }}>Part Time</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="interestFullTime" name="interestType" value="Full Time" {{ session('formData.interestType') == 'Full Time' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="interestFullTime">Full Time</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                    <div class="d-flex justify-content-center" style="overflow:auto;">
                        <div>
                            <a href="{{route('create.listing.step1')}}"><button class="btn-primary" type="button" id="prevBtn">Previous</button></a>
                            <button class="btn-primary" type="submit" id="nextBtn">Next</button>
                           <!--  @if (session()->has('formData.listing_id'))
                            <a href="{{route('create.listing.step3')}}"><button class="btn-primary" type="button" id="nextBtn">Next</button></a>
                            @else
                            <button class="btn-primary" type="submit" id="nextBtn">Next</button>
                            @endif -->
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
    $('#addnewliststep2').on('submit', function(e) {
        e.preventDefault(); // Prevent normal form submission
        /* let formData = $(this).serialize(); */ // Get form data
        var formData = new FormData(this);

        $.ajax({
            url: "{{ route('store.listing.step2') }}", // Adjust the route as needed
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