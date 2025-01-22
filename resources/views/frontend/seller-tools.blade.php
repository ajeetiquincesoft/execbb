@extends('frontend.layout.master')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-container py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Sell a Business</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tools</li>
            </ol>
        </nav>
    </div>
</div>
<div class="container my-7">
    <div class="main-container">
        <!-- Main Header -->
        <h1>Educated Clients Make Buying Easier</h1>
        <p class="subtext">
            EBB believes purchases are made easier when clients understand the process. This section identifies some of the issues that you will need to address and the <a href="{{route('anxiety')}}" target="_blank">sources of anxiety</a> that the buyer may experience.
        </p>
        <hr>
        <!-- Cards Section -->
        <div class="card-container">
            <!-- Card 1 -->
            <div class="card-custom">
                <div class="card-title">Preparing For the Sale</div>
                <div class="card-text">
                    Before you think about selling your business, <a href="{{route('salesprep')}}" target="_blank">make sure you are prepared.</a> There are three phases to the selling process: 1) Getting Ready, 2) Finding Buyers, 3) Negotiating & Closing the Deal.
                </div>
            </div>
            <!-- Card 2 -->
            <div class="card-custom">
                <div class="card-title">Determining Price</div>
                <div class="card-text">
                    There are many methods of <a href="{{route('business.valuation')}}" target="_blank">establishing the value of a business.</a> You may want to identify which method or combination of methods you believe would be most appropriate to value your business.
                </div>
            </div>
            <!-- Card 3 -->
            <div class="card-custom">
                <div class="card-title">Five Mistakes Sellers Make</div>
                <div class="card-text">
                    Watch out! Avoid the <a href="{{route('fivemistakes')}}" target="_blank">five most common mistakes</a> sellers make, which include: 1) Improper/incomplete documentation, 2) dealing with only one buyer, 3) not preparing an exit plan, 4) not knowing the value of your business, and 5) not seeking professional advice.
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .main-container {
        background-color: #fff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        padding: 79px;
        margin: -13px auto;
    }

    h1 {
        font-size: 1.7rem !important;
        font-weight: 600;
        text-align: center;
        margin-top: 0;
    }

    .subtext {
        font-size: 16px;
        text-align: center;
        margin-bottom: 30px;
    }

    .breadcrumb-item a {
        color: #626262;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    .card-container {
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
        margin-top: 50px;
    }

    .card-custom {
        background-color: #F2EFEB;
        padding: 40px;
        border: none;
        border-radius: 0px;
        max-width: 300px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        font-size: 20px;
        font-weight: 600;
        color: #806132 !important;
        margin-bottom: 15px !important;
    }

    .card-text {
        font-size: 13px;
        color: #333;
    }

    hr {
        margin: 30px auto;
        width: 100%;
    }

    .card-custom a {
        color: #7F2149 !important;
    }

    p.subtext a {
        color: #1D1C1C !important;
    }
</style>
@endsection