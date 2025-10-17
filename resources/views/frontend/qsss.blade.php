@extends('frontend.layout.master')

@section('content')
    <!-- Breadcrumb Section -->
    <div class="breadcrumb-container py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('ebb.buyers') }}">Buyers</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('buyer.tools') }}">Tools</a></li>
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
                    <h5 class="main-heading">Qualified Subchapter S Subsidiary</h5>
                </div>
            </div>
            <div class="row px-3 px-md-5 ab_ebb">
                <!-- Main Content -->
                <div class="col-md-8 main-head">
                    <div class="Content-text question">
                        <h3 class="section-heading">Qualified Subchapter S Subsidiary</h3>
                        <p>This information came from the State of <a href="https://www.nj.gov/Business.shtml"
                                style="color: #7F2149; text-decoration: underline;">New Jersey’s Web site</a>.
                            Check with your accountant, lawyer or small business advisor for the most current information or
                            changes to the tax law for this type of business organization.</p>
                        <p>Under The Small Business Job Protection Act of 1996, an
                            S Corporation is permitted to own a Qualified Subchapter S Subsidiary (QSSS) and effectively
                            treat the subsidiary as if it were a division. The assets, liabilities, and items of income,
                            deduction and credit would flow through to the parent retaining the same character.</p>
                        <p>To obtain recognition as a NJ QSSS, companies must file the revised <a href="#"
                                style="color: #7F2149; text-decoration: underline;">form CBT-2553</a> along with a copy of
                            <a href="#" style="color: #7F2149; text-decoration: underline;">Federal Form 966</a>
                            before the 16th day of the fourth month of the first tax year the election is to take place.
                        </p>
                        <p>To maintain the separate entity principle, every qualified NJ QSSS must <a href="#"
                                style="color: #7F2149; text-decoration: underline;">file a CBT-100S</a> and pay the minimum
                            tax of $200. Unless the NJ QSSS formally dissolves or withdraws with the Division of Revenue,
                            Business Services Bureau, it will be required to file report with the NJ Division of Revenue and
                            a <a href="#" style="color: #7F2149; text-decoration: underline;">Corporation Business Tax
                                Return</a>.</p>
                        <p>The parent corporation must consent to taxation by NJ by <a href="#"
                                style="color: #7F2149; text-decoration: underline;">filing a CBT-100</a> or <a
                                href="#" style="color: #7F2149; text-decoration: underline;">CBT-100S</a> which
                            includes the QSSS’s assets, liabilities, income, and expenses. The property, receipts, and
                            payroll of the QSSS must be included in the parent corporation's allocation factor. Failure of
                            the parent corporation to either consent/file a CBT-100/CBT-100S for a period will result in
                            denial of status and the subsidiary will be subject to taxation in NJ as a <a
                                href="{{ route('ccorp') }}" style="color: #7F2149; text-decoration: underline;">C
                                Corporation</a>.</p>
                    </div>
                </div>
                <!-- Side Panel -->
                <div class="col-md-4" style="background-color: #F8F8F8;;">
                    <div class="Ebb-section-about">
                        <div class="boxes-button-section">
                            <div class="EBB-team-title">
                                <h5>Accelerate Your Search</h5>
                                <p>Become an <a href="{{ route('preferred.buyers.program') }}"
                                        style="color: #7F2149; text-decoration: underline;">EBB Preferred Buyer</a> and
                                    benefit from our full services.</p>
                            </div>
                        </div>
                        <div class="boxes-button-section">
                            <div class="EBB-team-title">
                                <h5>Phases of Buying a Business</h5>
                                <p>Before you start familiarize yourself with the <a href="{{ route('busbuyphase') }}"
                                        style="color: #7F2149; text-decoration: underline;">phases</a>.</p>
                            </div>
                        </div>
                        <div class="boxes-button-section">
                            <div class="EBB-team-title">
                                <h5>Factors to Consider</h5>
                                <p>When buying a business, <a href="{{ route('considerations') }}"
                                        style="color: #7F2149; text-decoration: underline;">consider these factors</a>.</p>
                            </div>
                        </div>
                        <div class="boxes-button-section">
                            <div class="EBB-team-title">
                                <h5>Secure Financing Through EBB</h5>
                                <p>Get the right terms and rate, work with our <a href="{{ route('financing') }}"
                                        style="color: #7F2149; text-decoration: underline;">mortgage specialists</a>.</p>
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
