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
                        {{--  <input type="text" class="form-control form-control-lg" placeholder="Industry" name="industry"
                            value="{{ request('industry') }}"> --}}
                        <select class="form-select form-select-lg" name="industry" id="industry">
                            <option selected value="" disabled>Industry</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->CategoryID }}">{{ $category->BusinessCategory }}</option>
                            @endforeach
                        </select>
                        <select class="form-select form-select-lg" name="businessType" id="busType">
                            <option selected value="" disabled>Business Category</option>
                            @foreach ($businessTypes as $businessType)
                                <option value="{{ $businessType->SubCatID }}">{{ $businessType->SubCategory }}</option>
                            @endforeach
                        </select>
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
                    <h5>Invest In A Sure Thing</h5>
                    <p>"YOURSELF"</p>
                </div>
                <div class="col-12 col-md-6 col-lg-3 border-right px-5">
                    <h5>Selling Businesses Since 1985</h5>
                    <p>1,000's BUSINESSES SOLD</p>
                </div>
                <div class="col-12 col-md-6 col-lg-3 border-right px-5">
                    <h5>Registered Buyers</h5>
                    <p>100,000 REGISTERED BUYERS</p>
                </div>
                <div class="col-12 col-md-6 col-lg-3 px-5">
                    <h5>Business Marketplace</h5>
                    <p>100+/-BUSINESSES FOR SALE</p>
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
                    <a href="{{ route('see-more-categories') }}" class="btn btn">See More Categories</a>
                </div>
            </div>

            <div class="row g-3 bus_cat row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5">
                @foreach ($hotSubCategories as $subHotCategory)
                    <div class="col">
                        <a href="{{ route('search.index', ['businessType' => $subHotCategory->SubCatID]) }}"
                            class="bus-cat-link" target="_blank">
                            {{ $subHotCategory->SubCategory }}
                        </a>
                    </div>
                @endforeach
                {{--  @foreach ($subCategories as $subCategory)
                    <div class="col">
                        <a href="{{ route('search.index', ['businessType' => $subCategory->SubCatID]) }}"
                            class="bus-cat-link" target="_blank">
                            {{ $subCategory->SubCategory }}
                        </a>
                    </div>
                @endforeach --}}
            </div>

        </div>
    </div>

    <!-- Bussiness Listings -->

    {{-- ============================================================
    FEATURED BUSINESS LISTINGS
============================================================ --}}

    <div class="container my-5 business_listing_slider premium-listings-section">

        {{-- ========================================================
        HEADER
    ========================================================= --}}
        <div class="d-md-flex justify-content-between align-items-center mb-4">

            <div class="premium-section-heading">

                <span class="premium-section-label">
                    FEATURED OPPORTUNITIES
                </span>

                <h2 class="text mb-1">
                    Featured Business Listings
                </h2>

            </div>


            <a href="{{ route('business.listings') }}" class="see_all_listing premium-see-all" target="_blank">

                See All Listings

                <i class="fas fa-arrow-right"></i>

            </a>

        </div>


        @if ($listings->isEmpty())
            {{-- ====================================================
            EMPTY STATE
        ===================================================== --}}

            <p class="no_lis">
                No listings available.
            </p>
        @else
            {{-- ====================================================
            SLIDER CONTROLS
            KEEPING YOUR EXISTING STRUCTURE
        ===================================================== --}}

            <div class="carousel-controls premium-carousel-controls">

                <div class="carousel-prev">
                    <i class="fas fa-chevron-left"></i>
                </div>

                <div class="carousel-next">
                    <i class="fas fa-chevron-right"></i>
                </div>

            </div>


            {{-- ====================================================
            SLIDER
        ===================================================== --}}

            <div class="slider card-container premium-card-container">

                @foreach ($listings as $listing)
                    @php

                        /*
                    |--------------------------------------------------------------------------
                    | Listing Image
                    |--------------------------------------------------------------------------
                    */

                        $listingImage = !empty($listing->imagepath)
                            ? asset('assets/uploads/images/' . $listing->imagepath)
                            : asset('assets/images/business_image.jpg');

                        /*
                    |--------------------------------------------------------------------------
                    | Gross Revenue
                    |--------------------------------------------------------------------------
                    */

                        $totalCost = ($listing->COG1 ?? 0) + ($listing->COG2 ?? 0) + ($listing->COG3 ?? 0);

                        $grossRevenue = ($listing->AnnualSales ?? 0) - $totalCost;

                        /*
                    |--------------------------------------------------------------------------
                    | Operating Expenses
                    |--------------------------------------------------------------------------
                    */

                        $totalOperatingExpenses = ($listing->AnnRent ?? 0) + ($listing->CommonAreaMaint ?? 0);

                        /*
                    |--------------------------------------------------------------------------
                    | Operating Profit
                    |--------------------------------------------------------------------------
                    */

                        $operatingProfit = ($listing->AnnualSales ?? 0) - ($totalCost + $totalOperatingExpenses);

                        /*
                    |--------------------------------------------------------------------------
                    | Adjusted Cash Flow
                    |--------------------------------------------------------------------------
                    */

                        $adjustedCashFlow = ($listing->OtherInc ?? 0) + $operatingProfit;

                        /*
                    |--------------------------------------------------------------------------
                    | SDE
                    |
                    | If your listings table has a dedicated SDE column,
                    | it will be used.
                    |
                    | Otherwise adjusted cash flow is used as fallback.
                    |--------------------------------------------------------------------------
                    */

                        $sde = $listing->SDE ?? $adjustedCashFlow;
                    @endphp


                    {{-- =================================================
                    BUSINESS CARD
                ================================================== --}}

                    <div class="premium-business-card">


                        {{-- =============================================
                        IMAGE AREA
                    ============================================== --}}

                        <div class="premium-business-image">

                            <a href="{{ route('view.business.listing', $listing->ListingID) }}">

                                <img src="{{ $listingImage }}" alt="{{ $listing->BusType ?? 'Business Listing' }}"
                                    loading="lazy">

                            </a>


                            {{-- Image dark gradient --}}
                            <div class="premium-image-overlay"></div>


                            {{-- =========================================
                            IMAGE FINANCIALS
                        ========================================== --}}

                            <div class="premium-image-financials">


                                {{-- Asking Price --}}
                                <div class="premium-image-price">

                                    <span>
                                        Asking Price
                                    </span>

                                    <strong>
                                        ${{ number_format($listing->ListPrice ?? 0, 0) }}
                                    </strong>

                                </div>


                                {{-- Adjusted Cash Flow --}}
                                <div class="premium-image-cashflow">

                                    <span>
                                        Adjusted Cash Flow
                                    </span>

                                    <strong>
                                        ${{ number_format($adjustedCashFlow, 0) }}
                                    </strong>

                                </div>


                            </div>

                        </div>


                        {{-- =============================================
                        CARD CONTENT
                    ============================================== --}}

                        <div class="premium-business-content">


                            {{-- =========================================
                            BUSINESS TYPE + CATEGORY
                        ========================================== --}}

                            <div class="premium-business-meta">


                                {{-- Business Type --}}
                                <div class="premium-business-type">

                                    {{ $listing->BusType ?? 'Business Type' }}

                                </div>


                                {{-- Business Category --}}
                                <div class="premium-business-category">

                                    {{ getSubCategoryName($listing->SubCat) }}

                                </div>


                            </div>


                            {{-- =========================================
                            BUSINESS TITLE
                        ========================================== --}}

                            <h3 class="premium-business-title">

                                <a href="{{ route('view.business.listing', $listing->ListingID) }}">

                                    {{ $listing->BusType ?? 'Business Opportunity' }}

                                </a>

                            </h3>


                            {{-- =========================================
                            LOCATION
                        ========================================== --}}

                            <div class="premium-business-location">

                                <span class="premium-location-icon">

                                    <i class="fas fa-map-marker-alt"></i>

                                </span>


                                <span class="premium-location-text">

                                    {{ $listing->County ?? 'N/A' }}

                                    @if (!empty($listing->State))
                                        , {{ $listing->State }}
                                    @endif

                                </span>

                            </div>


                            {{-- =========================================
                            FINANCIAL INFORMATION
                        ========================================== --}}

                            <div class="premium-financial-grid">


                                {{-- Down Payment --}}
                                <div class="premium-financial-item">

                                    <div class="premium-financial-icon">

                                        <i class="fas fa-wallet"></i>

                                    </div>

                                    <div class="premium-financial-data">

                                        <span>
                                            Down Payment
                                        </span>

                                        <strong>
                                            ${{ number_format($listing->DownPay ?? 0, 0) }}
                                        </strong>

                                    </div>

                                </div>


                                {{-- Gross Revenue --}}
                                <div class="premium-financial-item">

                                    <div class="premium-financial-icon">

                                        <i class="fas fa-chart-line"></i>

                                    </div>

                                    <div class="premium-financial-data">

                                        <span>
                                            Gross Revenue
                                        </span>

                                        <strong>
                                            ${{ number_format($grossRevenue, 0) }}
                                        </strong>

                                    </div>

                                </div>


                                {{-- SDE --}}
                                <div class="premium-financial-item premium-sde-item">

                                    <div class="premium-financial-icon">

                                        <i class="fas fa-user-tie"></i>

                                    </div>

                                    <div class="premium-financial-data">

                                        <span>
                                            SDE
                                        </span>

                                        <strong>
                                            ${{ number_format($sde, 0) }}
                                        </strong>

                                    </div>

                                </div>


                            </div>


                            {{-- =========================================
                            CARD FOOTER
                        ========================================== --}}

                            <div class="premium-card-footer">


                                <div class="premium-opportunity-label">

                                    <i class="fas fa-shield-alt"></i>

                                    <span>
                                        Business Opportunity
                                    </span>

                                </div>


                                <a href="{{ route('view.business.listing', $listing->ListingID) }}"
                                    class="premium-view-button">

                                    View Opportunity

                                    <i class="fas fa-arrow-right"></i>

                                </a>


                            </div>


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
                        $agentImagePath = public_path('assets/uploads/images/' . $agent->image);
                    @endphp
                    <div class="col">
                        <div class="agent-card d-lg-flex">
                            @if (!empty($agent->image) && file_exists($agentImagePath))
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

    <!-- welcome section and about section -->
    <section class="welcome-section">
        <div class="container">
            <div class="row align-items-center g-4">

                <!-- Image -->
                <div class="col-12 col-lg-6 order-1 order-lg-1">
                    <div class="welcome-img">
                        <img src="{{ asset('assets/images/welcome_about_group.png') }}" alt="Business Meeting"
                            class="img-fluid">
                    </div>
                </div>

                <!-- Content -->
                <div class="col-12 col-lg-6 order-2 order-lg-2">
                    <div class="welcome-content text-center text-lg-start">

                        <h6 class="text-brown mb-2">Welcome To</h6>

                        <h2 class="mb-3">
                            EXECUTIVE BUSINESS BROKERS!
                        </h2>

                        <p class="wel-subtitle mb-3">
                            Unlocking Opportunities, Maximizing Success.
                        </p>

                        <p class="wel-desc">
                            Are you looking to buy or sell a business? Look no further!
                            <strong><a href="{{ route('about.us') }}" target="_blank">EXECUTIVE BUSINESS
                                    BROKERS</a></strong> is here to
                            assist you every step of the way.
                            With our expert knowledge and extensive network, we are dedicated to helping you
                            navigate the complex world of business transactions.
                        </p>

                        <p class="wel-desc">
                            Whether you are a seasoned entrepreneur or a first-time buyer, we have the
                            resources and expertise to ensure a smooth and successful deal.
                        </p>

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
                            {{--  <p class="list-item-description"><a href="{{ route('open-list.with.ebb') }}"
                                    target="_blank">List with EBB</a> and benefit from our database, reputation, and
                                marketing efforts that draw in qualified buyers.</p> --}}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Buyers Section -->
            <div class="col-md-6">
                <div class="custom-section" style="background: url('{{ $buyersImagePath }}') no-repeat center center;">
                    <h2 class="section-title">Buyers</h2>
                    <div class="divider"></div>
                    {{-- <div class="list-item">
                        <span class="list-item-icon">
                            <i class="bi bi-check-circle-fill"></i>
                        </span>
                        <div>
                            <p class="list-item-title">Accelerate Your Search</p>
                            <p class="list-item-description">Become an <a href="{{ route('preferred.buyers.program') }}"
                                    target="_blank">EBB Preferred Buyer</a> and benefit from our full services; access
                                detailed information on 100s of businesses online 24/7.</p>
                        </div>
                    </div> --}}
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
                        <a href="{{ route('about.us') }}" class="btn learn-more-btn">Learn More</a>
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
                        <a href="{{ route('contact.us') }}" class="example-link">Contact Us &rarr;</a>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                    <div class="custom-card">
                        <div class="number-badge">02</div>
                        <h5 class="card-title">Preliminary Negotiations/Letter of Intent</h5>
                        <a href="{{ route('contact.us') }}" class="example-link">Contact Us &rarr;</a>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                    <div class="custom-card">
                        <div class="number-badge">03</div>
                        <h5 class="card-title">Due Diligence</h5>
                        <a href="{{ route('contact.us') }}" class="example-link">Contact Us &rarr;</a>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                    <div class="custom-card">
                        <div class="number-badge">04</div>
                        <h5 class="card-title">Negotiation/ Definitive Acquisition Agreement</h5>
                        <a href="{{ route('contact.us') }}" class="example-link">Contact Us &rarr;</a>
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
                autoplay: false, // Auto slide
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
    <script>
        $(document).ready(function() {
            $('#industry').change(function() {
                var id = $(this).val();
                if (id) {
                    $.ajax({
                        url: "{{ route('get.business.category', ['id' => '__ID__']) }}".replace(
                            '__ID__',
                            id),
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#busType').empty();
                            $('#busType').append(
                                '<option value="">Business Category</option>');
                            $.each(data, function(key, value) {
                                $('#busType').append('<option value="' + value
                                    .SubCatID + '">' + value.SubCategory +
                                    '</option>');
                            });
                        }
                    });
                } else {
                    $('#second-dropdown').empty().append('<option value="">Select an option</option>');
                }
            });
        });
    </script>
    <style>
        /* css for about section start*/
        .welcome-section {
            background-color: #f5f3f2;
            padding: 60px 0;
        }

        /* Image */
        .welcome-img img {
            width: 100%;
            height: auto;
            border-radius: 6px;
            object-fit: cover;
        }

        /* Text styles */
        .text-brown {
            color: #835f33;
            font-weight: 600;
            letter-spacing: 1px;
            font-size: 42px;
        }

        .welcome-content h2 {
            font-size: 34px;
            line-height: 1.3;
            font-weight: 500;
        }

        .wel-subtitle {
            font-size: 18px;
            font-weight: 500;
            color: #444;
        }

        .wel-desc {
            font-size: 15px;
            color: #666;
            line-height: 1.8;
        }

        p.wel-desc a {
            color: #812652;
            cursor: pointer;
        }

        /* Tablet */
        @media (max-width: 991px) {
            .welcome-section {
                padding: 50px 0;
            }

            .welcome-content h2 {
                font-size: 28px;
            }
        }

        /* Mobile */
        @media (max-width: 576px) {
            .welcome-section {
                padding: 40px 15px;
            }

            .welcome-content h2 {
                font-size: 24px;
            }

            .wel-subtitle {
                font-size: 14px;
            }

            .wel-desc {
                font-size: 14px;
            }
        }

        /* css for about section end */
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
            min-height: 600px;
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

        /*  .slider .card {
                                                    margin-right: 10px;
                                                } */

        /*  .slider .slick-slide:last-child .card {
                                                    margin-right: 0;
                                                } */

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
            font-size: 14px;
            text-align: center;
            font-weight: bold;
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
            line-height: 50px;
            font-size: 18px;
            text-align: center;
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
                padding: 15px;
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

            .custom-card {
                padding: 2rem 2rem 2rem 15px;
            }

            .custom-card .card-title {
                font-size: 15px;
                margin-top: 15px;
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

            .custom-card {
                padding: 2rem 2rem 2rem 15px;
            }

            .custom-card .card-title {
                font-size: 15px;
                margin-top: 15px;
            }

        }

        /* Large desktops */
        @media screen and (min-width: 1601px) {

            /* styles for large desktops */
            .custom-card {
                padding: 2rem 2rem 2rem 15px;
            }

            .custom-card .card-title {
                font-size: 18px;
                margin-top: 15px;
            }
        }

        .no_lis {
            text-align: center;
            font-weight: bold;
            color: #333333;
        }
    </style>
    <style>
        .premium-listings-section {
            position: relative;
        }


        .premium-section-heading {
            position: relative;
        }

        .premium-section-label {
            display: block;

            margin-bottom: 4px;

            color: #8b1747;

            font-size: 9px;

            font-weight: 700;

            letter-spacing: 1.4px;

            text-transform: uppercase;
        }

        .premium-section-heading h2 {
            margin-bottom: 0 !important;

            color: #242424;

            font-size: 27px;

            font-weight: 700;
        }

        .premium-see-all {
            display: inline-flex;

            align-items: center;

            gap: 7px;

            color: #8b1747 !important;

            font-size: 12px;

            font-weight: 600;

            text-decoration: none !important;

            transition: all .25s ease;
        }

        .premium-see-all:hover {
            color: #6d1037 !important;
        }

        .premium-see-all i {
            font-size: 10px;

            transition: transform .2s ease;
        }

        .premium-see-all:hover i {
            transform: translateX(3px);
        }



        .premium-card-container {

            display: block !important;
            gap: 0 !important;

            overflow: hidden;

            padding: 3px 2px 8px;

            scroll-behavior: smooth;

        }




        .premium-business-card {

            position: relative;


            min-width: 0;

            background: #ffffff;

            border: 1px solid #e6e6e6;

            border-radius: 11px;

            overflow: hidden;

            box-shadow:
                0 3px 12px rgba(0, 0, 0, .055);

            transition:
                transform .3s ease,
                box-shadow .3s ease,
                border-color .3s ease;

        }


        /* Hover */

        .premium-business-card:hover {

            transform: translateY(-4px);

            border-color: #d8b4c5;

            box-shadow:
                0 12px 28px rgba(0, 0, 0, .12);

        }


        .premium-business-image {

            position: relative;

            height: 150px;

            overflow: hidden;

            background: #eeeeee;

        }


        /* Link */

        .premium-business-image>a {

            display: block;

            width: 100%;

            height: 100%;

        }


        /* Image */

        .premium-business-image img {

            width: 100%;

            height: 100%;

            display: block;

            object-fit: cover;

            transition:
                transform .55s ease;

        }


        /* Zoom */

        .premium-business-card:hover .premium-business-image img {

            transform: scale(1.055);

        }


        .premium-image-overlay {

            position: absolute;

            left: 0;

            right: 0;

            bottom: 0;

            height: 85px;

            background:
                linear-gradient(to top,
                    rgba(0, 0, 0, .72),
                    rgba(0, 0, 0, 0));

            pointer-events: none;

        }


        .premium-featured-badge {

            position: absolute;

            top: 10px;

            left: 10px;

            z-index: 5;

            display: inline-flex;

            align-items: center;

            gap: 5px;

            padding: 6px 9px;

            border-radius: 4px;

            background: #8b1747;

            color: #ffffff;

            font-size: 8px;

            font-weight: 700;

            line-height: 1;

            letter-spacing: .35px;

            text-transform: uppercase;

            box-shadow:
                0 2px 6px rgba(0, 0, 0, .18);

        }


        .premium-image-financials {

            position: absolute;

            left: 12px;

            right: 12px;

            bottom: 10px;

            z-index: 5;

            display: flex;

            align-items: flex-end;

            justify-content: space-between;

            gap: 15px;

            color: #ffffff;

        }


        /* Asking price */

        .premium-image-price {

            min-width: 0;

            text-align: left;

        }

        .premium-image-price span,
        .premium-image-cashflow span {

            display: block;

            margin-bottom: 3px;

            color: rgba(255, 255, 255, .84);

            font-size: 7px;

            font-weight: 600;

            line-height: 1;

            letter-spacing: .75px;

            text-transform: uppercase;

        }

        .premium-image-price strong {

            display: block;

            color: #ffffff;

            font-size: 21px;

            font-weight: 700;

            line-height: 1;

            letter-spacing: -.3px;

        }


        /* Adjusted Cash Flow */

        .premium-image-cashflow {

            min-width: 0;

            text-align: right;

        }

        .premium-image-cashflow strong {

            display: block;

            color: #ffffff;

            font-size: 17px;

            font-weight: 700;

            line-height: 1;

        }


        .premium-business-content {

            padding: 12px 13px 12px;

        }


        .premium-business-meta {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 8px;

            min-height: 18px;

            margin-bottom: 4px;

        }


        /* Business Type */

        .premium-business-type {

            max-width: 55%;

            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;

            color: #8b1747;

            font-size: 8px;

            font-weight: 700;

            line-height: 1.2;

            letter-spacing: .45px;

            text-transform: uppercase;

        }


        /* Category */

        .premium-business-category {

            max-width: 45%;

            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;

            padding: 4px 6px;

            border-radius: 3px;

            background: #f7edf2;

            color: #8b1747;

            font-size: 7px;

            font-weight: 600;

            line-height: 1;

            text-align: right;

        }


        .premium-business-title {

            height: 35px;

            margin: 0 0 4px;

            overflow: hidden;

            font-size: 14px;

            font-weight: 700;

            line-height: 1.25;

        }

        .premium-business-title a {

            color: #242424;

            text-decoration: none;

            transition: color .2s ease;

        }

        .premium-business-title a:hover {

            color: #8b1747;

        }


        .premium-business-location {

            display: flex;

            align-items: center;

            gap: 6px;

            margin-bottom: 9px;

            color: #818181;

            font-size: 9px;

            line-height: 1;

        }


        /* Location icon */

        .premium-location-icon {

            width: 21px;

            height: 21px;

            min-width: 21px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 50%;

            background: #f8edf2;

            color: #8b1747;

            font-size: 8px;

        }


        /* Location text */

        .premium-location-text {

            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;

        }


        .premium-financial-grid {

            display: grid;

            grid-template-columns: 1fr 1fr;

            overflow: hidden;

            border: 1px solid #ededed;

            border-radius: 7px;

            background: #ffffff;

        }


        /* Financial item */

        .premium-financial-item {

            display: flex;

            align-items: center;

            gap: 7px;

            min-width: 0;

            padding: 7px 7px;

            border-right: 1px solid #ededed;

            border-bottom: 1px solid #ededed;

            background: #ffffff;

        }


        .premium-financial-item:nth-child(2n) {

            border-right: 0;

        }


        .premium-financial-item:nth-child(3) {

            border-bottom: 0;

        }


        /* If there are only 3 items */

        .premium-financial-item:last-child {

            border-bottom: 0;

        }


        .premium-financial-icon {

            width: 25px;

            height: 25px;

            min-width: 25px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 5px;

            background: #f8edf2;

            color: #8b1747;

            font-size: 9px;

        }

        .premium-financial-data {

            min-width: 0;

        }

        .premium-financial-data span {

            display: block;

            margin-bottom: 2px;

            overflow: hidden;

            color: #999999;

            font-size: 7px;

            font-weight: 500;

            line-height: 1.1;

            text-overflow: ellipsis;

            white-space: nowrap;

        }

        .premium-financial-data strong {

            display: block;

            overflow: hidden;

            color: #292929;

            font-size: 10px;

            font-weight: 700;

            line-height: 1.1;

            text-overflow: ellipsis;

            white-space: nowrap;

        }


        .premium-sde-item {

            background: #faf3f6;

        }

        .premium-sde-item .premium-financial-icon {

            background: #8b1747;

            color: #ffffff;

        }

        .premium-sde-item .premium-financial-data strong {

            color: #8b1747;

        }



        .premium-card-footer {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 8px;

            margin-top: 9px;

            padding-top: 9px;

            border-top: 1px solid #eeeeee;

        }


        /* Opportunity label */

        .premium-opportunity-label {

            display: flex;

            align-items: center;

            gap: 4px;

            min-width: 0;

            color: #999999;

            font-size: 7px;

            line-height: 1;

            white-space: nowrap;

        }

        .premium-opportunity-label i {

            color: #8b1747;

            font-size: 8px;

        }


        .premium-view-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 6px;

            height: 30px;

            padding: 0 11px;

            border-radius: 4px;

            background: #8b1747;

            color: #ffffff !important;

            font-size: 8px;

            font-weight: 600;

            line-height: 1;

            text-decoration: none !important;

            white-space: nowrap;

            transition:
                background .2s ease,
                transform .2s ease;

        }

        .premium-view-button:hover {

            background: #6d1037;

            color: #ffffff !important;

        }

        .premium-view-button i {

            font-size: 7px;

            transition: transform .2s ease;

        }

        .premium-view-button:hover i {

            transform: translateX(3px);

        }


        .premium-carousel-controls {

            z-index: 20;

        }


        .premium-carousel-controls .carousel-prev,
        .premium-carousel-controls .carousel-next {

            transition: all .2s ease;

        }

        .premium-carousel-controls .carousel-prev:hover,
        .premium-carousel-controls .carousel-next:hover {

            color: #8b1747;

            transform: scale(1.08);

        }

        @media (max-width: 575px) {

            .premium-card-container {

                gap: 12px !important;

            }

            .premium-business-image {

                height: 165px;

            }


            .premium-image-price strong {

                font-size: 22px;

            }


            .premium-image-cashflow strong {

                font-size: 18px;

            }


            .premium-business-content {

                padding: 13px;

            }

        }


        .premium-card-container .slick-slide {
            margin-right: 12px !important;
            box-sizing: border-box !important;
        }

        /* Last card should not have extra right space */
        .premium-card-container .slick-slide:last-child {
            margin-right: 0 !important;
        }

        /* Keep card appearance unchanged */
        .premium-card-container .premium-business-card {
            box-sizing: border-box !important;
        }


        @media (min-width: 1025px) {
            .premium-card-container .slick-slide {
                margin-right: 12px !important;
            }
        }


        @media (min-width: 576px) and (max-width: 1024px) {
            .premium-card-container .slick-slide {
                margin-right: 10px !important;
            }
        }


        @media (max-width: 575px) {
            .premium-card-container .slick-slide {
                margin-right: 10px !important;
            }
        }
    </style>
@endsection
