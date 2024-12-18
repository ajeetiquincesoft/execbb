@extends('frontend.layout.master')

@section('content')
<!-- Seller PAGE-NO-6 HTML-->
<!-- Breadcrumb Section -->
<div class="breadcrumb-container py-3 seller">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Sell a Business</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sellers</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container main-container">
        <!-- Main Header -->
        <h1>Determining How to Sell Your Business</h1>
        <p class="subtext">
            Executive Business Brokers (EBB) works with business owners that have various levels of experience. To accommodate different needs, we offer several services to save buyers both time and money by helping you through the  complex process of selling a business.
        </p>
        <hr>
        <!-- Cards Section -->
        <div class="card-container">
            <!-- Card 1 -->
            <div class="card-custom">
                <div class="card-title">Consulting<br>Services.</div>
                <div class="card-text">
                    EBB can help you with <a href="#">due diligence,</a> determine your <a href="#">business' valuation</a> or advise you on whether  you should sell, <a href="#">merge or acquire</a> a new business.
                </div>
            </div>
            <!-- Card 2 -->
            <div class="card-custom">
                <div class="card-title">Educational<br>information for Free.</div>
                <div class="card-text">
                    If this is your first time selling a business, we recommend that you familiarize yourself with <a href="#">the process</a> to make sure that you prepare for the sale and use of our <a href="#">resource center.</a>
                </div>
            </div>
        </div>
    </div>
<style>
   .main-container {
    background-color: #fff;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    padding: 45px;
    border-radius: 8px;
    margin: -13px auto;
    max-width: 1200px;
}
h1 {
    font-size: 1.3rem !important;
    font-weight: 600;
    text-align: center;
    margin-top: 0;
}
.subtext {
    font-size: 15px;
    text-align: center;
    margin-bottom: 30px;
    margin-left: 68px;
    margin-right: 50px;
    text-align: center;
}
a {
    color: #5D5D5D !important;
    text-decoration: none !important;
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
    padding: 43px;
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
.seller {
    font-size: 13.5px;
    margin-right: 20px;
}
</style>
@endsection