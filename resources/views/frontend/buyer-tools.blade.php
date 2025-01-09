@extends('frontend.layout.master')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-container py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Buy a Business</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tools</li>
            </ol>
        </nav>
    </div>
</div>
<div class="container main-container buyer_tool">
    <!-- Main Header -->
    <h1>We Believe It is Important to Educate Our Clients</h1>
    <p class="subtext">
        This section identifies some of the issues you will need to address and the <a href="#">sources of anxiety</a> that you may experience when buying a business.
    </p>
    <hr>
    <!-- Cards Section -->
    <div class="card-container">
    <div class="row">
        <!-- Card 1 -->
        <div class="col-12 col-md-4">
            <div class="card-custom">
                <div class="card-title">Business<br> Organizations</div>
                <div class="card-text">
                    Before you embark upon your search, identify the <a href="#">business structure</a> that would be most appropriate for your situation.
                </div>
            </div>
        </div>
        <!-- Card 2 -->
        <div class="col-12 col-md-4">
            <div class="card-custom">
                <div class="card-title">Phases of Buying<br>a Business</div>
                <div class="card-text">
                    There are four main phases to buying a business. Familiarize yourself with <a href="#">the process</a> before you start your search.
                </div>
            </div>
        </div>
        <!-- Card 3 -->
        <div class="col-12 col-md-4">
            <div class="card-custom">
                <div class="card-title">Determining Price</div>
                <div class="card-text">
                    There are many methods of establishing the value of a business. Learn more about <a href="{{route('business.valuation')}}" target="_blank">business valuations</a> - it's an important part of the buying process.
                </div>
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
        border-radius: 8px;
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