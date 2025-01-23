@extends('frontend.layout.master')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-container py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Sellers </a></li>
                <li class="breadcrumb-item active"><a href="#">Seller Information</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- About us page no-14 HTML-->
<div class="container my-7">
    <div class="content-box">
        <div class="row">
            <div class="about_EBB">
                <h5 class="main-heading">Seller Information</h5>
            </div>
        </div>
        <div class="row px-3 px-md-5 ab_ebb">
            <!-- Main Content -->
            <div class="col-md-8 main-head">
                <div class="Content-text question">
                    <h3 class="section-heading">Pertinent Business Information in the Listing</h3>
                    <p>EBB’s sales materials are based on this type of information, which is provided to us by the seller:</p>
                    <p>- Historical federal tax returns, financial statements and balance sheets going back 3 years</p>
                    <p>- Year-to-date financial statement and balance sheet</p>
                    <p>- Detailed list of fixtures and equipment included in the sale</p>
                    <p>- Detailed list of inventory included in the sale</p>
                    <p>- Site survey and appraisal for the real estate, if available and applicable</p>
                    <p>- Photographs of the facility</p>
                    <p>- Breakdown of sales by customer & products/services</p>
                    <p>- Breakdown of accounts receivable by customer, amount and by aging</p>
                    <p>- Detailed list of contract obligations the buyer may have to assume</p>
                    <p>- Copy of premises lease</p>
                    <p>Much of the information in your business listing – the financial details, specifics on revenue and inventory - is sensitive in nature. That is why we only share this type of information with qualified candidates who have signed confidentiality agreements.</p>

                </div>
            </div>
            <!-- Side Panel -->
            <div class="col-md-4" style="background-color: #F8F8F8;;">
                <div class="Ebb-section-about">
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Tips For Selling Your Business</h5>
                            <ul>
                                <li>Put the Books in Order</li>
                                <li>Determine the Value of the Business</li>
                                <li>Continue to Manage the Business While Selling It</li>
                                <li>Negotiate Effectively by Calling in an Expert</li>
                            </ul>
                        </div>
                    </div>
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Ask the Experts to Sell Your Business</h5>
                            <p>EBB can <a href="{{route('services')}}" style="color: #7F2149; text-decoration: underline;" >guide you through the process</a> from business valuations to locating buyers.</p>
                        </div>
                    </div>
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>10 Questions to Ask</h5>
                            <p>Considering a business broker? <a href="{{route('questions')}}" style="color: #7F2149; text-decoration: underline;" >Ask the right questions</a> when you interview prospective brokers.</p>
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