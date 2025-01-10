@extends('frontend.layout.master')
@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-container py-3">
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
<div class="main-container">
        <!-- Title -->
        <h1>List Your Business with EBB</h1>
        <!-- Hero Section -->
        <div class="hero-section row align-items-center">
            <div class="col-md-6">
                <img src="{{ asset('assets/images/list_with_ebb.png') }}" alt="Business Meeting">
            </div>
            <div class="col-md-6 hero-text">
                <h2>Selling a business is a complex, time consuming process</h2>
                <p>It requires finding buyers, qualifying them, and negotiating the deal. At the same time, you still need to run your business.</p>
                <p>This is where Executive Business Brokers can help you. We are  experts at selling businesses and can <a href="#">guide you through the process.</a> When you list your business with us, our  services include:</p>
            </div>
        </div>
        <div class="after-hero-section"></div>
        <!-- Cards Section -->
        <div class="cards-container">
            <!-- Card 1 -->
            <div class="card-custom">
                <h3>Initial Meeting.</h3>
                <p>At this meeting, together we establish the objectives and timing for the sale.</p>
            </div>
            <!-- Card 2 -->
            <div class="card-custom">
                <h3>Business Evaluation.</h3>
                <p>EBB evaluates your company to provide you with a <a href="{{route('business.valuation')}}" class="sellorgive" target="_blank">business valuation.</a></p>
            </div>
            <!-- Card 3 -->
            <div class="card-custom">
                <h3>Listing Agreement.</h3>
                <p>The seller signs an agreement with EBB outlining the services to be provided and our fees.</p>
            </div>
            <!-- Card 4 -->
            <div class="card-custom">
                <h3>Marketing Materials.</h3>
                <p>EBB prepares  sales materials based on <a href="#">information from the seller</a> that outlines the businesses operation and finances  for prospective buyers.</p>
            </div>
            <!-- Card 5 -->
            <div class="card-custom">
                <h3>Confidential Marketing.</h3>
                <p>All prospective buyers sign a  confidentiality agreement prior to viewing the financial details and specifics of your businesses.</p>
            </div>
            <!-- Card 6 -->
            <div class="card-custom">
                <h3>Coordinating Negotiations and Closing the Sale.</h3>
                <p>EBB works with third parties (accountants, attorneys, bankers and landlords) to structure the deal and then coordinates the closing.</p>
            </div>
        </div>
        <div class="List_with_EBB">
        <!-- Button -->
        <a href="#" class="btn-custom">List With EBB</a>
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
   .card-custom a {
    color: #7F2149 !important;
}
p.subtext a {
    color: #1D1C1C !important;
}
/* Main Container */
.main-container {
    background-color: #fff;
    padding: 54px;
    max-width: 1133px;
    margin: -8px auto;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}
/* Header Text */
h1 {
    font-size: 1.5rem !important;
    text-align: center;
    font-size: 22px;
    font-weight: 600;
    margin-bottom: 25px;
}
/* Hero Section */
.hero-section img {
    width: 100%;
    border-radius: 6px;
}
.hero-section .hero-text {
    padding: 20px 60px;
}
.hero-section h2 {
    font-size: 28px;
    font-weight: 600;
    color: #806132;
}
.hero-section p {
    font-size: 15px;
    color: #555;
    line-height: 1.6;
}
/* Cards Section */
.cards-container {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    margin-top: 50px;
    justify-content: center;
}
.card-custom {
    background-color: #F7F5F2;
    padding: 32px;
    border: none;
    flex: 1 1 30%;
    min-width: 250px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
.card-custom h3 {
    font-size: 22px;
    font-weight: 600;
    color: #806132;
    margin-bottom: 10px;
}
.card-custom p {
    font-size: 16px;
    color: #555;
    line-height: 1.5;
}
/* Button Section */
.btn-custom {
    background-color: #7F2149;
    color: #fff;
    font-size: 15px;
    padding: 15px 26px;
    text-decoration: none;
    text-align: center;
}
.List_with_EBB {
    position: relative;
    text-align: center;
    margin: 40px 0px;
}
.btn-custom:hover {
    background-color: #8E0F50;
    color: #fff;
}
.align-items-center {
    align-items: center;
    margin-top: 90px !important;
}
/* h1::after {
    content: "";
    display: block;
    width: 660px;
    height: 1px;
    background-color: #B3B3B3;
    position: absolute; 
    left: 60%; 
    transform: translateX(-50%); 
    margin-top: 41px; 
} */
/* New Section Styling */
/* .after-hero-section {
    display: block;
    height: 1px; 
    width: 100%; 
    margin-top: 50px;
    background-color: #B3B3B3;
    text-align: center;
} */
.hero-text a {
    color: #7F2149; /* Purple for links */
    text-decoration: underline; /* Optional: underline for emphasis */
}
  
</style>
@endsection