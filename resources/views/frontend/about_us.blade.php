@extends('frontend.layout.master')

@section('content')
    <!-- Breadcrumb Section -->
    <div class="breadcrumb-container py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    {{-- <li class="breadcrumb-item"><a href="{{ route('seller') }}">Sellers </a></li> --}}
                    <li class="breadcrumb-item active"><a href="#">About Us</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- About us page no-14 HTML-->
    <div class="container my-7">
        <div class="content-box">
            <div class="row">
                <div class="about_EBB">
                    <h5 class="main-heading">About Us</h5>
                </div>
            </div>
            <div class="row px-3 px-md-5 ab_ebb">
                <!-- Main Content -->
                <div class="col-md-8 main-head">
                    <div class="Content-text">
                        <h3 class="section-heading">Experience and Expertise</h3>
                        <p> With extensive experience in the industry since
                            1985, we have marketed and sold thousands of businesses. We have a deep
                            understanding of the business brokerage landscape. Our team of seasoned
                            professionals possesses the knowledge, skills, and market insights
                            necessary to guide you through the buying or selling process effectively.
                        </p>
                        <h3 class="section-heading">Comprehensive Services:</h3>
                        <p>Comprehensive Services: We offer a comprehensive range of services
                            tailored to meet your specific needs. From business valuation and marketing
                            to negotiations and due diligence, we handle every aspect of the
                            transaction, allowing you to focus on your core business or investment
                            goals.</p>

                        <h3 class="section-heading">Extensive Network:</h3>
                        <p> Our vast network of buyers, sellers, and industry
                            contacts gives us a competitive edge in connecting the right parties.
                            Whether you are looking for a specific type of business or seeking qualified
                            buyers for your venture, we leverage our network to match you with the
                            perfect opportunity.</p>

                        <h3 class="section-heading">Confidentiality and Discretion:</h3>
                        <p>We understand the importance of
                            confidentiality in business transactions. Rest assured that all information
                            shared with us will be treated with the utmost discretion. Our proven
                            processes ensure that your identity and business details remain confidential
                            until you are ready to disclose them to potential buyers or sellers.</p>
                        <h3 class="section-heading">Personalized Approach:</h3>
                        <p> EXECUTIVE BUSINESS BROKERS, we believe in
                            providing personalized attention to our clients. We take the time to
                            understand your unique goals, preferences, and challenges, tailoring our
                            services to align with your specific requirements. You can count on us to be
                            your trusted advisor throughout the entire process. </p>
                        <h3 class="section-heading">Proven Track Record:</h3>
                        <p> Our track record of successful deals speaks for itself.
                            We have helped numerous clients achieve their buying and selling
                            objectives, earning us a reputation for excellence and reliability in the
                            industry. Rest assured that with EXECUTIVE BUSINESS BROKERS, you are in
                            capable hands.</p>
                        <h3 class="section-heading">Contact Us Today!</h3>
                        <p>Ready to embark on your business buying or selling journey? Contact EXECUTIVE
                            BUSINESS BROKERS today to schedule a consultation. Our friendly and
                            experienced team is eager to answer your questions, address your concerns, and
                            provide you with the guidance you need to make informed decisions in selling or
                            buying a business. Let us be your trusted partner in unlocking new opportunities
                            and maximizing your success.</p>
                        <p>Take the first step towards your business goals with EXECUTIVE BUSINESS
                            BROKERS!</p>
                        <h3 class="section-heading">ABOUT OUR TEAM</h3>
                        <p>Our experienced business broker sales team at Executive Business Brokers is the
                            backbone of our success. With many years of collective experience in the industry, our
                            team brings a wealth of knowledge and expertise to every transaction. Each member is
                            highly skilled in business valuation, market analysis, negotiation strategies, and deal
                            structuring. They understand the intricacies of various industries and have a keen eye for
                            identifying potential opportunities and risks. Our team's extensive network and strong
                            relationships with buyers and sellers enable them to match the right parties and facilitate
                            successful transactions. They are dedicated to providing exceptional service, personalized
                            attention, and unwavering support to our clients throughout the entire process. With our
                            experienced business broker sales team by your side, you can have confidence in
                            achieving your buying or selling objectives effectively and maximizing your success.</p>

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
