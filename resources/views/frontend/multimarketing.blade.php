@extends('frontend.layout.master')

@section('content')
    <!-- Breadcrumb Section -->
    <div class="breadcrumb-container py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('seller') }}">Sellers </a></li>
                    <li class="breadcrumb-item active"><a href="#">Multimarketing</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- About us page no-14 HTML-->
    <div class="container my-7">
        <div class="content-box">
            <div class="row">
                <div class="about_EBB">
                    <h5 class="main-heading">Multimarketing</h5>
                </div>
            </div>
            <div class="row px-3 px-md-5 ab_ebb">
                <!-- Main Content -->
                <div class="col-md-8 main-head">
                    <div class="Content-text">
                        <h3 class="section-heading">A Multi-level Marketing Program to Sell Your Business</h3>
                        <p>Each business that signs an exclusive listing agreement with EBB receives multi-level marketing
                            support that includes:</p>
                        <h3 class="section-heading">Internet Marketing</h3>
                        <p>EBB posts information about your business on its site and 15 affiliate sites. <a
                                href="javascript:void(0);" style="color: #7F2149; text-decoration: underline;"
                                class="businessList">Example</a></p>
                        <h3 class="section-heading">E-Mail Blasts</h3>
                        <p>EBB e-mails investors and pre-qualified, registered buyers who are looking for a particular type
                            of business.</p>
                        <h3 class="section-heading">Telemarketing</h3>
                        <p>EBB calls in-house investors and similar and complimentary type of businesses to determine if any
                            prospects are interested in acquiring a business or expanding an existing business.</p>
                        <h3 class="section-heading">Newspaper Ads</h3>
                        <p>EBB runs ads in both local and trade papers.</p>
                        <h3 class="section-heading">Flyers & Post Cards</h3>
                        <p>EBB mails flyers and post cards to similar and complementary businesses.</p>
                        <h3 class="section-heading">Business Brokers Networking</h3>
                        <p>EBB distributes information about your business to other key business brokerage companies.</p>
                        <h3 class="section-heading">Updates & Status Reports</h3>
                        <p>EBB sends monthly status reports to you detailing our progress and
                            lists of pending prospects and inquiries.</p>
                        <p>Much of the information in your business listing – the financial details, specifics on revenue
                            and inventory - is sensitive in nature. That is why we only share this type of information with
                            qualified candidates who have signed confidentiality agreements.</p>
                    </div>
                </div>
                <!-- Side Panel -->
                <div class="col-md-4" style="background-color: #F8F8F8;;">
                    <div class="Ebb-section-about">
                        <div class="boxes-button-section">
                            <div class="EBB-team-title">
                                <h5>Sell It Through EBB</h5>
                                <p><a href="{{ route('list.with.ebb') }}"
                                        style="color: #7F2149; text-decoration: underline;">List</a> your business with
                                    EBB..</p>
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
                                <h5>
                                    <a href="{{ route('message') }}" style="color: #806132; text-decoration: underline;">A
                                        Message</a>
                                    from EBB's President Larry Bodner
                                </h5>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.businessList').on('click', function() {
                var pdfPath = '/images/Example_Business_Listing.jpg';
                window.open(pdfPath, '_blank');
            });

        });
    </script>
@endsection
