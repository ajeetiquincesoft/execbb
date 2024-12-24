@extends('frontend.layout.master')
@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-container py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active"><a href="#">Search</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- About us page no-14 HTML-->
<div class="container my-7">
    <div class="content-box">
        <div class="row">
            <div class="about_EBB">
                <h5 class="main-heading">Search</h5>
            </div>
        </div>
        <div class="row px-5 mt-5">
            @forelse($listings as $listing)
            <div class="col-md-4 mb-5">
                <div class="card-container">
                    <div class="card shadow-sm" style="width: 18rem;">
                        <img src="{{ asset('assets/uploads/images/' . $listing->imagepath) }}" class="card-img-top" alt="{{ $listing->City }}, {{ $listing->State }}">
                        <div class="card-body text-center">
                            <h5 class="card-title card-title-slider">{{ $listing->City }}, {{ $listing->State }}</h5>
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

    .content-box {
        background-color: #FFFFFF;
        padding: 30px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .main-heading {
        font-size: 30px;
        font-weight: bold;
        font-family: Urbanist;
        margin-bottom: 20px;
        color: #000;
        border-bottom: 1px solid #B3B3B3;
        padding-bottom: 33px;
        text-align: center;
    }
</style>
@endsection