@extends('frontend.layout.master')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-container py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Sellers </a></li>
                <li class="breadcrumb-item active"><a href="#">Resources</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- About us page no-14 HTML-->
<div class="container my-7">
    <div class="content-box">
        <div class="row">
            <div class="about_EBB">
                <h5 class="main-heading">12 Point Process</h5>
            </div>
        </div>
        <div class="row px-3 px-md-5 ab_ebb">
            <!-- Main Content -->
            <div class="col-md-8 main-head">
                <div class="Content-text question">
                    <h3 class="section-heading">Executive Business Brokers' 12 Point Process</h3>
                    <p>1. Establish a <a href="{{route('business.valuation')}}" style="color: #7F2149; text-decoration: underline;" >fair and accurate selling price</a> through hands-on
                    assessment.</p>
                    <p>2. Offer advice on the attractiveness and value of the business.</p>
                    <p>3. Determine the time frame for selling the business.</p>
                    <p>4. Devise strategies and tactics to sell the business in the shortest time</p>
                    <p>5. Enter co-brokerage agreements to enhance the sale of the business.</p>
                    <p>6. Expose the business to potential buyers daily through proven <a href="{{route('multimarketing')}}" style="color: #7F2149; text-decoration: underline;" >media sources</a> – including the Internet.</p>
                    <p>7. Screen and pre-qualify buyers.</p>
                    <p>8. Provide reports on the status of the process.</p>
                    <p>9. Provide owners with feedback on their business from prospective buyers.</p>
                    <p>10. Negotiate on behalf of the seller and assist the buyer in coming to a purchase decision.</p>
                    <p>11. Assist the buyer in arranging <a href="{{route('financing')}}" style="color: #7F2149; text-decoration: underline;" >financing.</a></p>
                    <p>12. Expedite the process by assisting the accountants, attorneys and landlords.</p>
                </div>
            </div>
            <!-- Side Panel -->
            <div class="col-md-4" style="background-color: #F8F8F8;;">
                <div class="Ebb-section-about">
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Sell It Through EBB</h5>
                            <p><a href="{{route('list.with.ebb')}}" style="color: #7F2149; text-decoration: underline;" >List</a> your business with EBB..</p>
                        </div>
                    </div>
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>10 Questions to Ask</h5>
                            <p>Considering a business broker? <a href="{{route('questions')}}" style="color: #7F2149; text-decoration: underline;" >Ask the right questions</a> when you interview prospective brokers.</p>
                        </div>
                    </div>
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Tips For Selling Your Business</h5>
                            <p><ul>
                                <li>Put the Books in Order</li>
                                <li>Determine the Value of the Business</li>
                                <li>Continue to Manage the Business While Selling It</li>
                                <li>Negotiate Effectively by Calling in an Expert</li>
                            </ul>
                        </p>
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
@endsection