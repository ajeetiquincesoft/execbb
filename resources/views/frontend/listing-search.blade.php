@extends('frontend.layout.master')
@section('content')
    <!-- Breadcrumb Section -->
    <div class="breadcrumb-container py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="#">Search</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- About us page no-14 HTML-->
    <div class="container my-7">
        <div class="content-box">
            <!-- <div class="row agent_search mb-5">
                            <div class="col-md-12">
                                <form action="{{ route('business.listing.search') }}" method="get" class="">
                                    <input type="text" class="form-control" placeholder="Find Listing" name="query" value="{{ request('query') }}" required="">
                                    <button type="submit">Search Listing</button>
                                </form>
                            </div>
                        </div> -->
            <form action="{{ route('business.listing.search') }}" method="get" class="">
                <div class="row lis_search mb-5">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="form-group">
                            <select class="form-control" id="industry" name="industry">
                                <option value="">Industry</option>
                                @foreach ($categoryData as $category)
                                    <option value="{{ $category->CategoryID }}"
                                        {{ request('industry') == $category->CategoryID ? 'selected' : '' }}>
                                        {{ $category->BusinessCategory }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Second Column -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="form-group">
                            <select class="form-control" id="state" name="state">
                                <option value="">State</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->State }}"
                                        {{ request('state') == $state->State ? 'selected' : '' }}>{{ $state->StateName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Find Listing" name="query"
                                value="{{ request('query') }}">
                        </div>

                    </div>
                    <div class="col-12 col-sm-6 col-md-2 d-md-flex align-items-end lsbtn">
                        <button type="submit" name="lis_search">Search</button>
                    </div>
                </div>
            </form>
            <div class="row mt-5 bis_search">
                @forelse($listings as $listing)
                    <div class="col-12 col-sm-6 col-md-4 mb-5">
                        <div class="card-container">
                            <div class="card shadow-sm">
                                @if (!empty($listing->imagepath))
                                    <a href="{{ route('view.business.listing', $listing->ListingID) }}"><img
                                            src="{{ asset('assets/uploads/images/' . $listing->imagepath) }}"
                                            class="card-img-top" alt="{{ $listing->City }}, {{ $listing->State }}"></a>
                                @else
                                    <a href="{{ route('view.business.listing', $listing->ListingID) }}"><img
                                            src="{{ asset('assets/images/business_image.jpg') }}" class="card-img-top"
                                            alt="{{ $listing->City }}, {{ $listing->State }}"></a>
                                @endif
                                <div class="card-body text-center">
                                    <a href="{{ route('view.business.listing', $listing->ListingID) }}">
                                        <h5 class="card-title card-title-slider">{{ $listing->City }},
                                            {{ $listing->State }}</h5>
                                    </a>
                                    <p class="card-text mb-0">List Price: ${{ number_format($listing->ListPrice ?? 0, 2) }}
                                    </p>
                                    <p class="card-text">Down Pay: ${{ number_format($listing->DownPay ?? 0, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <span>No result found!</span>
                @endforelse
            </div>
            <div id="pagination" class="d-flex justify-content-end">
                {{ $listings->appends(request()->query())->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
    <style>
        .lis_search button {
            background-color: #7F2149;
            font-size: 16px;
            line-height: 24px;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 0px;
            width: 100%;
        }

        .lis_search .form-control {
            width: 100%;
            display: inline-block;
            height: 45px;
            border: 1px solid #B3B3B3;
        }

        .bis_search a {
            text-decoration: none;
        }
    </style>
@endsection
