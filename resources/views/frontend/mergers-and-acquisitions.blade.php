@extends('frontend.layout.master')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-container py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active"><a href="#">Mergers and Acquisitions</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- About us page no-14 HTML-->
<div class="container my-7">
    <div class="content-box">
        <div class="row">
            <div class="about_EBB">
                <h5 class="main-heading">Mergers and Acquisitions</h5>
            </div>
        </div>
        <div class="row px-5 mt-5">
            <!-- Main Content -->
            <div class="col-md-8 main-head">
                <div class="Content-text">
                    <h3 class="section-heading">Growth Through Merger or Acquisition</h3>
                    <p>In most cases it is more profitable for a business to grow by acquisition. It is also faster, more economical, less risky and easier to finance.  If you are considering a merger/acquisition, our advice is for you to base your purchase on strategic value, not price.</p>
                    <p>Each year, EBB assists buyers and sellers with acquiring or selling  businesses for strategic reasons. In some instances, we have been able to match buyers with businesses not originally up for sale.</p>
                    <p>Specifically, we can help you find a business and locate a buyer, then negotiate and close the deal. More importantly, we can help you understand the more complex issues around acquiring or merging a business into your company, such as:</p>
                    <p>- How to Structure the Deal</p>
                    <p>- Determining <a href="#" style="color: #7F2149; text-decoration: underline;">Market Value</a></p>
                    <p>- Conducting <a href="#" style="color: #7F2149; text-decoration: underline;">Due Diligence</a> on a Business</p>
                    <p>Interested in exploring your M&A options with EBB? We encourage you to  <a href="#" style="color: #7F2149; text-decoration: underline;">contact us</a> for more information.</p>
                  </div>
            </div>
            <!-- Side Panel -->
            <div class="col-md-4" style="background-color: #F8F8F8;;">
                <div class="Ebb-section-about">
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Determining Fair Market Value</h5>
                            <p>Don't know how to set a price? Contact EBB for a <a href="#" style="color: #7F2149; text-decoration: underline;">FREE valuation.</a></p>
                        </div>
                    </div>
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Sell It Through EBB</h5>
                            <p><a href="#" style="color: #7F2149; text-decoration: underline;">List</a>
                                your business with EBB.</p>
                        </div>
                    </div>
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Align Your Business with Us</h5>
                            <p>Set up a <a href="#" style="color: #7F2149; text-decoration: underline;">strategic alliance</a>
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