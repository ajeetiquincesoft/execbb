@extends('frontend.layout.master')

@section('content')
    <!-- Breadcrumb Section -->
    <div class="breadcrumb-container py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="#">Consulting</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- About us page no-14 HTML-->
    <div class="container my-7">
        <div class="content-box">
            <div class="row">
                <div class="about_EBB">
                    <h5 class="main-heading">Consulting</h5>
                </div>
            </div>
            <div class="row px-3 px-md-5 mt-0 mt-md-5">
                <!-- Main Content -->
                <div class="col-md-8 main-head services_consulting">
                    <div class="Content-text">
                        <h3 class="section-heading">Asking the Experts for Advice</h3>
                        <p>Executive Business Brokers (EBB) offers consulting services for any aspect of buying/selling a
                            business. We work with buyers and sellers to:</p>

                        <h3 class="section-heading mt-5">Determine the Value of a Business</h3>
                        <p>EBB offers <a href="{{ route('business.valuation') }}" class="sellorgive">business valuations</a>
                            as a consulting service to sellers interested in listing their business FSBO (For Sale By Owner)
                            or to sellers who simply want to know the value of their business.</p>

                        <h3 class="section-heading mt-5">Comment on the Structure of the Deal</h3>
                        <p>EBB is often asked – as an impartial and objective third party - to comment on the structure of a
                            deal for a business not offered through EBB. We can provide objective advice and guidance in
                            order to help you achieve the best results.</p>

                        <h3 class="section-heading mt-5">Prepare a Business for Sale</h3>
                        <p>Not all sellers are ready for sale and need help to develop an exit strategy. EBB can evaluate
                            your business operation and identify what you need to do to prepare for a sale.</p>
                        <p>Need help? <a href="{{ route('contact.us') }}" class="sellorgive">contact us</a> for more
                            information on any of our consulting services.</p>
                    </div>
                </div>
                <!-- Side Panel -->
                <div class="col-md-4" style="background-color: #F8F8F8;;">
                    <div class="Ebb-section-about">
                        <div class="boxes-button-section">
                            <div class="EBB-team-title">
                                <h5>Determining Fair Market Value</h5>
                                <p>Don't know how to set a price? Contact EBB for a <a href="{{ route('contact.us') }}"
                                        style="color: #7F2149; text-decoration: underline;">become FREE valuation</a> .</p>
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
                        <div class="boxes-button-section">
                            <div class="EBB-team-title">
                                <h5>Align Your Business with Us</h5>
                                <p>Set up a <a href="{{ route('strategic.alliances') }}"
                                        style="color: #7F2149; text-decoration: underline;">strategic alliance</a>
                                    with EBB and receive commissions and business.</p>
                            </div>

                        </div>
                        <div class="boxes-button-section">
                            <div class="EBB-team-title">
                                <h5>10 Questions to Ask</h5>
                                <p>Considering a business broker? <a href="{{ route('questions') }}"
                                        style="color: #7F2149; text-decoration: underline;">Ask the right questions</a>
                                    when you interview prospective brokers.</p>
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

        .ibba-logo {
            margin-top: 25px;
            display: block;
            max-width: 100%;
            height: 40px;
            margin: 20px;
        }

        p {
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
