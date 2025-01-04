@extends('frontend.layout.master')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-container py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active"><a href="#">Company</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- About us page no-14 HTML-->
<div class="container my-7">
    <div class="content-box">
        <div class="row">
            <div class="about_EBB">
                <h5 class="main-heading">Company</h5>
                <h6 class="sub-heading">Executive Business Brokers - A Large, Active Business Brokerage Firm</h6>
            </div>
        </div>
        <div class="row px-5 ab_ebb">
            <!-- Main Content -->
            <div class="col-md-8 main-head">
                <div class="Content-text">
                    <h3 class="section-heading">The Business Brokerage Specialists</h3>
                    <p>Since 1985, EBB has been selling companies in almost every sector, handling a wide range of
                        business opportunities from retail to wholesale, manufacturing to service.</p>
                    <h3 class="section-heading">We are in the Business of Selling Businesses</h3>
                    <p>The businesses we sell are companies with annual sales under $10M. The prices of these
                        companies range from $100K to $5M, requiring liquid investments of $50K to $2M.</p>
                    <h3 class="section-heading">We Bring Buyers and Sellers Together</h3>
                    <p>EBB brings together individuals with various levels of experience and provides them with
                        <a href="{{route('buyer.tools')}}" class="sellorgive" target="_blank">buying tools</a> and <a href="{{route('seller.tools')}}" class="sellorgive" target="_blank">selling tools</a>. We guide and facilitate the process of buying and selling a
                        business, saving our clients both time and money. Our fees are paid by the seller.</p>
                    <h3 class="section-heading">Reach Qualified Buyers and Sellers</h3>
                    <p>Our proprietary national database of thousands of qualified buyers and sellers ensures that
                        your listing reaches a vast audience. EBB also qualifies these prospects through our buyer
                        screening process.</p>
                    <h3 class="section-heading">No Geographic Restrictions</h3>
                    <p>EBB is a member of the International Business Brokerage Association and is affiliated with
                        many Internet marketing companies. Through these affiliations we have access to buyers and
                        sellers on a local, national and an international basis.</p>
                </div>
            </div>
            <!-- Side Panel -->
            <div class="col-md-4" style="background-color: #F8F8F8;;">
                <div class="Ebb-section-about">
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Join the EBB Team</h5>
                            <p>Our strength is our brokers. Learn how you can<a href="{{route('join.ebb')}}" class="sellorgive" target="_blank"> become part of our all-star
                                    team</a> .</p>
                        </div>

                    </div>
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Sell It Through EBB</h5>
                            <p><a href="{{route('list.with.ebb')}}" style="color: #7F2149; text-decoration: underline;" target="_blank">List</a>
                                your business with EBB.</p>
                        </div>

                    </div>
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Accelerate Your Search</h5>
                            <p>Become an <a href="{{route('preferred.buyers.program')}}" style="color: #7F2149; text-decoration: underline;" target="_blank">EBB Preferred Buyer</a>
                                and benefit from our full services.</p>
                        </div>

                    </div>
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>
                                <a href="#" style="color: #806132; text-decoration: underline;">A Message</a>
                                    from EBB's President Larry Bodner
                            </h5>
                        </div>
                    </div>
                    <img src="{{ asset('assets/images/about-us_logo.png') }}" alt="IBBA Logo" class="img-fluid ibba-logo">
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
        padding-bottom: 33px;
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
</style>
@endsection