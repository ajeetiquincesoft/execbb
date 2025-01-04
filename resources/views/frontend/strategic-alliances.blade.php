@extends('frontend.layout.master')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-container py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active"><a href="#">Strategic Alliances</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- About us page no-14 HTML-->
<div class="container my-7">
    <div class="content-box">
        <div class="row">
            <div class="about_EBB">
                <h5 class="main-heading">Strategic Alliances</h5>
            </div>
        </div>
        <div class="row px-5 mt-5 ab_ebb">
            <!-- Main Content -->
            <div class="col-md-8 main-head">
                <div class="Content-text">
                    <h2 class="align_your_self">Align Yourself with EBB</h2>
                    <h3 class="section-heading">Be Rewarded</h3>
                    <p class="join_us_p">If your product/service is valuable to small businesses you can become part of Executive Business Brokers affiliate program. As a partner, you could receive commission by simply referring clients to us.</p>
                    <p class="join_us_p">EBB actively looks for better ways to serve the small business community. If you are an attorney, accountant, insurance broker, business association or Chamber of Commerce that would not have a conflict in referring business to us, we encourage you to <a href="#" class="sellorgive">contact us </a> to set up a strategic alliance.</p>
                </div>
            </div>
            <!-- Side Panel -->
            <div class="col-md-4" style="background-color: #F8F8F8;;">
                <div class="Ebb-section-about">
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Join the EBB Team</h5>
                            <p>Our strength is our brokers. Learn how you can<a href="{{route('join.ebb')}}"
                            style="color: #7F2149; text-decoration: underline;" target="_blank"> become part of our all-star
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
        font-size: 26px;
        font-weight: bold;
        color: #806132;
        font-family: 'Urbanist';
        margin-bottom: 20px;
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

    .Content-text span {
        font-weight: bold;
    }

    p.join_us_p {
        font-family: 'Urbanist' !important;
    }

    h2.align_your_self {
        margin-bottom: 20px;
    }
</style>
@endsection