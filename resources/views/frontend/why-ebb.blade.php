@extends('frontend.layout.master')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-container py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active"><a href="#">Why EBB?</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- About us page no-14 HTML-->
<div class="container my-7">
    <div class="content-box">
        <div class="row">
            <div class="about_EBB">
                <h5 class="main-heading">Why EBB?</h5>
            </div>
        </div>
        <div class="row px-3 px-md-5 mt-0 mt-md-5 ab_ebb">
            <!-- Main Content -->
            <div class="col-md-8 main-head">
                <div class="Content-text">
                    <h3 class="section-heading">Buying and Selling a Business is Easier with EBB</h3>
                    <p>Executive Business Brokers has handled the marketing and sales efforts for over 1,000 small to mid-sized businesses in retail, service, and manufacturing and distribution industries. Our consultative approach to buying and selling  makes selling a business easier.</p>
                    <h3 class="section-heading mt-5">EBB Guides You through the Process</h3>
                    <p>As an objective third party we will review your business operation to help you determine its fair market value in today’s marketplace.  We will also coordinate and attend meetings with the various professionals involved and help accountants and attorneys address the various issues involved with the sale..</p>
                    <h3 class="section-heading mt-5">EBB Locates the Right Buyers</h3>
                    <p>Our aggressive <a href="#" class="sellorgive">multi-level marketing</a> effort that includes direct mail, advertising, networking and the Internet  draws buyers. Through our screening process we qualify them by determining their intent, requirements and financial resources. <span>ALL prospective buyers sign a  confidentiality and non-disclosure agreements prior to viewing  details of your businesses.</span></p>
                </div>
            </div>
            <!-- Side Panel -->
            <div class="col-md-4" style="background-color: #F8F8F8;;">
                <div class="Ebb-section-about">
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Join the EBB Team</h5>
                            <p>Our strength is our brokers. Learn how you can<a href="{{route('join.ebb')}}" class="sellorgive" > become part of our all-star
                                    team</a> .</p>
                        </div>

                    </div>
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Sell It Through EBB</h5>
                            <p><a href="{{route('list.with.ebb')}}" style="color: #7F2149; text-decoration: underline;" >List</a>
                                your business with EBB.</p>
                        </div>

                    </div>
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Accelerate Your Search</h5>
                            <p>Become an <a href="{{route('preferred.buyers.program')}}" style="color: #7F2149; text-decoration: underline;" >EBB Preferred Buyer</a>
                                and benefit from our full services.</p>
                        </div>

                    </div>
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>
                                <a href="{{route('message')}}" style="color: #806132; text-decoration: underline;" >A Message</a>
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
    .Content-text span{
        font-weight: bold;
    }
</style>
@endsection