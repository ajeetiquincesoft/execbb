@extends('admin.layout.master')
@section('content')
<div class="container-fluid content bg-light">
    <div class="row card p-4">
        <form id="addnewliststep1" action="{{ route('update.listing.step1',$listingData->ListingID) }}" method="post" enctype="multipart/form-data">
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
                            <option value="{{$data->CategoryID}}" {{ $listingData->BusCategory == $data->CategoryID ? 'selected' : '' }}>{{$data->BusinessCategory}}</option>
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
                            <option value="{{$bus_type->SubCatID}}" {{ $listingData->SubCat == $bus_type->SubCatID  ? 'selected' : '' }}>{{$bus_type->SubCategory}}</option>
                            @endforeach
                        </select>
                        @error('bus_type')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-4" style="height: 70px;">
                        <label for="franchise" class="form-check-label">Franchise</label>
                        <input type="checkbox" id="franchise" class="form-check-input" name="franchise" value="1" {{ $listingData->Franchise == 1 ? 'checked' : '' }} onchange="changeFranchiseValue()">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="cropName" class="form-label">Crop Name <span class="text-danger">*</span></label>
                        <input type="text" id="cropName" class="form-control" name="cropName" value="{{$listingData->CorpName}}">
                        @error('cropName')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dba" class="form-label">DBA <span class="text-danger">*</span></label>
                        <input type="text" id="dba" class="form-control" name="dba" value="{{$listingData->DBA}}">
                        @error('dba')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="productMix" class="form-label">Product Mix</label>
                        <input type="text" id="productMix" class="form-control" name="productMix" value="{{$listingData->Product}}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-8 mb-3">
                        <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                        <input type="text" id="address" class="form-control" name="address" value="{{$listingData->Address1}}">
                        @error('address')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="">City <span class="text-danger">*</span></label>
                        <input type="text" id="city" class="form-control" placeholder="City" name="city" value="{{$listingData->City}}">
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
                            <option value="{{$value->State}}" {{ strtolower($listingData->State) == strtolower($value->State) ? 'selected' : '' }}>{{$value->StateName}}</option>
                            @endforeach
                        </select>
                        @error('state')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="">Zip <span class="text-danger">*</span></label>
                        <input type="text" id="Zip" class="form-control" placeholder="Zip" name="zip_code" value="{{$listingData->Zip}}">
                        @error('zip_code')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="country" class="form-label">Country</label>
                        <!--  <input type="text" id="country" class="form-control" name="country" value="{{$listingData->County}}"> -->
                        <select id="country" class="form-select" name="country">
                            <option value="" selected="">Select country</option>
                            @foreach($counties as $key=>$value)
                            <option value="{{$value->County}}" {{$listingData->County == $value->County ? 'selected' : '' }}>{{$value->County}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                        <input type="tel" id="phone" class="form-control" name="phone" value="{{$listingData->Phone}}">
                        @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="fax" class="form-label">Fax</label>
                        <input type="text" id="fax" class="form-control" name="fax" value="{{$listingData->Fax}}">
                    </div>
                    <div class="col-md-4" style="height: 70px;">
                        <label for="featuredListing" class="form-check-label">Featured Listing</label>
                        <input type="checkbox" id="featuredListing" class="form-check-input" name="featuredListing" value="1" {{ $listingData->featured == 1 ? 'checked' : '' }} onchange="changeFeatureValue()">
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
                        <div id="listingImgError" style="color:#dc3545;"></div>
                        <div id="imagePreview"></div>
                    </div>
                    @if(!empty($listingData->imagepath))
                    <div class="col">
                        <div id="imageUploads">
                            <img class="view_upload_image" src="{{ asset('assets/uploads/images/' . $listingData->imagepath) }}" alt="Uploaded Image">
                        </div>
                    </div>
                    @endif
                    <div class="col-md-6">
                        <label for="document" class="form-label">Upload Document (PDF, DOCX, etc.)</label>
                        <input type="file" class="form-control" name="document" id="document" accept=".pdf,.doc,.docx,.xls,.xlsx">
                        @error('document')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        @if(isset($listingData->document_path))
                        <p class="mt-2">
                            Current File:
                            <a href="{{ asset('storage/' . $listingData->document_path) }}" target="_blank">View</a>
                        </p>
                        @endif
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="firstName" class="form-label">First Name <span class="text-danger">*</span></label>
                        <input type="text" id="firstName" class="form-control" name="first_name" value="{{$listingData->SellerFName}}">
                        @error('first_name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="lastName" class="form-label">Last Name <span class="text-danger">*</span></label>
                        <input type="text" id="lastName" class="form-control" name="last_name" value="{{$listingData->SellerLName}}">
                        @error('last_name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="homeAddress" class="form-label">Home Address</label>
                        <input type="text" id="homeAddress" class="form-control" name="home_address" value="{{$listingData->SHomeAdd1}}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="user_city" class="form-label">City</label>
                        <input type="text" id="city2" class="form-control" placeholder="City" name="user_city" value="{{$listingData->SCity}}">
                        @error('user_city')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="user_state" class="form-label">State</label>
                        <select id="State2" class="form-select" name="user_state">
                            <option value="" selected="">Select state</option>
                            @foreach($states as $key=>$value)
                            <option value="{{$value->State}}" {{ strtolower($listingData->SState) == strtolower($value->State) ? 'selected' : '' }}>{{$value->StateName}}</option>
                            @endforeach
                        </select>
                        @error('user_state')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="user_zip_code" class="form-label">Zip</label>
                        <input type="text" id="Zip2" class="form-control" placeholder="Zip" name="user_zip_code" value="{{$listingData->SZip}}">
                        @error('user_zip_code')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" id="email" class="form-control" name="user_email" value="{{$listingData->Email}}">
                        @error('user_email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="homePhone" class="form-label">Home Phone</label>
                        <input type="text" id="homePhone" class="form-control" name="user_home_phone" value="{{$listingData->SHomePh}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="homeFax" class="form-label">Home Fax</label>
                        <input type="text" id="homeFax" class="form-control" name="user_home_fax" value="{{$listingData->SHomeFax}}">
                    </div>
                </div>
                <div class="row mb-2">

                    <div class="col-md-4 mb-3">
                        <label for="pager" class="form-label">Pager</label>
                        <input type="text" id="pager" class="form-control" name="user_pager" value="{{$listingData->Pager}}">
                    </div>
                    <div class="col-md-4" style="height: 70px;">
                        <label for="review" class="form-check-label">Review</label>
                        <input type="checkbox" id="review" class="form-check-input" name="review" value="1" {{ $listingData->Review == 1 ? 'checked' : '' }} onchange="changeReviewValue()">
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
        $('#phone, #homePhone').on('input', function() {
            this.value = this.value.replace(/\D/g, '');
        });
        // Add custom method for validating image extensions
        $.validator.addMethod("imageExtension", function(value, element) {
            // Check if the file input value matches the allowed extensions (jpg, jpeg, png, svg)
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.svg)$/i;
            return this.optional(element) || allowedExtensions.test(value);
        }, "Only .jpg, .jpeg, .png, and .svg files are allowed.");
        // Custom image dimension validation
        // Flag to check if validation should pass
        let isValidImage = true;
        // Custom validation method for image dimensions
        $.validator.addMethod("imageDimensions", function(value, element) {
            var imageFile = element.files[0];

            if (!imageFile) {
                return true; // No file selected, skip validation
            }

            var img = new Image();
            var $element = $(element);

            img.onload = function() {
                var width = img.width;
                var height = img.height;
                var isValid = width >= 800 && height >= 500;

                // Store validation result in a data attribute
                $element.data("valid-image", isValid);

                // Manually trigger validation again
                if (isValid) {
                    $("#fileUpload").valid();
                }
            };

            img.src = URL.createObjectURL(imageFile);

            // Return stored validation result or assume false if not yet loaded
            return $element.data("valid-image") === true;
        }, "Image must be at least 800px by 500px.");
        $.validator.setDefaults({
            ignore: []
        });
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
                    required: true,
                    regex: /^[a-zA-Z\s]+$/
                },
                state: {
                    required: true
                },
                zip_code: {
                    required: true,
                    minlength: 4,
                    maxlength: 10
                },
                phone: {
                    required: true,
                    regex: /^\d{10}$/ // Custom regex rule
                },
                user_home_phone: {
                    regex: /^\d{10}$/ // Custom regex rule
                },
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                listing_img: {
                    imageExtension: true,
                    imageDimensions: true
                },
                user_city: {
                    regex: /^[a-zA-Z\s]+$/
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
                city: {
                    required: 'City is required.',
                    regex: 'City can only contain letters and spaces.'
                },
                user_city: {
                    regex: 'City can only contain letters and spaces.'
                },
                listing_img: {
                    imageExtension: 'Only .jpg, .jpeg, .png, and .svg files are allowed.'
                }
            },
            errorPlacement: function(error, element) {
                // Custom placement for errors
                console.log(element.attr('name'));
                if (element.attr('name') == 'listing_img') {
                    // Place the error outside the label in the #listingImgError div
                    error.appendTo('#listingImgError');
                } else {
                    // Default placement for other fields
                    error.insertAfter(element);
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
        $('#addnewliststep1 input').on('keyup change', function() {
            $(this).valid(); // Trigger validation for the input field
        });
    });
</script>
<style>
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
<script>
    document.getElementById('fileUpload').addEventListener('change', function(event) {
        isValidImage = true;
        /* $('#fileUpload').valid(); */
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