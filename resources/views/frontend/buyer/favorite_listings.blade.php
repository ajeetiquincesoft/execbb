@extends('frontend.layout.buyer-master')
@section('content')
<div class="favorite-container">
    <h2  class="text-center mb-2">Your Favorite Listings</h2>
    <p  class="text-center mb-5">You can check your Favorite Listings information below.</p>
    <div class="row">
        @foreach($favorites as $listing)
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-light">
                @if(!empty($listing->favoriteListing->imagepath))
                <img src="{{asset('assets/uploads/images/'. $listing->favoriteListing->imagepath)}}" alt="" class="card-img-top">
                @else
                <img src="{{ asset('assets/images/business_image.jpg') }}" alt="" class="card-img-top">
                @endif
                <div class="card-body fav_listing">
                    <h5 class="card-title">{{ $listing->favoriteListing->City }}, {{ $listing->favoriteListing->State }}</h5>
                    <p class="card-text mb-0">List Price: ${{ number_format($listing->favoriteListing->ListPrice ?? 0, 2) }}</p>
                    <p class="card-text">Down Pay: ${{ number_format($listing->favoriteListing->DownPay ?? 0, 2) }}</p>

                    <div class="d-flex justify-content-between align-items-center">
                        <form action="{{ route('buyer.favorites.remove', $listing->favoriteListing->ListingID) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-heart-broken"></i> Remove from Favorites
                            </button>
                        </form>

                        <a href="{{ route('view.business.listing', $listing->favoriteListing->ListingID) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-eye"></i> View Listing
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div id="pagination" class="d-flex justify-content-end">
            {{ $favorites->appends(request()->query())->links('vendor.pagination.custom') }}
        </div>
</div>
<style>
    .fav_listing h5, .fav_listing p{
        text-align: center;
    }
    </style>
@endsection