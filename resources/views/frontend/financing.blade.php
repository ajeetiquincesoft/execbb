@extends('frontend.layout.master')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-container py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active"><a href="#">Financing</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- About us page no-14 HTML-->
<div class="container my-7">
    <div class="content-box">
        <div class="row">
            <div class="about_EBB">
                <h5 class="main-heading">Financing</h5>
            </div>
        </div>
        <div class="row px-5 mt-5">
            <!-- Main Content -->
            <div class="col-md-8 main-head">
                <div class="Content-text">
                    <h3 class="section-heading">Financing Through EBB Has Its Advantages</h3>
                    <p>If you are purchasing an EBB listed business, consider financing it through one of our mortgage affiliates instead of working with a third party.</p>
                    <h3 class="section-heading mt-5">A Knowledgeable Team</h3>
                    <p>Each transaction carries with it a unique set of circumstances that should be reflected in the financing. The importance in understanding the particulars of the sale (the individuals, their situations and goals, the deal terms, etc), gives us – your team - a unique advantage over other finance providers.</p>
                    <h3 class="section-heading mt-5">Competitive Rates and the Right Terms</h3>
                    <p>When you work with an EBB business broker and their mortgage specialist affiliates, you get financing at a competitive rate AND terms that are right for your situation.</p>
                    <p>Need a business loan? We encourage you to <a href="{{route('contact.us')}}" class="sellorgive" target="_blank">contact us</a> for more information about our financing.</p>
                </div>
            </div>
            <!-- Side Panel -->
            <div class="col-md-4" style="background-color: #F8F8F8;;">
                <div class="Ebb-section-about">
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Determining Fair Market Value</h5>
                            <p>Don't know how to set a price? Contact EBB for a <a href="{{route('contact.us')}}"
                                    style="color: #7F2149; text-decoration: underline;" target="_blank">become FREE valuation</a> .</p>
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
                            <h5>Align Your Business with Us</h5>
                            <p>Set up a <a href="{{route('strategic.alliances')}}" style="color: #7F2149; text-decoration: underline;" target="_blank">strategic alliance</a>
                            with EBB and receive commissions and business.</p>
                        </div>

                    </div>
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>10 Questions to Ask</h5>
                            <p>Considering a business broker? <a href="#" style="color: #7F2149; text-decoration: underline;">Ask the right questions</a>
                            when you interview prospective brokers.</p>
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