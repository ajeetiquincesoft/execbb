@extends('frontend.layout.master')

@section('content')
    <!-- Breadcrumb Section -->
    <div class="breadcrumb-container py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Sell a Business
                        </a></li>
                    <li class="breadcrumb-item active"><a href="#">Seller Resource</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container my-7">
        <div class="content-box">
            <div class="row">
                <div class="about_EBB">
                    <h5 class="main-heading">Resources</h5>
                    <!-- <h6 class="sub-heading">Executive Business Brokers - A Large, Active Business Brokerage Firm</h6> -->
                </div>
            </div>
            <div class="row px-3 px-md-5">
                <!-- Main Content -->
                <div class="col-md-8 main-head">
                    <div class="Content-text">
                        <h3 class="section-heading">Books </h3>
                        <div class="container my-5">
                            <div class="row g-4">
                                <div class="col-12 col-md-4">
                                    <a href="https://www.amazon.com/exec/obidos/ASIN/0028629035/executivebu0f-20"><img
                                            src="{{ asset('assets/images/image_1.jpg') }}" alt="Image 1"
                                            class="seller_resource_img"></a>
                                </div>
                                <div class="col-12 col-md-4">
                                    <a href="https://www.amazon.com/exec/obidos/ASIN/1574100874/executivebu0f-20"><img
                                            src="{{ asset('assets/images/image_2.jpg') }}" alt="Image 2"
                                            class="seller_resource_img"></a>
                                </div>
                                <div class="col-12 col-md-4">
                                    <a href="https://www.amazon.com/exec/obidos/ASIN/0965657833/executivebu0f-20"><img
                                            src="{{ asset('assets/images/image_8.jpg') }}" alt="Image 2"
                                            class="seller_resource_img"></a>
                                </div>
                            </div>
                        </div>
                        <div class="container my-5">
                            <div class="row g-4">
                                <div class="col-12 col-md-4">
                                    <a href="https://www.amazon.com/exec/obidos/ASIN/1558507027/executivebu0f-20"><img
                                            src="{{ asset('assets/images/image_4.jpg') }}" alt="Image 1"
                                            class="seller_resource_img"></a>
                                </div>
                                <div class="col-12 col-md-4">
                                    <a href="https://www.amazon.com/exec/obidos/ASIN/1580620051/executivebu0f-20"><img
                                            src="{{ asset('assets/images/image_6.jpg') }}" alt="Image 3"
                                            class="seller_resource_img"></a>
                                </div>
                                <div class="col-12 col-md-4">
                                    <a href="https://www.amazon.com/exec/obidos/ASIN/0471150479/executivebu0f-20"><img
                                            src="{{ asset('assets/images/image_7.jpg') }}" alt="Image 1"
                                            class="seller_resource_img"></a>
                                </div>
                            </div>
                        </div>
                        <h3 class="section-heading">Government Agencies </h3>
                        <p><a href="https://www.nj.gov/treasury/revenue/dcr/geninfo/corpman.html"
                                style="color: #7F2149; text-decoration: underline;">NJ Business Entity Filings</a></p>
                        <p><a href="https://www.nj.gov/commerce/" style="color: #7F2149; text-decoration: underline;">NJ
                                Department of Commerce</a></p>
                        <p><a href="https://www.nj.gov/treasury/revenue/"
                                style="color: #7F2149; text-decoration: underline;">NJ Division of Revenue</a></p>
                        <p><a href="https://www.ftc.gov/" style="color: #7F2149; text-decoration: underline;">Federal Trade
                                Commission</a></p>
                        <p><a href="http://www.irs.ustreas.gov/" style="color: #7F2149; text-decoration: underline;">IRS</a>
                        </p>
                        <p><a href="http://www.sbaonline.sba.gov/" style="color: #7F2149; text-decoration: underline;">Small
                                Business Administration
                            </a></p>
                    </div>
                </div>
                <!-- Side Panel -->
                <div class="col-md-4" style="background-color: #F8F8F8;;">
                    <div class="Ebb-section-about">
                        <div class="boxes-button-section">
                            <div class="EBB-team-title">
                                <h5>Ask the Experts to Sell Your Business</h5>
                            </div>
                            <p>EBB can <a href="{{ route('services') }}" class="sellorgive">guide you through the
                                    process</a> from business valuations to locating buyers.</p>
                        </div>
                        <div class="boxes-button-section">
                            <div class="EBB-team-title">
                                <h5 id="openWindowCalculator">Mortgage Calculator</h5>
                            </div>
                        </div>
                        <div class="boxes-button-section">
                            <div class="EBB-team-title">
                                <h5>Tips For Selling Your Business</h5>
                            </div>
                            <ul>
                                <li>
                                    <p>Put the Books in Order</p>
                                </li>
                                <li>
                                    <p>Determine the Value of the Business</p>
                                </li>
                                <li>
                                    <p>Continue to Manage the Business While Selling It</p>
                                </li>
                                <li>
                                    <p>Negotiate Effectively by Calling in an Expert</p>
                                </li>
                            </ul>
                        </div>
                        <div class="boxes-button-section">
                            <div class="EBB-team-title">
                                <h5>
                                    <p><a href="{{ route('message') }}"
                                            style="color: #7F2149; text-decoration: underline;">A Message</a>
                                        from EBB's President Larry Bodner</p>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        a {
            text-decoration: none;
        }

        .sub-heading {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #000;
        }

        .section-heading {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
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

        p {
            font-size: 14px;
            line-height: 1.4;
        }

        .Content-text {
            font-family: 'Mulish', sans-serif;
            color: #5D5D5D;
        }

        .about_EBB {
            text-align: center;
        }

        .boxes-button-section {
            margin: 9px;
            background: #FFFFFF;
            padding: 12px;
            margin-bottom: 20px;
            margin-top: 20px;
        }

        .EBB-team-title {
            color: #806132;
            font-family: Mulish;
        }

        .seller_resource_img {
            width: 100%;
            height: 150px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h5#openWindowCalculator {
            cursor: pointer;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#openWindowCalculator').click(function() {
                window.open("{{ route('calculate.mortgage.form') }}", 'newWindow',
                    'width=700,height=500,scrollbars=yes,resizable=yes');
            });
        });
    </script>
@endsection
