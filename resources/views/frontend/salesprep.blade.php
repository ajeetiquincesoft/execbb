@extends('frontend.layout.master')

@section('content')
    <!-- Breadcrumb Section -->
    <div class="breadcrumb-container py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('seller') }}">Sellers </a></li>
                    <li class="breadcrumb-item active"><a href="#">Preparing For The Sale</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- About us page no-14 HTML-->
    <div class="container my-7">
        <div class="content-box">
            <div class="row">
                <div class="about_EBB">
                    <h5 class="main-heading">Preparing For The Sale</h5>
                </div>
            </div>
            <div class="row px-3 px-md-5 ab_ebb">
                <!-- Main Content -->
                <div class="col-md-8 main-head">
                    <div class="Content-text">
                        <h3 class="section-heading">Knowing What to Expect</h3>
                        <p>Enlisting the help of qualified outsiders who are impartial and specialize in the different areas
                            of selling your business will save you both time and money.</p>
                        <p>EBB can guide you through process of selling businesses, which has essentially, three phases.</p>
                        <h3 class="section-heading">Step 1: Getting Ready</h3>
                        <p>Before you put your business on the market for sale, make sure it is salable by identifying and
                            solving any issues. Conduct a thorough examination of your company’s finances and liabilities,
                            as well as the market conditions. Consider hiring an independent third party to assess the
                            value. They can re-cast the financial statements and show true profitability and value to
                            determine a fair and accurate price.</p>
                        <h3 class="section-heading">Step 2: Finding Buyers</h3>
                        <p>Locating and then qualifying buyers is difficult. Confidentiality is an issue and screening is a
                            time-consuming process. First you will need to identify their objectives. Are they a first
                            time-buyers, experienced business owners, <a href="#"
                                style="color: #7F2149; text-decoration: underline;">investors</a> or <a href=""
                                style="color: #7F2149; text-decoration: underline;">corporate</a> buyers? Then you will need
                            to look into their background, check their references and assess their financial position.</p>
                        <h3 class="section-heading">Step 3: Negotiating and Closing the Deal</h3>
                        <p>Hundreds of points will be covered during negotiations such as terms of payment, employee
                            contracts, royalties, non-compete agreements and warrantees. Calling in the experts – lawyers,
                            accountants and investment bankers - early may protect you and ensure you end up with a deal
                            that is fair for all parties involved.</p>
                    </div>
                </div>
                <!-- Side Panel -->
                <div class="col-md-4" style="background-color: #F8F8F8;;">
                    <div class="Ebb-section-about">
                        <div class="boxes-button-section">
                            <div class="EBB-team-title">
                                <h5>Tips For Selling Your Business</h5>
                                <p>
                                <ul>
                                    <li>Put the Books in Order</li>
                                    <li>Determine the Value of the Business</li>
                                    <li>Continue to Manage the Business While Selling It</li>
                                    <li>Negotiate Effectively by Calling in an Expert</li>
                                </ul>
                                </p>
                            </div>
                        </div>
                        <div class="boxes-button-section">
                            <div class="EBB-team-title">
                                <h5>Ask the Experts to Sell Your Business</h5>
                                <p>EBB can <a href="{{ route('services') }}"
                                        style="color: #7F2149; text-decoration: underline;">guide you through the
                                        process</a> from business valuations to locating buyers.</p>
                            </div>
                        </div>
                        <div class="boxes-button-section">
                            <div class="EBB-team-title">
                                <h5><a href="{{ route('twelvepoints') }}" style="color: #806132;">EBB's 12 point process</a>
                                </h5>
                            </div>
                        </div>
                        <div class="boxes-button-section">
                            <div class="EBB-team-title">
                                <h5>Determining Fair Market Value</h5>
                                <p>Don't know how to set a price? Contact EBB for a <a href="{{ route('contact.us') }}"
                                        style="color: #7F2149; text-decoration: underline;">FREE valuation</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
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
