@extends('frontend.layout.master')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-container py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active"><a href="#">Business Listing</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- Main Section -->
<section class="main-section our_services" style="background-color: #F8F8F8;">
    <div class="container py-5 container-padding" style="background-color: #FFFFFF; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
        <!-- Heading and Description -->
        <div class="text-center mb-5">
            <h1 class="fw-bold">Business Listings</h1>
        </div>
        <hr class="pursuit_hr mb-5">
        <div class="row agent_search mb-5">
            <div class="col-md-12">
                <form action="{{route('business.listings')}}" method="get" class="">
                    <input type="text" class="form-control" placeholder="Find Listing" name="query" value="{{ request('query') }}" required="">
                    <button type="submit">Search Listing</button>
                </form>
            </div>
        </div>
        <div class="text-center mb-5">
            <h1 class="fw-bold ebb_offer">EBB's Strength is Our Brokers</h1>
            <p class="text-muted ser_content">Our team of professionals was recruited for their knowledge and qualified service orientation. The passion of our people is critical to our success. Together we share a common set of values that are rooted in integrity, professionalism and excellence.</p>
        </div>
        
        <div class="row px-5 mt-5">
            @forelse($listings as $listing)
            <div class="col-md-4 mb-5">
                <div class="card-container">
                    <div class="card shadow-sm" style="width: 18rem;">
                        @if(!empty($listing->imagepath))
                        <a href="{{route('view.business.listing',$listing->ListingID)}}"><img src="{{ asset('assets/uploads/images/' . $listing->imagepath) }}" class="card-img-top" alt="{{ $listing->City }}, {{ $listing->State }}"></a>
                        @else
                        <a href="{{route('view.business.listing',$listing->ListingID)}}"><img src="{{ asset('assets/images/business_image.jpg') }}" class="card-img-top" alt="{{ $listing->City }}, {{ $listing->State }}"></a>
                        @endif
                        <div class="card-body text-center">
                        <a href="{{route('view.business.listing',$listing->ListingID)}}"><h5 class="card-title card-title-slider">{{ $listing->City }}, {{ $listing->State }}</h5></a>
                            <p class="card-text mb-0">List Price: ${{ number_format($listing->ListPrice ?? 0, 2) }}</p>
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
</section>
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

    .text-gold {
        color: #333333;
    }

    .fw-bold {
        font-weight: 700;
    }

    .main-section {
        background-color: #fff;
    }

    .text-muted {
        color: #7F8C8D;
    }

    .icon {
        font-size: 1.2em;
    }

    .list-unstyled li {
        margin-bottom: 10px;
    }

    .img-fluid {
        max-width: 100%;
        height: 289px;
        ;
        border-radius: 8px;
    }

    .breadcrumb {
        background: transparent;
    }

    /* Only change icon color to purple, leave text color unaffected */
    .icon-purple {
        color: #800080;
        /* Purple color for the icon */
    }

    .our_services_sec h3 {
        padding: 20px 0;
        font-size: 25px;
    }

    .our_services h1 {
        font-size: 25px;
    }

    h1.fw-bold.ebb_offer {
        margin-bottom: 20px;
    }

    p.text-muted.ser_content {
        margin: 0;
        line-height: 25px;
    }

    .agent-info {
        padding: 15px;
        height: 120px;
    }

    .contact_agent {
        text-align: center;
        margin-top: 15px;
    }

    a.agent_btn {
        border: 1px solid #806132;
        color: #806132;
        padding: 10px 80px;
        text-decoration: none;
        font-size: 20px;
        font-weight: bold;
    }

    .agent-info .agent-image {
        border-radius: 0px;
        object-fit: cover;
        margin-right: 15px;
    }

    a.see_all_agent {
        border: 1px solid #7F2149;
        background-color: #7F2149;
        color: #ffffff;
        padding: 10px 30px;
        text-decoration: none;
        font-size: 16px;
        font-weight: 500;
    }

    .see_agent {
        margin-top: 100px;
        text-align: center;
    }
    .agent_search button {
    background-color: #7F2149;
    font-size: 16px;
    line-height: 24px;
    border: none;
    color: white;
    padding: 10px 20px;
    border-radius: 0px;
}
.agent_search input.form-control {
    width: 85%;
    display: inline-block;
    height: 45px;
    border: 1px solid #B3B3B3;
}
a {
        text-decoration: none;
    }
</style>
@endsection