@extends('frontend.layout.master')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-container py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">About EBB</a></li>
                <li class="breadcrumb-item"><a href="#">Join EBB</a></li>
                <li class="breadcrumb-item active"><a href="#">Training</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- About us page no-14 HTML-->
<div class="container my-7">
    <div class="content-box">
        <div class="row">
            <div class="about_EBB">
                <h5 class="main-heading">Training</h5>
            </div>
        </div>
        <div class="row px-3 px-md-5 ab_ebb">
            <!-- Main Content -->
            <div class="col-md-8 main-head">
                <div class="Content-text">
                    <h3 class="section-heading">Comprehensive Training</h3>
                    <p>Held over three days at our corporate headquarters, the Executive Business Brokers (EBB) comprehensive training program is designed to equip you with the knowledge, tools and technology you need to become a successful business broker. The topics we cover include:</p>
                    <h3 class="section-heading">Business Management</h3>
                    <p>- Setting up and operating effectively</p>
                    <p>- Setting goals and objectives</p>
                    <p>- Time management</p>
                    <p>- Problem solving</p>
                    <p>- The systems and techniques for successfully managing the sale of a business</p>
                    <p>- Information management</p>
                    <p>- Office policies and procedures</p>
                    <p>- Remotely accessing and using EBB’s proprietary database</p>
                    <h3 class="section-heading">Deal Structuring</h3>
                    <p>- Structuring a deal</p>
                    <p>- Understanding and using the appropriate forms</p>
                    <p>- Preparation of Offer to Purchase Agreements</p>
                    <p>- Understanding lease agreements</p>
                    <p>- Financing solutions</p>
                    <h3 class="section-heading">Putting a Business Up for Sale</h3>
                    <p>- Appraising the fair market value of a business</p>
                    <p>- Establishing a fair price and terms</p>
                    <p>- Recasting financial statements</p>
                    <p>- Applicable accounting principals</p>
                    <h3 class="section-heading">Selling Businesses</h3>
                    <p>- Marketing a business for sale</p>
                    <p>- Listing techniques and relevant terminology</p>
                    <p>- Finding buyers and sellers</p>
                    <p>- Separating the prospects from the suspects</p>
                    <p>- Recognizing buyer and seller motivations</p>
                    <p class="join_us_p">If you are interested in talking to us about becoming an EBB business broker, we encourage you to <a href="#" class="sellorgive">send us your résumé</a> or <a href="{{route('contact.us')}}" class="sellorgive" target="_blank">contact us</a>.</p>
                </div>
            </div>
            <!-- Side Panel -->
            <div class="col-md-4" style="background-color: #F8F8F8;;">
                <div class="Ebb-section-about">
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Join the EBB Team</h5>
                            <p>EBB can <a href="#" style="color: #7F2149; text-decoration: underline;" >Send us</a> your resumé.</p>
                        </div>
                    </div>
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Become a Broker</h5>
                            <ul class="list-unstyled tips-list-join">
                                <li>
                                    <i class="bi bi-check-circle-fill text-purple"></i> High Commissions
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill text-purple"></i> Be Your Own Boss
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill text-purple"></i> Set Your Own Hours
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill text-purple"></i> Remotely access our Buyers & Sellers Database
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill text-purple"></i> Obtain a Steady Supply of Buyer Leads
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill text-purple"></i> Receive Full Training & Support Programs
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill text-purple"></i> Benefit from a State-of-the-Art Facility & Technology
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill text-purple"></i> Work on the Deals that Make Sense To You
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>
                                <a href="{{route('message')}}" style="color: #806132; text-decoration: underline;" target="_blank">A Message</a>
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
@endsection