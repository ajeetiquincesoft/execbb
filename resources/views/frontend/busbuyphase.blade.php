@extends('frontend.layout.master')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-container py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Tool</a></li>
                <li class="breadcrumb-item active"><a href="#">Process</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- About us page no-14 HTML-->
<div class="container my-7">
    <div class="content-box">
        <div class="row">
            <div class="about_EBB">
                <h5 class="main-heading">Process</h5>
                <h6 class="sub-heading">Phases of Buying A Business</h6>
                <p class="sub-title">Buying a business is a complex and time consuming process that can be broken down into four main phases.</p>
            </div>
        </div>
        <div class="row px-3 px-md-5 ab_ebb">
            <!-- Main Content -->
            <div class="col-md-8 main-head">
                <div class="Content-text">
                    <h3 class="section-heading">Phase I: Confidentiality Agreement</h3>
                    <p>Signing this document gives you access to sensitive information regarding the seller and their business. It also protects the seller by ensuring you will keep information disclosed during negotiations confidential.<a href="javascript:void(0);" class="showingAgreement" style="color: #7F2149; text-decoration: underline;"> Example</a></p>
                    <h3 class="section-heading">Phase 2: Preliminary Negotiations/Letter of Intent</h3>
                    <p>Both parties negotiate a letter of intent, which is non-binding and forms the basis for the definitive agreement. It outlines the deal structure, the purchase price and form, payment terms and closing contingencies.<a href="javascript:void(0);" class="offerToPurchase" style="color: #7F2149; text-decoration: underline;"> Example</a></p>
                    <h3 class="section-heading">Phase 3: Due Diligence</h3>
                    <p>During <a href="{{route('duediligence')}}" class="sellorgive" >due diligence</a> - this vitally important phase - you will examine the business background, finance, human resources, tax and legal matters.</p>
                    <h3 class="section-heading">Phase 4: Negotiation/Definitive Acquisition Agreement</h3>
                    <p>There are four main sections of the Definitive Acquisition Agreement: purchase price, representations, indemnification and covenants.</p>
                    <img src="{{ asset('assets/images/logo_adobe.gif') }}" alt="IBBA Logo" class="img-fluid adove-logo">
                </div>
            </div>
            <!-- Side Panel -->
            <div class="col-md-4" style="background-color: #F8F8F8;;">
                <div class="Ebb-section-about">
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Accelerate Your Search</h5>
                            <p>Become an <a href="{{route('preferred.buyers.program')}}" class="sellorgive" >EBB Preferred Buyer</a> and benefit from our full services.</p>
                        </div>

                    </div>
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Factors to Consider</h5>
                            <p>When buying a business, <a href="{{route('considerations')}}" style="color: #7F2149; text-decoration: underline;" >consider these factors</a>.</p>
                        </div>

                    </div>
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Business Organizations</h5>
                            <p>Learn about the different types of <a href="{{route('organization')}}" style="color: #7F2149; text-decoration: underline;" >business status</a>.</p>
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
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
     $(document).ready(function() {
        $('.offerToPurchase').on('click', function() {
            var pdfPath = '/pdfs/Offer_To_Purchase.pdf';
            window.open(pdfPath, '_blank'); 
        });
        $('.showingAgreement').on('click', function() {
            var pdfPath = '/pdfs/Confidentiality_Showing_Agreement_2005_website.pdf';
            window.open(pdfPath, '_blank'); 
        });
        
    });
    </script>
@endsection