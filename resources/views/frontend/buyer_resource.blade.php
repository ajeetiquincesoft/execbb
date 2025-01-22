@extends('frontend.layout.master')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-container py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Buy a Business</a></li>
                <li class="breadcrumb-item active"><a href="#">Buyer Resource</a></li>
            </ol>
        </nav>
    </div>
</div>
<div class="container my-7">
    <div class="content-box">
        <div class="row">
            <div class="about_EBB">
                <h5 class="main-heading">Resources</h5>
                <!-- <h6 class="sub-heading">Executive Business Brokers - A Large, Active Business Brokerage Firm</h6> -->
            </div>
        </div>
        <div class="row px-3 px-md-5">
            <!-- Main Content -->
            <div class="col-md-8 main-head">
                <div class="Content-text">
                    <h3 class="section-heading">Books </h3>
                    <div class="container my-5">
                        <div class="row g-4">
                            <div class="col-12 col-md-4">
                                <a href="https://www.amazon.com/exec/obidos/ASIN/0028629035/executivebu0f-20" target="_blank"><img src="{{asset('assets/images/image_1.jpg')}}" alt="Image 1" class="buyer_resource_img"></a>
                            </div>
                            <div class="col-12 col-md-4">
                            <a href="https://www.amazon.com/exec/obidos/ASIN/1574100874/executivebu0f-20" target="_blank"><img src="{{asset('assets/images/image_2.jpg')}}" alt="Image 2" class="buyer_resource_img"></a>
                            </div>
                            <div class="col-12 col-md-4">
                            <a href="https://www.amazon.com/exec/obidos/ASIN/1564143430/executivebu0f-20" target="_blank"><img src="{{asset('assets/images/image_3.jpg')}}" alt="Image 3" class="buyer_resource_img"></a>
                            </div>
                        </div>
                    </div>
                    <div class="container my-5">
                        <div class="row g-4">
                            <div class="col-12 col-md-4">
                            <a href="https://www.amazon.com/exec/obidos/ASIN/1558507027/executivebu0f-20" target="_blank"><img src="{{asset('assets/images/image_4.jpg')}}" alt="Image 1" class="buyer_resource_img"></a>
                            </div>
                            <div class="col-12 col-md-4">
                            <a href="https://www.amazon.com/exec/obidos/ASIN/0793104505/executivebu0f-20" target="_blank"><img src="{{asset('assets/images/image_5.jpg')}}" alt="Image 2" class="buyer_resource_img"></a>
                            </div>
                            <div class="col-12 col-md-4">
                            <a href="https://www.amazon.com/exec/obidos/ASIN/1580620051/executivebu0f-20" target="_blank"><img src="{{asset('assets/images/image_6.jpg')}}" alt="Image 3" class="buyer_resource_img"></a>
                            </div>
                        </div>
                    </div>
                    <div class="container my-5">
                        <div class="row g-4">
                            <div class="col-12 col-md-4">
                            <a href="https://www.amazon.com/exec/obidos/ASIN/0471150479/executivebu0f-20" target="_blank"><img src="{{asset('assets/images/image_7.jpg')}}" alt="Image 1" class="buyer_resource_img"></a>
                            </div>
                            <div class="col-12 col-md-4">
                            <a href="https://www.amazon.com/exec/obidos/ASIN/0965657833/executivebu0f-20" target="_blank"><img src="{{asset('assets/images/image_8.jpg')}}" alt="Image 2" class="buyer_resource_img"></a>
                            </div>
                        </div>
                    </div>
                    <h3 class="section-heading">Government Agencies </h3>
                    <p><a href="https://www.nj.gov/treasury/revenue/dcr/geninfo/corpman.html" style="color: #7F2149; text-decoration: underline;" target="_blank">NJ Business Entity Filings</a></p>
                    <p><a href="https://www.nj.gov/commerce/" style="color: #7F2149; text-decoration: underline;" target="_blank">NJ Department of Commerce</a></p>
                    <p><a href="https://www.nj.gov/treasury/revenue/" style="color: #7F2149; text-decoration: underline;" target="_blank">NJ Division of Revenue</a></p>
                    <p><a href="https://www.ftc.gov/" style="color: #7F2149; text-decoration: underline;" target="_blank">Federal Trade Commission</a></p>
                    <p><a href="http://www.irs.ustreas.gov/" style="color: #7F2149; text-decoration: underline;" target="_blank">IRS</a></p>
                    <p><a href="http://www.sbaonline.sba.gov/" style="color: #7F2149; text-decoration: underline;" target="_blank">Small Business Administration
                        </a></p>
                </div>
            </div>
            <!-- Side Panel -->
            <div class="col-md-4" style="background-color: #F8F8F8;;">
                <div class="Ebb-section-about">
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Accelerate Your Search</h5>
                        </div>
                        <p>Become an <a href="{{route('preferred.buyers.program')}}" class="sellorgive" target="_blank">EBB Preferred Buyer</a> and benefit from our full services.</p>
                    </div>
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Phases of Buying a Business</h5>
                        </div>
                        <p>Before you start familiarize yourself with the <a href="{{route('busbuyphase')}}" style="color: #7F2149; text-decoration: underline;" target="_blank">phases.</a></p>
                    </div>
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Factors to Consider</h5>
                        </div>
                        <p>When buying a business, <a href="{{route('considerations')}}" style="color: #7F2149; text-decoration: underline;" target="_blank">consider these factors</a>.</p>
                    </div>
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Secure Financing Through EBB</h5>
                        </div>
                        <p>Get the right terms and rate, work with our <a href="{{route('financing')}}" style="color: #7F2149; text-decoration: underline;" target="_blank">mortgage specialists</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <style>
        .breadcrumb-container {
            background-color: #F8F8F8;
        }

        .breadcrumb-item a {
            text-decoration: none;
            color: #333333;
        }

        .breadcrumb-item.active {
            color: #333333;
        }

        a {
            text-decoration: none;
        }

        .content-box {
            background-color: #FFFFFF;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .main-heading {
            font-size: 20px;
            font-weight: bold;
            font-family: Urbanist;
            margin-bottom: 20px;
            color: #000;
            border-bottom: 1px solid #B3B3B3;
            padding-bottom: 30px;
            margin-left: 10px;
            margin-right: 10px;
        }

        .sub-heading {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #000;
        }

        .section-heading {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
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

        p {
            font-size: 14px;
            line-height: 1.4;
        }

        .Content-text {
            font-family: 'Mulish', sans-serif;
            color: #5D5D5D;
        }

        .about_EBB {
            text-align: center;
        }

        .boxes-button-section {
            margin: 9px;
            background: #FFFFFF;
            padding: 12px;
            margin-bottom: 20px;
            margin-top: 20px;
        }

        .EBB-team-title {
            color: #806132;
            font-family: Mulish;
        }

        .buyer_resource_img {
            width: 100%;
            height: 150px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
    @endsection