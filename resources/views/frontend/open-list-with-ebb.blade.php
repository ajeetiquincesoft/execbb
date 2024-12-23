@extends('frontend.layout.master')
@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-container open-list">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Sell a Business</a></li>
                <li class="breadcrumb-item active" aria-current="page">List With EBB</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Main Container -->
<div class="box-container">
        <!-- Title -->
        <div class="text-center mb-5">
            <h1 class="main-title">List with EBB</h1>
            <p class="main-subtitle">
                Executive Business Brokers understands sellers have different needs, which is why we offer three programs <br>
                to help you sell your business.
            </p>
        </div>
        <!-- Cards Section -->
        <div class="row g-4">
            <!-- Card 1 -->
            <div class="col-12">
                <div class="card p-4 shadow-sm">
                    <div class="row align-items-center">
                        <div class="col-md-4 EBB-border">
                            <h3 class="card-title-color">Sole & Exclusive Right to Sell</h3>
                            <p class="card-text">Executive Business Brokers (EBB) retains sole and exclusive rights to sell your business.</p>
                            <div class="btn-color">
                            <a href="#" class="btn reg">Register</a>
                            <a href="#" class="btn reg">View Agreement</a>
                        </div>
                    </div>
                        <div class="col-md-8">
                            <div class="card-EBB">
                            <p class="card-description">
                                <strong>Advantage -</strong> Listing exclusively with EBB will give you  greater exposure by UNLEASHING the full  marketing powers of EBB and uniting our entire organization’s efforts to sell your business. As a professional organization, EBB will represent your best interest and market your business to a substantially larger audience of pre-qualified buyers, while never loosing sight of the importance of CONFIDENTIALITY. These increased marketing efforts often result in faster closings and increase the odds of generating a premium for your business.<br><br>
                                <strong>Disadvantage -</strong> You relinquish rights to sell your own business for the terms set forth in the  contract.
                            </p>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col-12">
                <div class="card p-4 shadow-sm">
                    <div class="row align-items-center">
                        <div class="col-md-4 EBB-border">
                            <h3 class="card-title-color">Agency Exclusive Agreement</h3>
                            <p class="card-text">EBB is the exclusive brokerage agency, but the seller retains the flexibility of trying to sell the business on his/her own while gaining valuable exposure to our buyers. EBB’s fee is paid only if you decide to accept an offer from one of our buyers. If you find your own buyer there is no commission due to EBB.</p>
                            <div class="btn-color">
                                <a href="#" class="btn reg">Register</a>
                                <a href="#" class="btn reg">View Agreement</a>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-EBB">
                            <p class="card-description">
                                <strong>Advantage:</strong> By engaging us you have a professional organization representing your interest and marketing your business.<br><br>
                                <strong>Disadvantage:</strong> The seller takes on the responsibility of marketing their business, dealing with non-qualified prospects, negotiating price terms and conditions, dealing with the landlords, attorneys, and accountants which are always time consuming  processes. Many times these distractions affect your ability to run your business effectively. Very often businesses that are sold by owners take much longer to sell & frequently sell for less than the market value.<br> </br> With an open listing there may be several agencies and brokers working on the sale of your business however, many times the facts and details of your business become distorted & inconsistent. More importantly the confidentiality of the sale is diminished. In addition, many experienced brokers feel that they are competing with the seller and that their time could be better spent on exclusive listings.
                            </p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col-12">
                <div class="card p-4 shadow-sm">
                    <div class="row align-items-center">
                        <div class="col-md-4 EBB-border">
                            <h3 class="card-title-color">Open Listing Agreement</h3>
                            <p class="card-text">The seller can hire as many Brokers as he/she wishes and also reserve  the right to sell the business on his/her own. The commission is paid  only to the Broker that initiated the sale.</p>
                            <div class="btn-color">
                                <a href="#" class="btn reg">Register</a>
                                <a href="#" class="btn reg">View Agreement</a>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-EBB">
                            <p class="card-description">
                                <strong>Advantage:</strong> No commissions are paid to EBB unless we find you a buyer. The seller can use multiple brokers.<br><br>
                                <strong>Disadvantage:</strong> The seller is responsible for  marketing their business, dealing with non-qualified prospects and negotiating the price - a time consuming process. Many times this results in lower sale price or a longer sales period.<br></br> your information about your business can become inconsistent, distorted and given out freely when you use multiple brokers since there is no one point person looking out for your best interests. In addition, many brokers feel they are competing with the seller and that their time would be better spent on exclusive listings.
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
    .breadcrumb {
        background: transparent;
    }

    .box-container {
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 65px;
            margin: 0px auto;
            max-width: 1100px;
        }
        .main-title {
            font-size: x-large;
            font-weight: 600;
            color: #000000;
        }
        .main-subtitle {
            color: #5D5D5D;
        }
        .card {
            border-radius: 8px;
        }
        .main-subtitle::after {
            content: '';
            display: block;
            width: 100%; /* Length of the line */
            height: 1px; /* Thickness of the line */
            background-color: #B3B3B3; /* Line color */
            margin: 28px auto -32px; /* Center the line and add spacing */
        }
        .card-title-color{
            color: #806132;
            font-size: 30px
        }
        .card-text{
            font-size: 14px;
        }
        .btn.reg {
            background-color: #7F2149;
            color: white;
            border: 1px sold;
            border-radius: 1px;
        }
        .b, strong {
            color: #806132;
            font-weight: 400;
        }
        .card-description{
            font-size: 14px;
        }
        .EBB-border{
            border-right: 1px solid #333333;
        }
        .card-EBB {
            margin: 0 20px;
        }
        .open-list{
            padding-top: 20px;
        }
</style>
@endsection