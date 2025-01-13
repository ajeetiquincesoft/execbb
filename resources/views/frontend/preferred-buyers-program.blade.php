@extends('frontend.layout.master')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-container py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active"><a href="#">Preferred Buyers Program</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- About us page no-14 HTML-->
<div class="container my-7">
    <div class="content-box">
        <div class="row">
            <div class="about_EBB">
                <h5 class="main-heading">Preferred Buyers Program</h5>
            </div>
        </div>
        <div class="row px-3 px-md-5 mt-0 mt-md-5 ab_ebb">
            <!-- Main Content -->
            <div class="col-md-8 main-head">
                <div class="Content-text">
                    <h3 class="section-heading">Find a Business Faster</h3>
                    <p>The Preferred Buyer Program is for buyers who are serious and motivated. Instead of coming into our office to sign the standard agreements once qualified, you gain online access to EBB’s full services and listings to help you find the right business faster.</p>
                    <h3 class="section-heading mt-5">Matchmaker</h3>
                    <p>When you register, you are asked to identify key factors, such as location, business type, price, and down payment. Our proprietary software generates a list of businesses that matches your criteria.</p>
                    <h3 class="section-heading mt-5">Access Detailed Information Online</h3>
                    <p>Once you have signed a confidentiality agreement, you will have 24/7 access to <a href="#" class="sellorgive">business profiles</a>, which includes the business’ name, its address, photographs and financial information</p>
                    <h3 class="section-heading mt-5">Receive Information First</h3>
                    <p>Instead of checking with us, you will automatically receive monthly reports and new <a href="{{route('business.listings')}}" class="sellorgive" target="_blank">business listings</a>, changes and updates as they occur via E-mail.</p>
                    <h3 class="section-heading mt-5">Your Registration Fee is Refundable</h3>
                    <p>Registration fees for the Preferred Buyer Program are refundable when you buy a business through EBB.</p>
                    <h3 class="section-heading mt-5">Register Now!</h3>
                    <p><a href="{{route('register.with.ebb')}}" class="sellorgive" taget="_blank">1 Month for $69.00</a></p>
                    <p><a href="{{route('register.with.ebb')}}" class="sellorgive" taget="_blank">3 Months for $150.00</a></p>
                    <p><a href="{{route('register.with.ebb')}}" class="sellorgive" taget="_blank">6 Months for $250.00</a></p>
                  </div>
            </div>
            <!-- Side Panel -->
            <div class="col-md-4" style="background-color: #F8F8F8;;">
                <div class="Ebb-section-about">
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5><p><a href="#" style="color: #7F2149; text-decoration: underline;">A Message</a>
                              from EBB's President Larry Bodner</p></h5>
                        </div>
                    </div>
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Secure Financing Through EBB</h5>
                        </div>
                    </div>
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <p>Get the right terms and rate, work with our <a href="{{route('financing')}}" style="color: #7F2149; text-decoration: underline;" target="_blank">mortgage specialists.</a></p>
                        </div>
                    </div>
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Factors to Consider</h5>
                        </div>
                    </div>
                    <div class="boxes-button-section">
                      <div class="EBB-team-title">
                          <p>When buying a business,<a href="#" style="color: #7F2149; text-decoration: underline;">consider these factors.</a></p>
                      </div>
                  </div>
                </div>
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

    .content-box {
        background-color: #FFFFFF;
        padding: 30px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .main-heading {
        font-size: 20px;
        font-weight: bold;
        font-family: Urbanist;
        margin-bottom: 20px;
        color: #000;
        border-bottom: 1px solid #B3B3B3;
        padding-bottom: 30px;
        margin-left: 10px;
        margin-right: 10px;
    }

    .sub-heading {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 40px;
        color: #000;
    }

    .section-heading {
        font-size: 20px;
        font-weight: bold;
        color: #000;
        font-family: 'Urbanist';
    }

    .side-panel {
        height: 590px;
        width: 390px;
        margin-top: 40px;
        margin-left: -80px;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        border: 16px solid #F8F8F8;
    }

    .side-panel a {
        color: #7F2149;
    }

    .side-panel a:hover {
        text-decoration: underline;
    }

    .ibba-logo {
        margin-top: 25px;
        display: block;
        max-width: 100%;
        height: 40px;
        margin: 20px;
    }

    .ab_ebb p {
        font-size: 14px;
        color: #5D5D5D;
        line-height: 22px;
    }

    .Content-text {
        margin-right: 80px;
        font-family: 'Mulish', sans-serif;
        color: #5D5D5D;
    }

    .about_EBB {
        text-align: center;
    }

    .boxes-button-section {
        background: #FFFFFF;
        padding: 12px;
        margin-bottom: 12px;
        margin-top: 12px;
    }

    .EBB-team-title h5 {
        font-weight: bold;
        color: #806132;
        font-family: Mulish;
    }

    .EBB-team-title {
        padding-top: 16px;
        padding-left: 16px;
    }
</style>
@endsection