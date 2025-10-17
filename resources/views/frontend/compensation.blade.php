@extends('frontend.layout.master')

@section('content')
    <!-- Breadcrumb Section -->
    <div class="breadcrumb-container py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">About EBB</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('join.ebb') }}">Join EBB</a></li>
                    <li class="breadcrumb-item active"><a href="#">Compensation</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- About us page no-14 HTML-->
    <div class="container my-7">
        <div class="content-box">
            <div class="row">
                <div class="about_EBB">
                    <h5 class="main-heading">Compensation</h5>
                </div>
            </div>
            <div class="row px-3 px-md-5 mt-2 mt-md-5 ab_ebb">
                <!-- Main Content -->
                <div class="col-md-8 main-head">
                    <div class="Content-text">
                        <h3 class="section-heading-join mb-4">Business Brokers are Well Compensated</h3>
                        <p class="join_us_p">The earning potential for a motivated business broker is unlimited. Individuals
                            who <a href="{{ route('qualifications') }}" class="sellorgive">fit the profile</a>, as well as
                            possess strong interpersonal skills and the desire to work hard - can succeed as a business
                            broker.</p>
                        <p class="join_us_p">Executive Business Brokers (EBB) receives a 10% commission on the total selling
                            price. Our minimum success fee is set at $12,500.00. The listing and selling agents each receive
                            25% of the total commission
                            collected as compensation. When the listing agent is also the selling agent, the payout is 50%.
                        </p>
                        <p class="join_us_p">EBB concentrates on the small to mid-sized segment of the market. These
                            companies are retail, wholesale & distribution, manufacturing, services and franchises. Their
                            annual sales volumes are under $10M and their sale price ranges from $100K to $5M+.</p>
                        <p class="join_us_p">This is a straight commission opportunity. EBB Business Brokers are independent
                            contractors (1099), who set their own hours, work on their own territories and within the
                            industries they are most comfortable.
                            Most of our business brokers work only on those transactions that make sense to them and we
                            support their efforts.</p>
                        <p class="join_us_p">EBB employs the latest technologies to ensure their success. We also provide
                            valuable marketing and administrative support. Our business brokers receive a steady supply of
                            buyer leads from us and have
                            remote access to our proprietary database of over 20K buyers and 100’s of business listings.</p>
                        <p class="join_us_p">Generally there is a learning curve and typically a new broker will not begin
                            to see any commissions for a minimum of 90 days. Successful brokers who achieve the goals
                            outlined in EBB's New Agent's Business Plan, designed to help brokers set and reach income
                            objectives, will begin to generate new deals monthly.</p>
                        <p class="join_us_p">If you are interested in talking to us about becoming an EBB business broker,
                            we encourage you to <a href="#" class="sellorgive">send us your résumé</a> or <a
                                href="{{ route('contact.us') }}" class="sellorgive">contact us</a>.</p>
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
