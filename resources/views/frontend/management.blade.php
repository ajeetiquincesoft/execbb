@extends('frontend.layout.master')

@section('content')
    <!-- Breadcrumb Section -->
    <div class="breadcrumb-container py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="#">Management</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- About us page no-14 HTML-->
    <div class="container my-7">
        <div class="content-box">
            <div class="row">
                <div class="about_EBB">
                    <h5 class="main-heading">Management</h5>
                </div>
            </div>
            <div class="row px-3 px-md-5 mt-0 mt-md-5 ab_ebb">
                <!-- Main Content -->
                <div class="col-md-8 main-head">
                    <div class="Content-text">
                        <h3 class="section-heading">A Results Driven Leader</h3>
                        <p>Executive Business Brokers' President Larry Bodner established the business in 1985 to provide
                            small to mid-sized business owners with value-added professional services.</p>
                        <h3 class="section-heading mt-5">Years of Experience</h3>
                        <p>Since 1985, Larry has successfully guided sellers and buyers through transfers of ownership and
                            business valuations. He has represented manufacturing, distribution, retail and private sector
                            clients in sales ranging from $100K to $5M.</p>
                        <h3 class="section-heading mt-5">Unique Perspective</h3>
                        <p>As an experienced owner and operator of a chain of retail stores, Larry understands what makes a
                            business valuable, how to present a business to prospective buyers, how to negotiate terms and
                            how to secure the maximum price for a business.</p>
                    </div>
                </div>
                <!-- Side Panel -->
                <div class="col-md-4" style="background-color: #F8F8F8;;">
                    <div class="Ebb-section-about">
                        <div class="boxes-button-section">
                            <div class="EBB-team-title">
                                <h5>Join the EBB Team</h5>
                                <p>Our strength is our brokers. Learn how you can <a href="{{ route('join.ebb') }}"
                                        class="sellorgive">become part of our all-star
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
