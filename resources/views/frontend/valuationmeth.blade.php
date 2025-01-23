@extends('frontend.layout.master')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-container py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Services </a></li>
                <li class="breadcrumb-item"><a href="#">Consulting  </a></li>
                <li class="breadcrumb-item active"><a href="#">Business Valuation</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- About us page no-14 HTML-->
<div class="container my-7">
    <div class="content-box">
        <div class="row">
            <div class="about_EBB">
                <h5 class="main-heading">Valuation Meth</h5>
            </div>
        </div>
        <div class="row px-3 px-md-5 mt-0 mt-md-5">
            <!-- Main Content -->
            <div class="col-md-8 main-head mar_acq">
                <div class="Content-text">
                    <h3 class="section-heading">Methods Used for Business Valuation</h3>
                    <p>Here are several methods for determining the value of a business. Executive Business Brokers uses a multiple of the seller's discretionary cash (SDC) to determine a business' worth in the marketplace.</p>
                    <h3 class="section-heading">Multiple of Discretionary Cash (SDC)</h3>
                    <p>This Method uses a multiple of seller's discretionary cash flow.  Retail businesses generally range from 0-2 times the SDC.  Manufacturing, distributing and service businesses range from 0-4 times SDC.  Plus the depreciated value of the fixtures & equipment, wholesale value of the salable inventory and market value of the real estate if included.</p>
                    <h3 class="section-heading">Tangible Assets (Balance Sheet Method)</h3>
                    <p>Sometimes used to evaluate a business that is losing money. Value is based on current assets.</p>
                    <h3 class="section-heading">Cost to Create Approach</h3>
                    <p>Used when purchasing an existing business. Value is based on estimating the start up costs minus what is missing plus a premium for the time saved.</p>
                    <h3 class="section-heading">Rule of Thumb Method</h3>
                    <p>Uses averages to provide a frame of reference for a business’ worth in a particular industry.</p>
                    <h3 class="section-heading">Book Value</h3>
                    <p>The least controversial method. Value is based on the business’ assets and liabilities.</p>
                    <h3 class="section-heading">Multipliers</h3>
                    <p>Uses an industry average sales figure from recent sales of comparable business. The value of a business is determined by multiplying the sales by the gross sales.</p>
                    <h3 class="section-heading">Excess Earning Method</h3>
                    <p>Estimated from an industry average and is similar to the capitalized earnings approach. Here the return on assets is separated from other earnings ("excess" earnings) generated.</p>
                    <h3 class="section-heading">Capitalized Earning Approach</h3>
                    <p>Based on the rate of return in earnings that the investor expects.</p>
                   
                  </div>
            </div>
            <!-- Side Panel -->
            <div class="col-md-4" style="background-color: #F8F8F8;;">
                <div class="Ebb-section-about">
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Determining Fair Market Value</h5>
                            <p>Don't know how to set a price? Contact EBB for a <a href="{{route('contact.us')}}" style="color: #7F2149; text-decoration: underline;" >FREE valuation.</a></p>
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
                            <h5>Align Your Business with Us</h5>
                            <p>Set up a <a href="{{route('strategic.alliances')}}" style="color: #7F2149; text-decoration: underline;" >strategic alliance</a>
                            with EBB and receive commissions and business.</p>
                        </div>
                    </div>
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>10 Questions to Ask</h5>
                            <p>Considering a business broker? <a href="{{route('questions')}}" style="color: #7F2149; text-decoration: underline;" >Ask the right questions</a>
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