@extends('frontend.layout.master')
@section('content')
    <!-- Hero Section -->
    @php
        $imagePath = asset('assets/images/Mask_group.png');
        $buyersImagePath = asset('assets/images/Buyers1.png');
    @endphp
    <div class="position-relative text-center text-white"
        style="background-image: url('{{ $imagePath }}'); background-size: cover; background-position: center; height: 500px;">
        <div class="container position-absolute top-50 start-50 translate-middle d-flex flex-column justify-content-center">
            <h1 class="fw-bold mb-4">Business Listing Search</h1>
            <form class="listing_search" method="get" action="{{ route('search.index') }}">
                <div class="bus_lis_search">
                    <div class="listing_search d-md-flex align-items-center">
                        <input type="text" class="form-control form-control-lg" placeholder="Industry" name="industry"
                            value="{{ request('industry') }}">
                        <select class="form-select form-select-lg" name="state">
                            <option selected value="" disabled>State</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->State }}">{{ $state->StateName }}</option>
                            @endforeach
                        </select>
                        <div class="d-flex justify-content-center align-items-center full-screen">
                            <button type="submit" class="btn btn-primary px-4 py-2">Search</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Highlights Section -->
    <div class="bg-dark-color text-white py-5">
        <div class="container prefect_bus">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-3 border-right px-5">
                    <h5>The Perfect Business Opportunity</h5>
                </div>
                <div class="col-12 col-md-6 col-lg-3 border-right px-5">
                    <h5>Largest Marketplace of Sellers</h5>
                    <p>50,000+ Businesses Listed</p>
                </div>
                <div class="col-12 col-md-6 col-lg-3 border-right px-5">
                    <h5>Extensive Buyer Network</h5>
                    <p>50k+ Successful Sales</p>
                </div>
                <div class="col-12 col-md-6 col-lg-3 px-5">
                    <h5>Highest Visitor Volume</h5>
                    <p>12m Monthly Page Views</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="bus_listing">
        <div class="container py-5">
            <div class="d-md-flex justify-content-between align-items-center mb-4 top_business">
                <h2>Top Business Categories</h2>
                <div class="see_more">
                    <a href="#" class="btn btn">See More Categories</a>
                </div>
            </div>
            <div class="row g-3 bus_cat row-cols-3 row-cols-md-3 row-cols-lg-6">
                <!-- Column 1 -->
                <div class="col">
                    <a href="#" class="text-decoration-none text-primary">Bagel</a>
                    <a href="#" class="text-decoration-none text-primary">Retail</a>
                    <a href="#" class="text-decoration-none text-primary">Pizzeria</a>
                </div>

                <!-- Column 2 -->
                <div class="col">
                    <a href="#" class="text-decoration-none text-primary">Car Wash</a>
                    <a href="#" class="text-decoration-none text-primary">Childcare</a>
                    <a href="#" class="text-decoration-none text-primary">Franchises</a>
                </div>

                <!-- Column 3 -->
                <div class="col">
                    <a href="#" class="text-decoration-none text-primary">Automotive</a>
                    <a href="#" class="text-decoration-none text-primary">Laundromat</a>
                    <a href="#" class="text-decoration-none text-primary">Asset Sales</a>
                </div>

                <!-- Column 4 -->
                <div class="col">
                    <a href="#" class="text-decoration-none text-primary">Gas Stations</a>
                    <a href="#" class="text-decoration-none text-primary">Dry Cleaner</a>
                    <a href="#" class="text-decoration-none text-primary">Liquor Store</a>
                </div>

                <!-- Column 5 -->
                <div class="col">
                    <a href="#" class="text-decoration-none text-primary">Restaurant/ Bar</a>
                    <a href="#" class="text-decoration-none text-primary">Service Business</a>
                    <a href="#" class="text-decoration-none text-primary">SBA qualified Deals</a>
                </div>

                <!-- Column 6 -->
                <div class="col">
                    <a href="#" class="text-decoration-none text-primary">Commercial Real Estate</a>
                    <a href="#" class="text-decoration-none text-primary">Mergers & Acquisitions</a>
                    <a href="#" class="text-decoration-none text-primary">Convenience Store/Deli</a>
                </div>
            </div>

        </div>
    </div>

    <!-- Bussiness Listings -->

    <div class="container my-5 business_listing_slider">
        <div class="d-md-flex justify-content-between align-items-center mb-4">
            <h2 class="text mb-4">Featured Business Listings</h2>
            <a href="{{ route('business.listings') }}" class="see_all_listing" target="_blank">See All Listings</a>
        </div>
        @if ($listings->isEmpty())
            <p class="no_lis">No listings available.</p>
        @else
            <!-- Previous and Next buttons (as divs) -->
            <div class="carousel-controls">
                <div class="carousel-prev"><i class="fas fa-chevron-left"></i></div>
                <div class="carousel-next"><i class="fas fa-chevron-right"></i></div>
            </div>
            <!-- Carousel Items -->
            <div class="slider card-container">
                @foreach ($listings as $listing)
                    <div class="card shadow-sm">
                        <!-- <img src="{{ asset('assets/uploads/images/' . $listing->imagepath) }}" class="card-img-top" alt="{{ $listing->City }}, {{ $listing->State }}"> -->
                        @if (!empty($listing->imagepath))
                            <a href="{{ route('view.business.listing', $listing->ListingID) }}"><img
                                    src="{{ asset('assets/uploads/images/' . $listing->imagepath) }}" class="card-img-top"
                                    alt="{{ $listing->City }}, {{ $listing->State }}"></a>
                        @else
                            <a href="{{ route('view.business.listing', $listing->ListingID) }}"><img
                                    src="{{ asset('assets/images/shutterstock.png') }}" class="card-img-top"
                                    alt="{{ $listing->City }}, {{ $listing->State }}"></a>
                        @endif
                        <div class="card-body text-center">
                            <a href="{{ route('view.business.listing', $listing->ListingID) }}"
                                class="home_business_listing">
                                <h5 class="card-title card-title-slider">{{ $listing->City }}, {{ $listing->State }}</h5>
                            </a>
                            <p class="card-text mb-0">List Price: ${{ number_format($listing->ListPrice ?? 0, 2) }}</p>
                            <p class="card-text">Down Pay: ${{ number_format($listing->DownPay ?? 0, 2) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- LEADING AGENTS -->

    <section class="leading-agents">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="section-title-agents">Leading Agents</h2>
                <a href="{{ route('all.brokers') }}" class="see-all-brokers" target="_blank">See All Brokers</a>
            </div>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <!-- Agent Card 1 -->
                @foreach ($agents as $agent)
                    @php
                        $text = strip_tags($agent->Comments);
                        $words = explode(' ', $text);
                        $limitedComment = implode(' ', array_slice($words, 0, 12));

                        if (count($words) > 15) {
                            $limitedComment .= '...';
                        }
                    @endphp
                    <div class="col">
                        <div class="agent-card d-lg-flex">
                            @if (!empty($agent->image))
                                <a href="{{ route('view.broker.profile', $agent->AgentUserRegisterId) }}"
                                    target="_blank"><img src="{{ asset('assets/uploads/images/' . $agent->image) }}"
                                        alt="{{ $agent->FName }} {{ $agent->LName }}" class="agent-image"></a>
                            @else
                                <a href="{{ route('view.broker.profile', $agent->AgentUserRegisterId) }}"
                                    target="_blank"><img src="{{ asset('assets/images/avatar.png') }}"
                                        alt="{{ $agent->FName }} {{ $agent->LName }}" class="agent-image"></a>
                            @endif
                            <div class="leading_agent">
                                <a href="{{ route('view.broker.profile', $agent->AgentUserRegisterId) }}"
                                    target="_blank">
                                    <h5 class="mb-1">{{ ucfirst($agent->FName) }} {{ ucfirst($agent->LName) }}</h5>
                                </a>
                                <p class="mb-0">{{ $limitedComment }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <!-- SELLER & BUYER -->

    <div class="container my-5">
        <div class="row">
            <!-- Sellers Section -->
            <div class="col-md-6">
                <div class="custom-section" style="background: url('{{ $buyersImagePath }}') no-repeat center center;">
                    <h2 class="section-title">Sellers</h2>
                    <div class="divider"></div>
                    <div class="list-item">
                        <span class="list-item-icon">
                            <i class="bi bi-check-circle-fill"></i>
                        </span>
                        <div>
                            <p class="list-item-title">Ask the Experts to Sell Your Business</p>
                            <p class="list-item-description">Looking for help to sell your business? <a
                                    href="{{ route('list.with.ebb') }}" target="_blank">EBB can guide you</a> through the
                                process from business valuations to locating buyers.</p>
                        </div>
                    </div>
                    <div class="list-item">
                        <span class="list-item-icon">
                            <i class="bi bi-check-circle-fill"></i>
                        </span>
                        <div>
                            <p class="list-item-title">EBB Offers Several Listing Programs</p>
                            <p class="list-item-description"><a href="{{ route('open-list.with.ebb') }}"
                                    target="_blank">List with EBB</a> and benefit from our database, reputation, and
                                marketing efforts that draw in qualified buyers. <a href="https://50graphics.com/"
                                    target="_blank">Replica Watches</a></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Buyers Section -->
            <div class="col-md-6">
                <div class="custom-section" style="background: url('{{ $buyersImagePath }}') no-repeat center center;">
                    <h2 class="section-title">Buyers</h2>
                    <div class="divider"></div>
                    <div class="list-item">
                        <span class="list-item-icon">
                            <i class="bi bi-check-circle-fill"></i>
                        </span>
                        <div>
                            <p class="list-item-title">Accelerate Your Search</p>
                            <p class="list-item-description">Become an <a href="{{ route('preferred.buyers.program') }}"
                                    target="_blank">EBB Preferred Buyer</a> and benefit from our full services; access
                                detailed information on 100s of businesses online 24/7.</p>
                        </div>
                    </div>
                    <div class="list-item">
                        <span class="list-item-icon">
                            <i class="bi bi-check-circle-fill"></i>
                        </span>
                        <div>
                            <p class="list-item-title">Secure Financing Through EBB</p>
                            <p class="list-item-description">Work with one of <a href="{{ route('financing') }}"
                                    target="_blank">our mortgage specialists</a> to get the terms and rate that is right
                                for you.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- OUR SERVICES -->
    <div class="ser-section">
        <div class="container services-section">
            <h2>Our Services</h2>
            <div class="our_service_title">
                <div class="align-items-center d-md-flex justify-content-between mb-4 w-100">
                    <a class="ebb-offer-text">EBB Offers Buyers/Sellers 1 Stop Shopping</a>
                    <a href="{{ route('services') }}" class="btn btn view_all_services" target="_blank">View All
                        Services</a>
                </div>

                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="service-card">
                            <img src="{{ asset('assets/images/services_1.png') }}">
                            <div class="service-content text-center">
                                <h5 class="service-title">Consulting</h5>
                                <p class="service-description">Executive Business Brokers (EBB) offers consulting services
                                    for
                                    any aspect of buying/selling a business.We work with buyers and sellers to.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="service-card">
                            <img src="{{ asset('assets/images/services_2.png') }}">
                            <div class="service-content text-center">
                                <h5 class="service-title">Business Valuations</h5>
                                <p class="service-description">Valuing a business is not an exact science. There is no
                                    right
                                    way to determine price, as there are many methods of doing so. Many factors play into
                                    value.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="service-card">
                            <img src="{{ asset('assets/images/services_3.png') }}">
                            <div class="service-content text-center">
                                <h5 class="service-title">Mergers & Acquisitions</h5>
                                <p class="service-description">In most cases it is more profitable for a business to grow
                                    by
                                    acquisition. It is also faster, more economical, less risky, and easier to finance.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- WHY EBB -->

    <!-- <title>Why EBB</title> -->
    <div class="container-fluid why-ebb-section align-items-center">
        <div class="row">
            <div class="col-lg-7 col-md-12 image-container">
                <div class="overlay"></div>
                <img src="{{ asset('assets/images/why_ebb.png') }}" alt="Handshake" class="img-fluid">
            </div>
            <div class="col-lg-5 col-md-12 text-container align-items-center">
                <div class="content-ebb px-4 px-sm-0 ebb_padding_remove">
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
                    <div class="why_ebb_btn">
                        <a href="#" class="btn learn-more-btn">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PHASES -->
    <section class="phases-section">
        <div class="container text-center">
            <!-- Heading Section -->
            <p class="text-uppercase text-muted small fw-bold phase_title">Phases</p>
            <h2 class="fw-bold mb-3">Phases of Buying A Business</h2>
            <div class="phase_complex">
                <p class="text-muted phase_complex_center">
                    Buying a business is a complex and time-consuming process that can be broken down into four main phases.
                </p>
            </div>

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Initialize the Slick slider
        $(document).ready(function() {
            $('.slider').slick({
                infinite: true, // Loop through the slides
                slidesToShow: 4, // Show four slides at a time
                slidesToScroll: 1, // Move one slide per click
                prevArrow: $('.carousel-prev'), // Link the previous button to the slick carousel
                nextArrow: $('.carousel-next'),
                dots: true, // Display navigation dots
                autoplay: true, // Auto slide
                autoplaySpeed: 2000, // Time between slides
                fade: false, // Disable fade transition
                speed: 500, // Transition speed in ms

                // Responsive settings
                responsive: [{
                        breakpoint: 1024, // For tablets
                        settings: {
                            slidesToShow: 3 // Show 3 items on smaller screens
                        }
                    },
                    {
                        breakpoint: 768, // For mobile devices
                        settings: {
                            slidesToShow: 2 // Show 2 items on smaller screens
                        }
                    },
                    {
                        breakpoint: 480, // For very small devices
                        settings: {
                            slidesToShow: 1 // Show 1 item on very small screens
                        }
                    }
                ]
            });
        });
    </script>
    <style>
        .ser-section {
            position: relative;
            background: url('{{ asset('assets/images/our-services-section.png') }}');
            background-size: cover;
            background-position: center;
        }

        .ebb-offer-text {
            color: #000;
            text-decoration: none;
        }

        .why-ebb-section {
            position: relative;
            background: url('{{ asset('assets/images/gray-abstract.png') }}');
            background-size: cover;
            background-position: center;
        }

        /* Style the carousel controls (prev & next buttons) */
        .business_listing_slider {
            position: relative;
        }

        .carousel-controls {
            position: absolute;
            top: 40px;
            right: 35px;
            display: flex;
            gap: 10px;
            z-index: 10;
        }

        /* Styling for the div controls */
        .carousel-prev,
        .carousel-next {
            font-size: 18px;
            /* Adjust size for < and > symbols */
            color: #34485C;
            /* Text color */
            padding: 8px 12px;
            /* Padding around the symbol */
            cursor: pointer;
            border-radius: 50%;
            /* Make it round */
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s ease;
        }

        .slider {
            position: relative;
            padding-bottom: 30px;
        }

        .slider .card {
            margin-right: 10px;
        }

        .slider .slick-slide:last-child .card {
            margin-right: 0;
        }

        .slider .card {
            width: 100%;
            max-width: 100%;
        }

        .border-right {
            border-right: 1px solid #806132;
            /* White border between sections */
        }

        .prefect_bus p {
            color: #D9D9D9;
            font-size: 12px;
        }

        .bg-dark-color {
            background-color: #040404;
        }

        .listing_search button {
            border-radius: 0;
            border: 0;
            height: 48px;
        }

        .listing_search.d-md-flex.align-items-center {
            width: 64%;
            margin: 0 auto;
        }

        .listing_search input select button {
            border: 0px;
            height: 55px;
        }

        .prefect_bus h5 {
            line-height: 30px;
        }

        .home_business_listing {
            text-decoration: none;
        }

        .see_all_listing {
            font-weight: 600;
            text-decoration: underline;
            color: #806132;
        }

        /* Small devices (phones, 600px and down) */
        @media screen and (max-width: 600px) {
            .custom-card {
                padding: 1.5rem;
                margin: 0 auto;
            }

            .top_business h2 {
                text-align: center;
            }

            .see_more {
                text-align: center;
            }

            .listing_search.d-md-flex.align-items-center {
                width: 100%;
                margin: 0 auto;
            }

            .listing_search .form-control,
            .listing_search .form-select {
                margin-bottom: 10px;
            }

            .prefect_bus h5,
            .prefect_bus p {
                text-align: center;
            }

            .carousel-controls {
                top: 50px;
            }

            .leading-agents .section-title-agents {
                font-size: 18px;
            }

            .leading-agents .see-all-brokers {
                font-size: 12px;
            }

            .leading-agents {
                height: auto;
            }

            .agent-card a img.agent-image {
                float: left;
            }

            .agent-card {
                height: auto;
            }

            .custom-section {
                padding: 0 10px;
                height: auto;
            }

            .custom-section h2 {
                text-align: center;
                padding-top: 15px;
            }

            .our_service_title a {
                font-size: 15px;
            }

            .services-section {
                padding: 0px 15px;
            }

            .text-container {
                padding: 3rem 0rem;
            }

            .why_ebb_btn {
                text-align: center;
            }

            .phase_title {
                padding-top: 15px;
            }


        }

        @media screen and (min-width: 601px) and (max-width: 768px) {
            .services-section {
                padding: 0px 15px;
                text-align: center;
            }

            .custom-card {
                width: 100%;
                max-width: 100%;
                height: 167px;
            }

            .phase_title {
                padding-top: 15px;
            }

            .navbar .container {
                max-width: 100%;
            }

            .agent-card a img.agent-image {
                float: left;
            }

            .agent-card {
                height: 110px;
            }

            .listing_search.d-md-flex.align-items-center {
                width: 100%;
                margin: 0 auto;
            }

            .prefect_bus h5,
            .prefect_bus p {
                text-align: center;
            }

            .leading-agents {
                height: auto;
            }

            .custom-section {
                padding: 0 10px;
                height: auto;
            }

            .custom-section h2 {
                text-align: center;
                padding-top: 15px;
            }



        }

        /* Tablets (portrait and landscape) */
        @media screen and (min-width: 769px) and (max-width: 1024px) {
            .navbar .container {
                max-width: 100%;
            }

            .listing_search.d-md-flex.align-items-center {
                width: 100%;
                margin: 0 auto;
            }

            .prefect_bus h5,
            .prefect_bus p {
                text-align: center;
            }

            .prefect_bus .border-right {
                border-right: none;
            }

            .leading-agents {
                height: auto;
            }

            .agent-card {
                height: 175px;
            }

            .agent-card a img.agent-image {
                float: left;
            }

            .custom-section {
                padding: 0 10px;
                height: 475px;
            }

            .custom-section h2 {
                text-align: center;
                padding-top: 15px;
            }

        }

        /* Desktops (laptops and large screens) */
        @media screen and (min-width: 1025px) {
            .agent-card {
                height: 120px;
            }

            .agent-card a img.agent-image {
                float: left;
            }
        }

        /* Large desktops */
        @media screen and (min-width: 1601px) {
            /* styles for large desktops */
        }

        .no_lis {
            text-align: center;
            font-weight: bold;
            color: #333333;
        }
    </style>
@endsection
