@extends('frontend.layout.master')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-container py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">About EBB</a></li>
                <li class="breadcrumb-item"><a href="#">Join EBB</a></li>
                <li class="breadcrumb-item active"><a href="#">Qualifications</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- About us page no-14 HTML-->
<div class="container my-7">
    <div class="content-box">
        <div class="row">
            <div class="about_EBB">
                <h5 class="main-heading">Qualifications</h5>
            </div>
        </div>
        <div class="row px-3 px-md-5 mt-2 mt-md-5 ab_ebb">
            <!-- Main Content -->
            <div class="col-md-8 main-head">
                <div class="Content-text">
                    <h3 class="section-heading-join mb-4">Are You a Strong Candidate?</h3>
                    <p class="join_us_p">Executive Business Brokers is looking for individuals who possess strong interpersonal skills, have the desire to work hard, and are persistent and patient.</p>
                    <p class="join_us_p">For this type of position, a strong background in business or sales helps. Many of <a href="{{route('all.brokers')}}" class="sellorgive" >our brokers</a> have owned their own businesses or spearheaded new ventures for their previous employer. This type of experience has given them a unique perspective and insight into the operation and management of businesses.</p>
                    <p class="join_us_p">As an intermediary, a business broker also possesses creative problem solving skills to help them meet and overcome challenging situations. They also need good organizational and time management skills to help them juggle all the sales leads and businesses they have listed.</p>
                    <p class="join_us_p">Most importantly, a business broker should enjoy talking and working with people. They need to be self-motivated, creative and resourceful. Many of our business brokers derive a sense of achievement out
                    of helping others solve problems.</p>
                    <p class="join_us_p">If you believe you fit the profile of a business broker, we encourage you to <a href="#" class="sellorgive">send us your résumé</a> or <a href="{{route('contact.us')}}" class="sellorgive" >contact us</a>.</p>
                </div>
            </div>
            <!-- Side Panel -->
            <div class="col-md-4" style="background-color: #F8F8F8;;">
                <div class="Ebb-section-about">
                    <div class="boxes-button-section">
                        <div class="EBB-team-title">
                            <h5>Join the EBB Team</h5>
                            <p>Our strength is our brokers. Learn how you can <a href="{{route('join.ebb')}}"
                                    style="color: #7F2149; text-decoration: underline;" >become part of our all-star
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
    padding: 0px 15px;
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