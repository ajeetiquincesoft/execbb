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
                    <h5 class="main-heading">Limited Liability Company</h5>
                </div>
            </div>
            <div class="row px-3 px-md-5 ab_ebb">
                <!-- Main Content -->
                <div class="col-md-8 main-head">
                    <div class="Content-text question">
                        <h3 class="section-heading">Limited Liability Company</h3>
                        <p>This information came from the State of <a href="https://www.nj.gov/Business.shtml"
                                style="color: #7F2149; text-decoration: underline;">New Jersey’s Web site</a>.
                            Check with your accountant, lawyer or small business advisor for the most current information or
                            changes to the tax law for this type of business organization.</p>
                        <p>The NJ Limited Liability Company (LLC) Act, N.J.S.A. 42:2b-1, provides for the establishment of
                            LLCs in NJ. To form a LLC a Certificate of Formation is filed with the <a
                                href="https://www.nj.gov/treasury/revenue/"
                                style="color: #7F2149; text-decoration: underline;">Division of Revenue</a>. It should
                            include:</p>
                        <p>- LLC’s name, the registered agent’s name and address, and the
                            registered office address.</p>
                        <p>- Latest date of dissolution, if applicable.</p>
                        <p>- A statement that the LLC has 1+ members, and may stipulate that
                            the entity will be formed at any date/time after filing the certificate
                            of formation.</p>
                        <p>LLCs are a separate legal entity and can continue until cancellation of the LLC's certificate of
                            formation. Foreign LLCs must register with the Division of Revenue before conducting business in
                            NJ.</p>
                        <p>Typically LLCs are governed by an operating or other written agreement that sets forth details
                            relating to membership, including relative rights, powers, and duties (e.g., voting). It may
                            also indicate the LLC is headed by a manager and may even provide for classes/groups of members
                            in the manner established in the operating agreement.</p>
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
