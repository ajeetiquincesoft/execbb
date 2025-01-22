@extends('frontend.layout.master')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-container py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Services </a></li>
                <li class="breadcrumb-item"><a href="#">Consulting </a></li>
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
                <h5 class="main-heading">Factors Effecting Valuation</h5>
            </div>
        </div>
        <div class="row px-3 px-md-5 mt-0 mt-md-5">
            <!-- Main Content -->
            <div class="col-md-8 main-head mar_acq">
                <div class="Content-text">
                    <h3 class="section-heading">Factors Effecting Valuation</h3>
                    <p>While business valuations are very subjective, there are 16 key factors to take into consideration when valuing a business.</p>
                    <ol type="1" class="factor_valuation">
                        <li>Annual Sales and Profit Trends – What are they for the last 3 years?</li>
                        <li>Lease Terms & Conditions – What are they?</li>
                        <li>Marketing – What stage is the business in – infancy or maturity? How long has the present owner owned it? What is the primary source of sales? How is the company positioned? What are the marketing/sales programs?</li>
                        <li>Presentation – Is the business presentable (clean, organized)? What is the condition of environment?</li>
                        <li>Business Hours – What is the number of days and hours of operation?</li>
                        <li>Type of Products/Services – Are the products/services proprietary or commodities? Are they diverse? What are their advantages?</li>
                        <li>Type of Business – Is it a franchise or an existing business?</li>
                        <li>Systems –What are the systems in place for accounting, employee management, software/hardware and sales/marketing?</li>
                        <li>Financial Outlook – What is the asset base (high or low)? Are there records that reflect profit/sales trends? Is revenue sustainable? What are the growth and expansion opportunities? What is owed and what is coming in (debts, credits and receivables)?</li>
                        <li>Marketplace - Who are the competitors? What are the barriers? How does the industry landscape look? What is the geography/location of the business?</li>
                        <li>Management & Employees – Is the business managed by the owner or hired help?</li>
                        <li>Customers – What are the # of customers and their contribution to revenue?</li>
                        <li>Suppliers – What are the # of vendors, their contribution to the business and how much does the business depend upon them?</li>
                        <li>Relationships/Uninterrupted business – Can customer, supplier and employee relationships withstand a change in ownership?</li>
                        <li>Legal Issues – Are there any lawsuits, environmental issues or pending regulatory changes?</li>
                        <li>Terms & Stock – Will the purchaser buy or the seller sell? Does it require a low or high down payment?</li>
                    </ol>

                </div>
            </div>
            <!-- Side Panel -->
            <div class="col-md-4" style="background-color: #F8F8F8;;">
                <div class="Ebb-section-about">
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Determining Fair Market Value</h5>
                            <p>Don't know how to set a price? Contact EBB for a <a href="{{route('contact.us')}}" style="color: #7F2149; text-decoration: underline;" target="_blank">FREE valuation.</a></p>
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
                            <p>Considering a business broker? <a href="{{route('questions')}}" style="color: #7F2149; text-decoration: underline;" target="_blank">Ask the right questions</a>
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

    ol.factor_valuation li {
        margin-bottom: 20px;
        font-size: 14px;
        color: #5D5D5D;
        line-height: 22px;
    }
</style>
@endsection