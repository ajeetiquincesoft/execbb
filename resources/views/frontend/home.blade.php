@extends('frontend.layout.master')
@section('content')
<!-- Hero Section -->
@php
$imagePath = asset('assets/images/Mask_group.png');
@endphp
<div class="position-relative text-center text-white" style="background-image: url('{{ $imagePath }}'); background-size: cover; background-position: center; height: 500px;">
    <div class="container h-100 d-flex flex-column justify-content-center">
        <h1 class="fw-bold mb-4">Business Listing Search</h1>
        <div class="bg-white">
            <div class="listing_search d-flex align-items-center">
                <input type="text" class="form-control form-control-lg" placeholder="Industry">
                <select class="form-select form-select-lg">
                    <option selected disabled>State</option>
                    <option value="NY">New York</option>
                    <option value="CA">California</option>
                    <option value="TX">Texas</option>
                </select>
                <div class="d-flex justify-content-center align-items-center full-screen">
                    <button class="btn btn-primary px-4 py-2">Search</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Highlights Section -->
<div class="bg-dark text-white py-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3">
                <h5>The Perfect Business Opportunity</h5>
            </div>
            <div class="col-md-3">
                <h5>Largest Marketplace of Sellers</h5>
                <p>50,000+ Businesses Listed</p>
            </div>
            <div class="col-md-3">
                <h5>Extensive Buyer Network</h5>
                <p>50k+ Successful Sales</p>
            </div>
            <div class="col-md-3">
                <h5>Highest Visitor Volume</h5>
                <p>12m Monthly Page Views</p>
            </div>
        </div>
    </div>
</div>

<!-- Categories Section -->
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Top Business Categories</h2>
        <a href="#" class="btn btn">See More Categories</a>
    </div>

    <div class="container">
        <div class="row g-3 bus_cat">
            <!-- Column 1 -->
            <div class="col">
                <a href="#" class="text-decoration-none text-primary">Bagel</a><br>
                <a href="#" class="text-decoration-none text-primary">Retail</a><br>
                <a href="#" class="text-decoration-none text-primary">Pizzeria</a>
            </div>

            <!-- Column 2 -->
            <div class="col">
                <a href="#" class="text-decoration-none text-primary">Car Wash</a><br>
                <a href="#" class="text-decoration-none text-primary">Childcare</a><br>
                <a href="#" class="text-decoration-none text-primary">Franchises</a>
            </div>

            <!-- Column 3 -->
            <div class="col">
                <a href="#" class="text-decoration-none text-primary">Automotive</a><br>
                <a href="#" class="text-decoration-none text-primary">Laundromat</a><br>
                <a href="#" class="text-decoration-none text-primary">Asset Sales</a>
            </div>

            <!-- Column 4 -->
            <div class="col">
                <a href="#" class="text-decoration-none text-primary">Gas Stations</a><br>
                <a href="#" class="text-decoration-none text-primary">Dry Cleaner</a><br>
                <a href="#" class="text-decoration-none text-primary">Liquor Store</a>
            </div>

            <!-- Column 5 -->
            <div class="col">
                <a href="#" class="text-decoration-none text-primary">Restaurant/ Bar</a><br>
                <a href="#" class="text-decoration-none text-primary">Service Business</a><br>
                <a href="#" class="text-decoration-none text-primary">SBA qualified Deals</a>
            </div>

            <!-- Column 6 -->
            <div class="col">
                <a href="#" class="text-decoration-none text-primary">Commercial Real Estate</a><br>
                <a href="#" class="text-decoration-none text-primary">Mergers & Acquisitions</a><br>
                <a href="#" class="text-decoration-none text-primary">Convenience Store/Deli</a>
            </div>
        </div>
    </div>

</div>

<!-- Bussiness Listings -->

<div class="container my-5">
    <h2 class="text mb-4">Featured Business Listings</h2>

    <!-- Carousel -->
    <div id="businessSlider" class="carousel slide" data-bs-ride="carousel">
        <!-- Indicators -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#businessSlider" data-bs-slide-to="0" class="active" aria-current="true"></button>
            <button type="button" data-bs-target="#businessSlider" data-bs-slide-to="1"></button>
        </div>

        <!-- Carousel Items -->
        <div class="carousel-inner">
            <!-- Slide 1 -->
            <div class="carousel-item active">
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    <!-- Card 1 -->
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="{{asset('assets/images/feature_listing_1.png')}}" class="card-img-top" alt="East Hanover, NJ">
                            <div class="card-body text-center">
                                <h5 class="card-title">East Hanover, NJ</h5>
                                <p class="card-text">List Price: $289000</p>
                                <p class="card-text">Down Pay: $289000</p>
                            </div>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="{{asset('assets/images/feature_listing_2.png')}}" class="card-img-top" alt="Union City, NJ">
                            <div class="card-body text-center">
                                <h5 class="card-title">Union City, NJ</h5>
                                <p class="card-text">List Price: $289000</p>
                                <p class="card-text">Down Pay: $289000</p>
                            </div>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="{{asset('assets/images/feature_listing_3.png')}}" class="card-img-top" alt="Bronx, NY">
                            <div class="card-body text-center">
                                <h5 class="card-title">Bron X, NY</h5>
                                <p class="card-text">List Price: $289000</p>
                                <p class="card-text">Down Pay: $289000</p>
                            </div>
                        </div>
                    </div>
                    <!-- Card 4 -->
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="{{asset('assets/images/feature_listing_4.png')}}" class="card-img-top" alt="Jersey City, NJ">
                            <div class="card-body text-center">
                                <h5 class="card-title">Jersey City, NJ</h5>
                                <p class="card-text">List Price: $289000</p>
                                <p class="card-text">Down Pay: $289000</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item">
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    <!-- Reuse same cards for demonstration -->
                    <!-- Card 1 -->
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="{{asset('assets/images/feature_listing_1.png')}}" class="card-img-top" alt="East Hanover, NJ">
                            <div class="card-body text-center">
                                <h5 class="card-title">East Hanover, NJ</h5>
                                <p class="card-text">List Price: $289000</p>
                                <p class="card-text">Down Pay: $289000</p>
                            </div>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="{{asset('assets/images/feature_listing_2.png')}}" class="card-img-top" alt="Union City, NJ">
                            <div class="card-body text-center">
                                <h5 class="card-title">Union City, NJ</h5>
                                <p class="card-text">List Price: $289000</p>
                                <p class="card-text">Down Pay: $289000</p>
                            </div>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="{{asset('assets/images/feature_listing_3.png')}}" class="card-img-top" alt="Bronx, NY">
                            <div class="card-body text-center">
                                <h5 class="card-title">Bron X, NY</h5>
                                <p class="card-text">List Price: $289000</p>
                                <p class="card-text">Down Pay: $289000</p>
                            </div>
                        </div>
                    </div>
                    <!-- Card 4 -->
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="{{asset('assets/images/feature_listing_4.png')}}" class="card-img-top" alt="Jersey City, NJ">
                            <div class="card-body text-center">
                                <h5 class="card-title">Jersey City, NJ</h5>
                                <p class="card-text">List Price: $289000</p>
                                <p class="card-text">Down Pay: $289000</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#businessSlider" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#businessSlider" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<!-- LEADING AGENTS -->

<section class="leading-agents">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="section-title-agents">Leading Agents</h2>
            <a href="#" class="see-all-brokers">See All Brokers</a>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <!-- Agent Card 1 -->
            <div class="col">
                <div class="agent-card d-flex">
                    <img src="{{asset('assets/images/larry_bodner_picture_1.png')}}" alt="Larry Bodner" class="agent-image">
                    <div>
                        <h5 class="mb-1">Larry Bodner</h5>
                        <p class="mb-0">Mr. Bodner has over thirty years of successful business ownership experience.</p>
                    </div>
                </div>
            </div>
            <!-- Agent Card 2 -->
            <div class="col">
                <div class="agent-card d-flex">
                    <img src="{{asset('assets/images/larry_bodner_picture_2.png')}}" alt="Arthur Casares" class="agent-image">
                    <div>
                        <h5 class="mb-1">Arthur Casares</h5>
                        <p class="mb-0">Larry Svoboda Larry has over 30 years experience buying, selling and operating businesses.</p>
                    </div>
                </div>
            </div>
            <!-- Agent Card 3 -->
            <div class="col">
                <div class="agent-card d-flex">
                    <img src="{{asset('assets/images/larry_bodner_picture_3.png')}}" alt="Howard Goldberg" class="agent-image">
                    <div>
                        <h5 class="mb-1">Howard Goldberg</h5>
                        <p class="mb-0">Howard was a partner & president of a major New Jersey liquor & wine wholesale distributing company.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- SELLER & BUYER -->

<div class="container my-5">
    <div class="row">
        <!-- Sellers Section -->
        <div class="col-md-6">
            <div class="custom-section">
                <h2 class="section-title">Sellers</h2>
                <div class="divider"></div>
                <div class="list-item">
                    <span class="list-item-icon">
                        <i class="bi bi-check-circle-fill"></i>
                    </span>
                    <div>
                        <p class="list-item-title">Ask the Experts to Sell Your Business</p>
                        <p class="list-item-description">Looking for help to sell your business? <a href="#">EBB can guide you</a> through the process from business valuations to locating buyers.</p>
                    </div>
                </div>
                <div class="list-item">
                    <span class="list-item-icon">
                        <i class="bi bi-check-circle-fill"></i>
                    </span>
                    <div>
                        <p class="list-item-title">EBB Offers Several Listing Programs</p>
                        <p class="list-item-description">List with EBB and benefit from our database, reputation, and marketing efforts that draw in qualified buyers. <a href="#">Replica Watches</a></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Buyers Section -->
        <div class="col-md-6">
            <div class="custom-section">
                <h2 class="section-title">Buyers</h2>
                <div class="divider"></div>
                <div class="list-item">
                    <span class="list-item-icon">
                        <i class="bi bi-check-circle-fill"></i>
                    </span>
                    <div>
                        <p class="list-item-title">Accelerate Your Search</p>
                        <p class="list-item-description">Become an <a href="#">EBB Preferred Buyer</a> and benefit from our full services; access detailed information on 100s of businesses online 24/7.</p>
                    </div>
                </div>
                <div class="list-item">
                    <span class="list-item-icon">
                        <i class="bi bi-check-circle-fill"></i>
                    </span>
                    <div>
                        <p class="list-item-title">Secure Financing Through EBB</p>
                        <p class="list-item-description">Work with one of <a href="#">our mortgage specialists</a> to get the terms and rate that is right for you.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- OUR SERVICES -->

<div class="container services-section">
    <h2>Our Services</h2>
    <div class="py-">
        <div class="align-items-center d-flex justify-content-between mb-4 w-100">
            <a>EBB Offers Buyers/Sellers 1 Stop Shopping</a>
            <a href="#" class="btn btn">View All Services</a>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="service-card">
                    <img src="{{asset('assets/images/services_1.png')}}">
                    <div class="service-content text-center">
                        <h5 class="service-title">Consulting</h5>
                        <p class="service-description">Executive Business Brokers (EBB) offers consulting services for any aspect of buying/selling a business.We work with buyers and sellers to.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="service-card">
                    <img src="{{asset('assets/images/services_2.png')}}">
                    <div class="service-content text-center">
                        <h5 class="service-title">Business Valuations</h5>
                        <p class="service-description">Valuing a business is not an exact science. There is no right way to determine price, as there are many methods of doing so. Many factors play into value.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="service-card">
                    <img src="{{asset('assets/images/services_3.png')}}">
                    <div class="service-content text-center">
                        <h5 class="service-title">Mergers & Acquisitions</h5>
                        <p class="service-description">In most cases it is more profitable for a business to grow by acquisition. It is also faster, more economical, less risky, and easier to finance.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- WHY EBB -->

<!-- <title>Why EBB</title> -->
<div class="container-fluid p-0 why-ebb-section d-flex align-items-center">
    <div class="row w-100">
        <div class="col-lg-7 col-md-12 image-container">
            <div class="overlay"></div>
            <img src="{{asset('assets/images/why_ebb.png')}}" alt="Handshake" class="img-fluid">
        </div>
        <div class="col-lg-5 col-md-12 text-container d-flex align-items-center">
            <div class="content px-4">
                <h2 class="title">Why EBB?</h2>
                <h3 class="subtitle">Buying and Selling a Business is Easier with EBB</h3>
                <p class="description">
                    Executive Business Brokers has handled the marketing and sales efforts
                    for over 1,000 small to mid-sized businesses in retail, service, and
                    manufacturing and distribution industries.
                </p>
                <p class="description">
                    Our consultative approach to buying and selling makes selling a business easier.
                </p>
                <a href="#" class="btn learn-more-btn">Learn More</a>
            </div>
        </div>
    </div>
</div>

<!-- PHASES -->
<section class="phases-section py-5">
    <div class="container text-center">
        <!-- Heading Section -->
        <p class="text-uppercase text-muted small fw-bold">Phases</p>
        <h2 class="fw-bold mb-3">Phases of Buying A Business</h2>
        <p class="text-muted mb-5">
            Buying a business is a complex and time-consuming process that can be broken down into four main phases.
        </p>

        <!-- Phase Cards Section -->
        <div class="row justify-content-center">
            <!-- Card 1 -->
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="custom-card">
                    <div class="number-badge">01</div>
                    <h5 class="card-title">Confidentiality Agreement</h5>
                    <a href="#" class="example-link">Example &rarr;</a>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="custom-card">
                    <div class="number-badge">02</div>
                    <h5 class="card-title">Preliminary Negotiations/Letter of Intent</h5>
                    <a href="#" class="example-link">Example &rarr;</a>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="custom-card">
                    <div class="number-badge">03</div>
                    <h5 class="card-title">Due Diligence</h5>
                    <a href="#" class="example-link">Example &rarr;</a>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="custom-card">
                    <div class="number-badge">04</div>
                    <h5 class="card-title">Negotiation/ Definitive Acquisition Agreement</h5>
                    <a href="#" class="example-link">Example &rarr;</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection