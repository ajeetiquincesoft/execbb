@extends('frontend.layout.master')

@section('content')
    <!-- Breadcrumb Section -->
    <div class="breadcrumb-container py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">About EBB</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('join.ebb') }}">Join EBB</a></li>
                    <li class="breadcrumb-item active"><a href="#">Job Description</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- About us page no-14 HTML-->
    <div class="container my-7">
        <div class="content-box">
            <div class="row">
                <div class="about_EBB">
                    <h5 class="main-heading">Job Description</h5>
                </div>
            </div>
            <div class="row px-3 px-md-5 mt-2 mt-md-5 ab_ebb">
                <!-- Main Content -->
                <div class="col-md-8 main-head">
                    <div class="Content-text">
                        <h3 class="section-heading-join mb-4">Conduits For Change</h3>
                        <p class="join_us_p">The business broker comes into contact with both buyers and sellers. Each has
                            their own reason for buying or selling a business. A buyer’s motivation may be financial
                            freedom, flexibility or empowerment, while a seller could be retiring, have fallen ill or
                            experienced a breakup in their marriage or their business partnership.</p>
                        <p class="join_us_p"><a href="https://www.finetimepieces.net/" class="sellorgive">replica
                                watches</a> It is the role of the business broker to help these individuals experience a
                            smooth transfer of ownership. As an intermediary, they identify the businesses for sale in a
                            marketing area and enter into listing agreements with sellers. In addition, business brokers
                            help buyers find the businesses that meet their requirements, then help them make an informed
                            decision as to which business is right for them.</p>
                        <p class="join_us_p">Bringing buyers and sellers together can be very rewarding. It also pays well!
                            Business brokers work with the business owner, accountants, attorneys, landlords and bankers.
                            For this service, a <a href="{{ route('compensation') }}" class="sellorgive">broker’s fee</a> is
                            paid by the seller of the business upon closing on the transaction.</p>
                        <p class="join_us_p">If you are interested in talking to us about becoming an EBB business broker,
                            <a href="https://www.finetimepieces.net/breitling.html" class="sellorgive">Breitling Replica
                                Watches</a> we encourage you to <a href="#" class="sellorgive">send us your résumé</a>
                            or <a href="{{ route('contact.us') }}" class="sellorgive">contact us</a>.
                        </p>
                    </div>
                </div>
                <!-- Side Panel -->
                <div class="col-md-4" style="background-color: #F8F8F8;;">
                    <div class="Ebb-section-about">
                        <div class="boxes-button-section">
                            <div class="EBB-team-title">
                                <h5>Join the EBB Team</h5>
                                <p>Our strength is our brokers. Learn how you can <a href="{{ route('join.ebb') }}"
                                        style="color: #7F2149; text-decoration: underline;">become part of our all-star
                                        team</a> .</p>
                            </div>

                        </div>
                        <div class="boxes-button-section">
                            <div class="EBB-team-title">
                                <h5>Become a Broker</h5>
                                <ul class="list-unstyled tips-list-join">
                                    <li>
                                        <i class="bi bi-check-circle-fill text-purple"></i> High Commissions
                                    </li>
                                    <li>
                                        <i class="bi bi-check-circle-fill text-purple"></i> Be Your Own Boss
                                    </li>
                                    <li>
                                        <i class="bi bi-check-circle-fill text-purple"></i> Set Your Own Hours
                                    </li>
                                    <li>
                                        <i class="bi bi-check-circle-fill text-purple"></i> Remotely access our Buyers &
                                        Sellers Database
                                    </li>
                                    <li>
                                        <i class="bi bi-check-circle-fill text-purple"></i> Obtain a Steady Supply of Buyer
                                        Leads
                                    </li>
                                    <li>
                                        <i class="bi bi-check-circle-fill text-purple"></i> Receive Full Training & Support
                                        Programs
                                    </li>
                                    <li>
                                        <i class="bi bi-check-circle-fill text-purple"></i> Benefit from a State-of-the-Art
                                        Facility & Technology
                                    </li>
                                    <li>
                                        <i class="bi bi-check-circle-fill text-purple"></i> Work on the Deals that Make
                                        Sense To You
                                    </li>
                                </ul>
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
            margin-bottom: 40px;
            color: #000;
        }

        .section-heading-join {
            font-size: 30px;
            font-weight: bold;
            color: #806132;
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
            padding: 0px 15px;
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

        .Content-text span {
            font-weight: bold;
        }

        .text-purple {
            color: #7F2149;
            margin-right: 10px;
        }

        .EBB-team-title ul li {
            margin: 20px 0px;
            font-family: 'Mulish';
            font-size: 14px;
        }

        p.join_us_p {
            font-family: 'Urbanist' !important;
        }
    </style>
@endsection
