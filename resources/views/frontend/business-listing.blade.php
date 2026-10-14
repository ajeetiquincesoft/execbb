@extends('frontend.layout.master')

@section('content')
    {{-- Breadcrumb --}}
    <div class="breadcrumb-container py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Business Listings
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="business-listings-section">
        <div class="container business-listings-container">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <header class="business-listings-header">
                <h1>Business Listings</h1>
                <p>
                    EBB's listings are available free to everyone who uses our site. To view the detailed
                    information, which is confidential in nature, we will ask you to sign a confidentiality
                    agreement when you register. For buyers who are aggressively looking to find a business,
                    we recommend that you sign up for our Preferred Buyer Program.
                </p>
            </header>

            <hr class="business-listings-divider">

            {{-- Search and filters --}}
            <form action="{{ route('business.listings') }}" method="GET" class="listing-search-form">
                <div class="row g-3 align-items-end">
                    <div class="col-12 col-sm-6 col-md-3">
                        <label for="industry" class="visually-hidden">Industry</label>
                        <select class="form-control" id="industry" name="industry">
                            <option value="">Industry</option>
                            @foreach ($categoryData as $category)
                                <option value="{{ $category->CategoryID }}"
                                    {{ request('industry') == $category->CategoryID ? 'selected' : '' }}>
                                    {{ $category->BusinessCategory }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <label for="state" class="visually-hidden">State</label>
                        <select class="form-control" id="state" name="state">
                            <option value="">State</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->State }}"
                                    {{ request('state') == $state->State ? 'selected' : '' }}>
                                    {{ $state->StateName }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-sm-8 col-md-4">
                        <label for="listing-query" class="visually-hidden">Find Listing</label>
                        <input type="text" class="form-control" id="listing-query" name="query"
                            placeholder="Find Listing" value="{{ request('query') }}">
                    </div>

                    <div class="col-12 col-sm-4 col-md-2">
                        <button type="submit" name="lis_search" class="listing-search-button">Search</button>
                    </div>
                </div>
            </form>
            {{-- Listings grid --}}
            <div class="row premium-listings-grid">
                @forelse ($listings as $listing)
                    @php
                        $listingImage = !empty($listing->imagepath)
                            ? asset('assets/uploads/images/' . $listing->imagepath)
                            : asset('assets/images/business_image.jpg');

                        $totalCost = ($listing->COG1 ?? 0) + ($listing->COG2 ?? 0) + ($listing->COG3 ?? 0);

                        $grossRevenue = ($listing->AnnualSales ?? 0) - $totalCost;

                        $totalOperatingExpenses = ($listing->AnnRent ?? 0) + ($listing->CommonAreaMaint ?? 0);

                        $operatingProfit = ($listing->AnnualSales ?? 0) - ($totalCost + $totalOperatingExpenses);

                        $adjustedCashFlow = ($listing->OtherInc ?? 0) + $operatingProfit;

                        $sde = $listing->SDE ?? $adjustedCashFlow;
                    @endphp

                    <div class="col-12 col-sm-6 col-lg-4 premium-listing-column">
                        <article class="premium-business-card">
                            <div class="premium-business-image">
                                <a href="{{ route('view.business.listing', $listing->ListingID) }}">
                                    <img src="{{ $listingImage }}" alt="{{ $listing->BusType ?? 'Business Listing' }}"
                                        loading="lazy">
                                </a>

                                <div class="premium-image-overlay"></div>

                                <div class="premium-image-financials">
                                    <div class="premium-image-price">
                                        <span>Asking Price</span>
                                        <strong>${{ number_format($listing->ListPrice ?? 0, 0) }}</strong>
                                    </div>

                                    <div class="premium-image-cashflow">
                                        <span>Adjusted Cash Flow</span>
                                        <strong>${{ number_format($adjustedCashFlow, 0) }}</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="premium-business-content">
                                <div class="premium-business-meta">
                                    <div class="premium-business-type">
                                        {{ $listing->BusType ?? 'Business Type' }}
                                    </div>
                                    <div class="premium-business-category">
                                        {{ getSubCategoryName($listing->SubCat) }}
                                    </div>
                                </div>

                                <h2 class="premium-business-title">
                                    <a href="{{ route('view.business.listing', $listing->ListingID) }}">
                                        {{ $listing->BusType ?? 'Business Opportunity' }}
                                    </a>
                                </h2>

                                <div class="premium-business-location">
                                    <span class="premium-location-icon" aria-hidden="true">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                    <span class="premium-location-text">
                                        {{ $listing->County ?? 'N/A' }}@if (!empty($listing->State))
                                            , {{ $listing->State }}
                                        @endif
                                    </span>
                                </div>

                                <div class="premium-financial-grid">
                                    <div class="premium-financial-item">
                                        <div class="premium-financial-icon" aria-hidden="true">
                                            <i class="fas fa-wallet"></i>
                                        </div>
                                        <div class="premium-financial-data">
                                            <span>Down Payment</span>
                                            <strong>${{ number_format($listing->DownPay ?? 0, 0) }}</strong>
                                        </div>
                                    </div>

                                    <div class="premium-financial-item">
                                        <div class="premium-financial-icon" aria-hidden="true">
                                            <i class="fas fa-chart-line"></i>
                                        </div>
                                        <div class="premium-financial-data">
                                            <span>Gross Revenue</span>
                                            <strong>${{ number_format($grossRevenue, 0) }}</strong>
                                        </div>
                                    </div>

                                    <div class="premium-financial-item premium-sde-item">
                                        <div class="premium-financial-icon" aria-hidden="true">
                                            <i class="fas fa-user-tie"></i>
                                        </div>
                                        <div class="premium-financial-data">
                                            <span>SDE</span>
                                            <strong>${{ number_format($sde, 0) }}</strong>
                                        </div>
                                    </div>
                                </div>

                                <footer class="premium-card-footer">
                                    <div class="premium-opportunity-label">
                                        <i class="fas fa-shield-alt" aria-hidden="true"></i>
                                        <span>Business Opportunity</span>
                                    </div>

                                    <a href="{{ route('view.business.listing', $listing->ListingID) }}"
                                        class="premium-view-button">
                                        View Opportunity
                                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                    </a>
                                </footer>
                            </div>
                        </article>
                    </div>
                    @empty
                        <div class="col-12">
                            <p class="text-center py-4 mb-0">No business listings found.</p>
                        </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                @if ($listings->hasPages())
                    <div class="listing-pagination">
                        {{ $listings->appends(request()->query())->links('vendor.pagination.custom') }}
                    </div>
                @endif
            </div>
        </section>

        <style>
            .business-listings-section {
                background: #f8f8f8;
                padding: 32px 0;
            }

            .business-listings-container {
                background: #fff;
                border-radius: 8px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, .06);
                padding: 32px;
            }

            .breadcrumb {
                background: transparent;
            }

            .business-listings-header {
                margin: 0 auto 28px;
                text-align: center;
            }

            .business-listings-header h1 {
                color: #242424;
                font-size: 28px;
                font-weight: 700;
                margin: 0 0 16px;
            }

            .business-listings-header p {
                color: #7f8589;
                line-height: 1.7;
                margin: 0;
            }

            .business-listings-divider {
                border: 0;
                border-top: 1px solid #e8e8e8;
                margin: 0 0 28px;
            }

            .listing-search-form {
                margin-bottom: 28px;
            }

            .listing-search-form .form-control {
                width: 100%;
                height: 45px;
                border: 1px solid #d2d2d2;
                border-radius: 4px;
                box-shadow: none;
            }

            .listing-search-form .form-control:focus {
                border-color: #8b1747;
                box-shadow: 0 0 0 3px rgba(139, 23, 71, .1);
            }

            .listing-search-button {
                width: 100%;
                min-height: 45px;
                border: 0;
                border-radius: 4px;
                background: #8b1747;
                color: #fff;
                font-size: 14px;
                font-weight: 600;
                padding: 10px 18px;
                transition: background .2s ease;
            }

            .listing-search-button:hover,
            .listing-search-button:focus {
                background: #6d1037;
                color: #fff;
            }

            .premium-listings-grid {
                align-items: stretch;
                row-gap: 24px;
            }

            .premium-listing-column {
                display: flex;
                align-items: stretch;
            }

            .premium-business-card {
                display: flex;
                flex-direction: column;
                width: 100%;
                min-width: 0;
                overflow: hidden;
                background: #fff;
                border: 1px solid #e6e6e6;
                border-radius: 11px;
                box-shadow: 0 3px 12px rgba(0, 0, 0, .055);
                transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
            }

            .premium-business-card:hover {
                transform: translateY(-4px);
                border-color: #d8b4c5;
                box-shadow: 0 12px 28px rgba(0, 0, 0, .12);
            }

            .premium-business-image {
                position: relative;
                flex-shrink: 0;
                height: 190px;
                overflow: hidden;
                background: #eee;
            }

            .premium-business-image>a {
                display: block;
                width: 100%;
                height: 100%;
            }

            .premium-business-image img {
                display: block;
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform .55s ease;
            }

            .premium-business-card:hover .premium-business-image img {
                transform: scale(1.055);
            }

            .premium-image-overlay {
                position: absolute;
                right: 0;
                bottom: 0;
                left: 0;
                height: 85px;
                background: linear-gradient(to top, rgba(0, 0, 0, .76), transparent);
                pointer-events: none;
            }

            .premium-image-financials {
                position: absolute;
                right: 12px;
                bottom: 12px;
                left: 12px;
                z-index: 1;
                display: flex;
                align-items: flex-end;
                justify-content: space-between;
                gap: 12px;
                color: #fff;
            }

            .premium-image-price,
            .premium-image-cashflow {
                min-width: 0;
            }

            .premium-image-price span,
            .premium-image-cashflow span {
                display: block;
                margin-bottom: 4px;
                color: rgba(255, 255, 255, .88);
                font-size: 10px;
                font-weight: 600;
                line-height: 1.2;
                letter-spacing: .5px;
                text-transform: uppercase;
            }

            .premium-image-price strong,
            .premium-image-cashflow strong {
                display: block;
                color: #fff;
                font-weight: 700;
                line-height: 1.1;
                white-space: nowrap;
            }

            .premium-image-price strong {
                font-size: 21px;
            }

            .premium-image-cashflow {
                text-align: right;
            }

            .premium-image-cashflow strong {
                font-size: 16px;
            }

            .premium-business-content {
                display: flex;
                flex: 1;
                flex-direction: column;
                min-width: 0;
                padding: 13px;
            }

            .premium-business-meta {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 8px;
                min-height: 20px;
                margin-bottom: 5px;
            }

            .premium-business-type {
                max-width: 55%;
                overflow: hidden;
                color: #8b1747;
                font-size: 10px;
                font-weight: 700;
                line-height: 1.2;
                letter-spacing: .4px;
                text-overflow: ellipsis;
                text-transform: uppercase;
                white-space: nowrap;
            }

            .premium-business-category {
                max-width: 45%;
                overflow: hidden;
                padding: 4px 6px;
                border-radius: 3px;
                background: #f7edf2;
                color: #8b1747;
                font-size: 10px;
                font-weight: 600;
                line-height: 1.2;
                text-align: right;
                text-overflow: ellipsis;
                white-space: nowrap;
            }

            .premium-business-title {
                display: -webkit-box;
                min-height: 40px;
                margin: 0 0 8px;
                overflow: hidden;
                font-size: 18px;
                font-weight: 700;
                line-height: 1.25;
                -webkit-box-orient: vertical;
                -webkit-line-clamp: 2;
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
                gap: 8px;
                min-width: 0;
                margin-bottom: 12px;
                color: #444;
                font-size: 13px;
                line-height: 1.3;
            }

            .premium-location-icon {
                display: inline-flex;
                flex: 0 0 30px;
                align-items: center;
                justify-content: center;
                width: 30px;
                height: 30px;
                border-radius: 50%;
                background: #f8edf2;
                color: #8b1747;
                font-size: 13px;
            }

            .premium-location-text {
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }

            .premium-financial-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                overflow: hidden;
                border: 1px solid #ededed;
                border-radius: 7px;
                background: #fff;
            }

            .premium-financial-item {
                display: flex;
                align-items: center;
                gap: 7px;
                min-width: 0;
                padding: 9px 7px;
                border-right: 1px solid #ededed;
                border-bottom: 1px solid #ededed;
            }

            .premium-financial-item:nth-child(2n) {
                border-right: 0;
            }

            .premium-financial-item:last-child {
                border-bottom: 0;
            }

            .premium-financial-icon {
                display: flex;
                flex: 0 0 30px;
                align-items: center;
                justify-content: center;
                width: 30px;
                height: 30px;
                border-radius: 5px;
                background: #f8edf2;
                color: #8b1747;
                font-size: 13px;
            }

            .premium-financial-data {
                min-width: 0;
                overflow: hidden;
            }

            .premium-financial-data span,
            .premium-financial-data strong {
                display: block;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }

            .premium-financial-data span {
                margin-bottom: 3px;
                color: #555;
                font-size: 10px;
                font-weight: 500;
                line-height: 1.2;
            }

            .premium-financial-data strong {
                color: #292929;
                font-size: 11px;
                font-weight: 700;
                line-height: 1.2;
            }

            .premium-sde-item {
                background: #faf3f6;
            }

            .premium-sde-item .premium-financial-icon {
                background: #8b1747;
                color: #fff;
            }

            .premium-sde-item .premium-financial-data strong {
                color: #8b1747;
            }

            .premium-card-footer {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 8px;
                margin-top: auto;
                padding-top: 12px;
                border-top: 1px solid #eee;
            }

            .premium-opportunity-label {
                display: flex;
                align-items: center;
                gap: 5px;
                min-width: 0;
                color: #444;
                font-size: 10px;
                line-height: 1.2;
            }

            .premium-opportunity-label i {
                color: #8b1747;
                font-size: 10px;
            }

            .premium-view-button {
                display: inline-flex;
                flex-shrink: 0;
                align-items: center;
                justify-content: center;
                gap: 6px;
                min-height: 32px;
                padding: 0 10px;
                border-radius: 4px;
                background: #8b1747;
                color: #fff !important;
                font-size: 11px;
                font-weight: 600;
                line-height: 1;
                text-decoration: none !important;
                white-space: nowrap;
                transition: background .2s ease, transform .2s ease;
            }

            .premium-view-button:hover {
                transform: translateY(-1px);
                background: #6d1037;
            }

            .premium-view-button i {
                font-size: 9px;
                transition: transform .2s ease;
            }

            .premium-view-button:hover i {
                transform: translateX(3px);
            }

            .listing-pagination {
                display: flex;
                justify-content: flex-end;
                margin-top: 30px;
            }

            @media (max-width: 991.98px) {
                .business-listings-container {
                    padding: 24px;
                }

                .premium-business-image {
                    height: 175px;
                }

                .premium-image-price strong {
                    font-size: 19px;
                }

                .premium-image-cashflow strong {
                    font-size: 14px;
                }
            }

            @media (max-width: 575.98px) {
                .business-listings-section {
                    padding: 16px 0;
                }

                .business-listings-container {
                    padding: 18px 14px;
                }

                .business-listings-header h1 {
                    font-size: 24px;
                }

                .premium-business-image {
                    height: 200px;
                }

                .premium-business-content {
                    padding: 13px;
                }
            }
        </style>
    @endsection
