@extends('frontend.layout.master')

@section('content')
    <!-- Breadcrumb Section -->
    <div class="breadcrumb-container py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="#">Contact Us</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Main Container -->
    <div class="container my-5 container-padding contact-us">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <!-- Contact Information Form -->
            <div class="col-md-8 border-right-contact">
                <h1 class="Contact-text">Contact Us</h1>
                <div class="form-text">
                    <form method="POST" action="{{ route('contact.submit') }}" name="contact-form" id="contact-form">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" placeholder="First Name" name="first_name">
                                @if ($errors->has('first_name'))
                                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" placeholder="Last Name" name="last_name">
                                @if ($errors->has('last_name'))
                                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Mailing Address" name="address">
                            @if ($errors->has('address'))
                                <span class="text-danger">{{ $errors->first('address') }}</span>
                            @endif
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" placeholder="City/Town" name="city">
                                @if ($errors->has('city'))
                                    <span class="text-danger">{{ $errors->first('city') }}</span>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <select class="form-select" name="state">
                                    <option value="" selected disabled>State</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->State }}">{{ strtoupper($state->State) }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('state'))
                                    <span class="text-danger">{{ $errors->first('state') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" placeholder="County" name="country">
                                @if ($errors->has('country'))
                                    <span class="text-danger">{{ $errors->first('country') }}</span>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" placeholder="Zip Code" name="zip">
                                @if ($errors->has('zip'))
                                    <span class="text-danger">{{ $errors->first('zip') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 mb-3">
                                <input type="text" class="form-control" placeholder="Day Time Phone"
                                    name="day_time_phone" id="day_time_phone">
                                @if ($errors->has('day_time_phone'))
                                    <span class="text-danger">{{ $errors->first('day_time_phone') }}</span>
                                @endif
                            </div>
                            <div class="col-md-4 mb-3">
                                <input type="text" class="form-control" placeholder="Evening Phone" name="evening_phone"
                                    id="evening_phone">
                            </div>
                            <div class="col-md-4 mb-3">
                                <input type="text" class="form-control" placeholder="Cellular Phone"
                                    name="cellular_phone" id="cellular_phone">
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Email Address" name="email">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <select class="form-select" name="time_to_connect">
                                <option value="" selected disabled>Best Time to Contact</option>
                                <option value="9:00 am - 11:00 pm">9:00 am - 11:00 pm</option>
                                <option value="11:00 am - 2:00 pm">11:00 am - 2:00 pm</option>
                                <option value="2:00 pm - 5:00 pm">2:00 pm - 5:00 pm</option>
                                <option value="After 5:00 pm">After 5:00 pm</option>
                            </select>
                            @if ($errors->has('time_to_connect'))
                                <span class="text-danger">{{ $errors->first('time_to_connect') }}</span>
                            @endif
                        </div>
                        <div class="mb-5 custom-input">
                            <textarea class="form-control custom-textarea" rows="5" placeholder="Enter up to 500 characters"
                                name="message" maxlength="500"></textarea>
                        </div>
                        <div class="Ques-btn">
                            <h6 class="fw-bold">Which Statement Describes you?*</h6>
                        </div>
                        <div class="row">
                            <!-- Radio Button Group 1 -->
                            <div class="col-12 d-flex flex-wrap">
                                <div class="d-flex align-items-center me-3 mb-2">
                                    <div class="custom-radio">
                                        <input class="form-check-input me-3" type="radio" name="role"
                                            id="seller" value="seller">
                                        <label class="form-check-label" for="seller">Seller</label>
                                    </div>

                                </div>
                                <div class="d-flex align-items-center me-3 mb-2">
                                    <div class="custom-radio">
                                        <input class="form-check-input me-3" type="radio" name="role"
                                            id="buyer" value="buyer">
                                        <label class="form-check-label" for="buyer">Buyer</label>
                                    </div>

                                </div>
                                <div class="d-flex align-items-center me-3 mb-2">
                                    <div class="custom-radio">
                                        <input class="form-check-input me-3" type="radio" name="role"
                                            id="borrower" value="borrower">
                                        <label class="form-check-label" for="borrower">Borrower</label>
                                    </div>

                                </div>
                                <div class="d-flex align-items-center me-3 mb-2">
                                    <div class="custom-radio">
                                        <input class="form-check-input me-3" type="radio" name="role"
                                            id="brokerInquiry" value="brokerInquiry">
                                        <label class="form-check-label" for="brokerInquiry">Broker Inquiry</label>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12 mb-3 statement-desc">
                                <div class="d-flex align-items-center me-3">
                                    <div class="custom-radio">
                                        <input class="form-check-input me-3" type="radio" name="role"
                                            id="seekingEmployment" value="seekingEmployment">
                                        <label class="form-check-label" for="seekingEmployment">Seeking Employment</label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="con_submit">
                            <button type="submit" class="btn btn-custom px-5 py-2">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Tips for Selling Your Business -->
            <div class="col-md-4">
                <div class="contact-right-part">
                    <h5 class="mb-3 fw-bold">How You Can Reach Us</h5>
                    <span class="contect-add">Address</span>
                    <ul class="list-unstyled tips-list">
                        <li>
                            <span class="text"></span> 2583 Morris Avenue <br>Union, New Jersey 07083
                        </li>
                    </ul>
                    <span class="contect-add">Phone</span>
                    <ul class="list-unstyled tips-list">
                        <li>
                            <span class="text"></span> T: 908.851.9040 <br>F: 908.851.9066
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#day_time_phone, #evening_phone, #cellular_phone').on('input', function() {
                this.value = this.value.replace(/\D/g, '');
            });
            $.validator.addMethod("regex", function(value, element, regexpr) {
                return this.optional(element) || regexpr.test(value); // Allows optional fields to be empty
            }, "Invalid phone number format.");
            var form = $('#contact-form');
            form.validate({
                rules: {
                    first_name: {
                        required: true
                    },
                    last_name: {
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
                    country: {
                        required: true
                    },
                    zip: {
                        required: true,
                        minlength: 5, // Minimum length for US ZIP code
                        maxlength: 10 // Maximum length for 9-digit ZIP code
                    },
                    day_time_phone: {
                        required: true,
                        regex: /^\d{10}$/
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    time_to_connect: {
                        required: true
                    }

                },
                messages: {
                    day_time_phone: {
                        required: 'Phone number is required.',
                        regex: 'Must be a valid phone number.'
                    },
                    evening_phone: {
                        regex: 'Must be a valid phone number.'
                    },
                    cellular_phone: {
                        regex: 'Must be a valid phone number.'
                    }
                },
                submitHandler: function(form) {
                    form.submit(); // Proceed with form submission if valid
                }
            });
        });
    </script>
    <style>
        a {
            text-decoration: none;
        }

        .link-danger {
            color: #AA1260;
        }

        /* Form Styling */
        .form-control,
        .form-select {
            border-radius: 0;
            border: 1px solid #ccc;
            padding: 10px 10px;
            font-size: 0.9rem;
            color: #555;
        }

        .btn-custom {
            background-color: #7F2149;
            color: #fff;
            margin-left: 170px;
            border: 1px;
            margin-top: 24px;
            border-radius: 1px;
            padding: 12px 60px !important;
        }

        .btn-custom:hover {
            background-color: #8A104E;
            color: #fff;
        }

        /* Tips Section */
        .tips-list {
            font-size: 0.95rem;
            line-height: 1.8;
            color: #555;
        }

        .tips-list li {
            margin-bottom: 15px;
            position: relative;
        }

        .check-icon {
            position: absolute;
            left: 0;
            top: 0;
            color: #AA1260;
            font-weight: bold;
            font-size: 1rem;
        }

        .Contact-text {
            margin-bottom: 40px;
            font-weight: 600;
        }

        .link-styled {
            color: #7F2149;
            /* Change link color to green */
            text-decoration: underline;
            /* Add underline to the link */
        }

        .col-md-8.border-right-contact {
            border-right: 1px solid #D9D9D9;
            padding-right: 50px;
        }

        .contact-right-part {
            padding-left: 50px;
            padding-top: 20px;
        }

        span.contect-add {
            font-weight: bold;
            padding-bottom: 15px;
            display: block;
        }

        .Ques-btn {
            color: #000000;
            margin-bottom: 20px;
        }

        .statement-desc label {
            color: #333333;
            margin-bottom: 10px;
        }

        .statement-desc .form-check-input[type=radio] {
            margin-top: -0.75em;
        }

        .form-control:focus::placeholder,
        .form-control:not(:placeholder-shown)::placeholder {
            font-size: 12px;
            transform: translateY(-10px);
            color: #007bff;
        }
    </style>
@endsection
