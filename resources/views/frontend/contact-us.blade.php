@extends('frontend.layout.master')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-container py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active"><a href="#">Contact Us</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- Main Container -->
<div class="container my-5 container-padding contact-us">
    <div class="row">
        <!-- Contact Information Form -->
        <div class="col-md-8 border-right-contact">
            <h1 class="Contact-text">Contact Information</h1>
            <div class="form-text">
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
                    <div class="mb-3">
                        <select class="form-select">
                            <option selected disabled>Best Time to Contact</option>
                            <option value="Morning">Morning</option>
                            <option value="Afternoon">Afternoon</option>
                            <option value="Evening">Evening</option>
                        </select>
                    </div>
                    <div class="mb-5 custom-input">
                        <textarea class="form-control custom-textarea" rows="4" placeholder="Message"></textarea>
                    </div>
                    <div class="Ques-btn">
                        <h6 class="fw-bold">Which Statement Describes you?*</h6>
                    </div>
                    <div class="row">
                        <!-- Radio Button Group 1 -->
                        <div class="col-12 d-flex statement-desc">
                            <div class="d-flex align-items-center me-3">
                                <label class="form-check-label me-3" for="seller">Seller</label>
                                <input class="form-check-input" type="radio" name="role" id="seller" value="seller">
                            </div>
                            <div class="d-flex align-items-center me-3">
                                <label class="form-check-label me-3" for="buyer">Buyer</label>
                                <input class="form-check-input" type="radio" name="role" id="buyer" value="buyer">
                            </div>
                            <div class="d-flex align-items-center me-3">
                                <label class="form-check-label me-3" for="borrower">Borrower</label>
                                <input class="form-check-input" type="radio" name="role" id="borrower" value="borrower">
                            </div>
                            <div class="d-flex align-items-center me-3">
                                <label class="form-check-label me-3" for="brokerInquiry">Broker Inquiry</label>
                                <input class="form-check-input" type="radio" name="role" id="brokerInquiry" value="brokerInquiry">
                            </div>
                        </div>
                        <div class="col-12 mb-3 statement-desc">
                            <div class="d-flex align-items-center me-3">
                                <label class="form-check-label me-3" for="seekingEmployment">seekingEmployment</label>
                                <input class="form-check-input" type="radio" name="role" id="seekingEmployment" value="seekingEmployment">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-custom px-5 py-2">Submit</button>
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
<style>
    .breadcrumb-container {
        background-color: #F8F8F8;
    }

    .breadcrumb-item a {
        text-decoration: none;
        color: #333333;
    }

    .breadcrumb-item.active {
        color: #333333;
    }

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
        padding: 16px;
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
</style>
@endsection