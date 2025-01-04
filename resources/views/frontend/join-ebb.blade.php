@extends('frontend.layout.master')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-container py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active"><a href="#">Join EBB</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- About us page no-14 HTML-->
<div class="container my-7">
    <div class="content-box">
        <div class="row">
            <div class="about_EBB">
                <h5 class="main-heading">Join EBB</h5>
            </div>
        </div>
        <div class="row px-5 mt-5 ab_ebb">
            <!-- Main Content -->
            <div class="col-md-8 main-head">
                <div class="Content-text">
                    <h3 class="section-heading-join mb-4">A Career with Promise</h3>
                    <p class="join_us_p">Business brokerage is a niche industry that offers opportunity and unlimited earning potential. Regardless of the economic environment, people buy and sell businesses for many reasons. In the US, where 20% of the 16M private small businesses are for sale at any one time, there is a huge opportunity for intermediaries.</p>
                    <p class="join_us_p">Professional business brokers deal with both current and potential business owners. For many, the decision to purchase or sell a business is one of the largest financial decisions they will ever make. The <a href="#" class="sellorgive">role of a business broker</a> is to help turn their hopes and dreams into a reality.</p>
                    <p class="join_us_p">Executive Business Brokers is looking for individuals who fit the <a href="all.brokers" class="sellorgive" target="_blank">business broker profile</a>. They are honest professionals who work hard, have self-discipline, communicate well with others and possess a
                        willingness to learn. Our <a href="#" class="sellorgive">compensation</a> is competitive with the industry.</p>
                    <p class="join_us_p">As part of our team, you will benefit from our name recognition and reputation for quality professional service, our <a href="#" class="sellorgive">extensive marketing programs</a> and our <a href="#" class="sellorgive">comprehensive training program</a> that will support your efforts and teach you proven methods designed to ensure your success.</p>
                    <p class="join_us_p">If you are interested in talking to us about becoming an EBB business broker, we encourage you to <a href="#" class="sellorgive">send us your résumé</a> or <a href="{{route('contact.us')}}" class="sellorgive" target="_blank">contact us</a>.</p>
                </div>
            </div>
            <!-- Side Panel -->
            <div class="col-md-4" style="background-color: #F8F8F8;;">
                <div class="Ebb-section-about">
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Join the EBB Team</h5>
                            <p>Our strength is our brokers. Learn how you can <a href="{{route('join.ebb')}}"
                                    style="color: #7F2149; text-decoration: underline;" target="_blank">become part of our all-star
                                    team</a> .</p>
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

    .section-heading-join {
        font-size: 30px;
        font-weight: bold;
        color: #806132;
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

    .Content-text span {
        font-weight: bold;
    }
    .text-purple {
    color: #7F2149;
    margin-right: 10px;
}
.EBB-team-title ul li {
    margin: 20px 0px;
    font-family: 'Mulish';
    font-size: 14px;
}
p.join_us_p {
    font-family: 'Urbanist' !important;
}
</style>
@endsection