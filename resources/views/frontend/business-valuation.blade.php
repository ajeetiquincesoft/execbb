@extends('frontend.layout.master')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-container py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
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
                <h5 class="main-heading">Business Valuation</h5>
            </div>
        </div>
        <div class="row px-3 px-md-5 mt-0 mt-md-5">
            <!-- Main Content -->
            <div class="col-md-8 main-head bus_valu">
                <div class="Content-text">
                    <h3 class="section-heading">How EBB Determines a Business' Worth</h3>
                    <p>Valuing a business is not an exact science. There is no right way to determine price, as there are many <a href="{{route('valuationmeth')}}" style="color: #7F2149; text-decoration: underline;" >methods</a> of doing so. <a href="{{route('valuationfactors')}}" style="color: #7F2149; text-decoration: underline;" >Many factors</a> play into value – the economy, management, location, cash flow, lease, etc.</p>
                    <p>EBB uses a multiple of the seller’s discretionary cash (SDC) to determine a business’ worth in the marketplace. Because each business has a different model and set of circumstances, we believe the SDC model rewards business with higher profits.</p>
                    <p>While multiples vary from industry to industry, they generally fall into the 1X – 4X the <a href="#" style="color: #7F2149; text-decoration: underline;"> Sellers Discretionary Cash</a> (SDC) plus the depreciated value of the fixtures and equipment and the wholesale value of the saleable inventory.</p>
                    <p><a href="{{route('contact.us')}}" style="color: #7F2149; text-decoration: underline;" >Ask EBB </a>to help you determine the value of your business.</p>
                  </div>
            </div>
            <!-- Side Panel -->
            <div class="col-md-4" style="background-color: #F8F8F8;;">
                <div class="Ebb-section-about">
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Determining Fair Market Value</h5>
                            <p>Don't know how to set a price? Contact EBB for a <a href="{{route('contact.us')}}" style="color: #7F2149; text-decoration: underline;" > FREE valuation.</a></p>
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
                            <p>Considering a business broker? <a href="{{route('questions')}}" style="color: #7F2149; text-decoration: underline;">Ask the right questions</a>
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