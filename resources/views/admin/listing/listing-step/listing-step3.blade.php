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
                <form id="addnewliststep3" action="">
                @csrf
                <input type="hidden" name="id" value="{{ session('formData.listing_id') ? session('formData.listing_id') : '' }}">

                    <!-- One "tab" for each step in the form: -->
                   
                    <div class="tab" style="display: block;">
                        <h3>Pricing</h3>
                        <hr>
                        <!-- Management and Referring Agent -->
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <h4 class="form-sec mb-3">Management Agent</h4>
                                <div class="d-flex">
                                    <div class="col-sm-6 p-0  mb-3">
                                        <label for="managementAgentName">Name</label>
                                        <input type="text" class="form-control" id="managementAgentName" name="managementAgentName"  value="{{ session('formData.managementAgentName') ? session('formData.managementAgentName') : '' }}">
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label for="managementAgentPhone">Phone</label>
                                        <input type="text" class="form-control" id="managementAgentPhone" name="managementAgentPhone"  value="{{ session('formData.managementAgentPhone') ? session('formData.managementAgentPhone') : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6  mb-2">
                                <h4 class="form-sec mb-3">Referring Agent</h4>
                                <div class="d-flex">
                                    <div class="col p-0 mb-3">
                                        <label for="referringAgentName">Name</label>
                                        <input type="text" class="form-control" id="referringAgentName" name="referringAgentName"  value="{{ session('formData.referringAgentName') ? session('formData.referringAgentName') : '' }}">
                                    </div>
                                    <div class="col mb-3">
                                        <label for="referringAgentPhone">Phone</label>
                                        <input type="text" class="form-control" id="referringAgentPhone" name="referringAgentPhone"  value="{{ session('formData.referringAgentPhone') ? session('formData.referringAgentPhone') : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Listing Data -->
                        <div class="row mb-2">
                            <h4 class="form-sec mb-3">Listing Data</h4>
                            <div class="col-md-3 mb-3">
                                <label for="listingDate">Listing Date</label>
                                <input type="date" class="form-control" id="listingDate" name="listingDate"  value="{{ session('formData.listingDate') ? session('formData.listingDate') : '' }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="expDate">Exp Date</label>
                                <input type="date" class="form-control" id="expDate" name="expDate"  value="{{ session('formData.expDate') ? session('formData.expDate') : '' }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="listingType">Listing Type</label>
                                <input type="text" class="form-control" id="listingType" name="listingType"  value="{{ session('formData.listingType') ? session('formData.listingType') : '' }}">
                            </div>
                        </div>

                        <!-- Co-Broker and Reason for Sale -->
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label for="coBroker">Co-Broker</label>
                                <input type="text" class="form-control" id="coBroker" name="coBroker"  value="{{ session('formData.coBroker') ? session('formData.coBroker') : '' }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="reasonForSale">Reason For Sale</label>
                                <input type="text" class="form-control" id="reasonForSale" name="reasonForSale"  value="{{ session('formData.reasonForSale') ? session('formData.reasonForSale') : '' }}">
                            </div>
                        </div>

                        <!-- formData Data -->
                        <div class="row mb-2">
                            <h4 class="form-sec mb-3">formData Data</h4>
                            <div class="col-md-3 mb-3">
                                <label for="listPrice">List Price</label>
                                <input type="text" class="form-control" id="listPrice" name="listPrice"  value="{{ session('formData.listPrice') ? session('formData.listPrice') : '' }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="purPrice">Pur. Price</label>
                                <input type="text" class="form-control" id="purPrice" name="purPrice"  value="{{ session('formData.purPrice') ? session('formData.purPrice') : '' }}">

                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="downPay">Down Pay</label>
                                <input type="text" class="form-control" id="downPay" name="downPay"  value="{{ session('formData.downPay') ? session('formData.downPay') : '' }}">

                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="balance">Balance</label>
                                <input type="text" class="form-control" id="balance" name="balance"  value="{{ session('formData.balance') ? session('formData.balance') : '' }}">

                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3 mb-3">
                                <label for="interest">Interest</label>
                                <input type="text" class="form-control" id="interest" name="interest"  value="{{ session('formData.interest') ? session('formData.interest') : '' }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="addTerms">Add. Terms</label>
                                <input type="text" class="form-control" id="addTerms" name="addTerms"  value="{{ session('formData.addTerms') ? session('formData.addTerms') : '' }}">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="invInPrice">Inv. in Price</label>
                                <input type="text" class="form-control" id="invInPrice" name="invInPrice"  value="{{ session('formData.invInPrice') ? session('formData.invInPrice') : '' }}">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="invNotInPrice">Inv. Not in Price</label>
                                <input type="text" class="form-control" id="invNotInPrice" name="invNotInPrice"  value="{{ session('formData.invNotInPrice') ? session('formData.invNotInPrice') : '' }}">
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
                                <input type="text" class="form-control" id="agent" name="agent"  value="{{ session('formData.agent') ? session('formData.agent') : '' }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="commission">Commission</label>
                                <input type="text" class="form-control" id="commission" name="commission"  value="{{ session('formData.commission') ? session('formData.commission') : '' }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="flatFee">Flat Fee</label>
                                <input type="text" class="form-control" id="flatFee" name="flatFee"  value="{{ session('formData.flatFee') ? session('formData.flatFee') : '' }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="reAskingPrice">Re Asking Price</label>
                                <input type="text" class="form-control" id="reAskingPrice" name="reAskingPrice" value="{{ session('formData.reAskingPrice') ? session('formData.reAskingPrice') : '' }}">
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
                  
                    <div class="d-flex justify-content-center" style="overflow:auto;">
                        <div>
                        <a href="{{route('create.listing.step2')}}"><button class="btn-primary" type="button" id="prevBtn">Previous</button></a>
                            <button class="btn-primary" type="submit" id="nextBtn">Next</button>
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
    $('#addnewliststep3').on('submit', function(e) {
        e.preventDefault(); // Prevent normal form submission
        /* let formData = $(this).serialize(); */ // Get form data
        var formData = new FormData(this);

        $.ajax({
            url: "{{ route('store.listing.step3') }}", // Adjust the route as needed
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
 <script>
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