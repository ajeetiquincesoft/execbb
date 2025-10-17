@extends('frontend.layout.master')

@section('content')
    <!-- Breadcrumb Section -->
    <div class="breadcrumb-container py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('seller') }}">Sellers </a></li>
                    <li class="breadcrumb-item active"><a href="#">Evaluating Brokers</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- About us page no-14 HTML-->
    <div class="container my-7">
        <div class="content-box">
            <div class="row">
                <div class="about_EBB">
                    <h5 class="main-heading">Questions</h5>
                </div>
            </div>
            <div class="row px-3 px-md-5 ab_ebb">
                <!-- Main Content -->
                <div class="col-md-8 main-head">
                    <div class="Content-text question">
                        <h3 class="section-heading">Assessing Business Brokers</h3>
                        <p>If you are considering a business broker to help you sell your business, you should spend some
                            time assessing whether they are knowledgeable, professional and experienced.</p>
                        <p>EBB suggests you interview at least 2 brokers and ask these questions:</p>
                        <p>1. How long has your company been in business?</p>
                        <p>2. How many sales associates does your company have?</p>
                        <p>3. What is your company’s website address?</p>
                        <p>4. Has your company sold businesses like mine?</p>
                        <p>5. Is business brokerage your company’s specialty?</p>
                        <p>6. Can I make an appointment to visit your office?</p>
                        <p>7. Can I have a list of references to call and copy of your company’s Brochure?</p>
                        <p>8. Are you affiliated with any business brokerage associations or groups?</p>
                        <p>9. How will you market my business? Do you use the internet to sell businesses?</p>
                        <p>10. How often will I receive a progress report?</p>
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
@endsection
