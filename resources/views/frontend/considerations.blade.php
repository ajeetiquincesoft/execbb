@extends('frontend.layout.master')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-container py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Buyers</a></li>
                <li class="breadcrumb-item"><a href="#">Tool</a></li>
                <li class="breadcrumb-item active"><a href="#">Considerations</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- About us page no-14 HTML-->
<div class="container my-7">
    <div class="content-box">
        <div class="row">
            <div class="about_EBB">
                <h5 class="main-heading">Considerations</h5>
            </div>
        </div>
        <div class="row px-3 px-md-5 ab_ebb">
            <!-- Main Content -->
            <div class="col-md-8 main-head">
                <div class="Content-text">
                    <h3 class="section-heading">Factors to Consider</h3>
                    <p>When evaluating whether a business is the right purchase for you there are many things to consider.</p>
                    <p>Even though you may be buying a successful existing business or <a href="#" class="sellorgive" target="_blank">franchise</a>, you need to be aware of many other factors.  For example, you should have a complete understanding of what is and is not included with the sale. </p>
                    <p><a href="javascript:void(0);" class="openPdf" style="color: #7F2149; text-decoration: underline;">What to consider</a> When buying a business, it is important to consider five main areas:</p>
                    <p>- Finances & Legal Issues</p>
                    <p>- Marketing Program</p>
                    <p>- Employees</p>
                    <p>- Customer Base</p>
                    <p>- Location and Appearance</p>
                </div>
            </div>
            <!-- Side Panel -->
            <div class="col-md-4" style="background-color: #F8F8F8;;">
                <div class="Ebb-section-about">
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Accelerate Your Search</h5>
                            <p>Become an <a href="{{route('preferred.buyers.program')}}" style="color: #7F2149; text-decoration: underline;" target="_blank">EBB Preferred Buyer</a> and benefit from our full services.</p>
                        </div>
                    </div>
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Due Diligence Check List</h5>
                            <p>Protect your investment by using this <a href="javascript:void(0);" style="color: #7F2149; text-decoration: underline;" class="checkList">checklist</a>.</p>
                        </div>
                    </div>
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Phases of Buying a Business</h5>
                            <p>Before you start familiarize yourself with the <a href="{{route('busbuyphase')}}" style="color: #7F2149; text-decoration: underline;" target="_blank">phases</a>.</p>
                        </div>
                    </div>
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Secure Financing Through EBB</h5>
                            <p>Get the right terms and rate, work with our <a href="{{route('financing')}}" style="color: #7F2149; text-decoration: underline;" target="_blank">mortgage specialists</a>.</p>
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
        $('.openPdf').on('click', function() {
            var pdfPath = '/pdfs/w1_what_to_consider.pdf';
            window.open(pdfPath, '_blank'); 
        });
        $('.checkList').on('click', function() {
            var pdfPath = '/pdfs/W2_Items_Due_Diligence_R.pdf';
            window.open(pdfPath, '_blank'); 
        });
        
    });
    </script>
@endsection