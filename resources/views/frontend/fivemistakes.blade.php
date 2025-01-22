@extends('frontend.layout.master')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-container py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Sellers </a></li>
                <li class="breadcrumb-item active"><a href="#">Tools</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- About us page no-14 HTML-->
<div class="container my-7">
    <div class="content-box">
        <div class="row">
            <div class="about_EBB">
                <h5 class="main-heading">5 Most Common Mistakes Sellers Make</h5>
            </div>
        </div>
        <div class="row px-3 px-md-5 ab_ebb">
            <!-- Main Content -->
            <div class="col-md-8 main-head">
                <div class="Content-text">
                    <h3 class="section-heading">1) Improper & Incomplete Documentation</h3>
                    <p>Getting your books in order will help the process go smoother and faster. Prepare 3 years of Federal Tax Returns prior to sale, Profit and Loss statements, year to date financial statements & balance sheets, a detailed equipment list, a break down of sales, and an employee list by length of service, salary and responsibility. You should also include an executive summary of the business and all contracts and leases (including the premises lease.) You should also readjust the financial statements to show the true cash flow of the business enterprise and include a detailed explanation on the logic used in the re-casting.</p>
                    <h3 class="section-heading">2) Dealing with only one Buyer</h3>
                    <p>Deals fall through. If you spend all your time and efforts with one buyer and the deal falls through, then you have to start all over again. Selling a business can be a very time consuming and prolonged experience. There are many parties involved including attorneys, accountants, landlord, banker, state and government agencies as well as many issues to be addressed. Negotiating a satisfactory agreement between all the parties can become overwhelming and can rob valuable marketing time in finding the right buyer. Therefore we recommend that you do not exclusively work with one buyer and keep marketing the business for sale and keeping an on going dialog with all serious candidates.</p>
                    <h3 class="section-heading">3) Not preparing an Exit Plan</h3>
                    <p>Preparing an exit plan will help to ensure there is no disruption in the operation of a business as it passes from one owner to another. Sellers should prepare at least 3 years in advance of a sale. Preparing for a sale includes getting all the books and records in order, negotiating long term lease options, cleaning up your balance sheet, classify all income and expenses properly to show the true earnings of the enterprise. Repair, replace or remove all equipment as necessary. Preparing key employees for the sale and providing proper incentives for their cooperation.</p>
                    <h3 class="section-heading">4) Not knowing the value of your Business</h3>
                    <p>Pricing a business correctly from the beginning will help you to sell the business faster. Valuing a business is not an exact science and is very subjective. There are many factors affecting value both tangible and intangible that play into the process. A price to high may leave an impression that you are not a serious Seller and a price to low could rob you or the true value of your enterprise. A professional can assist you in coming to an informed and objective decision as to value.</p>
                    <h3 class="section-heading">5) Not getting Professional Advice</h3>
                    <p>Professional advice can mean the difference between a successful conclusion to a transaction or costly missed opportunity. There are too many factors involved with selling a business. It can be a very complex and time consuming process. Knowing where to look for the right buyers, how to market the business for sale, how to structure the sale, how to develop a presentation package, how to create excitement about the business, how to manage the flow of information and the coordination between all the parties involved Attorney’s, Accountants, Bankers, Landlord, etc.</p>
                </div>
            </div>
            <!-- Side Panel -->
            <div class="col-md-4" style="background-color: #F8F8F8;;">
                <div class="Ebb-section-about">
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
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>10 Questions to Ask</h5>
                            <p>Considering a business broker? <a href="{{route('questions')}}" style="color: #7F2149; text-decoration: underline;" target="_blank">Ask the right questions</a> when you interview prospective brokers.</p>
                        </div>
                    </div>
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Mortgage Calculator</h5>
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