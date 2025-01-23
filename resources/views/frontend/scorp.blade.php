@extends('frontend.layout.master')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-container py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Buyers</a></li>
                <li class="breadcrumb-item"><a href="#">Tools</a></li>
                <li class="breadcrumb-item active"><a href="#">Business Organizations</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- About us page no-14 HTML-->
<div class="container my-7">
    <div class="content-box">
        <div class="row">
            <div class="about_EBB">
                <h5 class="main-heading">S Corporation</h5>
            </div>
        </div>
        <div class="row px-3 px-md-5 ab_ebb">
            <!-- Main Content -->
            <div class="col-md-8 main-head">
                <div class="Content-text question">
                    <h3 class="section-heading">S Corporation</h3>
                    <p>This information came from the State of <a href="https://www.nj.gov/Business.shtml" style="color: #7F2149; text-decoration: underline;" >New Jersey’s Web site</a>.
                        Check with your accountant, lawyer or small business advisor for the most current information or changes to the tax law for this type of business organization.</p>
                    <p>S Corporations pay a lower corporate tax rate and the shareholders report their pro rata share of S corporation income on their NJ individual income tax returns. The combined tax between the electing S Corporation and its shareholders generally will not exceed the 9% NJ Corporation Business Tax Rate. The rate is 7.5% for corporations with entire net income of $100,000 or less.</p>
                    <p>A corporation may elect to be a NJ S Corporation only if it meets ALL of these conditions:</p>
                    <p>- The corporation is registered as a NJ corporation or as a foreign
                        corporation authorized to do business in NJ by the Division of
                        Revenue's Business Services Bureau;</p>
                    <p>- The corporation is/will be a S Corporation pursuant to Section 1361
                        of the Federal Internal Revenue Code;</p>
                    <p>- Every shareholder of the corporation consents to the election and
                        the jurisdictional requirements as detailed in Part II of the NJ
                        S Corporation Election Form CBT-2553.</p>
                    <p>- The corporation consents to the election and the assumption of any
                        tax liabilities of any non-consenting shareholders who were not
                        initial shareholders as indicated in Part III of Form CBT-2553.</p>
                </div>
            </div>
            <!-- Side Panel -->
            <div class="col-md-4" style="background-color: #F8F8F8;;">
                <div class="Ebb-section-about">
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Accelerate Your Search</h5>
                            <p>Become an <a href="{{route('preferred.buyers.program')}}" style="color: #7F2149; text-decoration: underline;" >EBB Preferred Buyer</a> and benefit from our full services.</p>
                        </div>
                    </div>
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Phases of Buying a Business</h5>
                            <p>Before you start familiarize yourself with the <a href="{{route('busbuyphase')}}" style="color: #7F2149; text-decoration: underline;" >phases</a>.</p>
                        </div>
                    </div>
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Factors to Consider</h5>
                            <p>When buying a business, <a href="{{route('considerations')}}" style="color: #7F2149; text-decoration: underline;" >consider these factors</a>.</p>
                        </div>
                    </div>
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Secure Financing Through EBB</h5>
                            <p>Get the right terms and rate, work with our <a href="{{route('financing')}}" style="color: #7F2149; text-decoration: underline;" >mortgage specialists</a>.</p>
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
        color: #000;
    }

    .sub-title {
        margin-bottom: 40px;
        font-family: 'Mulish';
        color: #5D5D5D;
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

    .adove-logo {
        margin-top: 25px;
        display: block;
        max-width: 100%;
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