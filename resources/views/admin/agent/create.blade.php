@extends('admin.layout.master')
@section('content')
    <div class="container-fluid content bg-light">
        @if (Session::has('success_message'))
            <div class="alert alert-success alert-block" id="alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ Session::get('success_message') }}</strong>
            </div>
        @endif
        <div class="card mb-4">
            <div class="card-body">
                <form id="agent-form" action="{{ route('register.agent') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="agentId">Agent Id <span class="text-danger">*</span></label>
                                <input type="text" placeholder="" id="agent_id" class="form-control" name="agent_id"
                                    value="{{ old('agent_id') }}">
                                @if ($errors->has('agent_id'))
                                    <span class="text-danger">{{ $errors->first('agent_id') }}</span>
                                @endif
                                @if (Session::has('duplicate_error'))
                                    <span class="text-danger">{{ Session::get('duplicate_error') }}</span>
                                @endif

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="firstName">First name <span class="text-danger">*</span></label>
                                <input type="text" placeholder="" id="first_name" class="form-control" name="first_name"
                                    value="{{ old('first_name') }}">
                                @if ($errors->has('first_name'))
                                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="lastName">Last name <span class="text-danger">*</span></label>
                                <input type="text" placeholder="" id="last_name" class="form-control" name="last_name"
                                    value="{{ old('last_name') }}">
                                @if ($errors->has('last_name'))
                                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="agentAddress">Address</label>
                                <input type="text" placeholder="" id="address" class="form-control" name="address"
                                    value="{{ old('address') }}">
                                @if ($errors->has('address'))
                                    <span class="text-danger">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="agentCity">City</label>
                                <input type="text" placeholder="" id="city" class="form-control" name="city"
                                    value="{{ old('city') }}">
                                @if ($errors->has('city'))
                                    <span class="text-danger">{{ $errors->first('city') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="agentState">State</label>
                                <select id="state" class="form-select" name="state">
                                    <option value="" selected="">Select state</option>
                                    @foreach ($states as $key => $value)
                                        <option value="{{ $value->State }}"
                                            {{ old('state') == $value->State ? 'selected' : '' }}>{{ $value->StateName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="agentCity">Zip</label>
                                <input type="text" placeholder="" id="zip_code" class="form-control" name="zip_code"
                                    value="{{ old('zip_code') }}">
                                @if ($errors->has('zip_code'))
                                    <span class="text-danger">{{ $errors->first('zip_code') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="agentDob">Date of birth</label>
                                <input type="date" placeholder="" id="dob" class="form-control" name="dob"
                                    value="{{ old('dob') }}">
                                @if ($errors->has('dob'))
                                    <span class="text-danger">{{ $errors->first('dob') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="agentHomephone">Home phone <span class="text-danger">*</span></label>
                                <input type="text" placeholder="" id="home_phone" class="form-control"
                                    name="home_phone" value="{{ old('home_phone') }}">
                                @if ($errors->has('home_phone'))
                                    <span class="text-danger">{{ $errors->first('home_phone') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="agentFax">Fax</label>
                                <input type="text" placeholder="" id="fax" class="form-control" name="fax"
                                    value="{{ old('fax') }}">
                                @if ($errors->has('fax'))
                                    <span class="text-danger">{{ $errors->first('fax') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="agentEmail">Email <span class="text-danger">*</span></label>
                                <input type="text" placeholder="" id="email" class="form-control" name="email"
                                    value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <!-- <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="agentComment">Comment</label>
                                    <input type="text" placeholder="" id="comment" class="form-control"
                                        name="comment" value="{{ old('comment') }}">
                                    @if ($errors->has('comment'))
    <span class="text-danger">{{ $errors->first('comment') }}</span>
    @endif
                                </div>
                            </div> -->
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="agentComment">Comment</label>
                                <textarea class="form-control ckeditor" id="comment" name="comment">{{ old('comment') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3" style="height: 70px;">
                            <label class="form-check-label" for="flexCheckDefault">
                                Spouse
                            </label>
                            <input class="form-check-input" type="checkbox" value="1" id="agentSpouse"
                                name="spouse" {{ old('spouse') ? 'checked' : '' }} onclick="changeSpouseValue()">


                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="agentSSnumber">Spouse first name</label>
                                <input type="text" placeholder="" id="spouse_first_name" class="form-control"
                                    name="spouse_first_name" value="{{ old('spouse_first_name') }}">
                                @if ($errors->has('spouse_first_name'))
                                    <span class="text-danger">{{ $errors->first('spouse_first_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="agentSSnumber">Spouse last name</label>
                                <input type="text" placeholder="" id="spouse_last_name" class="form-control"
                                    name="spouse_last_name" value="{{ old('spouse_last_name') }}">
                                @if ($errors->has('spouse_last_name'))
                                    <span class="text-danger">{{ $errors->first('spouse_last_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="agentSSnumber">SS Number</label>
                                <input type="text" placeholder="" id="ss_number" class="form-control"
                                    name="ss_number" value="{{ old('ss_number') }}">
                                @if ($errors->has('ss_number'))
                                    <span class="text-danger">{{ $errors->first('ss_number') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="agentCellular">Cellular</label>
                                <input type="text" placeholder="" id="cellular" class="form-control"
                                    name="cellular" value="{{ old('cellular') }}">
                                @if ($errors->has('cellular'))
                                    <span class="text-danger">{{ $errors->first('cellular') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="agentPager">Pager</label>
                                <input type="text" placeholder="" id="pager" class="form-control" name="pager"
                                    value="{{ old('pager') }}">
                                @if ($errors->has('pager'))
                                    <span class="text-danger">{{ $errors->first('pager') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="agentHiredate">Hire date</label>
                                <input type="date" placeholder="" id="hire_date" class="form-control"
                                    name="hire_date" value="{{ old('hire_date') }}">
                                @if ($errors->has('hire_date'))
                                    <span class="text-danger">{{ $errors->first('hire_date') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="agentTerminateddate">Terminated</label>
                                <input type="date" placeholder="" id="terminate_date" class="form-control"
                                    name="terminate_date" value="{{ old('terminate_date') }}">
                                @if ($errors->has('terminate_date'))
                                    <span class="text-danger">{{ $errors->first('terminate_date') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3" style="height: 70px;">
                            <label class="form-check-label" for="flexCheckDefault">
                                Display on web
                            </label>
                            <input class="form-check-input" type="checkbox" value="1" id="display_on_web"
                                name="display_on_web" {{ old('display_on_web') ? 'checked' : '' }}
                                onclick="changeDisplayValue()">
                        </div>
                        <div class="col-md-3" style="height: 70px;">
                            <label class="form-check-label" for="flexCheckDefault">
                                Active
                            </label>
                            <input class="form-check-input" type="checkbox" value="1" id="active_agent"
                                name="active_agent" {{ old('active_agent') ? 'checked' : '' }}
                                onclick="changeActiveAgentValue()">
                        </div>
                        <div class="col-md-3">
                            <div class="col">
                                <u><span id="fileLink">View Image</span> </u>
                                <br><!-- Placeholder for the file name -->
                                <label for="fileUpload" class="upload-button mt-1">
                                    <input type="file" id="fileUpload" accept="image/*" style="display:none;"
                                        name="agent_image">
                                    <span class="button-text"> <img src="{{ url('assets/images/uploadicon.svg') }}"
                                            alt="">Upload</span>
                                </label>
                                <div class="avatar-upload-agent">
                                    <div id="imagePreview" class="avatar-circle"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="d-grid mx-auto agentSignup">
                            <button type="submit" class="btn agentBtn">Submit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div p-8>
        <p>&nbsp;</p>
    </div>
    <style>
        .ck-editor__editable {
            min-height: 300px !important;
        }
    </style>

    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#comment'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#agent-form').validate({
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
                    agent_id: {
                        required: true,
                        regex: /^[A-Za-z]+$/
                    },
                    home_phone: {
                        required: true,
                        regex: /^(?:\+?1[-. ]?)?\(?\d{3}\)?[-. ]?\d{3}[-. ]?\d{4}$/
                    },
                    city: {
                        regex: /^[a-zA-Z\s]+$/
                    }
                },
                messages: {
                    home_phone: {
                        required: 'Phone number is required.',
                        regex: 'Must be a valid phone number.'
                    },
                    city: {
                        regex: 'City can only contain letters and spaces.'
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

            $('#agent-form input').on('keyup change', function() {
                $(this).valid();
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
                        document.getElementById('imagePreview').innerHTML = '<p>Uploaded file: ' + file.name +
                            '</p>';
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
