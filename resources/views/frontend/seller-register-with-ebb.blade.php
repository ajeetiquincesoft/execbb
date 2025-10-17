@extends('frontend.layout.master')

@section('content')
    <!-- Breadcrumb Section -->
    <div class="breadcrumb-container py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Sell a Business</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('open-list.with.ebb') }}">Open List With EBB</a></li>
                    <li class="breadcrumb-item active"><a href="#">Sign Up</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Main Container -->
    <div class="container my-5 container-padding">
        <div class="row">
            <!-- Contact Information Form -->
            <div class="col-md-8 border-right-contact">
                <h1 class="Contact-text">Contact Information</h1>
                <div class="text-muted">
                    <p class="text-muted">
                        Sign up now to list your business exclusively with Executive Business Brokers <br>
                        or <a href="#" class="link-styled">print out our agreement</a>.
                    </p>
                </div>
                <form>
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" placeholder="First Name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" placeholder="Last Name">
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Mailing Address">
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" placeholder="City/Town">
                        </div>
                        <div class="col-md-6 mb-3">
                            <select class="form-select">
                                <option selected disabled>State</option>
                                <option value="1">State 1</option>
                                <option value="2">State 2</option>
                                <option value="3">State 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" placeholder="County">
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" placeholder="Zip Code">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 mb-3">
                            <input type="text" class="form-control" placeholder="Day Time Phone">
                        </div>
                        <div class="col-md-4 mb-3">
                            <input type="text" class="form-control" placeholder="Evening Phone">
                        </div>
                        <div class="col-md-4 mb-3">
                            <input type="text" class="form-control" placeholder="Cellular Phone">
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" placeholder="Email Address">
                    </div>
                    <small class="text-muted d-block mb-3">
                        You must enter a valid email address to activate your account. <br>
                        <span class="link-styled">We will never sell or give your email address away.</span>
                    </small>
                    <div class="mb-3">
                        <select class="form-select">
                            <option selected disabled>Best Time to Contact</option>
                            <option value="Morning">Morning</option>
                            <option value="Afternoon">Afternoon</option>
                            <option value="Evening">Evening</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-custom px-5 py-2">Submit</button>
                </form>
            </div>
            <div class="col-md-4">
                <div class="contact-right-part">
                    <h5 class="mb-3 fw-bold">Tips For Selling Your Business</h5>
                    <hr>
                    <ul class="list-unstyled tips-list">
                        <li>
                            <i class="bi bi-check-circle-fill text-purple"></i> Organize your books and finances to prepare
                            to sell
                            <hr>
                        </li>
                        <li>
                            <i class="bi bi-check-circle-fill text-purple"></i> Determine the Value of the Business
                            <hr>
                        </li>
                        <li>
                            <i class="bi bi-check-circle-fill text-purple"></i> Continue to Manage the Business While
                            Selling It
                            <hr>
                        </li>
                        <li>
                            <i class="bi bi-check-circle-fill text-purple"></i> Negotiate Effectively by Calling in an
                            Expert
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
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

        .Contact-text {
            margin-bottom: 10px;
            font-weight: 600;
        }

        .text-muted {
            font-size: 13px;
        }

        .link-styled {
            color: #7F2149;
            /* Change link color to green */
            text-decoration: underline;
            /* Add underline to the link */
        }

        .form-text {
            width: 560px;
        }

        .text-purple {
            color: #7F2149;
            /* Replace with your desired purple color */
        }

        hr {
            border: none;
            border-top: 1px solid #B3B3B3;
            /* Purple color */
            margin-bottom: 20px;
            /* Adjust spacing */
        }

        .col-md-8.border-right-contact {
            border-right: 1px solid #D9D9D9;
            padding-right: 50px;
        }

        .contact-right-part {
            padding-left: 50px;
            padding-top: 20px;
        }
    </style>
@endsection
