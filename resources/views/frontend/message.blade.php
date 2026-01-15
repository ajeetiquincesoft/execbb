@extends('frontend.layout.master')

@section('content')
    <!-- Breadcrumb Section -->
    <div class="breadcrumb-container py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">About EBB</a></li>
                    <li class="breadcrumb-item active"><a href="#">President's Message</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- About us page no-14 HTML-->
    <div class="container my-7">
        <div class="content-box">
            <div class="row">
                <div class="about_EBB">
                    <h5 class="main-heading">President's Message</h5>
                </div>
            </div>
            <div class="row px-3 px-md-5 ab_ebb">
                <!-- Main Content -->
                <div class="col-md-8 main-head">
                    <div class="Content-text question">
                        <h3 class="section-heading">Driving the American Dream, Our Business is Selling Businesses</h3>
                        <p>I have always had a great respect and admiration for the drive, determination and risk in which
                            business owners take on in the pursuit of independence. I first saw this entrepreneurial spirit
                            in my parents, who have owned and operated a small business for over 35 years.</p>
                        <p>At Executive Business Brokers (EBB) we believe in this spirit. It is what makes our country so
                            great, and we are proud and honored to have helped so many entrepreneurs realize their dream.
                            Since 1985, EBB has been recognized for our commitment to excellence in the representation of
                            the clients we serve. While holding steadfast to our integrity, professionalism and traditional
                            ethical values, we have remained a responsive leader in a dynamic and constantly changing
                            marketplace.</p>
                        <p>To achieve and maintain this position of preeminence, our focus has always been on the quality of
                            our people and aligning ourselves with business professionals who can help our clients achieve
                            their goals. We support our highly motivated and accomplished network of sales associates
                            through comprehensive training, cutting-edge technology and on-going support. We were quick to
                            respond and harness the power of the Internet, which has had a tremendous and positive impact on
                            our industry. It has fueled our growth by helping us to drive our business objectives and
                            marketing programs while simultaneously educating buyers and sellers.</p>
                        <p>We believe our adherence to a highly personalized and consultative approach to the buying and
                            selling process will assure an ever-increasing capacity to contribute added value to the
                            transactions of our clients. This will allow us to remain an innovative and progressive leader
                            within the business brokerage industry.<br><br>
                            Sincerely,<br>
                            <font face="Mistral" color="#50494c" size="5"><span
                                    style="FONT-SIZE: 20pt; FONT-FAMILY: Mistral">Larry</span></font>
                        </p>
                        <p>Larry Bodner</p>
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
                                <h5>Sell It Through EBB</h5>
                                <p><a href="{{ route('list.with.ebb') }}"
                                        style="color: #7F2149; text-decoration: underline;">List</a>
                                    your business with EBB.</p>
                            </div>

                        </div>
                        {{-- <div class="boxes-button-section">
                            <div class="EBB-team-title">
                                <h5>Accelerate Your Search</h5>
                                <p>Become an <a href="{{ route('preferred.buyers.program') }}"
                                        style="color: #7F2149; text-decoration: underline;">EBB Preferred Buyer</a>
                                    and benefit from our full services.</p>
                            </div>

                        </div> --}}
                        <div class="boxes-button-section">
                            <div class="EBB-team-title">
                                <h5>Experience a Smooth Transfer of Ownership with EBB</h5>
                                <ul class="list-unstyled tips-list-join">
                                    <li>
                                        <i class="bi bi-check-circle-fill text-purple"></i> Results-driven
                                    </li>
                                    <li>
                                        <i class="bi bi-check-circle-fill text-purple"></i> Confidential
                                    </li>
                                    <li>
                                        <i class="bi bi-check-circle-fill text-purple"></i> Pre-Qualified Purchasers
                                    </li>
                                    <li>
                                        <i class="bi bi-check-circle-fill text-purple"></i> Specialization
                                    </li>
                                    <li>
                                        <i class="bi bi-check-circle-fill text-purple"></i> Reconstruction of Cash Flow
                                    </li>
                                    <li>
                                        <i class="bi bi-check-circle-fill text-purple"></i> Knowledgeable
                                    </li>
                                    <li>
                                        <i class="bi bi-check-circle-fill text-purple"></i> Accurate Business Valuation
                                    </li>
                                    <li>
                                        <i class="bi bi-check-circle-fill text-purple"></i> Maximum Exposure
                                    </li>
                                    <li>
                                        <i class="bi bi-check-circle-fill text-purple"></i> Professional Negotiations
                                    </li>
                                    <li>
                                        <i class="bi bi-check-circle-fill text-purple"></i> Database Marketing
                                    </li>
                                    <li>
                                        <i class="bi bi-check-circle-fill text-purple"></i> Results-Oriented Fee Structure
                                    </li>
                                    <li>
                                        <i class="bi bi-check-circle-fill text-purple"></i> Internet Advertising
                                    </li>
                                    <li>
                                        <i class="bi bi-check-circle-fill text-purple"></i> No Downtime
                                    </li>
                                </ul>
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

        .EBB-team-title ul li {
            margin: 20px 0px;
            font-family: 'Mulish';
            font-size: 14px;
        }

        .text-purple {
            color: #7F2149;
            margin-right: 10px;
        }
    </style>
@endsection
